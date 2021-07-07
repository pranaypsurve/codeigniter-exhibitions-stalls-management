<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?php echo base_url('assets/css/top_header_v.css')?>" rel="stylesheet" media="all">
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
  <script>
  	 $(document).ready(function() {
    	 $('#total_earning').change(function() { 
    		total1 = $('#total_earning').val();
    		total1 = total1 * 20 / 100;
    		$('#totcom').val(total1);
        $('#combal').val(total1);
               // alert(total1);
            }); 
    	 $('#compaid').change(function() { 
    		paid = $('#compaid').val();
    		tot = $('#totcom').val();
        back = $('#backbal').val();
        
    		paid = parseInt(tot) - parseInt(paid) + parseInt(back);
        // paid = parseInt(paid) 
        alert(paid);
    		$('#combal').val(paid);
               // alert(total1);
            }); 
        $('#partyDrop').on("change",function() {
          var partyName = $("#partyDrop").val();
          console.log(partyName);
          jQuery.ajax({
            type:'post',
            url:'<?php echo base_url();?>index.php/exhibition/exhibition/ajaxCode',
            data:'partyid='+partyName,
            success:function(result){
              // alert(result);
              $('#backbal').val(result);
            }
          });
        });
  });  
  </script>
</head>
<body>
<div class="container-fluid test">
<form method="POST" class="form-horizontal" action="<?php echo base_url().'index.php/exhibition/exhibition/newStand/'.$users['id'] ; ?>" >
<fieldset>
<legend>Add Stand</legend>
<div class="form-group">
  <label class="control-label" for="counterno">Counter No.</label>  
  <input id="counterno" name="counterno" type="text" placeholder="Counter No" class="form-control">
  <?php echo form_error('counterno'); ?>
</div>
<div class="form-group">
  <label class="control-label" for="partyDrop">Party</label>  
 <!--  <input id="lname" name="partyid" type="text" placeholder="Start Date" value="<?php echo $users['party_id']; ?>" class="form-control" required=""> -->
  <select class="custom-select" name="partyname" id="partyDrop">
    <option value="">Select Party Name</option>
      <?php
    foreach($partyDropdown as $party)
    {
        echo '<option value="'.$party['id'].'">'.$party['name'].'</option>';
    }
    ?>  
    </select>   
    <?php echo form_error('partyname'); ?> 
  </div>
<div class="form-group">
  <label class="control-label" for="total_earning">Total Earning</label>  
  <input id="total_earning" name="totalearning" type="number" placeholder="Total Earning" value="<?php echo 0; ?>"  class="form-control" readonly >
   <?php echo form_error('totalearning'); ?> 
  </div>
<div class="form-group">
  <label class="control-label" for="compaid">Comission Paid</label>
    <input id="compaid" name="comissionpaid" type="number" placeholder="Comission Paid" value="<?php echo 0; ?>"  class="form-control" readonly>
     <?php echo form_error('comissionpaid'); ?> 
  </div>
<div class="form-group">
  <label class="control-label" for="combal">Comission Balance</label>  
  <input id="combal" name="comissionbalance" type="text" placeholder="Comission Balance" value="<?php echo 0; ?>" class="form-control" readonly>
  </div>
<div class="form-group">
  <label class="control-label" for="totcom">Total Comission</label>  
  <input id="totcom" name="totalcomission" type="text" placeholder="Total Comission" value="<?php echo 0; ?>" class="form-control" readonly>
  </div>

  <div class="form-group">
  <label class="control-label" for="backbal">Back Balance</label>  
  <input id="backbal" name="backbalance" type="text" placeholder="Back Balance" value="<?php echo 0; ?>" class="form-control" readonly>
  </div>

  <div class="form-group">
  <label class="control-label" for="reference">Reference</label>  
  <input id="reference" name="reference" type="text" placeholder="Reference" value="<?php  ?>" class="form-control">
  </div>
  <div class="form-group">
  <label class="control-label" for="extra">Extra</label>  
  <input id="extra" name="extra" type="number" placeholder="Extra" value="<?php echo 0; ?>" class="form-control">
  </div>

<div class="form-group" style="text-align: center;">
  <label class="control-label" for="save"></label>
  <!-- <div class="col-md-8"> -->
    <button id="save" name="save" class="btn btn-success"><i class="fas fa-save"></i> Save</button>&nbsp;&nbsp;&nbsp;&nbsp;
    <a id="clear"  name="cnc" class="btn btn-success" href="<?php echo base_url().'index.php/exhibition/exhibition/edit/'.$users['id']; ?>"><i class="fas fa-window-close"></i> Cancel</a>
    <!-- <button id="clear" name="clear" class="btn btn-danger">Reset</button> -->
</div>
</fieldset>
</form>
</div>
</body>
</html>