<?php
/**
 * Created by PhpStorm.
 * User: supriyo
 * Date: 13-12-2017
 * Time: 20:49
 */

class CallbackFunction extends CI_Controller{


    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('CallbackFunction_model');
        $this->load->helper('general');
    }
    public function addedit($id=0){

        $data=array();
       if($id != ''){
           if($id > 0)
            $data['data']=$this->CallbackFunction_model->getData($id);



            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                $field=$this->input->post();
                $id=$this->input->post('trip_id');

                $checkDuplicate= "{$id},{$field['data']['trip_name']}";
                $this->form_validation->set_rules('data[kidpool_trip_id]','Kid Pool Trip ID','required');
                $this->form_validation->set_rules('data[trip_name]','Trip Name','required|trim|callback_check_duplicate[{$checkDuplicate  }]');



                if ($this->form_validation->run() == TRUE){
                    $this->CallbackFunction_model->saveData($field,$id);

                }

            }
            $this->load->view('callbackFunction',$data);
       } else{
           die('invalid request');
       }


    }

    public  function check_duplicate($data){

        list($id,$trip_name)=explode(',',$data);
        $result = $this->CallbackFunction_model->check_duplicate($id, $trip_name);
        if($result == 0)
            $response = true;
        else {
                $this->form_validation->set_message('check_duplicate', 'Trip Name must be unique');
            $response = false;
        }
        return $response;
    }


}

?>