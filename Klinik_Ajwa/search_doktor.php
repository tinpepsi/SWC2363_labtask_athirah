<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Patient Record</title>
</head>
<body>
<?php include ("header.php"); ?>

<form action="recordfound_doktor.php" method="post">
    <h1>Search record doktor</h1>
    <p>
        <label class="label" for="ID">ID: </label>
        <input id="ID" type="text" name="ID" size="30" maxlength="30" 
        value="<?php if (isset($_POST['ID'])) echo $_POST['ID']; ?>" />
    </p>
    <p><input id="submit" type="submit" name="submit" value="Search" /></p>
</form>

</body>
</html>
