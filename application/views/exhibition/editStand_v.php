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
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-noty/2.4.1/packaged/jquery.noty.packaged.min.js" integrity="sha512-deW7s7mlh1kdsULBlS05epcSl1Zze2KafJ4KH5kyOP3MkAYCbVC3lrVYoQ2lM1AlaWR3jYm+Myiad2sluDPoEg==" crossorigin="anonymous"></script>
  <link href="<?php echo base_url('assets/css/common_form_css/form_add_edit.css');?>" rel="stylesheet">
   <script>
    $(document).ready(function(){
        $("#pd").removeClass("active");
        $("#income").removeClass("active");
        $("#expese").removeClass("active");
        $("#exhibition").addClass("active");
});
  </script>
  <script type="text/javascript">
  	 $(document).ready(function() {
    // alert("Hello world!");
    tot1 = $('#totcom').val();
    tot2 = $('#total_earning').val();
    tot3 =  $('#combal').val();
    tot4 = $('#backbali').val();
    // alert(tot4);
     // alert(tot1+tot2);
    	 $('#total_earning').ready(function() { 
    		total1 = $('#total_earning').val();
    		total1 = total1 * 20 / 100;
        total1 = parseInt(total1) + parseInt(tot4);
    		$('#totcom').val(total1);
        // tot1 = $('#totcom').val();
               // alert(total1);
            }); 
    	$('#comrev').change(function() { 
        paid = $('#comrev').val();
        tot = $('#totcom').val();
        paid = tot-paid;
        $('#combal').val(paid);
               // alert(paid);
            }); 
      $('#comrev').ready(function() { 
        paid = $('#comrev').val();
        tot = $('#totcom').val();
        back = $('#backbali').val();
        
        paid = parseInt(tot) - parseInt(paid) ;
        // paid = parseInt(paid) 
        $('#combal').val(paid);
        
            });
      var combeforeclk = $("#comrev").val();
      var te = $("#te").val();
       $('#save').on("mouseover",function() {
          var compaidafterclk = $("#comrev").val();
          var te = $("#te").val();
          var res;
          var res2;
          console.log(compaidafterclk);
          if (combeforeclk == compaidafterclk) 
          {
            res=0;
          }else
          {
            res=1;
          }
          jQuery.ajax({
            type:'post',
            url:'<?php echo base_url();?>index.php/exhibition/exhibition/getflagForUpdateExhibitioncol',
            data:'partyid='+res,
            success:function(result){
               // alert(result);
               flag = result;
               // alert(flag);
               $("#flag").val(flag);
            }
          });
        });

       $("#smsflag").val(0);
       $("#sendsms").click(function(){        
        $("#smsflag").val(1); // Submit the form
    });
  });  
  </script>
  <?php if($this->session->flashdata('sent')): ?>
     <script type="text/javascript">
    function notify() {
        noty({
            text: '<?=$this->session->flashdata('sent')?>',
            layout: 'topRight',
            type: 'error',
            closeButton: true,
            timeout: 2000
        });
        // alert('<?=$this->session->flashdata('sent')?>');
    }
    window.onload = notify;
</script>

<?php endif;?>

<?php if($this->session->flashdata('fail')): ?>
     <script type="text/javascript">
    function notify() {
        noty({
            text: '<?=$this->session->flashdata('fail')?>',
            layout: 'topRight',
            type: 'error',
            closeButton: true,
            timeout: 3000
        });
        // alert('<?=$this->session->flashdata('fail')?>');
    }
    window.onload = notify;
</script>
<?php endif;?>
</head>
<body>
<div class="container-fluid test">
<form method="POST" class="form-horizontal form1" id="smsid" action="<?php echo base_url().'index.php/exhibition/exhibition/editStand/'.$users['exhibition_id'].'/'.$users['stand_id'] ; ?>" >
<fieldset>
<legend>Edit Stand</legend>
<div class="form-group">
  <label class="control-label" for="counterno">Counter No.</label>  
  <input id="counterno" name="counterno" type="text" placeholder="Counter No" value="<?php echo $users['stand_no']; ?>" class="form-control">
  <input type="hidden" id="flag" name="flag">
  <?php echo form_error('counterno'); ?>
</div>
<div class="form-group">
  <label class="control-label" for="sdate">Party</label>  
  <select class="custom-select" name="partyname">
      <?php 
      $partyvar = "";
    foreach($partyDropdown as $party)
    {
      if($party['id'] == $users['party_id'])
      {
        $partyvar = $party['id'];
        echo '<option value="'.$party['id'].'">'.$party['name'].'</option>';
      }
       // echo '<option value="'.$party['id'].'">'.$party['name'].'</option>'; 
    }
    ?>  
    </select>   
    <?php echo form_error('partyname'); ?> 
    <input id="partyid" name="partyid" value="<?php echo $partyvar; ?>" type="hidden">
  </div>
