<?php
defined("BASEPATH") OR exit('No direct script access allowed');
class Product_alert_model extends CI_Model
{
	/* return product record its quantity is less than alert quantity */
	public function getProductAlert(){
		$this->db->select('p1.*,category.category_name as cname')
				 ->from('products p1')
				 ->join('products p2',"p1.product_id = p2.product_id")
				 ->join('category',"category.category_id = p1.category_id")
				 ->where('p1.alert_quantity > p2.quantity');
		return $this->db->get()->result();
	}
	public function getCsvData(){
		$this->db->select('p1.code as Code,p1.name as Name,p1.cost as Cost,p1.price as Price,p1.unit as Unit,p1.quantity as Quantity,p1.alert_quantity as Alert Quantity,category.category_name as Category Name')
				 ->from('products p1')
				 ->join('products p2',"p1.product_id = p2.product_id")
				 ->join('category',"category.category_id = p1.category_id")
				 ->where('p1.alert_quantity > p2.quantity');
		return $this->db->get();
	}
}
?>