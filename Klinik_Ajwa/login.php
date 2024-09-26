<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Ajwa</title>
</head>
<body>
<?php
//call file to connect server Klinik Ajwa
include ("Header.php");?>

<?php
//This section processes submissions from the login form
//check if the form has been submitted
if($_SERVER['REQUEST_METHOD']== 'POST') {

//validate the username
if(!empty($_POST['ID'])){
    $un = mysqli_real_escape_string($connect, $_POST ['ID']);
} else {
    $un = FALSE;
    echo'<p class = "error"> You forgot to enter your ID.</p>';
}

//validate the password
if(!empty($_POST['Password'])){
    $p = mysqli_real_escape_string($connect, $_POST ['Password']);
} else {
    $p = FALSE;
    echo'<p class = "error"> You forgot to enter your password.</p>';
}



//if no problem
if ($un && $p) {

    $q = "SELECT ID, FirstName, LastName, Specialization, Password FROM Doktor WHERE (ID = '$un' AND Password = '$p')";

    // run the query and assign it to the variable $result
    $result = mysqli_query($connect, $q);

    // count the number of rows that match the username?password combination
    // if one database row (record) matches the input:
    if (mysqli_num_rows($result) == 1) {

        // start the session, fetch the record and insert the three values in an array
        session_start();
        $_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);

        echo '<p> Login successful. </p>';

        // cancel the rest of the script
        exit();
        
        mysqli_free_result($result);
        mysqli_close($connect);
    } else {
        echo '<p class="error"> The username and password entered do not match our records. <br> Perhaps you need to register, just click the register button.</p>';
    }

    mysqli_close($connect);
} else {
    echo '<p class="error"> Please enter both ID and Password.</p>';

}
}//end of submit conditional

?>

<h2 align = "center" >LOGIN</h2>

<form action = "login.php" method = "post">

<p><label class = "label" for = "ID"> ID: </label>
<input id = "ID" type = "text" name = "ID" size = "4" maxlength= "6"
value ="<?php if (isset($_POST['ID'])) echo $_POST ['ID'];?>" ></p>

<p><label class = "label" for = "Password"> Password: </label>
<input id = "Password" type = "password" name = "Password" size = "15" maxlength = "60"
value = "<?php if (isset($_POST['Password'])) echo $_POST ['Password'];?>" ></p>

<p>&nbsp;</p>
<p align = "left"><input id = "submit" type = "submit" name = "submit" value = "login"  />
    &nbsp;
<p align = "left"><input id = "reset" type = "reset" name = "reset" value = "login"  />

<p align = "center"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Don't have an account?
<a href= "register.php">Sign Up</a>

</p>
</div>
</div>

</body>
</html>