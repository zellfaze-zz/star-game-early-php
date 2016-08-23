<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>We need a root user!</title>

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
          <h1>Whoa! There is no root!</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <p>This looks like it might be a new installation. You don't have a
             root user yet, which is required. Please enter a password for the
             root user below and we'll get right on making that account for
             you.
          </p>
        </div>
        
        <div class="col-md-12">
          <form method="POST" action="/star-game/login/createroot">
            <div class="form-group">
              <label for="password">Root Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-default">Create Root</button>
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