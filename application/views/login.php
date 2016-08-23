<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Please Login</title>

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
          <h1>Please Login</h1>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <p>If you don't have an account, enter a username and password and
             click the Register button.
          </p>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <?php 
            if (isset($error)) {
              echo '<p class="bg-warning">' . $error . '</p>';
            }
          ?>
          <form method="POST" action="/star-game/login/check">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" name="username" id="username" placeholder="Username">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <button type="submit" name="login" class="btn btn-default">Login</button>
            <button type="submit" name="register" class="btn btn-default">Register</button>
          </form>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/star-game/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>