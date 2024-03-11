<?php
session_start();
$_SESSION["test"] = "f";
echo (isset($_SESSION));
