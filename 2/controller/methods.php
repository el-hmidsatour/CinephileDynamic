<?php
  include("../Config/database.php");

  function AddUser($cnx,$data)
  {
    $req="INSERT INTO  users(nom,email,pass,join_date)".
    " VALUES('".$data["first_name"]." ".$data["last_name"].
    "','".$data["email"]."','".$data["password"].
    "',curdate()".");";
    $res = $cnx->query($req);
  }
?>