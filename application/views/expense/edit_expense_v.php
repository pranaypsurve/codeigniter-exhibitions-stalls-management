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

  <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" ></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script> 
  <script>
    $(document).ready(function(){
      $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd'
      });
      $(function() { 
                $( "#expensedate" ).datepicker(); 
                //$( "#toDate" ).datepicker(); 
            }); 

        $("#pd").removeClass("active");
        $("#exhibition").removeClass("active");
         $("#income").removeClass("active");
        $("#expense").addClass("active");
});
  </script>
</head>
<body>
<div class="container-fluid test">
<form method="POST" class="form-horizontal form1" action="<?php echo base_url().'index.php/expense/expense/edit_expense/'.$get_expense->expense_id ; ?>" >
<fieldset>
<legend>Edit Expense</legend>
<div class="form-group">
  <label class="control-label" for="expensedate">Date</label>  
  <input id="expensedate" name="expensedate" type="text" placeholder="Expense Date" value="<?php echo $get_expense->expense_date ?>" class="form-control">
  <?php echo form_error('expensedate'); ?>
  </div>
  <div class="form-group">
  <label class="control-label" for="expensedescription">Description</label>  
  <input id="expensedescription" name="expensedescription" type="text" placeholder="Description" value="<?php echo $get_expense->description ?>" class="form-control">
    <?php echo form_error('expensedescription'); ?>
  </div>
<div class="form-group">
  <label class="control-label" for="expenseamount">Amount</label>  
  <input id="expenseamount" name="expenseamount" type="number" placeholder="Amount" value="<?php echo $get_expense->expense_amount ?>" class="form-control">
    <?php echo form_error('expenseamount'); ?>
  </div>
<div class="form-group" style="text-align: center;">
  <label class="control-label" for="save"></label>
  <!-- <div class="col-md-8"> -->
    <button id="save" name="save" class="btn btn-success"><i class="fas fa-save"></i> Save</button>&nbsp;&nbsp;&nbsp;&nbsp;
    <a id="clear"  name="cnc" class="btn btn-success" href="<?php echo base_url().'index.php/expense/expense'; ?>"><i class="fas fa-window-close"></i> Cancel</a>
    <!-- <button id="clear" name="clear" class="btn btn-danger">Reset</button> -->
</div>
</fieldset>
</form>
</body>
</html>