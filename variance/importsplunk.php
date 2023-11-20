<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
 
  <title>Import Splunk</title>
 
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
 
<body>
    <br />
    <div class="container">
        <nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Import Splunk</li>
				<!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
			</ol>
		</nav>

        <form action="splunkquery.php" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFileInput" aria-describedby="customFileInput" name="file" style="cursor: pointer;">
                    <label class="custom-file-label" for="customFileInput">Select file</label>
                </div>
                <div class="input-group-append">
                    <input type="submit" name="submit" value="Upload" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
 
</body>
 
</html>

<script src="./assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#customFileInput').on('change', function() {
            $('.custom-file-label').html($('#customFileInput').val());
        });
    });
</script>