<?php
  include("../Config/database.php");

  function AddUser($cnx,$data)
  {
    $req="DELETE FROM Film WHERE Date IS NULL;";
    $res = $cnx->query($req);
  }


?>