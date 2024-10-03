  // แสดงภาพเมื่อเลือกไฟล์
  $(document).ready(function(){

    $('#upbtn').hide();
    $('#emppic').on('change', function() {
        var reader = new FileReader();
        var preview = document.getElementById('preview');
        // var imgname = document.getElementById('imgname');

        reader.onload = function () {         
          preview.src = reader.result;          
        };
        reader.readAsDataURL(event.target.files[0]);
        $('#imgname').text(event.target.files[0].name);

        if ($('#emppic').val() === "") {
          $('#upbtn').hide();
        }else{
          $('#upbtn').show();
        }
        
    });
  });
