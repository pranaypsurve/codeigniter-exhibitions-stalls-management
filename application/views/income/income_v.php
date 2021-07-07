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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-noty/2.4.1/packaged/jquery.noty.packaged.min.js" integrity="sha512-deW7s7mlh1kdsULBlS05epcSl1Zze2KafJ4KH5kyOP3MkAYCbVC3lrVYoQ2lM1AlaWR3jYm+Myiad2sluDPoEg==" crossorigin="anonymous"></script>
  <link href="<?php echo base_url('assets/css/common_form_css/form_add_edit.css')?>" rel="stylesheet">
  <!-- Below jquery is only for date picker  -->
  <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" ></script> 
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>  
  <!-- below linked file have default current mnt and fltr btn and export btn flag setted -->
  <script type="text/javascript" src="<?=base_url()?>assets/js/common/income_expense_js/common_jq.js"></script>
  <script>
    $(document).ready(function(){
        $("#pd").removeClass("active");
        $("#exhibition").removeClass("active");
        $("#income").addClass("active");
});
  </script>
  <?php if($this->session->flashdata('incomeNotFound')): ?>
     <script type="text/javascript">
    function notify() {
        noty({
            text: '<?=$this->session->flashdata('incomeNotFound')?>',
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
	<div class="container">
     <div class="row p-3 filterDate" style="background-color: #f8f9fa;">
    <form class="form-inline" method="post" action="<?php echo base_url().'index.php/income/income/getfilters'; ?>">
      <input type="hidden" name="filter_flag" id="filter_flag">
          <label class="lb">From Date</label>&nbsp;&nbsp;
          <input type="text" class="form-control mr-5" id="fDate" autocomplete="off" name="fDate" value="<?=set_value('fDate')?>" placeholder="From Date">&nbsp;
          <label class="lb">To Date</label>&nbsp;&nbsp;
          <input type="text" class="form-control" id="tDate" autocomplete="off" name="tDate" value="<?=set_value('tDate')?>" placeholder="To Date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <button type="submit" class="btn btn-primary bnbn" id="fltr">Filter</button>&nbsp;&nbsp;&nbsp;
          <a href="<?php echo base_url().'index.php/income/income/index'; ?>" class="btn btn-primary bnbn">Clear</a>&nbsp;&nbsp;&nbsp;
          <button id="exp" class="btn btn-primary bnbn">Export</button>&nbsp;&nbsp;&nbsp;
    </form>
  </div>
	<div class="row">
             <div class="ml-auto">
                    <button type="button" class="btn btn-default btn-filter float-right"><!-- <span class="glyphicon glyphicon-filter"></span> --><a class="btn btn-default  btn-primary" href="<?php echo base_url().'index.php/income/income/add_income/'; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Add Income</a></button>
                </div>
                <div class="table-responsive">
            <table class="table table-bordered" style="border-color:black;">
                <thead class="thead-dark">
                  <tr>
                    <th>Date</th>
                    <th>Description</th>
              			<th>Amount</th>
              			<th>Actions</th>
                  </tr>
                </thead>
<?php
if (empty($filter_data)) 
{ 
		if(!empty($all_income))
		 {  
		 	foreach ($all_income as $value) {
				?>
				<tr>
					<td><?php echo $value['date']; ?></td>
          <td><?php echo $value['description']; ?></td>
					<td><?php echo $value['amount']; ?></td>
					<td><a href="<?php echo base_url().'index.php/income/income/edit_add_income/'.$value['income_id']; ?>">Edit</a> <a href="<?php echo base_url().'index.php/income/income/delete_income/'.$value['income_id']; ?>">Delete</a></td>
				</tr>
			<?php }
		 }else
		{ ?>
			<tr><td colspan="4">No Data Found</td></tr>
		<?php  } 
}else{
   foreach ($filter_data as $value) 
  {?>
     <td><?php echo $value['date']; ?></td>
          <td><?php echo $value['description']; ?></td>
          <td><?php echo $value['amount']; ?></td>
          <td><a href="<?php echo base_url().'index.php/income/income/edit_add_income/'.$value['income_id']; ?>">Edit</a> <a href="<?php echo base_url().'index.php//income/income/delete_income/'.$value['income_id']; ?>">Delete</a></td>
        </tr>
         <?php }
}
?>
                
            </table>
            </div>
        </div>
    </div>
</div>	
<br><br><br><br>
</body>
</html>