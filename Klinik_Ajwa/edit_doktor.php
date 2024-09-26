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

    //look for First_Name
    if (empty($_POST['First_Name'])) {
        $error[] = 'you forgot to enter the First Name.';
    }else {
        $n = mysqli_real_escape_string($connect, trim($_POST['First_Name']));
    }

    //look for last name
    if (empty($_POST['Last_Name'])) {
        $error[] = 'you forgot to enter the Last Name.';
    }else {
        $l = mysqli_real_escape_string($connect, trim($_POST['Last_Name']));
    }

    //look for Specialization
    if (empty($_POST['Specialization'])) {
        $error[] = 'you forgot to enter the Specialization.';
    }else {
        $in = mysqli_real_escape_string($connect, trim($_POST['Specialization']));
    }

    //look for diagnose
    if (empty($_POST['Password'])) {
        $error[] = 'you forgot to enter the Password.';
    }else {
        $d = mysqli_real_escape_string($connect, trim($_POST['Password']));
    }

    //if no problem occured
    if(empty($error)) {
        $q = "SELECT ID FROM doktor WHERE Specialization = '$in' AND ID != $id";

        $result = @mysqli_query($connect, $q);

        if(mysqli_num_rows($result) == 0) {
            $q = "UPDATE doktor SET First_Name= '$n' , Last_Name = '$l' , Specialization = '$in', Password = '$d' WHERE ID= '$id' LIMIT 1";

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

$q = "SELECT First_Name, Last_Name, Specialization, Password FROM doktor WHERE ID=$id";
$result = @mysqli_query ($connect, $q);

if (mysqli_num_rows($result) == 1) {

    //get doctor information
    $row = mysqli_fetch_array ($result, MYSQLI_NUM);
    //Create the form

    echo '<form action = "edit_doktor.php" method = "post">
        <p><label class = "label" for = "First_Name" > First Name: </label>
        <input id = "First_Name" type = "text" name = "First_Name" size = "30" maxlength= "30" value = "' .$row[0].'"></p>

        <p><br><label class = "label" for = "Last_Name" > Last Name: </label>
        <input id = "Last_Name" type = "text" name = "Last_Name" size = "30" maxlength= "30" value = "' .$row[1].'"></p>

        <p><br><label class = "label" for = "Specialization" > Specialization: </label>
        <input id = "Specialization" type = "text" name = "Specialization" size = "30" maxlength= "30" value = "' .$row[2].'"></p>

        <p><br><label class = "label" for = "Password" > Password: </label>
        <input id = "Password" type = "text" name = "Password" size = "30" maxlength= "30" value = "' .$row[3].'"></p>

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