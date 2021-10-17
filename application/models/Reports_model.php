<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function index(){
		
	} 
	public function getPurchase(){
		$this->db->select('p.date,p.reference_no,p.total,w.warehouse_name,s.supplier_name,pi.purchase_id,pi.quantity,pr.name')
		         ->from('purchases p')
		         ->join('warehouse w','w.warehouse_id = p.warehouse_id')
		         ->join('suppliers s','s.supplier_id = p.supplier_id')
		         ->join('purchase_items pi','pi.purchase_id = p.purchase_id')
		         ->join('products pr','pr.product_id = pi.product_id')
		         ->group_by('p.reference_no');
		return $this->db->get()->result();
	}
	public function getPurchaseItems(){
		return $this->db->get('purchase_items')->result();
	}
	public function getProduct(){
		return $this->db->get('products')->result();
	}
	public function getUsers(){
		return $this->db->get('users')->result();
	}
	public function getSuppliers(){
		return $this->db->get('suppliers')->result();
	}
	public function getWarehouses(){
		return $this->db->get('warehouse')->result();
	}
	public function getBillers(){
		return $this->db->get('biller')->result();
	}
	public function getClients(){
		return $this->db->get('client')->result();
	}
	public function getDiscounts(){
		return $this->db->get('discount')->result();
	}
	public function getPurchaseDetails($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date){

		$data = $this->db->query('
									SELECT DISTINCT 
										p.date,
										p.reference_no,
										w.warehouse_name,
										s.supplier_name,
										p.purchase_id,
										p.total 
									FROM purchases p 
									INNER JOIN warehouse w ON w.warehouse_id = p.warehouse_id 
									INNER JOIN suppliers s ON s.supplier_id = p.supplier_id 
									WHERE 
										(p.warehouse_id = ? OR ? IN ("",NULL)) 
									AND 
										(p.supplier_id = ? OR ? IN ("",NULL))
									AND
										(p.reference_no = ? OR ? IN ("",NULL))
									AND
										(p.user = ? OR ? IN ("",NULL))
									AND
										(p.date >= ? OR ? IN ("",NULL))
									AND
										(p.date <= ? OR ? IN ("",NULL))
								',
									array(
											$warehouse_id,
											$warehouse_id,
											$supplier_id,
											$supplier_id,
											$reference_no,
											$reference_no,
											$user_id,
											$user_id,
											$start_date,
											$end_date,
											$end_date,
											$end_date
										)
								);
		return $data->result();		
	}
	public function getPurchaseDetailsForCSV($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date){

		return $this->db->query('
									SELECT DISTINCT 
										p.date,
										p.reference_no,
										w.warehouse_name,
										s.supplier_name,
										p.purchase_id,
										p.total 
									FROM purchases p 
									INNER JOIN warehouse w ON w.warehouse_id = p.warehouse_id 
									INNER JOIN suppliers s ON s.supplier_id = p.supplier_id 
									WHERE 
										(p.warehouse_id = ? OR ? IN ("",NULL)) 
									AND 
										(p.supplier_id = ? OR ? IN ("",NULL))
									AND
										(p.reference_no = ? OR ? IN ("",NULL))
									AND
										(p.user = ? OR ? IN ("",NULL))
									AND
										(p.date >= ? OR ? IN ("",NULL))
									AND
										(p.date <= ? OR ? IN ("",NULL))
								',
									array(
											$warehouse_id,
											$warehouse_id,
											$supplier_id,
											$supplier_id,
											$reference_no,
											$reference_no,
											$user_id,
											$user_id,
											$start_date,
											$end_date,
											$end_date,
											$end_date
										)
								);	
	}
	public function getPurchaseProduct(){
		$data = $this->db->query('
									SELECT 
										pi.purchase_id,
										pr.name,
										sum(pi.quantity) as quantity
									FROM products pr
									INNER JOIN purchase_items pi ON pi.product_id = pr.product_id
									GROUP BY pr.product_id
								');
		return $data->result();
	}
	public function getPurchaseReturn(){
		$this->db->select('p.date,p.reference_no,p.tax_value,p.total,w.warehouse_name,s.supplier_name,p.id,pi.quantity,pr.name')
		         ->from('purchase_return p')
		         ->join('warehouse w','w.warehouse_id = p.warehouse_id')
		         ->join('suppliers s','s.supplier_id = p.supplier_id')
		         ->join('purchase_return_items pi','pi.purchase_return_id = p.id')
		         ->join('products pr','pr.product_id = pi.product_id')
		         ->group_by('p.reference_no');
		return $this->db->get()->result();
	}
	public function getPurchaseReturnDetails($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date){
		$data = $this->db->query('
									SELECT DISTINCT 
										p.date,
										p.reference_no,
										p.id,
										w.warehouse_name,
										s.supplier_name,
										p.total
									FROM purchase_return p 
									INNER JOIN warehouse w ON w.warehouse_id = p.warehouse_id 
									INNER JOIN suppliers s ON s.supplier_id = p.supplier_id 
									INNER JOIN purchase_return_items pi ON pi.purchase_return_id = p.id
									INNER JOIN products pr ON pr.product_id = pi.product_id

									WHERE 
										(p.warehouse_id = ? OR ? IN ("",NULL)) 
									AND 
										(p.supplier_id = ? OR ? IN ("",NULL))
									AND
										(p.reference_no = ? OR ? IN ("",NULL))
									AND
										(p.user = ? OR ? IN ("",NULL))
									AND
										(p.date >= ? OR ? IN ("",NULL))
									AND
										(p.date <= ? OR ? IN ("",NULL))
									
								',
									array(
											$warehouse_id,
											$warehouse_id,
											$supplier_id,
											$supplier_id,
											$reference_no,
											$reference_no,
											$user_id,
											$user_id,
											$start_date,
											$start_date,
											$end_date,
											$end_date
										)
								);
		return $data->result();
	}
	public function getPurchaseReturnDetailsForCSV($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date){
		return $this->db->query('
									SELECT DISTINCT 
										p.date,
										p.reference_no,
										p.id,
										w.warehouse_name,
										s.supplier_name,
										p.total
									FROM purchase_return p 
									INNER JOIN warehouse w ON w.warehouse_id = p.warehouse_id 
									INNER JOIN suppliers s ON s.supplier_id = p.supplier_id 
									INNER JOIN purchase_return_items pi ON pi.purchase_return_id = p.id
									INNER JOIN products pr ON pr.product_id = pi.product_id

									WHERE 
										(p.warehouse_id = ? OR ? IN ("",NULL)) 
									AND 
										(p.supplier_id = ? OR ? IN ("",NULL))
									AND
										(p.reference_no = ? OR ? IN ("",NULL))
									AND
										(p.user = ? OR ? IN ("",NULL))
									AND
										(p.date >= ? OR ? IN ("",NULL))
									AND
										(p.date <= ? OR ? IN ("",NULL))
									
								',
									array(
											$warehouse_id,
											$warehouse_id,
											$supplier_id,
											$supplier_id,
											$reference_no,
											$reference_no,
											$user_id,
											$user_id,
											$start_date,
											$start_date,
											$end_date,
											$end_date
										)
								);
	}
	public function getPurchaseReturnProduct(){
		$data = $this->db->query('
									SELECT 
										pi.purchase_return_id,
										pr.name,
										sum(pi.quantity) as quantity
									FROM  purchase_return_items pi 
									INNER JOIN products pr ON pr.product_id = pi.product_id
									GROUP BY pi.purchase_return_id, pr.product_id
								');
		return $data->result();
	}
	public function getPurchaseReturnItems(){
		return $this->db->get('purchase_return_items')->result();
	}
	public function getSales(){
		$this->db->select('s.date,s.reference_no,s.total,b.biller_name,c.client_name,si.sales_id,si.quantity,pr.name')
		         ->from('sales s')
		         ->join('biller b','b.biller_id = s.biller_id')
		         ->join('client c','c.client_id = s.client_id')
		         ->join('sales_items si','si.sales_id = s.sales_id')
		         ->join('products pr','pr.product_id = si.product_id')
		         ->group_by('s.reference_no');
		return $this->db->get()->result();
	}
	public function getSalesItems(){
		return $this->db->get('sales_items')->result();
	}
	public function getSalesDetails($reference_no,$user_id,$biller_id,$warehouse_id,$client_id,$discount_id,$start_date,$end_date){
									
		$data = $this->db->query('
									SELECT DISTINCT s.date,s.reference_no,s.sales_id,b.biller_name,c.client_name,s.total
									FROM sales s 
									INNER JOIN warehouse w ON w.warehouse_id = s.warehouse_id
									INNER JOIN biller b ON b.biller_id = s.biller_id
									INNER JOIN client c ON c.client_id = s.client_id
									INNER JOIN sales_items si ON si.sales_id = s.sales_id
									INNER JOIN products pr ON pr.product_id = si.product_id
									
									WHERE  
										(s.warehouse_id = ? OR ? IN ("",NULL))
									AND
										(s.biller_id = ? OR ? IN ("",NULL))
									AND
										(s.client_id = ? OR ? IN ("",NULL))
									AND
										(s.discount_id = ? OR ? IN ("",NULL))
									AND
										(s.reference_no = ? OR ? IN ("",NULL))
									AND
										(s.user = ? OR ? IN ("",NULL))
									AND
										(s.date >= ? OR ? IN ("",NULL))
									AND
										(s.date <= ? OR ? IN ("",NULL))
								',
									array(
											$warehouse_id,
											$warehouse_id,
											$biller_id,
											$biller_id,
											$client_id,
											$client_id,
											$discount_id,
											$discount_id,
											$reference_no,
											$reference_no,
											$user_id,
											$user_id,
											$start_date,
											$start_date,
											$end_date,
											$end_date
										)
								);
		return $data->result();
	}
	public function getSalesDetailsForCSV($reference_no,$user_id,$biller_id,$warehouse_id,$client_id,$discount_id,$start_date,$end_date){
									
		return $this->db->query('
									SELECT DISTINCT s.date,s.reference_no,s.sales_id,b.biller_name,c.client_name,s.total
									FROM sales s 
									INNER JOIN warehouse w ON w.warehouse_id = s.warehouse_id
									INNER JOIN biller b ON b.biller_id = s.biller_id
									INNER JOIN client c ON c.client_id = s.client_id
									INNER JOIN sales_items si ON si.sales_id = s.sales_id
									INNER JOIN products pr ON pr.product_id = si.product_id
									
									WHERE  
										(s.warehouse_id = ? OR ? IN ("",NULL))
									AND
										(s.biller_id = ? OR ? IN ("",NULL))
									AND
										(s.client_id = ? OR ? IN ("",NULL))
									AND
										(s.discount_id = ? OR ? IN ("",NULL))
									AND
										(s.reference_no = ? OR ? IN ("",NULL))
									AND
										(s.user = ? OR ? IN ("",NULL))
									AND
										(s.date >= ? OR ? IN ("",NULL))
									AND
										(s.date <= ? OR ? IN ("",NULL))
								',
									array(
											$warehouse_id,
											$warehouse_id,
											$biller_id,
											$biller_id,
											$client_id,
											$client_id,
											$discount_id,
											$discount_id,
											$reference_no,
											$reference_no,
											$user_id,
											$user_id,
											$start_date,
											$start_date,
											$end_date,
											$end_date
										)
								);
	}
	public function getSalesProduct(){
		$data = $this->db->query('
									SELECT 
										si.sales_id,
										pr.name,
										sum(si.quantity) as quantity
									FROM products pr
									INNER JOIN sales_items si ON si.product_id = pr.product_id
									GROUP BY si.sales_id,pr.product_id
								');
		return $data->result();
	}
	public function getSalesReturn(){
		$this->db->select('s.date,s.reference_no,s.tax_value,s.total,b.biller_name,c.client_name,s.id,si.quantity,pr.name')
		         ->from('sales_return s')
		         ->join('biller b','b.biller_id = s.biller_id')
		         ->join('client c','c.client_id = s.client_id')
		         ->join('sale_return_items si','si.sale_return_id = s.id')
		         ->join('products pr','pr.product_id = si.product_id')
		         ->group_by('s.reference_no');
		return $this->db->get()->result();
	}
	public function getSalesReturnDetails($reference_no,$user_id,$biller_id,$warehouse_id,$client_id,$discount_id,$start_date,$end_date){

		$data = $this->db->query('
									SELECT DISTINCT s.date,s.reference_no,s.id,b.biller_name,c.client_name,s.total
									FROM sales_return s 
									INNER JOIN warehouse w ON w.warehouse_id = s.warehouse_id
									INNER JOIN biller b ON b.biller_id = s.biller_id
									INNER JOIN client c ON c.client_id = s.client_id
									INNER JOIN sale_return_items si ON si.sale_return_id = s.id
									INNER JOIN products pr ON pr.product_id = si.product_id
									
									WHERE  
										(s.warehouse_id = ? OR ? IN ("",NULL))
									AND
										(s.biller_id = ? OR ? IN ("",NULL))
									AND
										(s.client_id = ? OR ? IN ("",NULL))
									AND
										(s.discount_id = ? OR ? IN ("",NULL))
									AND
										(s.reference_no = ? OR ? IN ("",NULL))
									AND
										(s.user = ? OR ? IN ("",NULL))
									AND
										(s.date >= ? OR ? IN ("",NULL))
									AND
										(s.date <= ? OR ? IN ("",NULL))
								',
									array(
											$warehouse_id,
											$warehouse_id,
											$biller_id,
											$biller_id,
											$client_id,
											$client_id,
											$discount_id,
											$discount_id,
											$reference_no,
											$reference_no,
											$user_id,
											$user_id,
											$start_date,
											$start_date,
											$end_date,
											$end_date
										)
								);
		return $data->result();
	}
	public function getSalesReturnDetailsForCSV($reference_no,$user_id,$biller_id,$warehouse_id,$client_id,$discount_id,$start_date,$end_date){

		return $this->db->query('
									SELECT DISTINCT s.date,s.reference_no,s.id,b.biller_name,c.client_name,s.total
									FROM sales_return s 
									INNER JOIN warehouse w ON w.warehouse_id = s.warehouse_id
									INNER JOIN biller b ON b.biller_id = s.biller_id
									INNER JOIN client c ON c.client_id = s.client_id
									INNER JOIN sale_return_items si ON si.sale_return_id = s.id
									INNER JOIN products pr ON pr.product_id = si.product_id
									
									WHERE  
										(s.warehouse_id = ? OR ? IN ("",NULL))
									AND
										(s.biller_id = ? OR ? IN ("",NULL))
									AND
										(s.client_id = ? OR ? IN ("",NULL))
									AND
										(s.discount_id = ? OR ? IN ("",NULL))
									AND
										(s.reference_no = ? OR ? IN ("",NULL))
									AND
										(s.user = ? OR ? IN ("",NULL))
									AND
										(s.date >= ? OR ? IN ("",NULL))
									AND
										(s.date <= ? OR ? IN ("",NULL))
								',
									array(
											$warehouse_id,
											$warehouse_id,
											$biller_id,
											$biller_id,
											$client_id,
											$client_id,
											$discount_id,
											$discount_id,
											$reference_no,
											$reference_no,
											$user_id,
											$user_id,
											$start_date,
											$start_date,
											$end_date,
											$end_date
										)
								);
	}
	public function getSalesReturnProduct(){
		$data = $this->db->query('
									SELECT 
										si.sale_return_id,
										pr.name,
										sum(si.quantity) as quantity
									FROM products pr
									INNER JOIN sale_return_items si ON si.product_id = pr.product_id
									GROUP BY si.sale_return_id,pr.product_id
								');
		return $data->result();
	}
	public function getSalesReturnItems(){
		return $this->db->get('sale_return_items')->result();
	}
	public function getPurchaseSalse(){
		$this->db->select('si.product_id,sum(si.quantity) as squantity,sum(si.gross_total) as total')
			         ->from('sales_items si')
			         ->group_by('si.product_id');
			$data['sales'] =  $this->db->get()->result();
			$this->db->select('p.name,p.code,p.cost,p.price,pi.product_id,sum(pi.quantity) as pquantity,sum(pi.gross_total) as total')
			         ->from('purchase_items pi')
			         ->join('products p','p.product_id = pi.product_id')
			         ->group_by('pi.product_id');
			$data['purchase'] =  $this->db->get()->result();
			return $data;
	}
	public function getProductsDetails($product_id,$start_date,$end_date){
			$result = $this->db->query('
											SELECT si.product_id,sum(si.quantity) as squantity,sum(si.gross_total) as total
											FROM sales_items si
											INNER JOIN sales s ON s.sales_id = si.sales_id
											
											WHERE 
												(s.date >= ? OR ? IN ("",NULL))
											AND
												(s.date <= ? OR ? IN ("",NULL))
											GROUP BY si.product_id
									   ',
									    array(
									    	$start_date,
									    	$start_date,
									    	$end_date,
									    	$end_date
										)
									   );
			$data['sales'] = $result->result();
			$result = $this->db->query('
											SELECT pr.name,pr.code,pr.cost,pr.price,pi.product_id,sum(pi.quantity) as pquantity,sum(pi.gross_total) as total
											FROM purchase_items pi
											INNER JOIN purchases p ON p.purchase_id = pi.purchase_id
											INNER JOIN products pr ON pr.product_id = pi.product_id
											WHERE 
												(p.date >= ? OR ? IN ("",NULL))
											AND
												(p.date <= ? OR ? IN ("",NULL))
											AND
												(pr.product_id = ? OR ? IN ("",NULL))
											GROUP BY pi.product_id
									   ',
									    array(
									    	$start_date,
									    	$start_date,
									    	$end_date,
									    	$end_date,
									    	$product_id,
									    	$product_id
										)
									   );
			$data['purchase'] = $result->result();
			return $data;
	}
	public function getProductsDetailsForCSV($product_id,$start_date,$end_date){
				return $this->db->query('
											SELECT 
												pr.name,
												pr.code,
												pi.cost,
												si.price,
												pr.product_id,
												sum(pi.quantity) as pquantity,
												sum(si.quantity) as squantity,
												sum(pi.gross_total) as purchase_total,
												sum(si.gross_total) as sales_total,
												(sum(si.quantity)*si.price) - (sum(si.quantity)*pi.cost) as profit
											FROM purchase_items pi
											INNER JOIN purchases p ON p.purchase_id = pi.purchase_id
											INNER JOIN products pr ON pr.product_id = pi.product_id
											INNER JOIN sales_items si ON si.product_id = pr.product_id
											INNER JOIN sales s ON s.sales_id = si.sales_id
											WHERE 
												(p.date >= ? OR ? IN ("",NULL))
											AND
												(p.date <= ? OR ? IN ("",NULL))
											AND
												(pr.product_id = ? OR ? IN ("",NULL))
											GROUP BY pi.product_id
									   ',
									    array(
									    	$start_date,
									    	$start_date,
									    	$end_date,
									    	$end_date,
									    	$product_id,
									    	$product_id
										)
									   );
	}
	public function getTax(){
		$data['product'] = $this->db->select('*')
									->from('products')
									->group_by('hsn_sac_code')
									->get()
									->result();
		$data['sales'] = $this->db->select('pr.hsn_sac_code,si.tax,si.product_id,s.shipping_state_id,b.state_id')
						 ->from('sales s')
						 ->join('sales_items si','s.sales_id = si.sales_id')
						 ->join('products pr','pr.product_id = si.product_id')
						 ->join('biller b','b.biller_id = s.biller_id')
						
						 ->get()
						 ->result();
						/* echo "<pre>";
						 print_r($data);
						 exit;*/
		return $data;
	}
}
/*CREATE PROCEDURE Purchase_details(IN reference_no INT(11),IN user_id INT(11),IN supplier_id INT(11),IN warehouse_id INT(11),IN start_date DATE,IN end_date DATE)

BEGIN
	SELECT p.*,w.*,s.* FROM purchases p INNER JOIN warehouse w ON w.warehouse_id = p.warehouse_id INNER JOIN suppliers s ON s.supplier_id = p.supplier_id  WHERE (p.warehouse_id = warehouse_id OR warehouse_id is NULL) AND (p.supplier_id = supplier_id OR supplier_id is NULL) AND (p.user_id = user_id OR user_id is NULL) AND (p.reference_no  = reference_no OR reference_no is NULL) AND (p.date >= start_date OR start_date is NULL) AND (p.date <= end_date OR end_date is NULL); 
END */
?>
