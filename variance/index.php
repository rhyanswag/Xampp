<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
 
  <title>Variance Investigation</title>
 
  <style>
    .custom-file-input.selected:lang(en)::after {
      content: "" !important;
    }
 
    .custom-file {
      overflow: hidden;
    }
 
    .custom-file-input {
      white-space: nowrap;
    }
  </style>
</head>
 
<body class="d-flex flex-column min-vh-100">
    <br />
    <div class="container">

        <div class="container justify-content-center">
            <div>
                <a href="importgiga.php" class="btn btn-outline-success btn-lg btn-block">Import Gigapay Raw Logs</a> 
            </div> <br />
            <div>
                <a href="importelp.php" class="btn btn-outline-primary btn-lg btn-block">Import ELP Raw Logs</a> 
            </div> <br />
            <div>
                <a href="importsplunk.php" class="btn btn-outline-info btn-lg btn-block">Import Splunk</a> 
            </div> <br />
            <div>
                <a href="investigate.php" class="btn btn-outline-warning btn-lg btn-block">Investigate</a> 
            </div>
        </div>

        

    </div>

    <footer class="mt-auto">
        <a href="truncategiga.php" class="btn btn-outline-dark btn-lg btn-block">Truncate Gigapay Raw Logs</a>
        <a href="truncateelp.php" class="btn btn-outline-dark btn-lg btn-block">Truncate ELP Raw Logs</a>
        <a href="truncatesplunk.php" class="btn btn-outline-dark btn-lg btn-block">Truncate Splunks</a>
        <a href="truncate.php" class="btn btn-outline-dark btn-lg btn-block">Truncate All Tables</a> 
    </footer>
 
</body>
 
</html>