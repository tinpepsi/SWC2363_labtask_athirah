<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php 
include("header.php");?>

<h2>Delete a record</h2>

<?php
// Look for a valid user ID, either through GET or POST
if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
    $id = $_GET['id'];
} elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
    $id = $_POST['id'];
} else {
    echo '<p class="error">This page has been accessed in error.</p>';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['sure']) && $_POST['sure'] == 'Yes') { // Delete the record
        // Make the query
        $q = "DELETE FROM pesakit WHERE ID_P=$id LIMIT 1";
        $result = @mysqli_query($connect, $q);

        if (mysqli_affected_rows($connect) == 1) { // If there was no problem
            // Display message
            echo '<h3>The record has been deleted.</h3>';
        } else {
            // Display error message
            echo '<p class="error">The record could not be deleted.<br>Probably because it does not exist or due to a system error.</p>';
            echo '<p>' . mysqli_error($connect) . '<br>Query: ' . $q . '</p>'; // Debugging message
        }
    } else {
        echo '<h3>The user has NOT been deleted.</h3>';
    }
} else {
    // Display the form
    // Retrieve the patient's data
    $q = "SELECT FirstName_P FROM pesakit WHERE ID_P=$id";
    $result = @mysqli_query($connect, $q);

    if (mysqli_num_rows($result) == 1) {
        // Get the patient's data
        $row = mysqli_fetch_array($result, MYSQLI_NUM);
        echo "<h3>Are you sure you want to permanently delete $row[0]?</h3>";
        echo '<form action="delete_pesakit.php" method="post">
              <input id="submit-yes" type="submit" name="sure" value="Yes">
              <input id="submit-no" type="submit" name="sure" value="No">
              <input type="hidden" name="id" value="' . $id . '">
              </form>';
    } else {
        echo '<p class="error">This page has been accessed in error.</p>';
    }
}

mysqli_close($connect);
?>

</body>
</html>
