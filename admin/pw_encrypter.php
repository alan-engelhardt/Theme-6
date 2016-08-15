<!DOCTYPE html>

<?php
if(!empty($_POST['pw'])){
    $pw = $_POST['pw'];
}
?> 

<html lang="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>pw encrypter</title>
        <style>
            body{
                font-family: sans-serif;
            }
            .pw{
                border: 1px solid;
                width: 25em;
                padding: .5em;
                margin-top: -.5em;
            }
        </style>
    </head>

    <body>
        <h1>Php password encrypter</h1>
        <form method="post" action="">
            <label>Type password:
                <input type="text" name="pw" >
            </label>
            <input type="submit" value="encrypt">
        </form>
<?php
if(isset($pw)){
    echo "<p>Your password: ".$pw."</p>"; 
    echo "<h3>Copy encrypted password in the desired format:</h3>";
    echo "<p>SHA1 40 character hex number:</p><p class='pw'>".sha1($pw)."</p>"; 
    echo "<p>MD5 32 character hex number:</p><p class='pw'>".md5($pw)."</p>";
}
?>
    </body>
</html>