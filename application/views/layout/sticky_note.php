<style type="text/css">
  .text-center{
    text-align:center;
    background: #ECF0F5;
    margin: 0;
  }
  .text-style{
    line-height: 18px;
    font-size: 13px;
    font-weight: bold;
    color: #7f8c8d;
    font-family: "proxima-nova", "Helvetica Neue", Helvetica, Arial, sans-serif;
    letter-spacing: 2px;
  }
  #contact{
    display: none;
    background: grey;
    color: #FFF;
    padding:1em 2em;
    margin-left: 15px;
    margin-right: 15px;
    border-bottom-left-radius: 3px;
    border-bottom-right-radius: 3px;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
  }
  .triangle {
    display: inline-block;
    margin: 0 5px;
    vertical-align: middle;
  }
  .triangle-5 {
    width: 60px;
    height: 30px;
    border-top: solid 30px rgb(128,128,128);
    border-left: solid 30px transparent;
    border-right: solid 30px transparent;
  }
</style>

<div id="contact">
  <style type="text/css">
    #notes {
      display: inline-block;
    }
    .sticky-note { 
      height: 150px; 
      width: 200px; 
      color: #000;
      font-weight: bold; 
      background: #f9dd45; 
      opacity: 0.7;
      border-radius: 10px; 
      border: 0px; 
      font-family: Helvetica, Arial, sans-serif; 
      font-size: 13px; 
      box-shadow: 2px 2px 10px rgba(0,0,0,0.4); 
      overflow: hidden; 
    }

    .contents { 
      background: #f9e055; 
      margin: 20px; 
      outline: none; 
    }

    .handle { 
      cursor: move; 
      background: #7f6c04; 
      border-radius: 8px 8px 0px 0px; 
      height: 25px;
    }

    .closee { 
      cursor: pointer 
    }

    #save { 
      margin-left: 7px; 
    }

    .sticky-note div.closee { 
      color: #3d3402; 
      opacity: 1; 
      text-shadow: 1px 0px 1px #a08805; 
      padding: 2px; 
    }
  </style>

  <div class="row" id="sticky-note-div">
    <div class="col-md-12" style="padding: 0">
      <!-- TO DO List -->
      <div class="" style="max-height: 350px; overflow-y: auto; overflow-x: hidden;">
        <div class="box-header" style="padding-left: 0; padding-right: 0;">
          <i class="ion ion-android-attach" style="color: #fff;"></i>

          <h3 class="box-title" style="color: #fff;">Sticky Note</h3>&emsp;

          <button title="New Note" id="new" class="btn bg-gray"><i class="fa fa-plus"></i></button> 
          <button title="Pin Note" id="save" class="btn bg-gray"><i class="fa fa-paperclip"></i></button>
        </div>

        <!-- /.box-header -->
        <div class="box-body" style="min-height: 175px; padding-left: 0; padding-right: 0;">
          <div class="row">
            <div class="col-md-12">
              <div id="notes">
                <?php 
                  $this->db->select('*')
                           ->where('user_id', $this->session->userdata('user_id'));
                  $notes = $this->db->get('sticky_note')->result_array();

                  foreach ($notes as $key => $value) {
                ?>
                    <div style="display: inline-block" class="sticky-note-pre ui-widget-content">
                      <div class="handle">
                        &nbsp;<div title="Close Note" class="close closee" onclick="remove('<?php echo $value['id']; ?>')"><i class="fa fa-close"></i></div>
                      </div>
                      <div class="contents"><?php echo $value['description'] ?></div>
                    </div>
                <?php
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</div>

<p class="text-center">
  <a title="Sticky Notes" href="#" id="toggle" class="triangle triangle-5"></a>
</p>

<p class="text-center text-style">sticky note</p>

<script type="text/javascript">
  $(function(){
     $("a#toggle").click(function(){
         $("#contact").slideToggle();
         return false;
     }); 
  });
</script>