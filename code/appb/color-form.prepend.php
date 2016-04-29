<?php
include 'FormHelper.php';
$_SERVER['REQUEST_METHOD'] = 'GET';
$form = new FormHelper();
$errors = array();
$colors = array('a'=>'b','c'=>'d');
