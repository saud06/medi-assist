<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Chosen: A jQuery Plugin by Harvest to Tame Unwieldy Select Boxes</title>
  <link href="<?php  echo base_url(); ?>assets/css/chosen.css" rel="stylesheet">
  
  
</head>
<body>
  
       
          <select data-placeholder="Choose a Country..." class="chosen-select" id="studentID" style="width:350px;" tabindex="2">
            <option value=""></option>
            <?php

            ?>
          </select>
        

 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
  
  <script src="<?php  echo base_url(); ?>assets/js/chosen.jquery.js"></script>
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>

  
</body>
</html>
