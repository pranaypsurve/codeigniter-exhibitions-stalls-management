<!DOCTYPE html>
<html>
<head>
	<title>$title</title>
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
        $("#exhibition").removeClass("active");
        $("#income").addClass("active");
});
  </script>
</head>
<body>
<div class="container-fluid test">
<form method="POST" class="form-horizontal form1" action="<?php echo base_url().'index.php/income/income/add_income' ; ?>" >
<fieldset>
<legend>Add Income</legend>
<div class="form-group">
  <label class="control-label" for="incomedate">Date</label>  
  <input id="incomedate" name="incomedate" type="date" placeholder="Start Date" class="form-control">
  <?php echo form_error('incomedate'); ?>
  </div>
   <div class="form-group">
  <label class="control-label" for="incomedescription">Description</label>  
  <input id="expensedescription" name="incomedescription" type="text" placeholder="Description" class="form-control">
    <?php echo form_error('incomedescription'); ?>
  </div>
<div class="form-group">
  <label class="control-label" for="incomeamount">Amount</label>  
  <input id="incomeamount" name="incomeamount" type="number" placeholder="Amount" class="form-control">
    <?php echo form_error('incomeamount'); ?>
  </div>
<div class="form-group" style="text-align: center;">
  <label class="control-label" for="save"></label>
  <!-- <div class="col-md-8"> -->
    <button id="save" name="save" class="btn btn-success"><i class="fas fa-save"></i> Save</button>&nbsp;&nbsp;&nbsp;&nbsp;
    <a id="clear"  name="cnc" class="btn btn-success" href="<?php echo base_url().'index.php/income/income'; ?>"><i class="fas fa-window-close"></i> Cancel</a>
    <!-- <button id="clear" name="clear" class="btn btn-danger">Reset</button> -->
</div>
</fieldset>
</form>
</body>
</html>