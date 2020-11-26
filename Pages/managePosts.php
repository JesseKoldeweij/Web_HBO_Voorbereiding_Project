<?php
if (!isAdmin()) {
    header('location: index.php?Pages=login');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h1>Ingelogd</h1>
<br>
<a href="index.php?logout" style="color: red;">Uitloggen</a>
<br>
<form method="POST" action="" id="" enctype="multipart/form-data">
    <label>Titel: </label><br>
    <input type="text" id="title" name="title"><br>
    <label>Bericht: </label><br>
    <textarea rows="4" cols="30" id="content" name="content"></textarea><br>
    <label>Afbeelding toevoegen: </label><br>
    <input type="file" name="image"><br>
    <input type="submit" value="submit" name="submit">
</form>
<div id="content">
</div>
</body>
</html>