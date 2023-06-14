<?php
include "includes/auto_load.req.php";
if(isset($_SESSION['message'])){
  $message = $_SESSION['message'];
}else{
  $message = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="icon" href="images/Logo.png" type="image/ico" />
    <title>Rwanda Trading Company</title>
<!--  background image and home design -->
<!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
   <script type="text/javascript">
    setInterval(function() {
    var d = new Date();
        $('#timer').text((d.getHours() +':' + d.getMinutes() + ':' + d.getSeconds() ));
    }, 1000); 
  </script>
  
  <style>
/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #1ABB9C; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #b30000; 
}
body, html {
  height: auto;
  font-family: Arial, Helvetica, sans-serif;
  background-color: #086AA7;
}

* {
  box-sizing: border-box;
}

.bg-img {
  /* The image used */
  background-image: url("img/pharmacy_bg0.png");

  min-height: auto;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}
/* Add styles to the form container */
.container {
  position: relative;
  right: 0px;
  margin: 0px;
  max-width: auto;
  font-size:16px;
  padding: 16px;
  margin-top:3%;
}
/* Full-width input fields */
input[type=text], input[type=password] {
  width: 90%;
  padding: 25px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}
input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}
/* Set a style for the submit button */
.btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  border: none;
  cursor: pointer;
  width: 90%;
  opacity: 0.9;
}
.btn:hover {
  opacity: 1;
}
</style>
</head>
<body class="bg-img">
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <div class="container" >
        <div class=""style="background-color: #c0d6e4;border-radius:10px;">
          <div class="card-header" style="background-color: #c0d6e4; border-radius:10px;">
            <div class="lockscreen-image" style="text-align:center;"><br>
              <img src="images/logo.png" alt="User Image" style="height:150px">
            </div>
            
            </div><hr>
          <div class="card-body">
            <?php echo $message; ?>
            <form action="router/action_page" method="post">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="inputEmail" name="username" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
                  <!--<label for="inputEmail">Username</label>--->
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required" autofocus="autofocus">
                  <!--<label for="inputPassword">Password</label>--->
                </div>
              </div>
              <input type="submit" class="btn btn-primary btn-sm" name="login_button" value="Login" >
            </form>
            <hr>
            
          </div>
          <div class="lockscreen-footer text-center" style="background:#c0d6e4;padding:5px;border-radius:10px;">
            This is a product of RTC <br>
            &copy; Copyright Reserved 2021-<?php echo date("Y"); ?>
            
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4"></div>
  </div>
  
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
