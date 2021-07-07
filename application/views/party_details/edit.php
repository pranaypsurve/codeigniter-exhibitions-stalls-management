<!DOCTYPE html>
<html>
<head>
	<title>Edit Party Detail Form</title>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->
    <!-- Main CSS-->
    <link href="<?php echo base_url('assets/css/main.css')?>" rel="stylesheet" media="all">
         <!-- Bootstrap Links -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <link href="<?php echo base_url('assets/css/common_form_css/form_add_edit.css');?>" rel="stylesheet">
</head>
<body>
<div class="container-fluid test">
 <form method="POST" class="form-horizontal form1" action="<?php echo base_url().'index.php/party_details/party_details/edit/'.$users['id'] ; ?>" >
<fieldset>
<legend>Edit Party Detail</legend>
<div class="form-group">
  <label class="control-label" for="partyName">Name</label>  
  <input id="partyName" name="partyName" type="text" placeholder="Name" value="<?php echo set_value('partyName',$users['name']); ?>" class="form-control">
  <?php echo form_error('partyName'); ?>
</div>
<div class="form-group">
  <label class="control-label" for="phoneNo">Phone Number</label>  
  <input id="phoneNo" name="phoneNo" type="number" placeholder="Phone Number" value="<?php echo set_value('phoneNo',$users['mobile_no']); ?>"  class="form-control">
  <?php echo form_error('phoneNo','<div class="addPartyDtl_error">*', '*</div>'); ?>
  </div>
<div class="form-group">
  <label class="control-label" for="comrev">Email</label>
    <input id="compaid" name="email" type="email" placeholder="xyz@example.com" value="<?php echo set_value('email',$users['email']); ?>"  class="form-control">
     <?php echo form_error('email','<div class="addPartyDtl_error">*', '*</div>'); ?>
  </div>
<div class="form-group">
  <label class="control-label" for="backBalance">Back Balance</label>  
  <input id="backBalance" name="backBalance" type="number" placeholder="Back Balance" value="<?php echo set_value('backBalance',$users['back_balance']); ?>" class="form-control">
  </div>
<div class="form-group" style="text-align: center;">
  <label class="control-label" for="save"></label>
  <!-- <div class="col-md-8"> -->
    <button id="save" name="save" class="btn btn-success"><i class="fas fa-save"></i> Save</button>&nbsp;&nbsp;&nbsp;&nbsp;
     <a id="clear"  name="cnc" class="btn btn-success" href="<?php echo base_url().'index.php/party_details/party_details/' ?>">
      <i class="fas fa-window-close"></i> Cancel</a>
    <!-- <button id="clear" name="clear" class="btn btn-danger">Reset</button> -->
</div>
</fieldset>
</form>
</div>
</body>
</html>
