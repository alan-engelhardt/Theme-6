<?php
session_start();

$nav ="<a href='../index.php'>Frontpage</a>
        <a href='#'>Page 2</a>
        <a href='#'>Page 3</a>
        <a href='admin.php'>Admin</a>
        <a href='../inc/logout.php'>Logout</a>";

if(isset($_SESSION['user_ID'])){
    $nav ="<a href='../index.php'>Frontpage</a>
        <a href='#'>Page 2</a>
        <a href='#'>Page 3</a>
        <a href='admin.php'>Admin</a>
        <a href='../inc/logout.php'>Logout</a>";

    $title = "Admin area 1";
    $header = "<h1 class='private'>My admin area 1</h1>";
    $css = "../css/style.css";
    $name = $_SESSION['user_name'];
    $img = $_SESSION['user_image'];
    $content = "<h1>Hi $name, you are in!</h1>";
    $content .= "<img src='../images/$img' class='profile_image'>";

    include_once "../inc/template.php";

}else{
    header('Location: ../index.php');
}