<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
<link href="<?php echo base_url('assets/css/top_header_v.css')?>" rel="stylesheet">
<title>Stalls Management</title>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?php echo base_url('assets/images/stall_logo.png')?>"><img width="50px" height="50px" src="<?php echo base_url('assets/images/stall_logo.png')?>"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active" id="pd">
        <a class="nav-link" href="<?php echo base_url().'index.php/party_details'; ?>">Party Details</a>
      </li>
      <li class="nav-item" id="exhibition">
        <a class="nav-link" href="<?php echo base_url().'index.php/exhibition/'; ?>">Exhibition</a>
      </li>
       <li class="nav-item" id="income">
        <a class="nav-link" href="<?php echo base_url().'index.php/income/'; ?>">Income</a>
      </li>
       <li class="nav-item" id="expense">
        <a class="nav-link" href="<?php echo base_url().'index.php/expense/'; ?>">Expense</a>
      </li>
      <li class="nav-item" id="report">
        <a class="nav-link" href="<?php echo base_url().'index.php/report/'; ?>">Report</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> --><a class="btn btn-success" href="<?php echo base_url().'index.php/logout' ; ?>"><i class="fas fa-sign-out-alt"></i> Logout</a><!-- </button> -->
    </form>
  </div>
</nav>
