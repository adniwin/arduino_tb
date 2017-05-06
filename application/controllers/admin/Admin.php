<?php

class admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('data_model');
        $this->load->library(array('curl', 'session', 'datatables'));
        $this->load->helper(array('form', 'url', 'jwt_helper', 'rest_response_helper', 'key_helper', 'image_process_helper', 'file'));
        $this->data = [] ;
        $this->checkauth();
    }

    private function get_values($table_name, $order_by, $limit = null)
    {
        $dest_table_as = $table_name;
        $select_values = array('*');
        $params = new stdClass();
        $params->dest_table_as = $dest_table_as;
        $params->select_values = $select_values;
        $params->order_by = array($order_by);
        if (isset($limit)) {
            $params->limit = $limit;
        }
        $get = $this->data_model->get($params);
        if ($get['response'] == OK_STATUS) {
            if (!empty($get['results'])) {
                if (isset($limit)) {
                    if ($limit == '1') {
                        $total = $get["results"][0];
                    } else {
                        $total = $get["results"];
                    }
                } else {
                    $total = $get["results"];
                }
            } else {
                $total = [];
            }
        } else {
            $total = [];
        }
        return $total;
    }

    public function checkauth()
    {
        if ($this->session->userdata('web_token') == "") {
            redirect('login');
            exit();
        } else {
            $decode = JWT::decode($this->session->userdata('web_token'), SERVER_SECRET_KEY, JWT_ALGHORITMA);
            if ($decode->response != OK_STATUS) {
                redirect('login');
                exit;
            } else {
                if ($decode->data->role != "A") {
                    redirect('login');
                    exit;
                }
            }
        }
    }

    public function dashboard()
    {
        $this->data['active_page'] = "dashboard";
        $this->data['title_page'] = "Dashboard";
        $order_by = array("order_column" => "id", "order_type" => "DESC");
        $this->data['last_value']= $this->get_values('arduino', $order_by, '1');
        $this->load->view('admin/index', $this->data);
    }

    public function data_graphic()
    {
        $uri = $this->uri->segment(3);
        $params = new stdClass();
        $params->dest_table_as = 'arduino as s';
        $order_by = array("order_column" => "id", "order_type" => "DESC");
        $get = $this->get_values('arduino', $order_by, '15');
        foreach ($get as $row) {
            $suhu[] = array($row->waktu, $row->suhu);
            $lembap[] = array($row->waktu, $row->kelembapan);
            $cahaya[] = array($row->waktu, $row->cahaya);
        }
        $data = array("suhu" => $suhu, "lembab" => $lembap, "cahaya" => $cahaya);
        echo json_encode($data, JSON_NUMERIC_CHECK);
    }


    public function data()
    {
        $this->data['active_page'] = "data";
        $this->data['title_page'] = "Data";
        $order_by = array("order_column" => "id", "order_type" => "DESC");
        $this->data['last_predict'] = $this->get_values('prediction_history', $order_by, '1');
        $this->load->view('admin/graphic', $this->data);
    }

    public function history()
    {
        $this->data['active_page'] = "history";
        $this->data['title_page'] = "History";
        $order_by = array("order_column" => "id", "order_type" => "DESC");
        $this->data['sensor_values']= $this->get_values('arduino', $order_by);
        $this->data['prediction_values'] = $this->get_values('prediction_history', $order_by);
        $this->load->view('admin/history', $this->data);
    }

    public function notfound()
    {
        $this->data['active_page'] = "notfound";
        $this->data['title_page'] = "Tidak ditemukan";
        $this->load->view('admin/404', $this->data);
    }

    public function predict()
    {
        $params = new stdClass();
        $this->data['active_page'] = "history";
        $this->data['title_page'] = "History";
        $order_by = array("order_column" => "id", "order_type" => "DESC");
        $res = $this->get_values('arduino', $order_by, '30');
        $suhu = [];
        $lembab = [];
        $cahaya = [];

        foreach ($res as $row) {
            // $data[] = $row;
            array_push($suhu, $row->suhu);
            array_push($lembab, $row->kelembapan);
            array_push($cahaya, $row->cahaya);
        }

        $suhu_limit = count($suhu);
        $lembab_limit = count($lembab);
        $cahaya_limit = count($cahaya);
        $rata_suhu = ceil(array_sum($suhu) / $suhu_limit);
        $rata_lembab = ceil(array_sum($lembab) / $lembab_limit);
        $rata_cahaya = ceil(array_sum($cahaya) / $cahaya_limit);
        switch ($rata_suhu) {
            case ($rata_suhu <= 22):
//                                $status_suhu = "dingin";
                $status_suhu = "Cold";
                break;
            case ($rata_suhu > 22 and $rata_suhu <= 35):
                $status_suhu = "Normal";
                break;
            case ($rata_suhu > 35):
//                $status_suhu = "panas";
                $status_suhu = "Hot";
                break;
            default:
                echo "Not allowed 0 as value";
                break;
        }
        switch ($rata_lembab) {
            case ($rata_lembab <= 20):
//                $status_lembab = "kering";
                $status_lembab = "Dry";
                break;
            case ($rata_lembab > 20 and $rata_lembab <= 70):
                $status_lembab = "Humid";
                break;
            case ($rata_lembab > 70):
                $status_lembab = "Very Humid";
                break;
            default:
                echo "Not allowed 0 as value";
                break;
        }
        switch ($rata_cahaya) {
            case ($rata_cahaya <= 1015):
//                $status_cahaya = "mendung";
                $status_cahaya = "Overcast";
                break;
            case ($rata_cahaya > 1015 and $rata_cahaya <= 1017):
//                $status_cahaya = "berawan";
                $status_cahaya = "Cloudy";
                break;
            case ($rata_cahaya > 1017):
//                $status_cahaya = "terang";
                $status_cahaya = "Sunny";
                break;
            default:
                echo "Not allowed 0 as value";
                break;
        }


        /////////////////////////////////// tahap 1
        //tahap 1,1,1
        if ($rata_suhu <= 22 and $rata_lembab <= 20 and $rata_cahaya <= 1015) {
            //            $status = "mendung kemungkinan hujan";
            $status = "Overcast going to rain";
        }
        //tahap 1,1,2
        elseif ($rata_suhu <= 22 and $rata_lembab <= 20 and ($rata_cahaya > 1015 and $rata_cahaya <= 1017)) {
            //            $status = "cerah";
            $status = "Sunny";
        }
        //tahap 1,1,3
        elseif ($rata_suhu <= 22 and $rata_lembab <= 20 and $rata_cahaya > 1017) {
            $status = "Sunny";
        }
        //tahap 1,2,1
        elseif ($rata_suhu <= 22 and ($rata_lembab > 20 and $rata_lembab <= 70) and $rata_cahaya <= 1015) {
            //            $status = "hujan";
            $status = "Rainy";
        }
        //tahap 1,2,2
        elseif ($rata_suhu <= 22 and ($rata_lembab > 20 and $rata_lembab <= 70) and ($rata_cahaya > 1015 and $rata_cahaya <= 1017)) {
            //            $status = "hujan";
            $status = "Rainy";
        }
        //tahap 1,2,3
        elseif ($rata_suhu <= 22 and ($rata_lembab > 20 and $rata_lembab <= 70) and $rata_cahaya > 1017) {
            //            $status = "cerah";
            $status = "Sunny";
        }
        //tahap 1,3,1
        elseif ($rata_suhu <= 22 and $rata_lembab > 70 and $rata_cahaya <= 1015) {
            //            $status = "hujan";
            $status = "Rainy";
        }
        //tahap 1,3,2
        elseif ($rata_suhu <= 22 and $rata_lembab > 70 and ($rata_cahaya > 1015 and $rata_cahaya <= 1017)) {
            //            $status = "hujan";
            $status = "Rainy";
        }
        //tahap 1,3,3
        elseif ($rata_suhu <= 22 and $rata_lembab > 70 and $rata_cahaya > 1017) {
            //            $status = "cerah";
            $status = "Sunny";
        }


        //////////////////////////////////// tahap 2
        //tahap 2,1,1
        elseif (($rata_suhu > 20 and $rata_suhu <= 35) and $rata_lembab <= 20 and $rata_cahaya <= 1015) {
            //            $status = "hujan";
            $status = "Rainy";
        }
        //tahap 2,2,1
        elseif (($rata_suhu > 20 and $rata_suhu <= 35) and ($rata_lembab > 20 and $rata_lembab <= 50) and $rata_cahaya <= 1015) {
            //            $status = "Berawan";
            $status = "Cloudy";
        }
        //tahap 2,3,1
        elseif (($rata_suhu > 20 and $rata_suhu <= 35) and $rata_lembab > 70 and $rata_cahaya <= 1015) {
            //            $status = "Kemungkinan Hujan";
            $status = "Going to Rain";
        }
        //tahap 2,1,2
        elseif (($rata_suhu > 20 and $rata_suhu <= 35) and $rata_lembab <= 20 and ($rata_cahaya > 1015 and $rata_cahaya <= 1017)) {
            //            $status = "Berawan";
            $status = "Cloudy";
        }
        //tahap 2,2,2
        elseif (($rata_suhu > 20 and $rata_suhu <= 35) and ($rata_lembab > 20 and $rata_lembab <= 50) and ($rata_cahaya > 800 and $rata_cahaya <= 1000)) {
            //            $status = "kemungkinan hujan";
            $status = "Going to Rain";
        }

        //tahap 2,3,2
        elseif (($rata_suhu > 22 and $rata_suhu <= 35) and $rata_lembab > 70 and ($rata_cahaya > 1015 and $rata_cahaya <= 1017)) {
            //            $status = "kemungkinan hujan";
            $status = "Going to Rain";
        }
        //tahap 2,1,3
        elseif (($rata_suhu > 22 and $rata_suhu <= 35) and $rata_lembab <= 20 and $rata_cahaya > 1017) {
            //            $status = "cerah";
            $status = "Sunny";
        }
        //tahap 2,2,3
        elseif (($rata_suhu > 22 and $rata_suhu <= 35) and ($rata_lembab > 20 and $rata_lembab <= 70) and $rata_cahaya > 1017) {
            //            $status = "cerah";
            $status = "Sunny";
        }
        //tahap 2,3,3
        elseif (($rata_suhu > 20 and $rata_suhu <= 35) and $rata_lembab > 70 and $rata_cahaya > 1000) {
            //            $status = "cerah";
            $status = "Sunny";
        }


        //////////////////////////////////// tahap 3
        //tahap 3,1,1
        elseif ($rata_suhu > 35 and $rata_lembab <= 20 and $rata_cahaya <= 1015) {
            //            $status = "berawan";
            $status = "Cloudy";
        }
        //tahap 3,2,1
        elseif ($rata_suhu > 35 and ($rata_lembab > 20 and $rata_lembab <= 70) and $rata_cahaya <= 1015) {
            //            $status = "hujan";
            $status = "Rainy";
        }
        //tahap 3,3,1
        elseif ($rata_suhu > 35 and $rata_lembab > 70 and $rata_cahaya <= 1015) {
            //            $status = "Hujan";
            $status = "Rainy";
        }
        //tahap 3,1,2
        elseif ($rata_suhu > 35 and $rata_lembab <= 20 and ($rata_cahaya > 1015 and $rata_cahaya <= 1017)) {
            //            $status = "cerah";
            $status = "Sunny";
        }
        //tahap 3,2,2
        elseif ($rata_suhu > 35 and ($rata_lembab > 20 and $rata_lembab <= 70) and ($rata_cahaya > 1015 and $rata_cahaya <= 1017)) {
            //            $status = "kemungkinan hujan";
            $status = "Going to Rain";
        }

        //tahap 3,3,2
        elseif ($rata_suhu > 35 and $rata_lembab > 70 and ($rata_cahaya > 1015 and $rata_cahaya <= 1017)) {
            //            $status = "hujan";
            $status = "Rain";
        }
        //tahap 3,1,3
        elseif ($rata_suhu > 35 and $rata_lembab <= 20 and $rata_cahaya > 1017) {
            //            $status = "cerah";
            $status = "Sunny";
        }
        //tahap 3,2,3
        elseif ($rata_suhu > 35 and ($rata_lembab > 20 and $rata_lembab <= 70) and $rata_cahaya > 1017) {
            //            $status = "berawan";
            $status = "Cloudy";
        }
        //tahap 3,3,3
        elseif ($rata_suhu > 35 and $rata_lembab > 70 and $rata_cahaya > 1017) {
            //            $status = "berawan";
            $status = "Cloudy";
        } else {
            //            $status = "data tidak tertaut";
            $status = "Data unlinked";
        }


        $suhu_array = array(
            $rata_suhu,
            $status_suhu
        );
        $lembab_array = array(
            $rata_lembab,
            $status_lembab
        );
        $cahaya_array = array(
            $rata_cahaya,
            $status_cahaya
        );
        $date = date('Y-m-d H:i:s');
        $day = date('l');
        $day_date = $day . ', ' . $date;
        $data = array(
            "temperature" => $rata_suhu,
            "humidity" => $rata_lembab,
            "light" => $rata_cahaya,
            "prediction" => $status,
            "time" => $day_date
        );
        $dest_table = 'prediction_history';
        $add = $this->data_model->add($data, $dest_table);
        if ($add['response'] == OK_STATUS) {
            echo json_encode($data);
        } else {
            echo response_fail();
        }
    }
}
