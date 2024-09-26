<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Ajwa</title>
</head>
<body>
    
<?php
// Call file to connect to server
include("header.php");

// This query inserts a record in the clinic table
// Has form been submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $error = array(); // Initialize an error array

    // Check for a First_Name
    if (empty($_POST['First_Name'])) {
        $error[] = 'You forgot to enter your first name.';
    } else {
        $n = mysqli_real_escape_string($connect, trim($_POST['First_Name']));
    } 

    // Check for last name
    if (empty($_POST['Last_Name'])) {
        $error[] = 'You forgot to enter your last name.';
    } else {
        $l = mysqli_real_escape_string($connect, trim($_POST['Last_Name']));
    }

    // Check for Specialization
    if (empty($_POST['Specialization'])) {
        $error[] = 'You forgot to enter your specialization.';
    } else {
        $i = mysqli_real_escape_string($connect, trim($_POST['Specialization']));
    }
    
    // Check for a Password
    if (empty($_POST['Password'])) {
        $error[] = 'You forgot to enter your Password.';
    } else {
        $d = mysqli_real_escape_string($connect, trim($_POST['Password']));
    }
    
    //register the user in the database
    //make the query
        $q = "INSERT INTO doktor (ID, First_Name, Last_Name, Specialization, Password) 
        VALUES ('', '$n', '$l', '$i', '$d')";
        $result = @mysqli_query ($connect, $q); // Run the query

        if ($result) { // If query runs successfully
            echo '<h1>Thank you!</h1>';
            mysqli_close($connect);
            exit();
        } else { // If query fails
            // Message
            echo '<h1>System error</h1>';

            // Debugging message
            echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>';
        }

    mysqli_close($connect);
    exit();
} // End of the main submit conditional
?>

<h2> Register Doktor</h2>
<h4> *required field </h4>
<form action = "registerDoktor.php" method = "post">

<p><label class= "label" for = "First_Name"> First Name: *</label>
<input id = "First_Name" type ="text" name ="First_Name" size="30" maxlength = "150"
value="<?php if (isset($_POST['First_Name'])) echo $_POST ['First_Name']; ?> " /></p>

<p><label class= "label" for = "Last_Name"> Last Name: *</label>
<input id = "Last_Name" type ="text" name ="Last_Name" size="30" maxlength = "60"
value="<?php if (isset($_POST['Last_Name'])) echo $_POST ['Last_Name']; ?> " /></p>

<p><label class= "label" for = "Specialization"> Specialization: *</label>
<input id = "Specialization" type ="text" name ="Specialization" size="20" maxlength = "20"
value="<?php if (isset($_POST['Specialization'])) echo $_POST ['Specialization']; ?> " /></p>

<p><label class= "label" for = "Password"> Password: *</label>
<input id = "Password" type ="text" name ="Password" size="12" maxlength = "12"
value="<?php if (isset($_POST['Password'])) echo $_POST ['Password']; ?> " /></p>

<p><input id = "submit" type ="submit" name ="submit" value="Register" /> &nbsp;&nbsp;
<input id = "reset" type ="reset" name ="reset" value="Clear All" />
</p>
</form>
<p>
<br  />
<br  />
<br  />


</body>
</html>