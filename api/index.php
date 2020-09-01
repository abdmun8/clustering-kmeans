<?php

function load($filename)
{
    require_once("view/$filename.php");
    die;
}

require_once('config.php');
require_once('data.php');
require_once('route.php');
