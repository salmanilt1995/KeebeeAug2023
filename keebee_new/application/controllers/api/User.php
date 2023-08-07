<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends My_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('common/Common_model');
        $this->load->model('api/User_model');
    }


    public function login()
    {
        $username = $this->Validator('username');
        $password = md5($this->Validator('password'));
        $check = $this->Common_model->getDataByIdMulti('tbl_user', 'username', $username, 'password', $password);

        if (!empty($check)) {
            $this->success_response_body('Login Successfully', true, array('data' => $check));
        } else {
            $this->error_response_body('Incorrect Credential!');
        }
    }

    public function clientList()
    {
        $user_id = $this->Validator('user_id');
        $client_id = $this->getValue('client_id');
        $page_id = $this->getValue('page_id');
        $search = $this->getValue('search');



        if ($client_id == '') {
            $totalRec = count((array) $this->Common_model->checkFieldUniqueData('tbl_client', 'user_id', $user_id));


            $total_pages = 0;
            if ($totalRec > 0) {
                $total_pages = ceil($totalRec / ITEM_PER_PAGE);
            }

            $data['page'] = ($page_id) ? $page_id : 1;

            $data['limit'] = ITEM_PER_PAGE;
            $data['offset'] = ($data['page'] - 1) * ITEM_PER_PAGE;

            $list = $this->User_model->getClientData($user_id, $data['offset'], $search);
        } else {
            $list = $this->Common_model->getDataByIdMulti('tbl_client', 'user_id', $user_id, 'client_id', $client_id);
        }




        if (!empty($list)) {
            $this->success_response_body(
                'Client list get Successfully',
                true,
                array(
                    'count' => $totalRec,
                    'items_per_page' => (int) ITEM_PER_PAGE,
                    'current_page' => (int) $page_id,
                    'total_pages' => $total_pages,
                    'data' => $list
                )
            );
        } else {
            $this->error_response_body('Recode not found!');
        }
    }

    public function addClient()
    {
        $user_id = $this->Validator('user_id');
        $billing_name = $this->Validator('billing_name');
        $contact_name = $this->Validator('contact_name');
        $mailing_address = $this->Validator('mailing_address');
        $direction = $this->Validator('direction');
        $phone = $this->Validator('phone');
        $second_phone = $this->getValue('second_phone');
        $area = $this->Validator('area');
        $note = $this->Validator('note');
        $shitlist = $this->Validator('shitlist');
        $prepay = $this->Validator('prepay');
        $call_first = $this->Validator('call_first');
        $warning = $this->Validator('warning');
        $client_id = $this->getValue('client_id');

        if ($client_id == '') {
            $insert = $this->Common_model->insertData('tbl_client', $_POST);
        } else {
            $insert = $this->Common_model->updateData('tbl_client', $_POST, 'client_id', $client_id);
        }

        if (!empty($insert)) {
            $_POST['client_id'] = $insert;
            if ($client_id == '') {
                $this->success_response_body('Client added Successfully', true, array('data' => $_POST));
            } else {
                $this->success_response_body('Client updated Successfully', true, array('data' => $_POST));
            }
        } else {
            $this->error_response_body(ERR_DATA_PROCESSING_ERROR);
        }
    }


    public function addTank()
    {
        $user_id = $this->Validator('user_id');
        $client_id = $this->Validator('client_id');
        $billing_name = $this->Validator('billing_name');
        $tank_type = $this->Validator('tank_type');
        $ownership = $this->Validator('ownership');
        $tank_size = $this->Validator('tank_size');
        $unit = $this->Validator('unit');
        $description = $this->Validator('description');
        $tank_id = $this->getValue('tank_id');


        if ($tank_id == '') {
            $insert = $this->Common_model->insertData('tbl_tank', $_POST);
        } else {
            $insert = $this->Common_model->updateData('tbl_tank', $_POST, 'tank_id', $tank_id);
        }

        if (!empty($insert)) {
            $_POST['tank_id'] = $insert;
            if ($tank_id == '') {
                $this->success_response_body('Tank added Successfully', true, array('data' => $_POST));
            } else {
                $this->success_response_body('Tank updated Successfully', true, array('data' => $_POST));
            }
        } else {
            $this->error_response_body(ERR_DATA_PROCESSING_ERROR);
        }
    }


    public function tankInfo()
    {

        $tank_id = $this->Validator('tank_id');
        $client_id = $this->Validator('client_id');

        $list = $this->Common_model->getDataByIdMulti('tbl_tank', 'client_id', $client_id, 'tank_id', $tank_id);
        if (!empty($list)) {
            $data['tank'] = $list;
 $fills = array();
            $fills = $this->Common_model->getActiveData('tbl_client_tank_fill', 'tank_id', $tank_id);
            if (!empty($fills)) {
                foreach ($fills  as $key => $value) {
                  
                    $fills[$key]->lpd = '';
                    $fills[$key]->dlf = '';
                    $fills[$key]->p20 = '';
                    $fills[$key]->po = '';
                }
            }

            $data['fills'] = $fills;

            $this->success_response_body(
                'Tank info get Successfully',
                true,
                array(
                    'data' => $data
                )
            );
        } else {
            $this->error_response_body('Recode not found!');
        }
    }

    public function addFill()
    {
        $user_id = $this->Validator('user_id');
        $client_id = $this->Validator('client_id');
        $tank_id = $this->Validator('tank_id');
        $percentage = $this->Validator('percentage');
        $volume = $this->Validator('volume');
        $price = $this->Validator('price');
        $calendar = $this->Validator('calendar');
        $note = $this->Validator('note');
        $fill_id  = $this->getValue('fill_id');


        if ($tank_id == '') {
            $insert = $this->Common_model->insertData('tbl_client_tank_fill', $_POST);
        } else {
            $insert = $this->Common_model->updateData('tbl_client_tank_fill', $_POST, 'fill_id', $fill_id);
        }

        if (!empty($insert)) {
            $_POST['fill_id'] = $insert;
            if ($fill_id == '') {
                $this->success_response_body('Fill added Successfully', true, array('data' => $_POST));
            } else {
                $this->success_response_body('Fill updated Successfully', true, array('data' => $_POST));
            }
        } else {
            $this->error_response_body(ERR_DATA_PROCESSING_ERROR);
        }
    }
}
