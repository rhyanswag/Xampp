<title>Splunk Import Result</title>
<style>
<?php include './assets/css/bootstrap.min.css'; ?>
</style>

<?php
// include mysql database configuration file
include_once 'conn.php';
 
if (isset($_POST['submit']))
{
 
    // Allowed mime types
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );
 
    // Validate whether selected file is a CSV file
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
    {
        $file = $_FILES['file']['name'];
 
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
 
            // Skip the first line
            //fgetcsv($csvFile);

            echo "
                <br />
                <div class='container'>
            ";

            // Skip the first line
            $numcols = fgetcsv($csvFile);

            if (count($numcols) != 5) {
                echo "
                    <nav aria-label='breadcrumb'>
                        <ol class='breadcrumb'>
                            <li class='breadcrumb-item'><a href='index.php'>Home</a></li>
                            <li class='breadcrumb-item' aria-current='page'><a href='importsplunk.php'>Import Splunk</a></li>
                            <li class='breadcrumb-item active' aria-current='page'>Splunk import result</li>
                        </ol>
                    </nav>
                ";

                echo "
                    <div class='alert alert-danger' role='alert'>
                        File not match!
                    </div>
                ";

                die;
            }
 
            // Parse data from CSV file line by line
             // Parse data from CSV file line by line
            $counter = 0;
            while (($getData = fgetcsv($csvFile, 100000000, ",")) !== FALSE)
            {
                // Get row data
                $_time = $getData[0];
                $id = $getData[1];
                $processor_ref_no = $getData[2];
                $app_transaction_number = $getData[3];
                $state = $getData[4];

                mysqli_query($conn, "INSERT INTO splunk (_time,id,processor_ref_no,app_transaction_number,state) VALUES ('" . $_time . "', '" . $id . "', '" . $processor_ref_no . "', '" . $app_transaction_number . "', '" . $state ."' )");

                $counter++;
            }
 
            // Close opened CSV file
            fclose($csvFile);

            echo "
                <br />
                <div class='container'>
            ";

            echo "
                <nav aria-label='breadcrumb'>
                    <ol class='breadcrumb'>
                        <li class='breadcrumb-item'><a href='index.php'>Home</a></li>
                        <li class='breadcrumb-item' aria-current='page'><a href='importsplunk.php'>Import Splunk</a></li>
                        <li class='breadcrumb-item active' aria-current='page'>Splunk import result</li>
                    </ol>
                </nav>
            ";

            echo "
                <div class='alert alert-success' role='alert'>
                    $file successfully imported. $counter rows inserted.
                </div>
            ";
         
    }
    else
    {
        echo "
            <div class='alert alert-danger' role='alert'>
                $file invalid file.
            </div>
        ";
    }
}