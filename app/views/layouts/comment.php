
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
    <link href="<?php echo $baseUrl ?>/assets/comment/font.css" rel="stylesheet">
    <link href="<?php echo $baseUrl ?>/assets/comment/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style="padding:0;">
    <div class="wrapper"style="background: #414d5b url('http://wikusamacup.com/assets/img/bg-home.jpg') fixed top center no-repeat;background-size: cover;">
      <div class="container pad-tb40" id="about" style="padding-top:10px;padding-bottom:0;">
			<div class="col-md-push-1 col-md-10 mar-bot50" align="center" style="margin-bottom:0;">
					<h1 class="title blue text-xlarge">"One Believe To Win The dreams"</h1>
          <div class="form">
                      <?php echo $flash['messages'] ?>

                      <?php echo $yield ?>
          </div>
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
        $('input[ name = milis ]').on( 'change', function(){
          if( 0 == $(this).val() )
            $( '#milis' ).slideDown();
          else
            $( '#milis' ).slideUp();
        });
      });
    </script>

  </body>
</html>
