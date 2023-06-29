<?php
session_start();
unset($_SESSION["patientemail"]);
header("location:index.html");
?>