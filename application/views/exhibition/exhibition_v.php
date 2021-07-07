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
  <script>
  	$(document).ready(function(){
        $("#pd").removeClass("active");
        $("#exhibition").addClass("active");
});
  </script>
</head>
<body>
<div class="container">
	<div class="row">
             <div class="ml-auto">
                    <button type="button" class="btn btn-default btn-filter float-right"><!-- <span class="glyphicon glyphicon-filter"></span> --><a class="btn btn-default  btn-primary" href="<?php echo base_url().'index.php/exhibition/exhibition/newExhibition' ; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Add</a></button>
                </div>
                <div class="table-responsive">
            <table class="table table-bordered" style="border-color:black;">
                <thead class="thead-dark">
                    <tr class="filters">
                        <!-- <th><input type="text" class="form-control" placeholder="#" disabled></th>
                        <th><input type="text" class="form-control" placeholder="First Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Last Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Username" disabled></th> -->
            <th>Id</th>
			<th>Total Counter</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Commission Received</th>
			<th>Comission Balance</th>
			<th>Total Comission</th>
			<th>Actions</th>
                    </tr>
                </thead>
                    <?php 
		if(!empty($fetch_records))
		{
			foreach ($fetch_records as $value) {
				?>
				<tr>
					<td><?php echo $value['id']; ?></td>
					<td><?php echo $value['total_stands']; ?></td>
					<td><?php echo $value['start_date']; ?></td>
					<td><?php echo $value['end_date']; ?></td>
					<td><?php echo $value['commission_received']; ?></td>
					<td><?php echo $value['comission_balance']; ?></td>
					<td><?php echo $value['total_comission']; ?></td>
					
					<td><a href="<?php echo base_url().'index.php/exhibition/exhibition/edit/'.$value['id'] ; ?>">Edit</a> <a href="<?php echo base_url().'index.php/exhibition/exhibition/deleteExhibition/'.$value['id'] ; ?>">Delete</a></td>
				</tr>
			<?php }
		}else
		{ ?>
			<tr><td colspan="8">No Data Found</td></tr>
		<?php } ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
<br><br><br><br><br>
<br><br><br>
</body>
</html>