<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  $('#provinces').change(function() {
    var id_province = $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_province,function:'provinces'},
      success: function(data){
          $('#districts').html(data); 
          $('#subdistricts').html(' '); 
          $('#subdistricts').val(' ');  
          $('#zip_code').val(' '); 
      }
    });
  });

  $('#districts').change(function() {
    var id_districts = $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_districts,function:'districts'},
      success: function(data){
          $('#subdistricts').html(data);  
      }
    });
  });

   $('#subdistricts').change(function() {
    var id_subdistricts= $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_subdistricts,function:'subdistricts'},
      success: function(data){
          $('#zip_code').val(data)
      }
    });
  
  });
</script>

