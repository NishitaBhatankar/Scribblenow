<?php
session_start();
header('Location:login_form.php');
session_destroy();
?>