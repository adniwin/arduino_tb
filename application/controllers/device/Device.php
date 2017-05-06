<?php

class device extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('data_model');
        $this->load->library(array('curl', 'session', 'email'));
        $this->load->helper(array('form', 'url', 'jwt_helper', 'rest_response_helper', 'key_helper', 'send_mail_helper', 'client_access_helper'));
        $this->data = [];
    }

    public function add()
    {
        $suhu = $this->input->post('suhu');
        $kelembapan = $this->input->post('kelembapan');
        $cahaya = $this->input->post('cahaya');
        $data = array(
            "suhu" => $suhu,
            "kelembapan" => $kelembapan,
            "cahaya" => $cahaya,
        );
        $dest_table = 'arduino';
        $add = $this->data_model->add($data, $dest_table);
        if ($add['response'] == OK_STATUS) {
            echo json_encode(response_success());
        } else {
            echo json_encode(response_fail());
        }
    }
}
