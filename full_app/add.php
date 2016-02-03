<?php
/** 
 * Setting CSRF Token For secure the data insertion
 */
  //Session Start
  session_start();
  //Create Token
  $csrf_token = md5( uniqid() );
  //Add token to session var
  $_SESSION['csrf_token'] = $csrf_token;
?>
<!--
  This Challenge was developed by Tiago Pais for SeedStars
  @email: tiagojfpais@gmail.com
  @linkedin: https://pt.linkedin.com/in/tiago-pais-2676234b
-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tiago Pais - Full APP Challenge</title>
    <!-- Bootstrap -->
    <link href="resources/css/bootstrap.min.css" rel="stylesheet">
    <link href="resources/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- CSS Stylesheet -->
    <link href="resources/css/styles.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="jumbotron text-center">
        <h1>Full App Challenge</h1>
        <p>&nbsp;</p>
        <p>Developed by Tiago Pais - <a href="mailto:tiagojfpais@gmail.com" target="_top">tiagojfpais@gmail.com</a></p>
      </div>
      <div class="main-page-content">
      <!-- Go to Other Pages -->
      <div class="row">
        <div class="col-xs-12">
          <p>
            <a href="." target="_self" class="btn btn-primary"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home</a>&nbsp;
            <a href="list" target="_self" class="btn btn-info"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>&nbsp;List All</a>
          </p>
        </div>
      </div>
<?php /** Notifications */
  if ( isset($_SESSION['errors']) || isset($_SESSION['success']) ) {
?>
      <!-- Notifications Area -->
      <div class="row">
<?php
    if( isset($_SESSION['errors']) ) {
?>
          <div class="col-xs-12"><p class="alert-msg bg-danger"><b><?php echo $_SESSION['errors']; ?></b></p></div>
<?php
    }elseif ( isset($_SESSION['success']) ) {
?>
          <div class="col-xs-12"><p class="alert-msg bg-success"><b><?php echo $_SESSION['success']; ?></b></p></div>
<?php
    }
?>
      </div>
<?php 
  }
  //unseting session vars
  unset($_SESSION['errors']);
  unset($_SESSION['success']);
  //closing
  session_write_close();
?>
        <!-- Add New Names & Emails -->
        <div class="row">
          <div class="col-xs-12 text-center">
            <h3>Add New Name & Email</h3>
          </div>
          <div class="col-xs-12 col-md-8 col-md-offset-2">
            <form action="resources/app/process.php" method="POST">
              <div class="form-group">
                <input type="hidden" name="_token" value="<?php echo $csrf_token; ?>" />
                <label for="name">Name</label>
                <input type="name" class="form-control" id="name" name="name" placeholder="Enter name..." required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email..." required>
              </div>
              <button type="submit" class="btn btn-success">Submit</button>
              <button type="reset" class="btn btn-danger">Reset</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery -->
    <script src="resources/js/jquery.min.js"></script>
    <!-- Bootstrap Main -->
    <script src="resources/js/bootstrap.min.js"></script>
  </body>
</html>