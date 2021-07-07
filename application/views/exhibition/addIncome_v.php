<!DOCTYPE html>
<html>
<head>
	<title>Add Income</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	 <!-- Bootstrap Links -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <link href="<?php echo base_url('assets/css/top_header_v.css')?>" rel="stylesheet" media="all">
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
<form method="POST" class="form-horizontal" action="<?php echo base_url().'index.php/exhibition/exhibition/addIncome/'.$exhibition_Id.'/'.$stand_id.'/'.$party_id ; ?>" >
<fieldset>
<legend>Add Income</legend>
<div class="form-group">
  <label class="control-label" for="fname">Date</label>  
  <input id="fname" name="incomeDate" type="date" placeholder="Stand No" class="form-control">
  <?php echo form_error('incomeDate'); ?>
</div>
<div class="form-group">
  <label class="control-label" for="total_earning">Income</label>  
  <input id="total_earning" name="income" type="number" placeholder="Income"  class="form-control">
   <?php echo form_error('income'); ?> 
  </div>

<div class="form-group" style="text-align: center;">
  <label class="control-label" for="save"></label>
  <!-- <div class="col-md-8"> -->
    <button id="save" name="save" class="btn btn-success"><i class="fas fa-save"></i> Save</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a id="clear"  name="cnc" class="btn btn-success" href="<?php echo base_url().'index.php/exhibition/exhibition/editStand/'.$exhibition_Id.'/'.$stand_id; ?>"><i class="fas fa-window-close"></i> Cancel</a>
    <!-- <button id="clear" name="clear" class="btn btn-danger">Reset</button> -->
</div>
</fieldset>
</form>
</div>
</body>
</html>