<?php
if (strlen(trim($_POST['zipcode'])) != 5) {
    print "Please enter a ZIP Code that is 5 characters long.";
}