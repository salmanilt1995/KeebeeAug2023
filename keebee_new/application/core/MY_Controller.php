<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class My_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('api/User_model');
        $this->load->model('common/Common_model');
        
    }

    public function getValue($value) {
        return $this->input->post($value);
    }
	

    public function getucFirst($value) {
        $getName = ucfirst(str_replace('_', ' ', $value));
        return $getName;
    }

    public function Validator($value) {
        if (empty($this->getValue($value)) || $this->getValue($value) == "") {
            $getName = $this->getucFirst($value);
            $this->error_response_body($getName . ' ' . ERR_INVALID_PARAMETER);
        } else {
            return $this->getValue($value);
        }
    }

    public function error_response_body($message) {
        header('Content-Type: application/json');
        $data['success'] = False;
        $data['msg'] = $message;
        echo json_encode($data);
        exit;
    }
	
	/* Error Message for social login*/
	public function error_social_response_body($message) {
        header('Content-Type: application/json');
        $data['success'] = False;
        $data['available'] = False;
        $data['msg'] = $message;
        echo json_encode($data);
        exit;
    }
	/* Sucess Message for social login*/
	public function success_social_response_body($message, $key = false, $array = array()) {
        header('Content-Type: application/json');
        $data['success'] = TRUE;
        $data['available'] = TRUE;
        $data['msg'] = $message;
        if ($key) {
            foreach ($array as $keys => $value) {
                $data[$keys] = $value;
            }
        }
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
        exit;
    }
	

    public function success_response_body($message, $key = false, $array = array()) {
        header('Content-Type: application/json');
        $data['success'] = TRUE;
        $data['msg'] = $message;
        if ($key) {
            foreach ($array as $keys => $value) {
                $data[$keys] = $value;
            }
        }
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
        exit;
    }
	
	
	
	public function generateRandomNumber($val) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $val; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
