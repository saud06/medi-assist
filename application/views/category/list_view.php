<?php
$requestData = $_REQUEST;

$columns = array( 
// datatable column index  => database column name
  0 => '',
  1 => 'category_code',
  2 => 'category_name',
  3 => 'category_desc'
);


// getting total number records without any search
$sql = "SELECT * FROM category";
$query = $this->db->query($sql);
$result = $query->result_array();
$totalData = $query->num_rows();
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * FROM category WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
  $sql.=" AND (category_code LIKE '".$requestData['search']['value']."%'";
  $sql.=" OR category_name LIKE '".$requestData['search']['value']."%'";
  $sql.=" OR category_desc LIKE '".$requestData['search']['value']."%')";
}
$query = $this->db->query($sql);
$result = $query->result_array();
$totalFiltered = $query->num_rows(); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */  
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
      "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
      "recordsTotal"    => intval( $totalData ),  // total number of records
      "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
      "data"            => $data   // total data array
      );

echo json_encode($json_data);  // send data as json format

?>
