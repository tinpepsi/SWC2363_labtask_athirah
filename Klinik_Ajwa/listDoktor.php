<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include ("header.php");?>

<?php
//make the query
$q = "SELECT ID, First_Name, Last_Name,Specialization,Password FROM Doktor ORDER BY ID";

//run the query
$result = @mysqli_query($connect, $q);

//if it ran without a problem, display the records
if($result)
{
    //table heading
    echo '<table border ="2">
    <tr><td><b>Edit</b></td>
    <td><b><b>Delete</b></td>
    <td><b><b>ID</b></td>
    <td><b><b>First Name</b></td>
    <td><b><b>Last Name</b></td>
    <td><b><b>Specialization</b></td>
    <td><b><b>Password</b></td>';

    //fetch and print all the records
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo '<tr>
        <td><a href = "edit_doktor.php?id=' .$row['ID'].'">Edit</a></td>
        <td><a href = "delete_doktor.php?id=' .$row['ID'].'">Delete</a></td>
        <td>' .$row ['ID']. '</td>
        <td>' .$row ['First_Name']. '</td>
        <td>' .$row ['Last_Name']. '</td>
        <td>' .$row ['Specialization']. '</td>
        <td>' .$row ['Password']. '</td>
        </tr>';
    }
    //close the table
    echo '</table>';

    //free up the resourced
    mysqli_free_result ($result);

    //if failed to run
}else{
    //error message
    echo '<p class = "error">The current student could not retrieve. We apologize for any inconvenience.</p>';

    //debugging message
    echo '<p>' .mysqli_error($connect). '<br><br>Query: ' . $q . '</p>';
} //end of it ($result)
//close the database connection
mysqli_close($connect);
?>

</div>
</div>
</body>
</html>