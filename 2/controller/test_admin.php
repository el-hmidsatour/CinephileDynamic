<?php

if($_SESSION['user']['role']!=='admin')
{
    header('Location:../view/home.php');
}

?>