<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - Stalls Management</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title></title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="js/noty/packaged/jquery.noty.packaged.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-noty/2.4.1/packaged/jquery.noty.packaged.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/login_v.css'); ?>">

<?php if($this->session->flashdata('failed')): ?>
     <script type="text/javascript">
    function notify() {
        noty({
            text: '<?=$this->session->flashdata('failed')?>',
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
<div class="login-form test">
	<!-- <?php //echo validation_errors(); ?> -->

    <form class="form1" action="<?php echo base_url().'index.php/login/Login/loginchk'; ?>" method="post">
    	<!-- <?php 
    		$attributes = array('role'=>'form');
    		//echo form_open('',$attributes);
    	 ?> -->
         <div class="text-center" style="margin-top:-15px;">
             <img width="135px" height="135px" src="<?php echo base_url('assets/images/stall_logo.png')?>">
         </div>
        <h2 class="text-center">Log in</h2>       
        <div class="form-group">
            <input type="text" class="form-control" name="usr" placeholder="Username" value="<?php //echo htmlspecialchars($_POST['usr'] ?? '');?>" required="required">
        </div>
        <?php echo form_error('usr'); ?>
        <div class="form-group">
            <input type="password" class="form-control" name="pswd" placeholder="Password" value="<?php //echo htmlspecialchars($_POST['pswd'] ?? '');?>" required="required">
        </div>
        <?php echo form_error('pswd'); ?>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        <!-- </div> -->
        <!-- <div class="clearfix">
            <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
            <a href="#" class="float-right">Forgot Password?</a> -->
        <!-- </div>  -->    
    </form>
    <!-- <p class="text-center"><a href="#">Create an Account</a></p> -->
</div>
</body>
</html>