<?php 
/** Get necessary files */
  include('resources/app/process.php');
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
            <a href="add" target="_self" class="btn btn-info"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add New</a>
          </p>
        </div>
      </div>
      <!-- List All Stored Names & Emails -->
        <div class="row">
          <div class="col-xs-12 text-center">
            <h3>List All Names & Emails</h3>
          </div>
          <div class="col-xs-12 col-md-8 col-md-offset-2">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                </tr>
              </thead>
              <tbody>
<?php
  //Get all records
  $items = getAllItems();
  if( $items ){
    foreach ($items as $item) {
?>
                <tr>
                  <td><?php echo $item['NAME']; ?></td>
                  <td><?php echo $item['EMAIL']; ?></td>
                </tr>
<?php
    }
  }else {
?>
                <tr>
                  <td colspan="2">No results found...</td>
                </tr>
<?php
  }
?>
              </tbody>
            </table>
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