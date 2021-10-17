<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Client_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	/*
		return user
	*/
	public function getUser(){
		return $this->db->get('users')->result();
	}
	/*
		return country
	*/
	public function getCountry(){
		return $this->db->get('countries')->result();
	}
	/*
		return state
	*/
	public function getState($id){	
		return $this->db->select('s.*')
		                 ->from('states s')
		                 ->join('countries c','c.id = s.country_id')
		                 ->where('s.country_id',$id)
		                 ->get()
		                 ->result();
	}
	/*
		return city 
	*/
	public function getCity($id){
		return $this->db->select('c.*')
		                 ->from('cities c')
		                 ->join('states s','s.id = c.state_id')
		                 ->where('c.state_id',$id)
		                 ->get()
		                 ->result();
	} 
	/* 
		return all client details to dispaly list 
	*/
	public function getClient(){
		//$b_cat_id = "SELECT SUBSTRING(category_id, 1, 1) FROM client";
		$data = $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
		                 ->from('client b')
		                 ->join('countries c','c.id = b.country_id')
		                 ->join('states st','st.id = b.state_id')
		                 ->join('cities ct','ct.id = b.city_id')
		                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
		                 ->join('category ccat','ccat.category_id = b.category_id')
		                 ->get()
		                 ->result();
		return $data;
	}
	/* 
		return all client details to dispaly list 
	*/
	public function getFilteredClient($client_id, $category_id, $user_id, $status){
		if(!empty($client_id) && empty($category_id) && empty($user_id) && empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->where('b.client_type_id',1)
			                 ->where('b.client_id',$client_id)
			                 ->get()
			                 ->result();
		}
		elseif(empty($client_id) && !empty($category_id) && empty($user_id) && empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->where('b.client_type_id',1)
			                 ->like('b.category_id',$category_id)
			                 ->get()
			                 ->result();
		}
		elseif(empty($client_id) && empty($category_id) && !empty($user_id) && empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->where('b.client_type_id',1)
			                 ->like('b.responsible_person_id',$user_id)
			                 ->get()
			                 ->result();
		}
		elseif(empty($client_id) && empty($category_id) && empty($user_id) && !empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->where('b.client_status',$status)
			                 ->where('b.client_type_id',1)
			                 ->get()
			                 ->result();
		}
		elseif(!empty($client_id) && !empty($category_id) && empty($user_id) && empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->where('b.client_type_id',1)
			                 ->where('b.client_id',$client_id)
			                 ->like('b.category_id',$category_id)
			                 ->get()
			                 ->result();
		}
		elseif(!empty($client_id) && empty($category_id) && !empty($user_id) && empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->where('b.client_type_id',1)
			                 ->where('b.client_id',$client_id)
			                 ->like('b.responsible_person_id',$user_id)
			                 ->get()
			                 ->result();
		}
		elseif(!empty($client_id) && empty($category_id) && empty($user_id) && !empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->where('b.client_status',$status)
			                 ->where('b.client_type_id',1)
			                 ->where('b.client_id',$client_id)
			                 ->get()
			                 ->result();
		}
		elseif(empty($client_id) && !empty($category_id) && !empty($user_id) && empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->where('b.client_type_id',1)
			                 ->like('b.category_id',$category_id)
			                 ->like('b.responsible_person_id',$user_id)
			                 ->get()
			                 ->result();
		}
		elseif(empty($client_id) && !empty($category_id) && empty($user_id) && !empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->where('b.client_status',$status)
			                 ->where('b.client_type_id',1)
			                 ->like('b.category_id',$category_id)
			                 ->get()
			                 ->result();
		}
		elseif(empty($client_id) && empty($category_id) && !empty($user_id) && !empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->where('b.client_status',$status)
			                 ->where('b.client_type_id',1)
			                 ->like('b.responsible_person_id',$user_id)
			                 ->get()
			                 ->result();
		}
		elseif(!empty($client_id) && !empty($category_id) && !empty($user_id) && empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->where('b.client_id',$client_id)
			                 ->where('b.client_type_id',1)
			                 ->like('b.category_id',$category_id)
			                 ->like('b.responsible_person_id',$user_id)
			                 ->get()
			                 ->result();
		}
		elseif(!empty($client_id) && !empty($category_id) && empty($user_id) && !empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->where('b.client_id',$client_id)
			                 ->where('b.client_type_id',1)
			                 ->like('b.category_id',$category_id)
			                 ->where('b.client_status',$status)
			                 ->get()
			                 ->result();
		}
		elseif(empty($client_id) && !empty($category_id) && !empty($user_id) && !empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->where('b.client_type_id',1)
			                 ->like('b.category_id',$category_id)
			                 ->like('b.responsible_person_id',$user_id)
			                 ->where('b.client_status',$status)
			                 ->get()
			                 ->result();
		}
		elseif(!empty($client_id) && empty($category_id) && !empty($user_id) && !empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->where('b.client_id',$client_id)
			                 ->where('b.client_type_id',1)
			                 ->like('b.responsible_person_id',$user_id)
			                 ->where('b.client_status',$status)
			                 ->get()
			                 ->result();
		}

		elseif(empty($client_id) && empty($category_id) && empty($user_id) && empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->where('b.client_type_id',1)
			                 ->get()
			                 ->result();
		}
		else{
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->where('b.client_status',$status)
			                 ->where('b.client_type_id',1)
			                 ->where('b.client_id',$client_id)
			                 ->like('b.category_id',$category_id)
			                 ->like('b.responsible_person_id',$user_id)
			                 ->get()
			                 ->result();
		}
	}
	/* 
		return all client 2 details to dispaly list 
	*/
	public function getFilteredClient2($country_id, $category_id, $user_id, $status){
		if(!empty($country_id) && empty($category_id) && empty($user_id) && empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->group_start()
			                 ->where('b.client_type_id',2)
			                 ->or_where('b.client_type_id',3)
			                 ->or_where('b.client_type_id',4)
			                 ->group_end()
			                 ->where('b.country_id',$country_id)
			                 ->get()
			                 ->result();
		}
		elseif(empty($country_id) && !empty($category_id) && empty($user_id) && empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->group_start()
			                 ->where('b.client_type_id',2)
			                 ->or_where('b.client_type_id',3)
			                 ->or_where('b.client_type_id',4)
			                 ->group_end()
			                 ->like('b.category_id',$category_id)
			                 ->get()
			                 ->result();
		}
		elseif(empty($country_id) && empty($category_id) && !empty($user_id) && empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->group_start()
			                 ->where('b.client_type_id',2)
			                 ->or_where('b.client_type_id',3)
			                 ->or_where('b.client_type_id',4)
			                 ->group_end()
			                 ->like('b.responsible_person_id',$user_id)
			                 ->get()
			                 ->result();
		}
		elseif(empty($country_id) && empty($category_id) && empty($user_id) && !empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->where('b.client_status',$status)
			                 ->group_start()
			                 ->where('b.client_type_id',2)
			                 ->or_where('b.client_type_id',3)
			                 ->or_where('b.client_type_id',4)
			                 ->group_end()
			                 ->get()
			                 ->result();
		}
		elseif(empty($country_id) && empty($category_id) && empty($user_id) && empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->group_start()
			                 ->where('b.client_type_id',2)
			                 ->or_where('b.client_type_id',3)
			                 ->or_where('b.client_type_id',4)
			                 ->group_end()
			                 ->get()
			                 ->result();
		}
		elseif(!empty($country_id) && !empty($category_id) && empty($user_id) && empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->group_start()
			                 ->where('b.client_type_id',2)
			                 ->or_where('b.client_type_id',3)
			                 ->or_where('b.client_type_id',4)
			                 ->group_end()
			                 ->where('b.country_id',$country_id)
			                 ->like('b.category_id',$category_id)
			                 ->get()
			                 ->result();
		}
		elseif(!empty($country_id) && empty($category_id) && !empty($user_id) && empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->group_start()
			                 ->where('b.client_type_id',2)
			                 ->or_where('b.client_type_id',3)
			                 ->or_where('b.client_type_id',4)
			                 ->group_end()
			                 ->where('b.country_id',$country_id)
			                 ->like('b.responsible_person_id',$user_id)
			                 ->get()
			                 ->result();
		}
		elseif(!empty($country_id) && empty($category_id) && empty($user_id) && !empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->group_start()
			                 ->where('b.client_type_id',2)
			                 ->or_where('b.client_type_id',3)
			                 ->or_where('b.client_type_id',4)
			                 ->group_end()
			                 ->where('b.country_id',$country_id)
			                 ->where('b.client_status',$status)
			                 ->get()
			                 ->result();
		}
		elseif(empty($country_id) && !empty($category_id) && empty($user_id) && !empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->where('b.client_status',$status)
			                 ->group_start()
			                 ->where('b.client_type_id',2)
			                 ->or_where('b.client_type_id',3)
			                 ->or_where('b.client_type_id',4)
			                 ->group_end()
			                 ->like('b.category_id',$category_id)
			                 ->get()
			                 ->result();
		}
		elseif(empty($country_id) && empty($category_id) && !empty($user_id) && !empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->where('b.client_status',$status)
			                 ->group_start()
			                 ->where('b.client_type_id',2)
			                 ->or_where('b.client_type_id',3)
			                 ->or_where('b.client_type_id',4)
			                 ->group_end()
			                 ->like('b.responsible_person_id',$user_id)
			                 ->get()
			                 ->result();
		}
		elseif(empty($country_id) && !empty($category_id) && !empty($user_id) && empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->group_start()
			                 ->where('b.client_type_id',2)
			                 ->or_where('b.client_type_id',3)
			                 ->or_where('b.client_type_id',4)
			                 ->group_end()
			                 ->like('b.category_id',$category_id)
			                 ->like('b.responsible_person_id',$user_id)
			                 ->get()
			                 ->result();
		}
		elseif(!empty($country_id) && !empty($category_id) && !empty($user_id) && empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->group_start()
			                 ->where('b.client_type_id',2)
			                 ->or_where('b.client_type_id',3)
			                 ->or_where('b.client_type_id',4)
			                 ->group_end()
			                 ->where('b.country_id',$country_id)
			                 ->like('b.category_id',$category_id)
			                 ->like('b.responsible_person_id',$user_id)
			                 ->get()
			                 ->result();
		}
		elseif(empty($country_id) && !empty($category_id) && !empty($user_id) && !empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->group_start()
			                 ->where('b.client_type_id',2)
			                 ->or_where('b.client_type_id',3)
			                 ->or_where('b.client_type_id',4)
			                 ->group_end()
			                 ->where('b.client_status',$status)
			                 ->like('b.category_id',$category_id)
			                 ->like('b.responsible_person_id',$user_id)
			                 ->get()
			                 ->result();
		}
		elseif(!empty($country_id) && empty($category_id) && !empty($user_id) && !empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->group_start()
			                 ->where('b.client_type_id',2)
			                 ->or_where('b.client_type_id',3)
			                 ->or_where('b.client_type_id',4)
			                 ->group_end()
			                 ->where('b.country_id',$country_id)
			                 ->where('b.client_status',$status)
			                 ->like('b.responsible_person_id',$user_id)
			                 ->get()
			                 ->result();
		}
		elseif(!empty($country_id) && !empty($category_id) && empty($user_id) && !empty($status)){
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->group_start()
			                 ->where('b.client_type_id',2)
			                 ->or_where('b.client_type_id',3)
			                 ->or_where('b.client_type_id',4)
			                 ->group_end()
			                 ->where('b.country_id',$country_id)
			                 ->where('b.client_status',$status)
			                 ->like('b.category_id',$category_id)
			                 ->get()
			                 ->result();
		}
		else{
			return $this->db->select('b.*,c.name as cname,st.name as stname,ct.name as ctname,ctyp.name as ctypname,ccat.category_id as ccatid,ccat.category_name as ccatname')
			                 ->from('client b')
			                 ->join('countries c','c.id = b.country_id')
			                 ->join('states st','st.id = b.state_id')
			                 ->join('cities ct','ct.id = b.city_id')
			                 ->join('client_type ctyp','ctyp.client_type_id = b.client_type_id')
			                 ->join('category ccat','ccat.category_id = b.category_id')
			                 ->group_start()
			                 ->where('b.client_type_id',2)
			                 ->or_where('b.client_type_id',3)
			                 ->or_where('b.client_type_id',4)
			                 ->group_end()
			                 ->where('b.country_id',$country_id)
			                 ->like('b.category_id',$category_id)
			                 ->like('b.responsible_person_id',$user_id)
			                 ->where('b.client_status',$status)
			                 ->get()
			                 ->result();
		}
	}
	/*
		return client type
	*/
	public function getClientType(){
		return $this->db->get('client_type')->result();
	}
	/*
		return client category
	*/
	public function getClientCat(){
		return $this->db->get('category')->result();
	}
	/* 
		insert new client record in databse 
	*/
	public function addModel($client_data, $kind_data){
		$sql = "insert into client (company_name,company_phone,contact_person,contact_person_phone,email,cc,bcc,client_type_id,category_id,responsible_person_id,country_id,state_id,city_id,loc_city,loc_area,road_no,house_no,zip_code,factory_address,skype,qq,whatsapp,wechat,client_status,user_id,datetime) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		if($this->db->query($sql,$client_data)){
			$insert_id = $this->db->insert_id();
			$sql2 = "insert into kind_attention (name,designation,client_id,user_id,datetime) values(?,?,$insert_id,?,?)";

			if($this->db->query($sql2,$kind_data)){
				return $this->db->insert_id();
			}
			else{
				return FALSE;
			}
		}
		else{
			return FALSE;
		}
	}
	/* 
		insert client type record in databse 
	*/
	public function addTypeModel($data){
		$sql = "insert into client_type (name,status,user_id,datetime) values(?,?,?,?)";
		if($this->db->query($sql,$data)){
		/*if($this->db->insert('client',$data)){*/
			return  $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	/* 
		return specific client record  
	*/
	public function getRecord($id){
		$sql = "select * from client where client_id = ?";
		if($query = $this->db->query($sql,array($id))){
		/*$this->db->where('client_id',$data);
		if($query = $this->db->get('client')){*/
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* 
		return specific kind attention record  
	*/
	public function getKindAtt($id){
		$sql = "select * from kind_attention where client_id = ?";
		if($query = $this->db->query($sql,array($id))){
		/*$this->db->where('client_id',$data);
		if($query = $this->db->get('client')){*/
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* 
		return specific client type record  
	*/
	public function getTypeRecord($id){
		$sql = "select * from client_type where client_type_id = ?";
		if($query = $this->db->query($sql,array($id))){
		/*$this->db->where('client_id',$data);
		if($query = $this->db->get('client')){*/
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* 
		save edited client record in databse 
	*/
	public function editModel($client_data,$kind_data,$id){
		/*$sql = "update client set client_name = ?,company_name = ?,address = ?,city_id = ?,country_id = ?,state_id = ?,mobile = ?,email = ?,postal_code = ?,gstid=?,vat_no=?,pan_no=?,tan_no=?,cst_reg_no=?,excise_reg_no=?,lbt_reg_no,servicetax_reg_no=?,gst_registration_type=? where client_id = ?";*/
		//if($this->db->query($sql,$data)){
		$this->db->where('client_id',$id);
		if($this->db->update('client',$client_data)){
			$this->db->where('client_id',$id);
			if($this->db->update('kind_attention',$kind_data)){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
		else{
			return FALSE;
		}
	}
	/* 
		save edited client type record in databse 
	*/
	public function editTypeModel($data,$id){
		/*$sql = "update client set client_name = ?,company_name = ?,address = ?,city_id = ?,country_id = ?,state_id = ?,mobile = ?,email = ?,postal_code = ?,gstid=?,vat_no=?,pan_no=?,tan_no=?,cst_reg_no=?,excise_reg_no=?,lbt_reg_no,servicetax_reg_no=?,gst_registration_type=? where client_id = ?";*/
		//if($this->db->query($sql,$data)){
		$this->db->where('client_type_id',$id);
		if($this->db->update('client_type',$data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/* 
		delete client record in databse 
	*/
	public function deleteModel($id){
		$sql = "delete from client where client_id = ?";
		if($this->db->query($sql,array($id))){
		/*$this->db->where('client_id',$id);
		if($this->db->delete('client')){*/
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/* 
		delete client type record in databse 
	*/
	public function deleteTypeModel($id){
		$sql = "delete from client_type where client_type_id = ?";
		if($this->db->query($sql,array($id))){
		/*$this->db->where('client_id',$id);
		if($this->db->delete('client')){*/
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>