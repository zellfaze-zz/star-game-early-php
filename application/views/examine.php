<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Celestial Body Examine</title>

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
          <h1><?php echo $type; ?> (ID: <?php echo $id; ?>)</h1>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <a class="btn btn-default" href="/star-game/explore/explore/<?php echo $x; ?>/<?php echo $y; ?>">Back to System</a>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-5">
          <h3>Data</h3>
          <table class="table">
            <tr>
              <th>Size</th>
              <td><?php echo $size; ?></td>
            </tr>
            <?php
            foreach ($data as $key => $value) {
              if (is_bool($value)) {
                if ($value) {
                  $value = 'True';
                } else {
                  $value = 'False';
                }
              }
              echo '<tr>';
              echo '<th>' . $key . '</th>';
              echo '<td>' . strval($value) . '</td>';
              echo '</tr>';
            }
            ?>
          </table>
        </div>
      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/star-game/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>