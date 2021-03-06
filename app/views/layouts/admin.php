
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Wikusama Cup 2014 | <?php echo ( ! empty( $title ) ) ? $title : '' ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="<?php echo $baseUrl ?>/assets/css/dashboard.css" rel="stylesheet">
    <link href="<?php echo $baseUrl ?>/assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo $baseUrl ?>/dashboard">Wikusamacup 2014</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo $baseUrl ?>/logout">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="<?php echo ( ! empty( $homeActive ) ? $homeActive : '' ) ?>"><a href="<?php echo $baseUrl ?>/dashboard">Team Registration</a></li>
            <li class="<?php echo ( ! empty( $scheduleActive ) ? $scheduleActive : '' ) ?>"><a href="<?php echo $baseUrl ?>/admin/schedule">Schedule & Scoring</a></li>
            <li class="<?php echo ( ! empty( $commentActive ) ? $commentActive : '' ) ?>"><a href="<?php echo $baseUrl ?>/admin/comment">Comment</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><?php echo ( ! empty( $title ) ) ? $title : '' ?></h1>

          <?php echo $flash['messages'] ?>

          <?php echo $yield ?>

        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.3/moment.min.js"></script>
    <script src="<?php echo $baseUrl ?>/assets/js/bootstrap-datetimepicker.js"></script>
    <script src="<?php echo $baseUrl ?>/assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo $baseUrl ?>/assets/js/ie10-viewport-bug-workaround.js"></script>

    <script type="text/javascript">
        $(function () {
            $('#datetimepicker').datetimepicker();
        });
    </script>

  </body>
</html>