<div class="form-group">
  <label class="control-label" for="edate">Total Earning</label>  
  <input id="total_earning" name="totalearning" type="number" placeholder="Total Earning" value="<?php echo $totalSumIncome; ?>" class="form-control" readonly>
  <input type="hidden" id="te" name="te">
  <?php echo form_error('totalearning'); ?>
  </div>
<div class="form-group">
  <label class="control-label" for="comrev">Comission Paid</label>
    <input id="comrev" name="comissionpaid" type="number" placeholder="Comission Paid" value="<?php echo $users['comission_paid']; ?>" class="form-control">
    <?php echo form_error('comissionpaid'); ?>
  </div>
<div class="form-group">
  <label class="control-label" for="combal">Comission Balance</label>  
  <input id="combal" name="comissionbalance" type="text" placeholder="Comission Balance" value="<?php echo $users['comission_balance']; ?>" class="form-control" readonly>
  <?php echo form_error('comissionbalance'); ?>
  </div>
<div class="form-group">
  <label class="control-label" for="totalcom">Total Comission</label>  
  <input id="totcom" name="totalcomission" type="text" placeholder="Total Comission"value="<?php echo $users['total_comission']; ?>" class="form-control" readonly>
  </div>
  <div class="form-group">
  <label class="control-label" for="backbali">Back Balance</label>  
  <input id="backbali" name="backbalance" type="text" placeholder="Total Comission"value="<?php echo $users['back_balance']; ?>" class="form-control" readonly>
  </div>
  <div class="form-group">
  <label class="control-label" for="reference">Reference</label>  
  <input id="reference" name="reference" type="text" placeholder="Reference" value="<?php echo $users['reference']; ?>" class="form-control">
  </div>
  <div class="form-group">
  <label class="control-label" for="extra">Extra</label>  
  <input id="extra" name="extra" type="number" placeholder="Extra" value="<?php echo $users['extra']; ?>" class="form-control">
  </div>
  <input id="smsflag" name="smsflag" type="hidden">
<div class="form-group" style="text-align: center;">
  <label class="control-label" for="save"></label>
  <!-- <div class="col-md-8"> -->
    <button id="save" name="save" class="btn btn-success"><i class="fas fa-save"></i> Save</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a id="clear"  name="cnc" class="btn btn-success" href="<?php echo base_url().'index.php/exhibition/exhibition/edit/'.$exhibition_id['id']; ?>"><i class="fas fa-window-close"></i> Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <button id="sendsms"  name="sendsms" class="btn btn-success"><!-- <i class="fas fa-save"></i> --> Send SMS</button>
    <!-- <button id="clear" name="clear" class="btn btn-danger">Reset</button> -->
</div>
</fieldset>
</form>
</div>
<hr>
<div class="container">
  <div class="row">
             <div class="ml-auto">
                    <button type="button" class="btn btn-default btn-filter float-right"><!-- <span class="glyphicon glyphicon-filter"></span> --><a class="btn btn-default  btn-primary" href="<?php echo base_url().'index.php/exhibition/exhibition/addIncome/'.$users['exhibition_id'].'/'.$users['stand_id'].'/'.$users['party_id']  ; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Add Income</a></button>
                </div>
                <div class="table-responsive">
            <table class="table table-bordered" style="border-color:black;">
                <thead class="thead-dark">
                  <tr>
                    <th>Date</th>
                    <th>Income</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                
                    <?php 
    if(!empty($allincome))
     {
      // var_dump('expression'); die;
      foreach ($allincome as $value) {
        ?>
        <tr>
          <td><?php echo $value['date']; ?></td>
          <td><?php echo $value['income']; ?></td>
          <td><a href="<?php echo base_url().'index.php/exhibition/exhibition/editaddIncome/'.$value['exhibition_id'].'/'.$value['stand_id'].'/'.$value['income_id'] ; ?>">Edit</a> <a href="<?php echo base_url().'index.php/exhibition/exhibition/deleteincome/'.$value['exhibition_id'].'/'.$value['stand_id'].'/'.$value['income_id'] ; ?>">Delete</a></td>
        </tr>
      <?php }
     }else
    { ?>
      <tr><td colspan="8">No Data Found</td></tr>
    <?php  } ?>
                
            </table>
            </div>
        </div>
    </div>
</div>  
<br><br><br><br>
</div>
</body>
</html>