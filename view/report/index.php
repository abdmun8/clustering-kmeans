<?php
session_start();
$data = $_SESSION['data']['loop1']['cluster_1'];
$bt = 'border-top: 1px solid black;';
$bb = 'border-bottom: 1px solid black;';
$br = 'border-right: 1px solid black;';
$bl = 'border-left: 1px solid black;';

?>
<!-- <h2 class="print-header" style="text-align:center;">Clustering Prestasi Siswa</h2> -->
<h4 style="text-align:center;">Iterasi ke-<?= $_SESSION['iterasi'] ?></h4>
<table cellspacing=" 0" class="table table-sm table-striped table-bordered" width="100%" id="table-report" style="width: 100%;">
    <thead class="thead-dark">
        <tr>
            <th style="text-align: left; <?= $bt . $br . $bl ?>">No</th>
            <th style="text-align: left; <?= $bt . $br ?>">Nama</th>
            <th style="text-align: left; <?= $bt . $br ?>">NISN</th>
            <th style="text-align: left; <?= $bt . $br ?>">Mengeja</th>
            <th style="text-align: left; <?= $bt . $br ?>">Penjumlahan</th>
            <th style="text-align: left; <?= $bt . $br ?>">Menulis</th>
            <th style="text-align: left; <?= $bt . $br ?>">Keaktifan</th>
            <th style="text-align: left; <?= $bt . $br ?>">Pengurangan</th>
            <th style="text-align: left; <?= $bt . $br ?>">Mewarnai</th>
            <th style="text-align: left; <?= $bt . $br ?>">Menggambar</th>
            <th style="text-align: left; <?= $bt . $br ?>">Mencocokan Bentuk</th>
            <th style="text-align: left; <?= $bt . $br ?>">C0</th>
            <th style="text-align: left; <?= $bt . $br ?>">C1</th>
            <th style="text-align: left; <?= $bt . $br ?>">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $index = 0;

        foreach ($data as $key => $value) {
            $index++;
            $isbb = $index == count($data) ? $bb : '';
        ?>
            <tr>
                <td style="<?= $bt . $br . $isbb . $bl ?>"><?= $index; ?></td>
                <td style="<?= $bt . $br . $isbb ?>"><?= $value['nama']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>"><?= $value['nisn']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['mengeja']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['penjumlahan']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['menulis']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['keaktifan']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['pengurangan']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['mewarnai']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['menggambar']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['mencocokan_bentuk']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['C0']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['C1']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: center;"><?= $value['C0'] < $value['C1'] ? 'Tidak Berprestasi' : 'Berprestasi'; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<?php
$datac0 = array_filter($data, function ($item) {
    return $item['C0'] < $item['C1'];
});
?>

<!-- <h2 class="print-header" style="text-align:center;">Clustering Prestasi Siswa</h2> -->
<h4 style="text-align:center;">Cluster 0 Iterasi-<?= $_SESSION['iterasi'] ?></h4>
<table cellspacing=" 0" class="table table-sm table-striped table-bordered" width="100%" id="table-report" style="width: 100%;">
    <thead class="thead-dark">
        <tr>
            <th style="text-align: left; <?= $bt . $br . $bl ?>">No</th>
            <th style="text-align: left; <?= $bt . $br ?>">Nama</th>
            <th style="text-align: left; <?= $bt . $br ?>">NISN</th>
            <th style="text-align: left; <?= $bt . $br ?>">Mengeja</th>
            <th style="text-align: left; <?= $bt . $br ?>">Penjumlahan</th>
            <th style="text-align: left; <?= $bt . $br ?>">Menulis</th>
            <th style="text-align: left; <?= $bt . $br ?>">Keaktifan</th>
            <th style="text-align: left; <?= $bt . $br ?>">Pengurangan</th>
            <th style="text-align: left; <?= $bt . $br ?>">Mewarnai</th>
            <th style="text-align: left; <?= $bt . $br ?>">Menggambar</th>
            <th style="text-align: left; <?= $bt . $br ?>">Mencocokan Bentuk</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $index = 0;

        foreach ($datac0 as $key => $value) {
            $index++;
            $isbb = $index == count($datac0) ? $bb : '';
        ?>
            <tr>
                <td style="<?= $bt . $br . $isbb . $bl ?>"><?= $index; ?></td>
                <td style="<?= $bt . $br . $isbb ?>"><?= $value['nama']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>"><?= $value['nisn']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['mengeja']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['penjumlahan']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['menulis']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['keaktifan']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['pengurangan']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['mewarnai']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['menggambar']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['mencocokan_bentuk']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<?php
$datac1 = array_filter($data, function ($item) {
    return $item['C0'] > $item['C1'];
});
?>

<!-- <h2 class="print-header" style="text-align:center;">Clustering Prestasi Siswa</h2> -->
<h4 style="text-align:center;">Cluster 1 Iterasi-<?= $_SESSION['iterasi'] ?></h4>
<table cellspacing=" 0" class="table table-sm table-striped table-bordered" width="100%" id="table-report" style="width: 100%;">
    <thead class="thead-dark">
        <tr>
            <th style="text-align: left; <?= $bt . $br . $bl ?>">No</th>
            <th style="text-align: left; <?= $bt . $br ?>">Nama</th>
            <th style="text-align: left; <?= $bt . $br ?>">NISN</th>
            <th style="text-align: left; <?= $bt . $br ?>">Mengeja</th>
            <th style="text-align: left; <?= $bt . $br ?>">Penjumlahan</th>
            <th style="text-align: left; <?= $bt . $br ?>">Menulis</th>
            <th style="text-align: left; <?= $bt . $br ?>">Keaktifan</th>
            <th style="text-align: left; <?= $bt . $br ?>">Pengurangan</th>
            <th style="text-align: left; <?= $bt . $br ?>">Mewarnai</th>
            <th style="text-align: left; <?= $bt . $br ?>">Menggambar</th>
            <th style="text-align: left; <?= $bt . $br ?>">Mencocokan Bentuk</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $index = 0;

        foreach ($datac1 as $key => $value) {
            $index++;
            $isbb = $index == count($datac1) ? $bb : '';
        ?>
            <tr>
                <td style="<?= $bt . $br . $isbb . $bl ?>"><?= $index; ?></td>
                <td style="<?= $bt . $br . $isbb ?>"><?= $value['nama']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>"><?= $value['nisn']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['mengeja']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['penjumlahan']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['menulis']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['keaktifan']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['pengurangan']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['mewarnai']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['menggambar']; ?></td>
                <td style="<?= $bt . $br . $isbb ?>text-align: right;"><?= $value['mencocokan_bentuk']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>




<h4 style="text-align:center;">Centroid <?= $_SESSION['iterasi'] ?></h4>
<table cellspacing=" 0" class="table table-sm table-striped table-bordered" width="100%" id="table-report" style="width: 100%;">
    <thead class="thead-dark">
        <tr>
            <th style="text-align: left; <?= $bt . $br . $bl ?>">Centroid</th>
            <th style="text-align: left; <?= $bt . $br ?>">Mengeja</th>
            <th style="text-align: left; <?= $bt . $br ?>">Penjumlahan</th>
            <th style="text-align: left; <?= $bt . $br ?>">Menulis</th>
            <th style="text-align: left; <?= $bt . $br ?>">Keaktifan</th>
            <th style="text-align: left; <?= $bt . $br ?>">Pengurangan</th>
            <th style="text-align: left; <?= $bt . $br ?>">Mewarnai</th>
            <th style="text-align: left; <?= $bt . $br ?>">Menggambar</th>
            <th style="text-align: left; <?= $bt . $br ?>">Mencocokan Bentuk</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="<?= $bt . $br . $bl ?>">C0</td>
            <td style="<?= $bt . $br ?>text-align: right;"><?= $_SESSION['data']['loop1']['c01']['mengeja']; ?></td>
            <td style="<?= $bt . $br ?>text-align: right;"><?= $_SESSION['data']['loop1']['c01']['penjumlahan']; ?></td>
            <td style="<?= $bt . $br ?>text-align: right;"><?= $_SESSION['data']['loop1']['c01']['menulis']; ?></td>
            <td style="<?= $bt . $br ?>text-align: right;"><?= $_SESSION['data']['loop1']['c01']['keaktifan']; ?></td>
            <td style="<?= $bt . $br ?>text-align: right;"><?= $_SESSION['data']['loop1']['c01']['pengurangan']; ?></td>
            <td style="<?= $bt . $br ?>text-align: right;"><?= $_SESSION['data']['loop1']['c01']['mewarnai']; ?></td>
            <td style="<?= $bt . $br ?>text-align: right;"><?= $_SESSION['data']['loop1']['c01']['menggambar']; ?></td>
            <td style="<?= $bt . $br ?>text-align: right;"><?= $_SESSION['data']['loop1']['c01']['mencocokan_bentuk']; ?></td>
        </tr>
        <tr>
            <td style="<?= $bt . $br . $bb . $bl ?>">C1</td>
            <td style="<?= $bt . $br . $bb ?>text-align: right;"><?= $_SESSION['data']['loop1']['c11']['mengeja']; ?></td>
            <td style="<?= $bt . $br . $bb ?>text-align: right;"><?= $_SESSION['data']['loop1']['c11']['penjumlahan']; ?></td>
            <td style="<?= $bt . $br . $bb ?>text-align: right;"><?= $_SESSION['data']['loop1']['c11']['menulis']; ?></td>
            <td style="<?= $bt . $br . $bb ?>text-align: right;"><?= $_SESSION['data']['loop1']['c11']['keaktifan']; ?></td>
            <td style="<?= $bt . $br . $bb ?>text-align: right;"><?= $_SESSION['data']['loop1']['c11']['pengurangan']; ?></td>
            <td style="<?= $bt . $br . $bb ?>text-align: right;"><?= $_SESSION['data']['loop1']['c11']['mewarnai']; ?></td>
            <td style="<?= $bt . $br . $bb ?>text-align: right;"><?= $_SESSION['data']['loop1']['c11']['menggambar']; ?></td>
            <td style="<?= $bt . $br . $bb ?>text-align: right;"><?= $_SESSION['data']['loop1']['c11']['mencocokan_bentuk']; ?></td>
        </tr>
    </tbody>
</table>



<script>
    <?php $_SESSION['jumlah_iterasi']-- ?>
    var base_url = '<?= $_SESSION['BASE_URL'] ?>';
    var sisa_iterasi = <?= $_SESSION['jumlah_iterasi'] ?>;
    var data_nilai = <?php echo json_encode($_SESSION['data_nilai']) ?>;
    var standar_nilai = <?php echo json_encode(
                            [
                                $_SESSION['data']['loop1']['c01'],
                                $_SESSION['data']['loop1']['c11']
                            ]
                        ) ?>;
    if (sisa_iterasi > 0) {

        var formData = new FormData();
        formData.append('standar_nilai', JSON.stringify(standar_nilai));
        formData.append('data_nilai', JSON.stringify(data_nilai));
        formData.append('jumlah_iterasi', <?= $_SESSION['jumlah_iterasi'] ?>);
        formData.append('action', 'clustering');
        fetch(base_url, {
                method: 'POST',
                body: formData,
            }).then(res => res.json())
            .then(data => {
                console.log(data)
                window.open(base_url + 'view/report/index.php')
            })
            .catch(err => console.log(err))
    }
</script>