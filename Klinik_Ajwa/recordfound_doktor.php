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

if (isset($_POST['ID'])) {
    $id= $_POST['ID'];
}
$id= mysqli_real_escape_string($connect, $id);

$q = "SELECT ID, First_Name, Last_Name, Specialization, Password FROM doktor WHERE ID = '$id' ORDER BY ID";

$result = @mysqli_query($connect, $q);

if ($result) {

    echo'<table border = "2">
    <tr><td><b>ID</b></td>
    <td><b>First Name</b></td>
    <td><b>Last Name</b></td>
    <td><b>Specialization</b></td>
    <td><b>Password</b></td>
    </tr>';

    //fetch and display record
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo '<tr>
        <td>' .$row['ID']. ' </td>
        <td>' .$row['First_Name']. ' </td>
        <td>' .$row['Last_Name']. ' </td>
        <td>' .$row['Specialization']. ' </td>
        <td>' .$row['Password']. ' </td>
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