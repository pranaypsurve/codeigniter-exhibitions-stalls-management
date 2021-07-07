<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="js/noty/packaged/jquery.noty.packaged.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-noty/2.4.1/packaged/jquery.noty.packaged.min.js" integrity="sha512-deW7s7mlh1kdsULBlS05epcSl1Zze2KafJ4KH5kyOP3MkAYCbVC3lrVYoQ2lM1AlaWR3jYm+Myiad2sluDPoEg==" crossorigin="anonymous"></script>

<?php if($this->session->flashdata('sucess')): ?>
    <!-- <script type="text/javascript">
        $.noty.defaults.killer = true;

        noty({
            text: '<?=$this->session->flashdata('sucess')?>',
            layout: 'top',
            type: 'error',
            closeButton: ['true']});
     </script> -->

     <script type="text/javascript">
    function notify() {
        noty({
            text: '<?=$this->session->flashdata('sucess')?>',
            layout: 'topRight',
            type: 'success',
            closeButton: true,
            timeout: 1000
        });
    }
    window.onload = notify;
</script>

<?php endif;?>