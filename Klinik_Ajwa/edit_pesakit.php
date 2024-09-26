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
<h2> Edit a record </h2>

<?php
//look for a valid user id, either through GET or POST
if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
    $id = $_GET['id'];
}elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
    $id = $_POST['id'];
}else {
    echo '<p class = "error">This page has been accessed in error. </p>';
    exit();
}

if($_SERVER ['REQUEST_METHOD'] == 'POST') {
    $error = array();

    //look for Firstname
    if (empty($_POST['FirstName_P'])) {
        $error[] = 'you forgot to enter the First Name.';
    }else {
        $n = mysqli_real_escape_string($connect, trim($_POST['FirstName_P']));
    }

    //look for last name
    if (empty($_POST['LastName_P'])) {
        $error[] = 'you forgot to enter the Last Name.';
    }else {
        $l = mysqli_real_escape_string($connect, trim($_POST['LastName_P']));
    }

    //look for insurance number
    if (empty($_POST['Insurance_Number'])) {
        $error[] = 'you forgot to enter the Insurance Number.';
    }else {
        $in = mysqli_real_escape_string($connect, trim($_POST['Insurance_Number']));
    }

    //look for diagnose
    if (empty($_POST['Diagnose'])) {
        $error[] = 'you forgot to enter the Diagnose.';
    }else {
        $d = mysqli_real_escape_string($connect, trim($_POST['Diagnose']));
    }

    //if no problem occured
    if(empty($error)) {
        $q = "SELECT ID_P FROM pesakit WHERE Insurance_Number = '$in' AND ID_P != $id";

        $result = @mysqli_query($connect, $q);

        if(mysqli_num_rows($result) == 0) {
            $q = "UPDATE pesakit SET FirstName_P= '$n' , LastName_P = '$l' , Insurance_Number = '$in', Diagnose = '$d' WHERE ID_P= '$id' LIMIT 1";

            $result = @mysqli_query($connect, $q);

            if(mysqli_affected_rows($connect) == 1) {

                echo '<h3> The user has been edited</h3>';
            } else {
                echo '<p class = "error"> The user has not been edited due to the system error. We apologize for any inconvenience.</p>';
                echo '<p>' .mysqli_error($connect). '<br/> query: ' .$q. '</p>';
            }
        }else {
            echo '<p class = "error"> The no ic has already been register</p>';
        }

        }else {

            echo '<p class = "error"> The following error (s) occured: <br/>';
            foreach($error as $msg)
         
            {
                echo " -$msg<br/> \n";
        }
        echo '</p><p>Please try again.</p>';

    }
}

$q = "SELECT FirstName_P, LastName_P, Insurance_Number, Diagnose FROM pesakit WHERE ID_P=$id";
$result = @mysqli_query ($connect, $q);

if (mysqli_num_rows($result) == 1) {

    //get patient information
    $row = mysqli_fetch_array ($result, MYSQLI_NUM);
    //Create the form

    echo '<form action = "edit_pesakit.php" method = "post">
        <p><label class = "label" for = "FirstName_P" > First Name: </label>
        <input id = "FirstName_P" type = "text" name = "FirstName_P" size = "30" maxlength= "30" value = "' .$row[0].'"></p>

        <p><br><label class = "label" for = "LastName_P" > Last Name: </label>
        <input id = "LastName_P" type = "text" name = "LastName_P" size = "30" maxlength= "30" value = "' .$row[1].'"></p>

        <p><br><label class = "label" for = "Insurance_Number" > Insurance Number: </label>
        <input id = "Insurance_Number" type = "text" name = "Insurance_Number" size = "30" maxlength= "30" value = "' .$row[2].'"></p>

        <p><br><label class = "label" for = "Diagnose" > Diagnose: </label>
        <input id = "Diagnose" type = "text" name = "Diagnose" size = "30" maxlength= "30" value = "' .$row[3].'"></p>

        <br><p><input id = "submit" type = "submit" name = "submit" value = "Edit"></p>

        <br><input type = "hidden" name = "id" value = "'.$id.' "/>

        </form>';

} else {
    echo '<p class= "error"> This page has been acessed in error.</p>';
}

mysqli_close($connect);
?>

</body>
</html>