<div class="data-page-header">
    <p>Data Nilai Siswa</p>
    <div class="btn-group btn-group-sm" role="group">
        <button class="btn btn-sm btn-success" onclick="selectAll()">Pilih Semua</button>
        <button class="btn btn-sm btn-warning" onclick="deselectAll()">Batalkan Pilihan</button>
        <button class="btn btn-sm btn-primary" onclick="processClustering()">Proses</button>
    </div>

</div>
<div class="card">
    <div class="card-body">
        <div>
            <table class="table table-sm table-striped" id="table" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Agama</th>
                        <th>PKN</th>
                        <th>B Indonesia</th>
                        <th>B Inggris</th>
                        <th>Matematika</th>
                        <th>Fisika</th>
                        <th>biologi</th>
                        <th>Kimia</th>
                        <th>Sejarah</th>
                        <th>Geografi</th>
                        <th>Ekonomi</th>
                        <th>Sosiologi</th>
                        <th>Seni Budaya</th>
                        <th>PJOK</th>
                        <th>B Arab</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Clustering</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-content-wrapper">
                    <span>Hasil clustering dengan metode Algoritma K-Means</span>
                    <div class="mb-2">
                        <div class="button-group btn-group-sm">
                            <button onclick="printResult()" type="button" class="btn btn-primary">Print</button>
                        </div>
                    </div>
                </div>
                <div id="print-area">
                    Loading...
                </div>
            </div>
            <div class="modal-footer">
                <p><i>*Data yang ditampilkan adalah hasil perhitungan</i></p>
            </div>
        </div>
    </div>
</div>

<script>
    var table;
    var standar_nilai;
    var print_html;
    $(document).ready(function() {
        initTable();
        req(base_url, 'GET', {
            action: 'data',
            table: 'nilai_kelas'
        }).then(res => {
            if (res.success) {
                standar_nilai = res.data;
            }
        })
    });

    function processClustering() {
        let data_nilai = [];
        if (standar_nilai.length < 2) return alert('Silahkan isi minimal 2 Standar Nilai!')
        let data = table.rows('.selected').data();
        if (!data.length) return alert('Pilih data siswa');
        for (let index = 0; index < data.length; index++) {
            const item = data[index];
            data_nilai.push(item)
        }
        $('#staticBackdrop').modal('show')
        req(base_url, 'POST', {
            standar_nilai: JSON.stringify(standar_nilai),
            data_nilai: JSON.stringify(data_nilai),
            action: 'clustering'
        }).then(res => {
            if (res.success) {
                $('#print-area').html(geneRateTableReport(res.data));
            }
        });
    }

    function printResult() {
        var h = innerHeight;
        var w = innerWidth;
        var printWindow = window.open("", "MsgWindow", `width=${w},height=${h}`);
        printWindow.document.write(print_html);
        printWindow.document.write(`<style>
        th,td {border: 1px solid black;padding: 0;}
        table {width: 100%; border: 1px solid black; border-collapse: collapse;} 
        </style>`);
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        setTimeout(() => {
            printWindow.close();
        }, 1000)

    }

    function printDoc() {
        console.log(1)
        window.print()
    }

    function geneRateTableReport(data) {
        let html = `<table class="table table-sm table-striped table-bordered" width="100%" id="table-report">`;
        html += `<thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NISN</th>
            <th>BAHASA</th>
            <th>IPS</th>
            <th>IPA</th>
            <th>Kelas</th>
        </tr>
    </thead>`;
        html += `<tbody>`;
        for (let index = 0; index < data.length; index++) {
            const item = data[index];
            html += `<tr>
            <td>${index+1}</td>
            <td>${item.nama}</td>
            <td>${item.nisn}</td>
            <td class="text-right">${item['BAHASA']}</td>
            <td class="text-right">${item['IPS']}</td>
            <td class="text-right">${item['IPA']}</td>
            <td>${item.result}</td>
            </tr>`;
        }
        html += "</tbody> </ table> ";
        print_html = html
        return html;
    }

    function deselectAll() {
        table.rows().deselect()
    }

    function selectAll() {
        table.rows().select()
    }

    function initTable() {
        // param
        var params = {
            action: 'data',
            table: 'nilai_siswa'
        };
        // qs object
        var qs = objectToQueryString(params);
        table = $('#table').DataTable({
            ajax: base_url + qs,
            scrollX: true,
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }],
            select: {
                style: 'os multi',
                selector: 'td:first-child'
            },
            order: [
                [1, 'asc']
            ],
            language: {
                url: base_url + "assets/Indonesian.json",
            },
            scrollX: true,
            columns: [{
                    data: 'id',
                    render: () => ''
                },
                {
                    data: 'nama'
                },
                {
                    data: 'agama'
                },
                {
                    data: 'pkn'
                },
                {
                    data: 'bind'
                },
                {
                    data: 'bing'
                },
                {
                    data: 'mtk'
                },
                {
                    data: 'fisika'
                },
                {
                    data: 'biologi'
                },
                {
                    data: 'kimia'
                },
                {
                    data: 'sejarah'
                },
                {
                    data: 'geografi'
                },
                {
                    data: 'ekonomi'
                },
                {
                    data: 'sosiologi'
                },
                {
                    data: 'sbud'
                },
                {
                    data: 'pjok'
                },
                {
                    data: 'barab'
                },

            ],
            initComplete: function(settings, json) {
                this.api().columns.adjust().draw()
            }
        });
    }

    function hapus(id) {
        if (confirm("Apakah anda yakin akan mengahpus data ini?")) deleteData('nilai_siswa', id, table);
    }

    function tambah() {
        loadPage('nilai_siswa/form');
    }

    function edit(id) {
        loadPage('nilai_siswa/form', {
            id: id,
            table: 'nilai_siswa',
        });
    }
</script>