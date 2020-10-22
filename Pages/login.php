<?php
$username = "";
$password    = "";
$errors   = array();
// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
    login();
}

// LOGIN USER
function login()
{
    global $con, $username, $errors;

    // grap form values
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // make sure form is filled properly
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // attempt login if no errors on form
    if (count($errors) == 0) {
        try {
            //check if username exists
            $query1 = "SELECT * FROM user WHERE username = ?";
            $stmt1 = $con->prepare($query1);
            $stmt1->execute(array($username));
            $result = $stmt1->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $hash = $result["password"];

                //check if password is correct with the username
                if (password_verify($password, $hash)) {
                    $query2 = "SELECT * FROM user WHERE username='$username' AND password='$hash' LIMIT 1";
                    $stmt2  = $con->prepare($query2);
                    $stmt2->execute();
                    if ($stmt2->rowCount() == 1) { // user found
                        $logged_in_user = $stmt2->fetch(PDO::FETCH_ASSOC);
                        if ($logged_in_user['user_type'] == 'admin') {
                            $_SESSION['user'] = $logged_in_user;
                            $_SESSION['success']  = "You are now logged in";
                            header('location: index.php?Pages=admin');
                        }else {
                            $_SESSION['user'] = $logged_in_user;
                            $_SESSION['success']  = "You are now logged in";

                            header('');
                        }
                    } else {
                        array_push($errors, "Wrong username/password combination");
                    }
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Log In</title>
    <link rel="stylesheet" type="text/css" href="css/StyleLogin.css">
</head>

<body>
<h1>Alfa news</h1>
<div id="FormContainer">
<form method="post" action="" id="login">
    <h2>Login</h2>
    <div class="input-group">
        <input type="text" name="username" placeholder="Username">
    </div>
    <div class="input-group">
        <input type="password" name="password" placeholder="Password">
    </div>
    <br>
    <div class="input-group">
        <button type="submit" class="btn" name="login_btn">Inloggen</button>
    </div>
</form>
</div>
</body>

</html>