<?php
include 'FormHelper.php';
$_SERVER['REQUEST_METHOD'] = 'GET';
$form = new FormHelper();
$errors = array();
$dishes = array('a'=>'b','c'=>'d');
