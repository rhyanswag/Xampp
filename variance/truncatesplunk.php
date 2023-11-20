<title>Truncate Splunk</title>
<style>
<?php include './assets/css/bootstrap.min.css'; ?>
</style>

<?php
include_once "conn.php";

// for ($i = 0; $i < count($table_list); $i++) {
//     echo $i. " " .$table_list[$i]. '<br />';
// }
// die;

echo "
    <br />
    <div class='container'>
";

echo "
    <nav aria-label='breadcrumb'>
        <ol class='breadcrumb'>
            <li class='breadcrumb-item'><a href='index.php'>Home</a></li>
            <li class='breadcrumb-item active' aria-current='page'>Truncate tables
        </ol>
    </nav>
";

    $query = "TRUNCATE TABLE splunk";

    // if (mysqli_multi_query($conn, $query)) {
    //     echo "Truncated Successfully";
    // } else {
    // echo "Error:" . mysqli_error($conn);
    // }

    if (mysqli_query($conn, $query)) {
        echo "
            <div class='alert alert-success' role='alert'>
                <i>Splunk</i> successfully truncated.
            </div>
        ";
    } else {
        echo "
            <div class='alert alert-danger' role='alert'>
                <i>Splunk</i> truncate failed.
            </div>
        ";
    }

echo "<div />";


?>