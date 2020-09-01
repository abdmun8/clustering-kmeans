<?php
if (!isset($_SESSION['username'])) {
    load("login");
}

load("index");
