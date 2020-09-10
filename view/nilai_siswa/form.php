<div class="alert alert-success text-center" style="display: none;">OK</div>
<div class="data-page-header">
    <p>Tambah Nilai Siswa</p>
    <button class="btn btn-sm btn-primary" onclick="kembali()">Kembali</button>
</div>
<div class="card">
    <div class="card-body">
        <form id="form-input">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="kelas">Jenis kelamin</label>
                    <select id="id_siswa" name="id_siswa" class="form-control">
                        <option selected disabled value="">Pilih Siswa..</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Agama</label>
                    <input type="number" min="0" class="form-control" id="agama" name="agama" placeholder="Agama">
                </div>
                <div class="form-group col-md-3">
                    <label>Pkn</label>
                    <input type="number" min="0" class="form-control" id="pkn" name="pkn" placeholder="Pkn">
                </div>
                <div class="form-group col-md-3">
                    <label>B indonesia</label>
                    <input type="number" min="0" class="form-control" id="bind" name="bind" placeholder="B indonesia">
                </div>
                <div class="form-group col-md-3">
                    <label>B Inggris</label>
                    <input type="number" min="0" class="form-control" id="bing" name="bing" placeholder="B Inggris">
                </div>
                <div class="form-group col-md-3">
                    <label>MTK</label>
                    <input type="number" min="0" class="form-control" id="mtk" name="mtk" placeholder="MTK">
                </div>
                <div class="form-group col-md-3">
                    <label>Fisika</label>
                    <input type="number" min="0" class="form-control" id="fisika" name="fisika" placeholder="Fisika">
                </div>
                <div class="form-group col-md-3">
                    <label>Biologi</label>
                    <input type="number" min="0" class="form-control" id="biologi" name="biologi" placeholder="Biologi">
                </div>
                <div class="form-group col-md-3">
                    <label>Kimia</label>
                    <input type="number" min="0" class="form-control" id="kimia" name="kimia" placeholder="Kimia">
                </div>
                <div class="form-group col-md-3">
                    <label>Sejarah</label>
                    <input type="number" min="0" class="form-control" id="sejarah" name="sejarah" placeholder="Sejarah">
                </div>
                <div class="form-group col-md-3">
                    <label>Geografi</label>
                    <input type="number" min="0" class="form-control" id="geografi" name="geografi" placeholder="Geografi">
                </div>
                <div class="form-group col-md-3">
                    <label>Ekonomi</label>
                    <input type="number" min="0" class="form-control" id="ekonomi" name="ekonomi" placeholder="Ekonomi">
                </div>
                <div class="form-group col-md-3">
                    <label>Sosiologi</label>
                    <input type="number" min="0" class="form-control" id="sosiologi" name="sosiologi" placeholder="Sosiologi">
                </div>
                <div class="form-group col-md-3">
                    <label>Seni Budaya</label>
                    <input type="number" min="0" class="form-control" id="sbud" name="sbud" placeholder="Seni Budaya">
                </div>
                <div class="form-group col-md-3">
                    <label>PJOK</label>
                    <input type="number" min="0" class="form-control" id="pjok" name="pjok" placeholder="PJOK">
                </div>
                <div class="form-group col-md-3">
                    <label>B Arab</label>
                    <input type="number" min="0" class="form-control" id="barab" name="barab" placeholder="B Arab">
                </div>
            </div>
            <button type="button" class="btn btn-primary float-right" onclick="simpan()">Simpan</button>
            <button type="button" class="btn btn-warning mx-1 float-right" onclick="resetForm()">Reset</button>
        </form>
    </div>
</div>
<script>
    // set required form
    var required = [
        'id_siswa',
        'agama',
        'pkn',
        'bind',
        'bing',
        'mtk',
        'fisika',
        'biologi',
        'kimia',
        'sejarah',
        'geografi',
        'ekonomi',
        'sosiologi',
        'sbud',
        'pjok',
        'barab',
    ];
    req(base_url, 'GET', {
        table: 'siswa',
        action: 'data'
    }).then(res => {
        $('#id_siswa').children().not(':first').remove();
        res.data.forEach(function(item) {
            $('#id_siswa').append(`<option value="${item.id}">${item.nama} - ${item.nisn}</option>`);
        });
        // load data if parameter id exist
        <?= isset($_GET['id']) ? "getDataById('nilai_siswa', '{$_GET['id']}');" : ''; ?>
    }).catch(err => console.log(err));

    /**
     * back to previous page
     */
    function kembali() {
        loadPage('nilai_siswa/data')
    }

    /**
     * validate form
     */
    function validate() {
        return validateForm(required);
    }

    function resetForm() {
        clearForm(required);
    }

    /**
     * save data
     */
    function simpan() {
        if (!validate()) {
            return;
        }
        var extra = {
            table: 'nilai_siswa',
            action: 'simpan',
        }
        <?= isset($_GET['id']) ? "extra.id='{$_GET['id']}';" : ''; ?>
        saveData(extra);
    }
</script>