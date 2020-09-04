<?php

/* ------------------------------- GET POST -------------------------------- */
function login()
{
    global $db;
    $req = $_POST;
    $sql = "SELECT * FROM user WHERE username = '{$req['username']}' AND password = md5('{$req['password']}')";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
        $_SESSION['username'] = $data['nama'];
        $_SESSION['nama'] = $data['nama'];
    } else {
        $_SESSION['login_gagal'] = TRUE;
    }
    header("location:" . BASE_URL);
}

// delete Data
function deleteData()
{
    $req = $_POST;
    // unset extra keys from post
    unset($_POST['table']);
    unset($_POST['action']);

    // set variable
    $table = $req['table'];
    $msg = "Data berhasil dihapus";
    $success = TRUE;
    $desc = "";
    $sql = "DELETE FROM $table WHERE id='{$_POST['id']}'";
    $result = query($sql);
    if ($result != TRUE) {
        $msg = $result;
        $success = FALSE;
    }
    echo json_encode(['msg' => $msg,  'success' => $success, 'description' => $desc]);
}
// save Data
function saveData()
{
    $req = $_POST;
    // unset extra keys from post
    unset($_POST['table']);
    unset($_POST['action']);

    // set variable
    $table = $req['table'];
    $msg = "Data berhasil disimpan";
    $success = TRUE;
    $desc = "";
    $cols = implode(',', array_keys($_POST));
    $values = implode("','", array_values($_POST));
    $sql = "INSERT INTO {$table} ($cols) VALUES ('$values')";

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        unset($_POST['id']);
        $template = "";
        foreach ($_POST as $key => $value) {
            $template .= "{$key}='$value',";
        }
        $template = substr($template, 0, strlen($template) - 1);
        $sql = "UPDATE {$table} set $template WHERE id='{$id}'";
    }

    $result = query($sql);
    if ($result != TRUE) {
        $msg = "Data gagal disimpan";
        $success = FALSE;
        $desc = $result;
    }
    echo json_encode(['msg' => $msg,  'success' => $success, 'description' => $desc]);
}

// save Detail
function saveDetail()
{
    $msg = "Data berhasil disimpan";
    $success = TRUE;
    $desc = "";
    $cols = implode(',', array_keys($_POST));
    $values = implode("','", array_values($_POST));
    $sql = "INSERT INTO {$_POST['table']} ($cols) VALUES ('$values')";
    $result = query($sql);
    if ($result != TRUE) {
        $msg = "Data gagal disimpan";
        $success = FALSE;
        $desc = $result;
    }
    echo json_encode(['msg' => $msg,  'success' => $success, 'description' => $desc]);
}

/* ------------------------------- GET REQUEST -------------------------------- */
function getData()
{
    $msg = "success";
    $success = TRUE;
    $sql = "";
    switch ($_GET['table']) {
        case 'nilai_siswa':
            if (isset($_GET['row'])) {
                $sql = "SELECT a.*,b.nama 
                        FROM {$_GET['table']} a 
                        LEFT JOIN siswa b ON a.id_siswa = b.id
                        WHERE a.id='{$_GET['id']}'";
                $data = select($sql, TRUE);
            } else {
                $data = $sql = "SELECT a.*,b.nama 
                        FROM {$_GET['table']} a 
                        LEFT JOIN siswa b ON a.id_siswa = b.id";
                $data = select($sql);
            }
            break;

        default:
            if (isset($_GET['row'])) {
                $sql = "SELECT * FROM {$_GET['table']} 
                    WHERE id='{$_GET['id']}'";
                $data = select($sql, TRUE);
            } else {
                $sql = "SELECT * FROM {$_GET['table']}";
                $data = select($sql);
            }
            break;
    }
    echo json_encode(['msg' => $msg,  'success' => $success, 'data' => $data]);
}

/* ------------------------------- BASE FUNCTION -------------------------------- */

// READ
function select($sql, $single = FALSE)
{
    global $db;
    $stmt = $db->prepare($sql);
    try {
        $stmt->execute();
        if ($single) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

// INSERT - UPDATE - DELETE
function query($sql)
{
    global $db;
    $stmt = $db->prepare($sql);
    try {
        $stmt->execute();
        return TRUE;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
