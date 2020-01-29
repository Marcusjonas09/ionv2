<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Courseflow extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Courseflow_model');
        date_default_timezone_set("Asia/Singapore");
    }

    public function suggest_what_to_petition()
    {
        $data['suggestion'] = $this->Courseflow_model->suggest_what_to_petition();
        echo json_encode($data);
    }

    public function suggested_petitions_available()
    {
        $data['suggested_available'] = $this->Courseflow_model->suggested_petitions_available();
        echo json_encode($data);
    }
}
