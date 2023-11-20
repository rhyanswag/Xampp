<?php include 'conn.php' ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="./assets/css/style.css" type="text/css"
            rel="stylesheet" />
        <link href="./assets/css/bootstrap.min.css" type="text/css"
            rel="stylesheet" />
    </head>
    <style>
    .img-url {
        background: url("demo-search-icon.png") no-repeat center right 7px;
    }
    </style>
    <body>
        <br />
        <div class="container">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Investigate</li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
                </ol>
            </nav>

            <div class="container justify-content-center">
                <form name='search' action='query.php' method='post'>
                    <div class="search">
                        <!-- <label>Search:</label> -->
                        <input value="Clear Field" class="submit-button btn btn-secondary btn-lg btn-block" onclick="clearMRNRN()">
                        <textarea type='text' name='searchitem' id='mrnrn'
                            class="img-url" id='keyword' onkeyup='textAreaAdjust(this)' style='overflow:hidden'></textarea>
                            
                            <br /><br />    
                            <input type="submit" name="submit" value="Submit" class="submit-button btn btn-outline-warning btn-lg btn-block">
                    </div>
                </form>
            </div>

        </div>
    </body>
</html>

<script>
function textAreaAdjust(element) {
    element.style.height = "1px";
    element.style.height = (25+element.scrollHeight)+"px";
}

function clearMRNRN() {
    document.getElementById("mrnrn").value = "";
}
</script>