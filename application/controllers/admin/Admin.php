<?php

class admin extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> model('data_model');
		$this -> load -> library(array('curl', 'session', 'datatables'));
		$this -> load -> helper(array('form', 'url', 'jwt_helper', 'rest_response_helper', 'key_helper', 'image_process_helper', 'file'));
		$this -> data = [];
		$this -> checkauth();

	}

	private function get_last_value() {
		$dest_table_as = 'arduino as a';
		$select_values = array('*');
		$params = new stdClass();
		$params -> dest_table_as = $dest_table_as;
		$params -> select_values = $select_values;
		$params -> limit = '1';
		$get = $this -> data_model -> get($params);
		if ($get['response'] == OK_STATUS) {
			if (!empty($get['results'])) {
				$total = $get["results"][0];
			} else {
				$total = [];
			}
		} else {
			$total = [];
		}
		return $total;
	}

	public function checkauth() {
		if ($this -> session -> userdata('web_token') == "") {
			redirect('login');
			exit();
		} else {
			$decode = JWT::decode($this -> session -> userdata('web_token'), SERVER_SECRET_KEY, JWT_ALGHORITMA);
			if ($decode -> response != OK_STATUS) {
				redirect('login');
				exit ;
			} else {
				if ($decode -> data -> role != "A") {
					redirect('login');
					exit ;
				}
			}
		}
	}

	public function dashboard() {
		$this -> data['active_page'] = "dashboard";
		$this -> data['title_page'] = "Dashboard";
		$this -> data['last_value'] = $this -> get_last_value();
		//        $this->data['total_data'] = array(
		//            "kategori_properti" => $this->get_table_count('kategori_properti'),
		//            "properti" => $this->get_table_count('properti'),
		//            "artikel" => $this->get_table_count('artikel'),
		//            "iklan" => $this->get_table_count('iklan'),
		//            "developer" => $this->get_table_count('developer'),
		//            "portfolio" => $this->get_table_count('portfolio'),
		//        );
		$this -> load -> view('admin/index', $this -> data);
	}

	public function data_graphic() {
		$uri = $this -> uri -> segment(3);
		$params = new stdClass();
		$params -> dest_table_as = 'arduino as s';
		$params -> select_values = array('s.*');
		$params -> limit = '15';
		$order_by = array("order_column" => "s.id", "order_type" => "DESC");
		$params -> order_by = array($order_by);
		$get = $this -> data_model -> get($params);
		foreach ($get["results"] as $row) {
			$suhu[] = array($row -> waktu, $row -> suhu);
			$lembap[] = array($row -> waktu, $row -> kelembapan);
			$cahaya[] = array($row -> waktu, $row -> cahaya);
		}
		$data = array("suhu" => $suhu, "lembab" => $lembap, "cahaya" => $cahaya);
		echo json_encode($data, JSON_NUMERIC_CHECK);
	}

	public function data_table() {
		$this -> datatables -> select('*');
		$this -> datatables -> from('arduino');
		return print_r($this -> datatables -> generate());
	}

	public function graphic() {
		$this -> data['active_page'] = "graphic";
		$this -> data['title_page'] = "Graphic";
		$this -> load -> view('admin/graphic', $this -> data);
	}

	public function history() {
		$params = new stdClass();
		$this -> data['active_page'] = "history";
		$this -> data['title_page'] = "History";
		$params -> dest_table_as = 'arduino as s';
		$params -> select_values = array('s.*');
		$order_by = array("order_column" => "s.id", "order_type" => "DESC");
		$params -> order_by = array($order_by);
		$get = $this -> data_model -> get($params);
		$this -> data['record'] = $get['results'];
		//        print_r($this->data['record']);exit();
		$this -> load -> view('admin/history', $this -> data);
	}

	public function notfound() {
		$this -> data['active_page'] = "notfound";
		$this -> data['title_page'] = "Tidak ditemukan";
		$this -> load -> view('admin/404', $this -> data);
	}

}
