<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Galaxy Explorer</title>

    <!-- Bootstrap -->
    <link href="/star-game/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1>Galaxy Explorer (System: <?php echo $x . ', ' . $y; ?>)</h1>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12" style="margin-bottom: 2em;">
          <a class="btn btn-default" href="/star-game/explore/explore/<?php echo $x; ?>/<?php echo $y-1; ?>" >Up</a>
          <a class="btn btn-default" href="/star-game/explore/explore/<?php echo $x; ?>/<?php echo $y+1; ?>" >Down</a>
          <a class="btn btn-default" href="/star-game/explore/explore/<?php echo $x-1; ?>/<?php echo $y; ?>" >Left</a>
          <a class="btn btn-default" href="/star-game/explore/explore/<?php echo $x+1; ?>/<?php echo $y; ?>" >Right</a>
        </div>
      </div>
      
      <?php
        foreach ($system as $planet) {
          echo '<div class="row">' . PHP_EOL;
          echo '<div class="col-md-12">'  . PHP_EOL;
          echo '<p><a href="/star-game/explore/examine/' .$planet['id'] .'">' . $planet['type'] . '</a> (' . $planet['size'] . ')</p>'  . PHP_EOL;
          echo '</div>'  . PHP_EOL;
          echo '</div>'  . PHP_EOL;
        }
      ?>
      
    </div>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/star-game/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>