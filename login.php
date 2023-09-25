<?php
if(empty($_POST['g-recaptcha-response'])){
  $captcha_error = 'Captcha is required';
 }else{
  $secret_key = '6LccTZUnAAAAAN7XgHGreSkdVph1zzUhFZiVJ9jD';
  $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);
  $response_data = json_decode($response);
  if(!$response_data->success){
   $captcha_error = 'Captcha verification failed';
  }
 }
?>
<html>  
    <head>  
        <title>Membuat Google Recaptcha Dengan PHP</title>  
          <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>  
    <body>  
    <div class="container" style="width: 600px">
   <h3 align="center">Membuat Google Recaptcha Dengan PHP</a></h3>
   <div class="panel panel-default">
      <div class="panel-heading">Register Form</div>
    <div class="panel-body">
     <form metod="post" id="captcha_form">
      <div class="form-group">
       <label>Email Address <span class="text-danger">*</span></label>
       <input type="text" name="email" id="email" class="form-control" />
       <span id="email_error" class="text-danger"></span>
      </div>
      <div class="form-group">
       <label>Password <span class="text-danger">*</span></label>
       <input type="password" name="password" id="password" class="form-control" />
       <span id="password_error" class="text-danger"></span>
      </div>
      <div class="form-group">
       <div class="g-recaptcha" data-sitekey="6LccTZUnAAAAABNJMBxm9t1WnVWFL9AVtwfuL_xi"></div>
       <span id="captcha_error" class="text-danger"></span>
      </div>
      <div class="form-group">
       <input type="submit" name="register" id="register" class="btn btn-info" value="Register" />
      </div>
     </form>
     
    </div>
   </div>
  </div>
    </body>  
</html>

<script>
$(document).ready(function(){

 $('#captcha_form').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"process_data.php",
   method:"POST",
   data:$(this).serialize(),
   dataType:"json",
   beforeSend:function(){
    $('#register').attr('disabled','disabled');
   },
   success:function(data){
    $('#register').attr('disabled', false);
    if(data.success){
     $('#captcha_form')[0].reset();
     $('#email_error').text('');
     $('#password_error').text('');
     $('#captcha_error').text('');
     grecaptcha.reset();
     alert('Form Successfully validated');
    }else{
     $('#email_error').text(data.email_error);
     $('#password_error').text(data.password_error);
     $('#captcha_error').text(data.captcha_error);
    }
   }
  })
 });

});
</script>