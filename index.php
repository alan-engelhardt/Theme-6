<?php
session_start();
// sessions to keep track if the user is aleady logged in, 
// and to be able to logout.
$css = "css/style.css";
$title = "This is my new public page";
$header = "<h1 class='public'>This is my public page</h1>";
$content = "";
$loginForm = "<p><form method='post' action=''>
                <label for='user'>Username</label>
                <input type='text' id='user' name='username' required>
                <label for='pw'>Password</label>
                <input type='password' id='pw' name='password' required>
                <input type='submit' name='login' id='login_button' value='Login'>
                </form></p>";

if(isset($_SESSION['user_ID'])){
    $nav = "<a href='index.php'>Frontpage</a>
            <a href='#'>Page 2</a>
            <a href='#'>Page 3</a>
            <a href='admin/admin.php'>Admin</a>
            <a href='admin/logout.php'>Logout</a>";
}else{
    $nav ="<a href='../index.php'>Frontpage</a>
        <a href='#'>Page 2</a>
        <a href='#'>Page 3</a>";
    $content .= "<h1>Please log in</h1> $loginForm";
}

if(isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])){
    $name = $_POST['username'];
    $pw = $_POST['password'];
    $incpw = sha1($pw);

    include_once "inc/credentials.php";
    $db = new PDO($dbInfo, $dbUser, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT id, name, image FROM users WHERE name = '$name' && pw = '$incpw'";
    $result = $db->query($sql);
    $validUser = $result->fetchObject();

    if($validUser){
        $_SESSION['user_ID'] = $validUser->id;
        $_SESSION['user_name'] = $validUser->name;
        $_SESSION['user_image'] = $validUser->image;
        header('Location: admin/admin.php');
    }else{
        $content = "<h1>Login failed. Please try again.</h1> $loginForm";
    }

}else{
    $content .= "<p>This is public </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce quis lectus quis sem lacinia nonummy. Proin mollis lorem non dolor. In hac habitasse platea dictumst. Nulla ultrices odio. Donec augue. Phasellus dui. Maecenas facilisis nisl vitae nibh. Proin vel est vitae eros pretium dignissim. Aliquam aliquam sodales orci. Suspendisse potenti. Nunc adipiscing euismod arcu. Quisque facilisis mattis lacus. Fusce bibendum, velit in venenatis viverra, tellus ligula dignissim felis, quis euismod mauris tellus ut urna. Proin scelerisque. Nulla in mi. Integer ac leo. Nunc urna ligula, gravida a, pretium vitae, bibendum nec, ante. Aliquam ullamcorper iaculis lectus. Sed vel dui. Etiam lacinia risus vitae lacus. Aliquam elementum imperdiet turpis. In id metus. Mauris eu nisl. Nam pharetra nisi nec enim. Nulla aliquam, tellus sed laoreet blandit, eros urna vehicula lectus, et vulputate mauris arcu ut arcu. Praesent eros metus, accumsan a, malesuada et, commodo vel, nulla. Aliquam sagittis auctor sapien. Morbi a nibh.</p>";
}

include_once "inc/template.php";