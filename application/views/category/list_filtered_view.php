<?php
$requestData = $_REQUEST;
$status = $this->uri->segment('3');

$columns = array( 
  0 => '',
  1 => 'category_code',
  2 => 'category_name',
  3 => 'category_desc'
);

$sql = "SELECT * FROM category";
if($status != '0'){
  $sql .= " WHERE category_status = '$status'";
}
$query = $this->db->query($sql);
$result = $query->result_array();
$totalData = $query->num_rows();
$totalFiltered = $totalData;

$sql = "SELECT * FROM category WHERE 1=1";
if($status != '0'){
  $sql .= " AND category_status = '$status'";
}
if( !empty($requestData['search']['value']) ) {
  $sql.=" AND (category_code LIKE '".$requestData['search']['value']."%'";
  $sql.=" OR category_name LIKE '".$requestData['search']['value']."%'";
  $sql.=" OR category_desc LIKE '".$requestData['search']['value']."%')";
}
$query = $this->db->query($sql);
$result = $query->result_array();
$totalFiltered = $query->num_rows();
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 

$query = $this->db->query($sql);
if($query){
  $result = $query->result_array();
}

$data = array();
$i = 1;
foreach ($result as $key => $row) {
  $id = $row["category_id"];
  $nestedData=array(); 

  $nestedData[] = $i;
  $nestedData[] = $row["category_code"];
  $nestedData[] = $row["category_name"];
  $nestedData[] = $row["category_desc"];
  $nestedData[] = '<div class="dropdown">
                    <button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-cog" aria-hidden="true"></i>&nbsp;
                      <span class="fa fa-angle-double-down"></span>
                    </button>
                    <ul class="dropdown-menu">
                      <li>
                        <a href="category/edit/'. $id .'"><i class="fa fa-edit"></i>Edit</a>
                      </li>
                      <li>
                        <a onclick="return confirm(\'Sure To Remove This Record ?\')" href="category/delete/'. $id .'"><i class="fa fa-trash-o"></i>Delete</a>
                      </li>
                    </ul>
                  </div>';
  
  $data[] = $nestedData;
  $i++;
}

$json_data = array(
      "draw"            => intval( $requestData['draw'] ), 
      "recordsTotal"    => intval( $totalData ), 
      "recordsFiltered" => intval( $totalFiltered ), 
      "data"            => $data 
      );

echo json_encode($json_data); 
?>