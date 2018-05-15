<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 5/15/2018
 * Time: 11:52 AM
 */
session_start();
unset($_SESSION['user']);

header('location:login.php');