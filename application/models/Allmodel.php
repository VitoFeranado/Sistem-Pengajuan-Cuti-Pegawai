<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * @author : thonie
	**/
class Allmodel extends CI_Model {


	public function getAllData($table)
	{
		return $this->db->get($table);
	}

	public function getAllDataLimited($table,$offset,$limit)
	{
		return $this->db->get($table,$limit,$offset);
	}
	
	public function getSelectedData($table,$key,$value)
	{
		$this->db->where($key, $value); 
		return $this->db->get($table);
	}
	
	public function getSelectedDataMultiple($table,$data)
	{
		return $this->db->get_where($table, $data);
	}
	
	function deleteData($table,$data)
	{
		$this->db->delete($table, $data);
	}
	
	function updateData($table,$data,$field,$key)
	{
		$this->db->where($key,$field);
		$this->db->update($table,$data);
	}
	
	function updateDataMultiField($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	
	function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}
	function get_pendaftar($cond){
		$this->db->select("*");
		$this->db->from("detail_pendaftar");
		if($cond)$this->db->where($cond);
		return $this->db->get();		
	}

}