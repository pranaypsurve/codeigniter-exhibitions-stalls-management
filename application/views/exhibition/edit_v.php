<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
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
        // $(document).keydown(function(e)
        // { 
        //   // Code To Stop Inspect Element
        //   if(e.which === 123){ 
        //   return false; 
        // }
        // oncontextmenu="alert('Right Click is Not Allowed');return false"
        // onkeydown="return false;" onmousedown="return false;"
// }); 
});
  </script>
</head>
<body>
<div class="container-fluid test">
<form method="POST" class="form-horizontal form1" action="<?php echo base_url().'index.php/exhibition/exhibition/edit/'.$users['id']; ?>" >
<fieldset>
<legend>Edit Exhibition</legend>
<div class="form-group">
  <label class="control-label" for="totalstand">Total Counter</label>  
  <input id="totalstand" name="totalcounter" type="text" placeholder="Total Stand" value="<?php echo $users['total_stands']; ?>" class="form-control">
  <?php echo form_error('totalcounter'); ?>
</div>
<div class="form-group">
  <label class="control-label" for="sdate">Start Date</label>  
  <input id="sdate" name="startdate" type="date" placeholder="Start Date" value="<?php echo $users['start_date']; ?>" class="form-control" >
  <?php echo form_error('startdate'); ?>
  </div>
<div class="form-group">
  <label class="control-label" for="edate">End Date</label> 
  <input id="edate" name="enddate" type="date" placeholder="End Date" value="<?php echo $users['end_date']; ?>" class="form-control">
     <?php echo form_error('enddate'); ?>
  </div>
<div class="form-group">
  <label class="control-label" for="comrev">Commission Received</label>
  
    <input id="comrev" name="comr" type="number" placeholder="Commission Received"value="<?php echo $users['commission_received']; ?>" class="form-control" readonly>
  </div>
<div class="form-group">
  <label class="control-label" for="combal">Comission Balance</label>  
  <input id="combal" name="comb" type="text" placeholder="Comission Balance" value="<?php echo $users['comission_balance']; ?>" class="form-control" readonly>
  </div>
<div class="form-group">
  <label class="control-label" for="totalcom">Total Comission</label>  
  
  <input id="totalcom" name="totcom" type="text" placeholder="Total Comission"value="<?php echo $users['total_comission']; ?>" class="form-control" readonly>
    
  </div>
<div class="form-group" style="text-align: center;">
  <label class="control-label" for="save"></label>
  <!-- <div class="col-md-8"> -->
   <button id="save" name="save" class="btn btn-success"><i class="fas fa-save"></i> Save</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a id="clear"  name="cnc" class="btn btn-success" href="<?php echo base_url().'index.php/exhibition/exhibition/'; ?>"><i class="fas fa-window-close"></i> Cancel</a>
    <!-- <button id="clear" name="clear" class="btn btn-danger">Reset</button> -->
  
</div>
</fieldset>
</form>
</div>
<hr>
<div class="container">
	<div class="row">
             <div class="ml-auto">
                    <button type="button" class="btn btn-default btn-filter float-right"><!-- <span class="glyphicon glyphicon-filter"></span> --><a class="btn btn-default  btn-primary" href="<?php echo base_url().'index.php/exhibition/exhibition/newStand/'.$users['id'] ; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Add Stands</a></button>
                </div>
                <div class="table-responsive">
            <table class="table table-bordered" style="border-color:black;">
                <thead class="thead-dark ">
                  <tr>
                    <th class="align-middle">Party</th>
              			<th class="align-middle">Counter No</th>
              			<th class="align-middle">Total Earning</th>
              			<th class="align-middle">Comission Paid</th>
              			<th class="align-middle">Comission Balance</th>
              			<th class="align-middle">Total Comission</th>
                    <th class="align-middle">Back Balance</th>
                    <th class="align-middle">Reference</th>
                    <th class="align-middle">Extra</th>
              			<th class="align-middle">Actions</th>
                  </tr>
                </thead>
                
                    <?php 
		if(!empty($getAllStands))
		 {
      // var_dump('expression'); die;
		 	foreach ($getAllStands as $value) {
				?>
				<tr>
					<td><?php echo $value['party_name']; ?></td>
					<td><?php echo $value['stand_no']; ?></td>
					<td><?php echo $value['total_earning']; ?></td>
          <td><?php echo $value['comission_paid']; ?></td>
					<td><?php echo $value['comission_balance']; ?></td>
					<td><?php echo $value['total_comission']; ?></td>
					<td><?php echo $value['back_balance']; ?></td>
          <td><?php echo $value['reference']; ?></td>
          <td><?php echo $value['extra']; ?></td>
					<td><a href="<?php echo base_url().'index.php/exhibition/exhibition/editStand/'.$value['exhibition_id'].'/'.$value['stand_id'] ; ?>">Edit</a> <a href="<?php echo base_url().'index.php/exhibition/exhibition/deleteStand/'.$users['id'].'/'.$value['stand_id'] ; ?>">Delete</a></td>
				</tr>
			<?php }
		 }else
		{ ?>
			<tr><td colspan="10">No Data Found</td></tr>
		<?php  } ?>
                
            </table>
            </div>
        </div>
    </div>
</div>	
<br><br><br><br>
</body>
</html>