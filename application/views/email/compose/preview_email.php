<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  $email_body = $body;
?>

<title>Preview Email</title>

<link href="../../assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<style type="text/css">
	.btn {
	  display: inline-block;
	  padding: 6px 12px;
	  margin-bottom: 0;
	  font-size: 14px;
	  font-weight: 400;
	  line-height: 1.42857143;
	  text-align: center;
	  white-space: nowrap;
	  vertical-align: middle;
	  -ms-touch-action: manipulation;
	  touch-action: manipulation;
	  cursor: pointer;
	  -webkit-user-select: none;
	  -moz-user-select: none;
	  -ms-user-select: none;
	  user-select: none;
	  background-image: none;
	  border: 1px solid transparent;
	  border-radius: 4px;
	}
</style>

<?php
 	if($fail = $this->session->flashdata('fail')){ 
 		echo '<p>' . $fail . '</p>';
 		echo '<a href="" onclick="window.close()">Close</a>.';
  	} 

 	else{
?>
		<form role="form" id="print_form" method="post" method="post" action="<?php echo base_url('email/send_email'); ?>" encType="multipart/form-data">
			<?= $body; ?>

		  	<br>

		  	<input type="hidden" name="type" value="<?= $type ?>">
		  	<input type="hidden" name="ref_no" id="ref_no" value="<?= $ref_no ?>">
		  	<input type="hidden" name="mail_no" id="mail_no" value="<?= $mail_no ?>">
		  	<input type="hidden" name="mail_type" id="mail_type" value="<?= $mail_type ?>">
		  	<input type="hidden" name="from" value="<?= $from ?>">
		  	<input type="hidden" name="to" value="<?= $to ?>">
		  	<input type="hidden" name="cc" value="<?= $cc ?>">
		  	<input type="hidden" name="bcc" value="<?= $bcc ?>">
		  	<input type="hidden" name="subject" value="<?= $subject ?>">

			<input type="hidden" name="mail_body" id="mail_body" value='<?= $body ?>'>

		  	<input type="hidden" name="contact_person" value="<?= $contact_person ?>">
		  	<input type="hidden" name="customer_id" value="<?= $customer_id ?>">
		  	<input type="hidden" name="customer_name" value="<?= $customer_name ?>">
		  	<input type="hidden" name="indent_no" value="<?= $indent_no ?>">
		  	<input type="hidden" name="manufacturer_id" value="<?= $manufacturer_id ?>">
		  	<input type="hidden" name="manufacturer_name" value="<?= $manufacturer_name ?>">
		  	<input type="hidden" name="grand_total" value="<?= $grand_total ?>">
		  	<input type="hidden" name="product_data" value='<?= $product_data ?>'>

		  	<p id="myElem" style="display: none;">Document Saved Successfully.</p>
		</form>

		<div class="pull-right">
			<button class="btn bg-gray" type="button" onclick="printContent();"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</button>
			
			<form style="display: inline-block;" role="form" id="form2" method="post" target="print_popup" action="<?php echo base_url('email/view_pdf/') ?>" onsubmit="window.open('about:blank', 'print_popup', 'width=1200, height=800');">
		        <input type="hidden" name="email_pdf" id="email_pdf">
		        <input type="hidden" name="file_name" id="file_name">

		        <button class="btn bg-gray" type="button" onclick="view_pdf('pdf');"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Export As PDF</button>
		    </form>
		</div>

		<br><br>

		<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-3.1.1.js"></script> 
		<script type="text/javascript">
			function view_pdf(type){
		      	var frm = $('#print_form');

		      	$.ajax({
		          	type: frm.attr('method'),
		          	url: frm.attr('action'),
		          	data: frm.serialize(),
		          	success: function (data) {
		              	console.log(data);
		          	},
		          	error: function(jqXHR, textStatus, errorThrown) {
		            	console.log(textStatus, errorThrown);
		          	}
		      	});

		      	var mail_type = $('#mail_type').val();
		      	var email_body = $('#mail_body').val();
		      	var ref_no = $('#ref_no').val();
		      	var ref_no = ref_no.replace('-', '_');
		      	var mail_no = $('#mail_no').val();
		      	var mail_no = mail_no.replace('-', '_');

		      	$('#email_pdf').val(email_body);
		      	$('#file_name').val(mail_type + '__ref_no_' + ref_no + '__indent_no_' + mail_no);
		      
		      	$("#form2").submit();

		      	window.location.reload(true);
		  	}

			function printContent(){
			    var frm = $('#print_form');

		      	$.ajax({
		          	type: frm.attr('method'),
		          	url: frm.attr('action'),
		          	data: frm.serialize(),
		          	success: function (data) {
		              	console.log(data);
		          	},
		          	error: function(jqXHR, textStatus, errorThrown) {
		            	console.log(textStatus, errorThrown);
		          	}
		      	});

		      	//var restorepage = document.body.innerHTML;
		      	var printcontent = $('#mail_body').val();
		      	document.body.innerHTML = printcontent;
		      	window.print();
		      	//document.body.innerHTML = restorepage;
			}
			  
		  	window.onafterprint = function(){
		    	window.location.reload(true);
		  	}
		</script>
<?php 
	}
?>