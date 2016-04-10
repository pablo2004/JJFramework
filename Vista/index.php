<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">

     <head>
          <title>Sistema</title>
          <meta charset="utf-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">

          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

          <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
          <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
         
          <link rel="stylesheet" href="Vista/recursos/app.css" />
          <script type="text/javascript" src="Vista/recursos/app.js"></script>

          <link rel="shortcut icon" type="image/x-icon" href="Vista/recursos/favicon.ico">
     </head>

     <body class="body">

          <nav class="navbar navbar-default navbar-fixed-top">
               <div class="container">
                    <div class="navbar-header">
                         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                         </button>
                         <a class="navbar-brand" href="#"><i class="fa fa-book"></i> Apps Logs</a>
                    </div>
               </div>
          </nav>

          <div class="container">
               <div class="row">
                    <?=$contenidoPrincipal; ?>
               </div>
          </div>

          <hr> 
     </body>

</html>