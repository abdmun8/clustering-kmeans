<?php

/* ------------------------------- GET POST -------------------------------- */
// login
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

// clustering process
function processClustering()
{
    $msg = "Data berhasil disimpan";
    $success = TRUE;
    $data = [];
    // data nilai
    $dns = json_decode($_POST['data_nilai'], TRUE);
    // standar nilai
    $sns = json_decode($_POST['standar_nilai'], TRUE);


    // var_dump($dns);
    // die;

    foreach ($dns as $keya => $dn) {
        $nilai = $dn;
        unset($nilai['id']);
        unset($nilai['id_siswa']);
        unset($nilai['nama']);
        unset($nilai['nisn']);

        // create sk
        $sk = [];
        // cek jarak
        foreach ($sns as $key => $sn) {
            $sk[$sn['kelas']] = getDistance($nilai, $sn);
        }

        // nilai
        $temp['mengeja'] = $dn['mengeja'];
        $temp['penjumlahan'] = $dn['penjumlahan'];
        $temp['menulis'] = $dn['menulis'];
        $temp['keaktifan'] =  $dn['keaktifan'];
        $temp['pengurangan'] = $dn['pengurangan'];
        $temp['mewarnai'] = $dn['mewarnai'];
        $temp['menggambar'] = $dn['menggambar'];
        $temp['mencocokan_bentuk'] = $dn['mencocokan_bentuk'];
        $temp['id_siswa'] = $dn['id_siswa'];
        $temp['nama'] = $dn['nama'];
        $temp['nisn'] = $dn['nisn'];
        $addedResult =  compareKey($sk);
        $newArr = array_merge($temp, $addedResult);
        $data[] = $newArr;
    }



    $iterasi = 1;
    $_SESSION['data'] = [];
    $_SESSION['data_nilai'] = $dns;
    $_SESSION['jumlah_iterasi'] =
        isset($_POST['jumlah_iterasi']) ? $_POST['jumlah_iterasi'] : 1;
    if (isset($_POST['is_new'])) {
        $_SESSION['iterasi'] = 0;
    }
    $_SESSION['iterasi']++;
    $temp_data['cluster_' . $iterasi] = $data;

    // c0 temp data
    $temp_data['c0' . $iterasi]['id'] = 1;
    // $temp_data['c0' . $iterasi]['nama'] = $data[0]['nama'];
    // $temp_data['c0' . $iterasi]['nisn'] = $data[0]['nisn'];
    $temp_data['c0' . $iterasi]['kelas'] = 'C0';
    $temp_data['c0' . $iterasi]['mengeja'] = 0;
    $temp_data['c0' . $iterasi]['penjumlahan'] = 0;
    $temp_data['c0' . $iterasi]['menulis'] = 0;
    $temp_data['c0' . $iterasi]['keaktifan'] = 0;
    $temp_data['c0' . $iterasi]['pengurangan'] = 0;
    $temp_data['c0' . $iterasi]['mewarnai'] = 0;
    $temp_data['c0' . $iterasi]['menggambar'] = 0;
    $temp_data['c0' . $iterasi]['mencocokan_bentuk'] = 0;
    // c0 temp data
    $temp_data['c1' . $iterasi]['id'] = 2;
    // $temp_data['c1' . $iterasi]['nama'] = $data[0]['nama'];
    // $temp_data['c1' . $iterasi]['nisn'] = $data[0]['nisn'];
    $temp_data['c1' . $iterasi]['kelas'] = 'C1';
    $temp_data['c1' . $iterasi]['mengeja'] = 0;
    $temp_data['c1' . $iterasi]['penjumlahan'] = 0;
    $temp_data['c1' . $iterasi]['menulis'] = 0;
    $temp_data['c1' . $iterasi]['keaktifan'] = 0;
    $temp_data['c1' . $iterasi]['pengurangan'] = 0;
    $temp_data['c1' . $iterasi]['mewarnai'] = 0;
    $temp_data['c1' . $iterasi]['menggambar'] = 0;
    $temp_data['c1' . $iterasi]['mencocokan_bentuk'] = 0;

    $temp_data['centroid_c0_' . $iterasi] = [];
    $temp_data['centroid_c1_' . $iterasi] = [];
    foreach ($data as $key => $value) {
        if ($value['C0'] < $value['C1']) {
            array_push($temp_data['centroid_c0_' . $iterasi], $value);

            // calculate sum
            $temp_data['c0' . $iterasi]['mengeja'] += $value['mengeja'];
            $temp_data['c0' . $iterasi]['penjumlahan'] += $value['penjumlahan'];
            $temp_data['c0' . $iterasi]['menulis'] += $value['menulis'];
            $temp_data['c0' . $iterasi]['keaktifan'] +=  $value['keaktifan'];
            $temp_data['c0' . $iterasi]['pengurangan'] += $value['pengurangan'];
            $temp_data['c0' . $iterasi]['mewarnai'] += $value['mewarnai'];
            $temp_data['c0' . $iterasi]['menggambar'] += $value['menggambar'];
            $temp_data['c0' . $iterasi]['mencocokan_bentuk'] += $value['mencocokan_bentuk'];
        } else {
            array_push($temp_data['centroid_c1_' . $iterasi], $value);

            // calculate sum
            $temp_data['c1' . $iterasi]['mengeja'] += $value['mengeja'];
            $temp_data['c1' . $iterasi]['penjumlahan'] += $value['penjumlahan'];
            $temp_data['c1' . $iterasi]['menulis'] += $value['menulis'];
            $temp_data['c1' . $iterasi]['keaktifan'] +=  $value['keaktifan'];
            $temp_data['c1' . $iterasi]['pengurangan'] += $value['pengurangan'];
            $temp_data['c1' . $iterasi]['mewarnai'] += $value['mewarnai'];
            $temp_data['c1' . $iterasi]['menggambar'] += $value['menggambar'];
            $temp_data['c1' . $iterasi]['mencocokan_bentuk'] += $value['mencocokan_bentuk'];
        }
    }

    // c0
    $temp_data['c0' . $iterasi]['mengeja'] = round($temp_data['c0' . $iterasi]['mengeja'] / count($temp_data['centroid_c0_' . $iterasi]), 2);
    $temp_data['c0' . $iterasi]['penjumlahan'] = round($temp_data['c0' . $iterasi]['penjumlahan'] / count($temp_data['centroid_c0_' . $iterasi]), 2);
    $temp_data['c0' . $iterasi]['menulis'] = round($temp_data['c0' . $iterasi]['menulis'] / count($temp_data['centroid_c0_' . $iterasi]), 2);
    $temp_data['c0' . $iterasi]['keaktifan'] = round($temp_data['c0' . $iterasi]['keaktifan'] / count($temp_data['centroid_c0_' . $iterasi]), 2);
    $temp_data['c0' . $iterasi]['pengurangan'] = round($temp_data['c0' . $iterasi]['pengurangan'] / count($temp_data['centroid_c0_' . $iterasi]), 2);
    $temp_data['c0' . $iterasi]['mewarnai'] = round($temp_data['c0' . $iterasi]['mewarnai'] / count($temp_data['centroid_c0_' . $iterasi]), 2);
    $temp_data['c0' . $iterasi]['menggambar'] = round($temp_data['c0' . $iterasi]['menggambar'] / count($temp_data['centroid_c0_' . $iterasi]), 2);
    $temp_data['c0' . $iterasi]['mencocokan_bentuk'] = round($temp_data['c0' . $iterasi]['mencocokan_bentuk'] / count($temp_data['centroid_c0_' . $iterasi]), 2);

    // c1
    $temp_data['c1' . $iterasi]['mengeja'] = round($temp_data['c1' . $iterasi]['mengeja'] / count($temp_data['centroid_c1_' . $iterasi]), 2);
    $temp_data['c1' . $iterasi]['penjumlahan'] = round($temp_data['c1' . $iterasi]['penjumlahan'] / count($temp_data['centroid_c1_' . $iterasi]), 2);
    $temp_data['c1' . $iterasi]['menulis'] = round($temp_data['c1' . $iterasi]['menulis'] / count($temp_data['centroid_c1_' . $iterasi]), 2);
    $temp_data['c1' . $iterasi]['keaktifan'] = round($temp_data['c1' . $iterasi]['keaktifan'] / count($temp_data['centroid_c1_' . $iterasi]), 2);
    $temp_data['c1' . $iterasi]['pengurangan'] = round($temp_data['c1' . $iterasi]['pengurangan'] / count($temp_data['centroid_c1_' . $iterasi]), 2);
    $temp_data['c1' . $iterasi]['mewarnai'] = round($temp_data['c1' . $iterasi]['mewarnai'] / count($temp_data['centroid_c1_' . $iterasi]), 2);
    $temp_data['c1' . $iterasi]['menggambar'] = round($temp_data['c1' . $iterasi]['menggambar'] / count($temp_data['centroid_c1_' . $iterasi]), 2);
    $temp_data['c1' . $iterasi]['mencocokan_bentuk'] = round($temp_data['c1' . $iterasi]['mencocokan_bentuk'] / count($temp_data['centroid_c1_' . $iterasi]), 2);

    $_SESSION['data']['loop' . $iterasi] = $temp_data;
    echo json_encode(['msg' => $msg,  'success' => $success, 'data' => $data]);
}

// compare closest standart
function compareKey($arr)
{
    $lowest = '';
    foreach (array_keys($arr) as $key => $value) {
        if ($key == 0) {
            $lowest = $value;
        } else {
            if ($arr[$value] < $arr[$lowest]) {
                $lowest = $value;
            }
        }
    }
    $arr['result'] = $lowest;
    return $arr;
}

// get distance nilai to standart
function getDistance($arrNilai, $arrStd)
{
    $keyNilai = array_keys($arrNilai);
    $cummulative = 0;
    foreach ($keyNilai as $key => $value) {
        $cummulative += pow(($arrStd[$value] - $arrNilai[$value]), 2);
    }

    return round(sqrt($cummulative), 2);
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
                $sql = "SELECT a.*,b.nama ,b.nisn
                        FROM {$_GET['table']} a 
                        LEFT JOIN siswa b ON a.id_siswa = b.id
                        WHERE a.id='{$_GET['id']}'";
                $data = select($sql, TRUE);
            } else {
                $data = $sql = "SELECT a.*,b.nama,b.nisn
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
