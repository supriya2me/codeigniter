<?php
/**
 * Created by PhpStorm.
 * User: supriyo
 * Date: 13-12-2017
 * Time: 20:54
 */

class CallbackFunction_model extends CI_Model{
    var $table=TABLE_TRIP;
    public function __construct()
    {
        parent::__construct();
    }

    public function getData($id=0){
        $result=array();
        if($id > 0)
        {
            $result=$this->db->get_where($this->table,array('trip_id'=>$id))->row();
        }
          return $result;
    }

    public function saveData($field=array(),$id=0){

        if($id > 0){
            $this->db->update($this->table, $field['data'], array('trip_id' => $id));
            return true;
        }
        else{
            $this->db->insert($this->table,$field['data']);
            return $this->db->insert_id();

        }
        return false;
    }
    function check_duplicate($id = '', $trip_name) {
        $this->db->where('trip_name', $trip_name);
        if($id) {
            $this->db->where_not_in('trip_id', $id);
        }
        return $this->db->get($this->table)->num_rows();
    }

}

?>