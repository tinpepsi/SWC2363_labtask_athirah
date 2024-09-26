<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Patient Record</title>
</head>
<body>
<?php include ("header.php"); ?>

<form action="recordfound_pesakit.php" method="post">
    <h1>Search record patient</h1>
    <p>
        <label class="label" for="Insurance_Number">Insurance Number: </label>
        <input id="Insurance_Number" type="text" name="Insurance_Number" size="30" maxlength="30" 
        value="<?php if (isset($_POST['Insurance_Number'])) echo $_POST['Insurance_Number']; ?>" />
    </p>
    <p><input id="submit" type="submit" name="submit" value="Search" /></p>
</form>

</body>
</html>
