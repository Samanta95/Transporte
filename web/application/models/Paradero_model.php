<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Paradero_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get paradero by id
     */
    function get_paradero($id)
    {
        return $this->db->get_where('paradero',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all paradero
     */
    function get_all_paradero()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('paradero')->result_array();
    }
        
    /*
     * function to add new paradero
     */
    function add_paradero($params)
    {
        $this->db->insert('paradero',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update paradero
     */
    function update_paradero($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('paradero',$params);
    }
    
    /*
     * function to delete paradero
     */
    function delete_paradero($id)
    {
        return $this->db->delete('paradero',array('id'=>$id));
    }
}