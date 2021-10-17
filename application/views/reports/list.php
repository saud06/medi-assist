<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager','accountant');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth/dashboard');
}
?>
<script type="text/javascript">
      function delete_id(id)
      {
         if(confirm('Sure To Remove This Record ?'))
         {
            window.location.href='<?php  echo base_url('biller/delete/'); ?>'+id;
         }
      }
</script>
<div class="main">

  <div class="main-inner">

      <div class="container">
  
        <div class="row">
          
          <div class="span12">          
            
            <div class="widget ">
              
              <div class="widget-header">
                  &nbsp;&nbsp;<img src="<?php  echo base_url(); ?>assets/images/list_product.png" />
                 <h3>List Reports</h3>
              </div> <!-- /widget-header -->
              <div class="widget-content1">
                <table class="table table-striped table-bordered table-hover" id="mydata">
                  <thead>
                    <tr>
                      <th width="10%">No</th>
                      <th>Name</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    <tr>
                      <td></td>
                      <td><a href="<?php  echo base_url('reports/products'); ?>">Products</a></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><a href="<?php  echo base_url('reports/purchase'); ?>">Purchase</a></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><a href="<?php  echo base_url('reports/purchase_return'); ?>">Purchase Return</a></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><a href="<?php  echo base_url('reports/sales'); ?>">Sales</a></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><a href="<?php  echo base_url('reports/sales_return'); ?>">Sales Return</a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

          </div> <!-- /span12 -->
   
       </div> <!-- /row -->
  
      </div> <!-- /container -->
      
  </div> <!-- /main-inner -->
    
</div> <!-- /main -->
