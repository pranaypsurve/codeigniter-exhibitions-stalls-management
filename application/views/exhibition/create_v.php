<!DOCTYPE html>
<html>
<head>
	<title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	 <!-- Bootstrap Links -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="<?php echo base_url('assets/css/common_form_css/form_add_edit.css')?>" rel="stylesheet">
   <script>
    $(document).ready(function(){
        $("#pd").removeClass("active");
        $("#income").removeClass("active");
        $("#expese").removeClass("active");
        $("#exhibition").addClass("active");
});
  </script>
</head>
<body>
<div class="container-fluid test">
<form method="POST" class="form-horizontal form1" action="<?php echo base_url().'index.php/exhibition/exhibition/newExhibition' ; ?>" >
<fieldset>
<legend>Add Exhibition</legend>
<div class="form-group">
  <label class="control-label" for="totalstand">Total Counter</label>  
  <input id="totalstand" name="totalcounter" type="text" placeholder="Total Counter" class="form-control">
  <?php echo form_error('totalcounter'); ?>
</div>
<div class="form-group">
  <label class="control-label" for="sdate">Start Date</label>  
  <input id="sdate" name="startdate" type="date" placeholder="Start Date" class="form-control">
  <?php echo form_error('startdate'); ?>
  </div>
<div class="form-group">
  <label class="control-label" for="edate">End Date</label>  
  <input id="edate" name="enddate" type="date" placeholder="End Date" class="form-control">
    <?php echo form_error('enddate'); ?>
  </div>
<div class="form-group">
  <label class="control-label" for="comrev">Commission Received</label>
    <input id="comrev" name="comr" type="number" placeholder="Commission Received" value="<?php echo 0; ?>" class="form-control" readonly>
    <?php //echo form_error('comr'); ?>
  </div>
<div class="form-group">
  <label class="control-label" for="combal">Comission Balance</label>  
  <input id="combal" name="comb" type="text" placeholder="Comission Balance" value="<?php echo 0; ?>" class="form-control" readonly>
  <?php //echo form_error('comb'); ?>
  </div>
<div class="form-group">
  <label class="control-label" for="totalcom">Total Comission</label>  
  
  <input id="totalcom" name="totcom" type="text" placeholder="Total Comission" value="<?php echo 0; ?>" class="form-control" readonly>
    
  </div>
<div class="form-group" style="text-align: center;">
  <label class="control-label" for="save"></label>
  <!-- <div class="col-md-8"> -->
    <button id="save" name="save" class="btn btn-success"><i class="fas fa-save"></i> Save</button>&nbsp;&nbsp;&nbsp;&nbsp;
    <a id="clear"  name="cnc" class="btn btn-success" href="<?php echo base_url().'index.php/exhibition/exhibition'; ?>"><i class="fas fa-window-close"></i> Cancel</a>
    <!-- <button id="clear" name="clear" class="btn btn-danger">Reset</button> -->
</div>
</fieldset>
</form>
</div>
</body>
</html>