    $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd'
      });
      $(function() { 
                $( "#fDate" ).datepicker(); 
                $( "#tDate" ).datepicker(); 
            }); 

    $('#filter_flag').val(0);
    $(document).ready(function()
    {
      //below code for filter flag on hidden field
      $('#filter_flag').val(0);
      //below code for export button on clk and change flag value and biind current date
       $('#exp').click(function(){
         $('#filter_flag').val(1);
            var fdate = $('#fDate').val();
            var tdate = $('#tDate').val();
            var date = new Date();
            var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
            var fdate = $('#fDate').val();
            var tdate = $('#tDate').val();
          if(fdate == '')
          {
            firstDay = (firstDay.getFullYear()) + '/' + (firstDay.getMonth() + 1) + '/' + firstDay.getDate();
              fdate = $('#fDate').val(firstDay);
          }else{
             fdate = $('#fDate').val();
          }
          if (tdate == '') 
          {
            lastDay = (lastDay.getFullYear()) + '/' + (lastDay.getMonth() + 1) + '/' + lastDay.getDate();
             tDate = $('#tDate').val(lastDay);
          }else{
             tdate = $('#tDate').val();
          }
        });
       //below function is used for on filter button for change flag value for form submit
        $('#fltr').click(function(event){
          // event.preventDefault();
          $('#filter_flag').val(0);
            var date = new Date();
            var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
            var fdate = $('#fDate').val();
            var tdate = $('#tDate').val();
          if(fdate == '')
          {
            firstDay = (firstDay.getFullYear()) + '/' + (firstDay.getMonth() + 1) + '/' + firstDay.getDate();
              fdate = $('#fDate').val(firstDay);
          }else{
             fdate = $('#fDate').val();
          }
          if (tdate == '') 
          {
            lastDay = (lastDay.getFullYear()) + '/' + (lastDay.getMonth() + 1) + '/' + lastDay.getDate();
             tDate = $('#tDate').val(lastDay);
          }else{
             tdate = $('#tDate').val();
          }
        });
    });