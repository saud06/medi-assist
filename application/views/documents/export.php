<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	$conn = mysqli_connect('localhost', 'root', '', 'winmark');
	$document_id = $this->uri->segment('3'); 
	$sql = "SELECT * FROM document WHERE document_id = $document_id";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	/*header("Content-Type: application/vnd.ms-word"); 
	header("Expires: 0"); 
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
	header("content-disposition: attachment;filename=Hawala.doc");*/
?>

<div id="export-content">
	Do Something
</div>

<script src="../../assets/plugins/jQuery/jquery-3.1.1.js"></script> 
<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdn.rawgit.com/eligrey/FileSaver.js/5733e40e5af936eb3f48554cf6a8a7075d71d18a/FileSaver.js"></script>
<script src="../../assets/plugins/jQuery-Word-Export/jquery.wordexport.js"></script>



<script type="text/javascript">
	jQuery(document).ready(function($) {
	    $("#page-content").wordExport();
	});

</script>