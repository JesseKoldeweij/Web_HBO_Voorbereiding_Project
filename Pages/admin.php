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
</body>
</html>