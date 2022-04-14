<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Pendaftar extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pendaftar_model', 'pendaftar');
    }
    public function index_get()
    {
        $id = $this->get('id');

        if ($id === NULL)
        {
            $pendaftar = $this->pendaftar->getPendaftar();
        } 
        else 
        {
            $pendaftar = $this->pendaftar->getPendaftar($id);
        }

        if ($pendaftar) 
        {
            $this->response($pendaftar, REST_Controller::HTTP_OK);
        } 
        else 
        {
            $this->response([
                'status' => FALSE,
                'message' => 'Data pendaftar tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'status' => $this->put('status')
        ];

        if ($this->pendaftar->updatePendaftar($data,$id) > 0)
        {
            $this->response($data,200); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'Gagal mengubah data pendaftar'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
    }

}