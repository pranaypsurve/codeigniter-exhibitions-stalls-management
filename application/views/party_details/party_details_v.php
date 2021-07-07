<!DOCTYPE html>
<html>
<head>
	<title>Party Details</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap Links -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Fontasowome ICON Pack -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script type="text/javascript" src="js/noty/packaged/jquery.noty.packaged.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-noty/2.4.1/packaged/jquery.noty.packaged.min.js"></script>
<script>
$(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});
</script>
<?php if($this->session->flashdata('sucess')): ?>
     <script type="text/javascript">
    function notify() {
        noty({
            text: '<?=$this->session->flashdata('sucess')?>',
            layout: 'topRight',
            type: 'success',
            closeButton: true,
            timeout: 2000
        });
    }
    window.onload = notify;
</script>
<?php endif;?>
<style>
	
.filterable {
    margin-top: 15px;
}
.filterable .panel-heading .pull-right {
    margin-top: -20px;
}
.filterable .filters input[disabled] {
    background-color: transparent;
    border: none;
    cursor: auto;
    box-shadow: none;
    padding: 0;
    height: auto;
}
.filterable .filters input[disabled]::-webkit-input-placeholder {
    color: #333;
}
.filterable .filters input[disabled]::-moz-placeholder {
    color: #333;
}
.filterable .filters input[disabled]:-ms-input-placeholder {
    color: #333;
}
</style>
</head>
<body>
<div class="container">
	<div class="row">
             <div class="ml-auto">
                    <button type="button" class="btn btn-default btn-filter float-right"><!-- <span class="glyphicon glyphicon-filter"></span> --><a class="btn btn-default  btn-primary" href="<?php echo base_url().'index.php/party_details/party_details/create' ; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Add</a></button>
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
			<th>Name</th>
			<th>Mobile No</th>
			<th>Email</th>
			<th>Back Balance</th>
			<th>Action</th>
                    </tr>
                </thead>
                    <?php 
		if($fetch_records > 0)
		{
			foreach ($fetch_records as $value) {
				?>
				<tr>
					<td><?php echo $value['id']; ?></td>
					<td><?php echo $value['name']; ?></td>
					<td><?php echo $value['mobile_no']; ?></td>
					<td><?php echo $value['email']; ?></td>
					<td><?php echo $value['back_balance']; ?></td>
					<td><a href="<?php echo base_url().'index.php/party_details/party_details/edit/'.$value['id'] ; ?>">Edit</a> <a href="<?php echo base_url().'index.php/party_details/party_details/delete/'.$value['id'] ; ?>">Delete</a></td>
				</tr>
			<?php }
		}else
		{ ?>
			<tr><td colspan="5">No Data Found</td></tr>
		<?php } ?>
                
            </table>
        </div>
        </div>
    </div>
</div>




</body>
</html>