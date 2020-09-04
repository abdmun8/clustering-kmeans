<?php


if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = NULL;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    switch ($_REQUEST['action']) {
        case 'logout':
            session_destroy();
            header("location:" . BASE_URL);
            break;
        case 'data':
            getData();
            break;
        default:
            if (!isset($_SESSION['username'])) {
                load("login");
            }
            load("index");
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_REQUEST['action']) {
        case 'login':
            login();
            break;
        case 'simpan':
            saveData();
            break;
        case 'delete':
            deleteData();
            break;
        default:
            header("location:" . BASE_URL);
            break;
    }
}
