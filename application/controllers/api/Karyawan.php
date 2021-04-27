<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Karyawan extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_data');
    }


    public function index_get()
    {
        $id = $this->get('id');
        if ($id == null) {

            $karyawan = $this->M_data->getData();
        } else {
            $karyawan = $this->M_data->getData($id);
        }

        if ($karyawan) {
            $this->response([
                'status' => true,
                'data' => $karyawan
            ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Id not found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function index_delete()
    {
        # code...
        $id = $this->delete('id');

        if ($id === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->M_data->deleteAPI($id) > 0) {
                # ok
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'deleted.'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'id not found!'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'nik' => $this->post('nik'),
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'dept' => $this->post('dept')
        ];

        if ($this->M_data->insert($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'new karyawan has bee created.'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'failed to create new data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nik' => $this->put('nik'),
            'nama' => $this->put('nama'),
            'email' => $this->put('email'),
            'dept' => $this->put('dept')
        ];
        if ($this->M_data->update($id, $data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'update karyawan has bee updated.'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'failed to update new data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}

/* End of file Karyawna.php */
