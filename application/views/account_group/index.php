        <script type="text/javascript">
        $(document).ready(function() {
            var oTable = $('#accountgroup_details_view').dataTable( {
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": '<?php echo base_url(); ?>index.php/accountgroup/accountgroup_details',
                        "bJQueryUI": true,
                        "sPaginationType": "full_numbers",
                        "iDisplayStart ":20,
                        "oLanguage": {
                    "sProcessing": "<img src='<?php echo base_url(); ?>assets/img/ajax-loader.gif'>"
                },  
                "fnInitComplete": function() {
                        //oTable.fnAdjustColumnSizing();
                 },
                        'fnServerData': function(sSource, aoData, fnCallback)
                    {
                      $.ajax
                      ({
                        'dataType': 'json',
                        'type'    : 'POST',
                        'url'     : sSource,
                        'data'    : aoData,
                        'success' : fnCallback
                      });
                    }
            } );
        } );
        </script>
        
        <div class="page-heading">
            <?php if($this->session->flashdata('success')) { ?>
            <div class="alert alert-success fade in">
                <button type="button" class="close close-sm" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
                <?php echo $this->session->flashdata('success');?>
            </div>
            <?php 
            }
            ?>
            <h3>
                <?php echo $page_title; ?>
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="<?php echo base_url(); ?>">Home</a>
                </li>
                <li class="active"> <?php echo $page_title; ?> </li>
            </ul>
        </div>
        
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <?php echo $page_title; ?>
                            <span class="tools pull-right">
                                <a class="custom-button" href="<?php echo base_url(); ?>index.php/accountgroup/add"> Add Account Group</a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <div class="adv-table">
                                <?php
                                    $tmpl = array ( 'table_open'  => '<table id="accountgroup_details_view" class="table table-bordered table-hover">' );
                                    $this->table->set_template($tmpl);
                                    $this->table->set_heading('AccountGroup No','Branch','Group Title','Category','Opening Balance','Actions');
                                    echo $this->table->generate();
                                ?>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>