<?php
  require_once('includes/load.php');
  require_once('includes/session.php');
  if(!$session->logout()) {redirect("index.php");}
?>
