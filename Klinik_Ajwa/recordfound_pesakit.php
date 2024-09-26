<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type = "text/css" href = "include.css" />
    <title>Document</title>
</head>
<body>
<?php include ("header.php"); ?>

<h2> Search result </h2>

<?php

if (isset($_POST['Insurance_Number'])) {
    $in = $_POST['Insurance_Number'];
}
$in = mysqli_real_escape_string($connect, $in);

$q = "SELECT ID_P, FirstName_P, LastName_P, Insurance_Number, Diagnose FROM pesakit WHERE Insurance_Number = '$in' ORDER BY ID_P";

$result = @mysqli_query($connect, $q);

if ($result) {

    echo'<table border = "2">
    <tr><td><b>ID</b></td>
    <td><b>First Name</b></td>
    <td><b>Last Name</b></td>
    <td><b>Insurance Number</b></td>
    <td><b>Diagnose</b></td>
    </tr>';

    //fetch and display record
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo '<tr>
        <td>' .$row['ID_P']. ' </td>
        <td>' .$row['FirstName_P']. ' </td>
        <td>' .$row['LastName_P']. ' </td>
        <td>' .$row['Insurance_Number']. ' </td>
        <td>' .$row['Diagnose']. ' </td>
        </tr>';
    }
    echo '</table>';
    mysqli_free_result($result);
    } else {
        echo '<p class = "error">If no record is shown, this is because you had an incorrect or missing entry in search form. 
            <br> Click the back button on the browser and try again.</p>';
        echo'<p>' .mysqli_error($connect). '<br><br/>Query:'.$q.'</p>';
    }
    mysqli_close($connect);

?>


</body>
</html>