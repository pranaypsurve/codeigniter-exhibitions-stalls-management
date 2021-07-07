<!DOCTYPE html>
<html>
<head>
	<title>Generate Monthly Reort</title>
	 <meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link href="<?php echo base_url('assets/css/top_header_v.css')?>" rel="stylesheet" media="all">
	<!-- Bootstrap Links -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="<?php echo base_url('assets/css/common_form_css/form_add_edit.css')?>" rel="stylesheet">
	<link href= 
	'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
	          rel='stylesheet'> 
	      
	    <script src= 
	"https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" > 
	    </script> 
	      
	    <script src= 
	"https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" > 
	    </script> 
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-noty/2.4.1/packaged/jquery.noty.packaged.min.js" integrity="sha512-deW7s7mlh1kdsULBlS05epcSl1Zze2KafJ4KH5kyOP3MkAYCbVC3lrVYoQ2lM1AlaWR3jYm+Myiad2sluDPoEg==" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function(){
    	$.datepicker.setDefaults({
    		dateFormat: 'yy-mm-dd'
    	});
    	$(function() { 
                $( "#fromDate" ).datepicker(); 
                $( "#toDate" ).datepicker(); 
            }); 
    	// $("#").datepicker();

        $("#pd").removeClass("active");
        $("#income").removeClass("active");
        $("#expese").removeClass("active");
        $("#exhibition").removeClass("active");
        $("#report").addClass("active");
});
  </script>
  <!-- <script>
    $(document).ready(function(){
       var partyName = $('#partyName').val();
       var from = $('#fromDate').val();
       var to = $('#toDate').val();
       // alert(dateNotSelected);
// alert(h);
       $('#view').click(function(){
       	var partyName = $('#partyName').val();
       	var from = $('#fromDate').val();
       	var to = $('#toDate').val();
       	if(from != '' && to != '')
       	{
       		$.ajax({
       			url:"<?php echo base_url(); ?>index.php/monthlyReport/report/da",
       			method:"POST",
       			data:{from:from,to:to,partyName:partyName},
       			success:function(data)
       			{
       				alert(data);
       			}
       		});
       	}else
       	{
       		alert('no Data');
       	}
       });
	});
  </script> -->

  <?php if($this->session->flashdata('partynotFound')): ?>
     <script type="text/javascript">
    function notify() {
        noty({
            text: '<?=$this->session->flashdata('partynotFound')?>',
            layout: 'topRight',
            type: 'error',
            closeButton: true,
            timeout: 2000
        });
    }
    window.onload = notify;
</script>

<?php endif;?>

<?php if($this->session->flashdata('incomenotFound')): ?>
     <script type="text/javascript">
    function notify() {
        noty({
            text: '<?=$this->session->flashdata('incomenotFound')?>',
            layout: 'topRight',
            type: 'error',
            closeButton: true,
            timeout: 2000
        });
    }
    window.onload = notify;
</script>

<?php endif;?>

</head>
<body>
<div class="container-fluid test">
<form method="POST" class="form-horizontal" action="<?php echo base_url().'index.php/monthlyReport/report/getReportFields'; ?>" >
<fieldset>
<legend>Generate Report</legend>
<div class="form-group">
  <label class="control-label" for="partyDrop">Party</label>  
  <select class="custom-select" name="partyName" id="partyName">
    <option value="">Select Party Name</option>
      <?php
		foreach ($partyDropdown as $party) {
			echo '<option value="'.$party['id'].'">'.$party['name'].'</option>';
		}
		?>
    </select>   
    <?php
    ?>
    <?php echo form_error('partyName'); ?> 
  </div>
<div class="form-group">
  <label class="control-label" for="fromDate">From</label>  
  <input id="fromDate" name="fromDate" type="text" placeholder="From Date" value="<?=set_value('fromDate')?>"  class="form-control" autocomplete="off">
   <?php echo form_error('fromDate'); ?> 
  </div>
<div class="form-group">
  <label class="control-label" for="toDate">To</label>
    <input id="toDate" name="toDate" type="text" placeholder="To Date" value="<?=set_value('toDate')?>"  class="form-control" autocomplete="off">
     <?php echo form_error('toDate'); ?> 
  </div>
  <input type="hidden" name="dateNotSelected" id="dateNotSelected">
<div class="form-group" style="text-align: center;">
  <label class="control-label" for="save"></label>
  <!-- <div class="col-md-8"> -->
    <button id="view" name="save" class="btn btn-success"><i class="fas fa-save"></i> Export</button>&nbsp;&nbsp;&nbsp;&nbsp;
    <!-- <a id="clear"  name="cnc" class="btn btn-success" href="<?php //echo base_url().'index.php/exhibition/exhibition/edit/'.$users['id']; ?>"><i class="fas fa-window-close"></i> Cancel</a> -->
    <!-- <button id="clear" name="clear" class="btn btn-danger">Reset</button> -->
</div>
</fieldset>
</form>
</div>
<hr>
<br><br><br><br>
</body>
</html>