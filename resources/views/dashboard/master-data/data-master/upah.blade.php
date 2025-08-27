<!-- Form Import Upah Start -->
<div id="formImportUpah" class="card border" style="display:none;">
    <div class="modal-content">
        <div class="card-header">
            <h4>Import Data</h4>
        </div>

        <div class="modal-body">
            <form method="post" action="/dashboard/master-data/upah-karyawan/import-user" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3">
                    <input type="file" name="file" class="form-control">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
            <button type="button" class="btn btn-outline-danger" onclick="hideImportUpah()">
                <i class=" fas fa-arrow-left mr-2"></i>Kembali
            </button>
            <div class="btn-group">
                <button type="button" class="btn btn-block btn-danger" class="fas fa-file-export mr-2"><i
                        class="fas fa-file-export mr-2"></i>Export</button>
                <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" id="iBtnExportUpah">(1) Data Upah</a>
                    <a class="dropdown-item" id="iBtnExportDataUser">(2) Data User</a>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Form Import Upah End -->

<!-- Form Edit Upah Start -->
<div id="formEditUpah" class="card border" style="display:none;">
    <div class="card-header">
        <h4>Edit Upah Karyawan</h4>
    </div>
    <form id="formData">
        <div class="modal-body">
            <div class="form-group">
                <label for="status">Status Karyawan</label>
                <select style="width: 100%" id="iStatusKaryawan" name="statusKaryawan" required></select>
            </div>
            <div class="form-group">
                <label for="dept">Departemen</label>
                <select style="width: 100%" id="iDepartemenUser" name="departemen" required></select>
            </div>

            <div class="form-group">
                <label for="sub-dept">Sub Departemen</label>
                <select style="width: 100%" id="iSubDepartemen" name="subDepartemen" required></select>
            </div>
            <div class="form-group">
                <label>Pos</label>
                <input name="pos" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label for="grade">Grade</label>
                <select style="width: 100%" id="iGrade" name="grade" required></select>
            </div>
            <div class="form-group">
                <label>ID Absen (4 digit)</label>
                <input name="idAbsen" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>NIP</label>
                <input name="username" type="text" class="form-control" autofocus>
                <small>Password untuk user baru sama dengan NIP. Setiap user dapat mengganti password melalui menu User
                    Profile.</small>
            </div>
            <div class="form-group">
                <label for="provi">Nama Karyawan</label>
                <select style="width: 100%" id="iNamaKaryawan" name="idKaryawan" required></select>
            </div>
            <div class="form-group">
                <label for="tipe">Type Kontrak</label>
                <select style="width: 100%" id="iTipeKontrak" name="tipe" required></select>
            </div>
            <div class="form-group">
                <label for="iTglDOJ">DOJ</label>
                <input type="text" id="iTglDOJ" name="tglDOJ" class="form-control">
            </div>
            <div class="form-group">
                <label>Masa Kerja</label>
                <input name="masaKerja" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>No Rekening</label>
                <input name="nominalTnjTransport" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="tipe">Skema BPJS</label>
                <select style="width: 100%" id="iSkemaBPJS" name="tipe" required></select>
            </div>
            <div class="form-group">
                <label for="tipe">Tipe Penggajian</label>
                <select style="width: 100%" id="iTipePenggajian" name="tipe" required></select>
            </div>
            <div class="form-group">
                <label>Gaji Pokok</label>
                <input name="intervalBulan" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Jabatan</label>
                <input name="intervalBulan" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Keahlian</label>
                <input name="intervalBulan" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Transport</label>
                <input name="intervalBulan" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Komunikasi</label>
                <input name="intervalBulan" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Tambahan Lainnya</label>
                <input name="intervalBulan" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>BPJS Kesehatan</label>
                <input name="tenor" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>BPJS TK</label>
                <input name="nominal" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>BPJS JP</label>
                <input name="tenor" type="text" class="form-control" autofocus>
            </div>
        </div>
        <div class="card-footer bg-whitesmoke">
            <div class="row justify-content-end">
                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                    <button type="button" class="btn btn-block btn-outline-danger" onclick="hideEditUpah()">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </button>
                </div>
                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                    <button type="submit" class="btn btn-block btn-success"><i
                            class="fas fa-check mr-2"></i>Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Form Edit Upah End -->

<button type="button" id="iImportUpah" class="btn btn-success w-auto mb-3">
    <i class="fas fa-plus mr-2"></i>Import
</button>


<div class="table-responsive">
    <table id="tableUpah" class="table table-striped table-bordered display nowrap" style="width: 100%">
        <thead>
            <tr>
                <th><input type="checkbox" id="allCheckboxUpah"></th>
                <th>Departemen</th>
                <th>Sub Departemen</th>
                <th>Pos</th>
                <th>Grade</th>
                <th>ID Absen / Username</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tipe Kontrak</th>
                <th>DOJ</th>
                <th>Masa Kerja</th>
                <th>No Rekening</th>
                <th>Skema BPJS</th>
                <th>Tipe Penggajian</th>
                <th>Updated At</th>
                <th>Gaji Pokok</th>
                <th>Jabatan</th>
                <th>Keahlian</th>
                <th>Transport</th>
                <th>Komunikasi</th>
                <th>Tambahan Lainnya</th>
                <th>BPJS-Kesehatan</th>
                <th>BPJS-TK</th>
                <th>BPJS-JP</th>
                <th>Action</th>
                <!-- <th>Simpanan Koperasi</th>
                                <th>Hutang Karyawan</th> -->
            </tr>
        </thead>
    </table>
</div>

<script>
function loadUpah() {
    if ($.fn.DataTable.isDataTable('#tableUpah')) {
        $('#tableUpah').DataTable().destroy();
    }

    $('#tableUpah').DataTable({
        ajax: {
                    url: "{{ url('dashboard/master-data/upah-karyawan/data') }}" 
                },
                columns: [
                    {data: 'id'},
                    {data: 'id_departemen'},
                    {data: 'subDepartemen'},
                    {data: 'pos'},
                    {data: 'grade'},
                    {data: 'id_absen'},
                    {data: 'username'},
                    {data: 'name'},
                    {data: 'tieKontrak'},
                    {data: 'doj'},
                    {data: 'masaKerja'},
                    {data: 'noRekening'},
                    {data: 'tipeBpjs',
                        render: function(data, type) {
                            let color;
                        if (data == '0') {
                            status = 'Normal';
                            color = 'green';
                        }
                        
                        else if (data == '1') {
                            status = 'Perusahaan';
                            color = 'blue';
                        }
                        else if (data == '2') {
                            status = 'Tidak Ikut';
                            color = 'orange';
                        }
                        else
                        {
                            status = 'Error';
                            color = 'red';
                        }
                        return '<span style="color:' + color + '">' + status + '</span>';
                    }
                    },
                    {data: 'statusSkemaGaji',
                        render: function(data, type) {
                            let color;
                        if (data == '1') {
                            status = 'Normal';
                            color = 'green';
                        }
                        
                        else if (data == '2') {
                            status = 'Harian';
                            color = 'orange';
                        }
                        else
                        {
                            status = 'Error';
                            color = 'red';
                        }
                        return '<span style="color:' + color + '">' + status + '</span>';
                    }
                    },

                    {data: 'updatedAt'},
                    {data: 'gajiPokok',
                    className: "text-right" ,
                    render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    {data: 'tunjanganJabatan',
                    className: "text-right" ,
                    render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    {data: 'tunjanganKeahlian',
                    className: "text-right" ,
                    render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    {data: 'tunjanganTransport',
                    className: "text-right" ,
                    render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    {data: 'tunjanganKomunikasi',
                    className: "text-right" ,
                    render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    {data: 'tambahanLainnya',
                    className: "text-right" ,
                    render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    {data: 'bpjsKes',
                    className: "text-right" ,
                    render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    {data: 'bpjsTk',
                    className: "text-right" ,
                    render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    {data: 'bpjsJp',
                    className: "text-right" ,
                    render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    // {data: 'simpananKoperasi',
                    // className: "text-right" ,
                    // render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    // {data: 'hutangKaryawan',
                    // className: "text-right" ,
                    // render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    { 
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <button type="button" id="iEditGrade" class="btn btn-warning edit-btn-upah" data-id="${row.username}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            `;
                        }
                    }
                ],
        paging: true,
        searching: true,
        ordering: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        language: {
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            paginate: {
                first: "Awal",
                last: "Akhir",
                next: "Next",
                previous: "Previous"
            },
        },
        scrollY: '400px',
        scrollCollapse: true,
        fixedHeader: true,
        responsive: true,
        scrollX: true,
        columnDefs: [{
            targets: 0,
            orderable: false,
            className: 'dt-body-center',
            render: function(data, type, row) {
                return `<input type="checkbox" class="rowCheckbox" />`;
            }
        }]
    });

    $('#allCheckboxUpah').on('change', function() {
        const checked = $(this).is(':checked');
        $('.rowCheckbox').prop('checked', checked);
    });

    $(document).on('change', '.rowCheckbox', function() {
        if (!$(this).is(':checked')) {
            $('#allCheckboxUpah').prop('checked', false);
        }
    });
}

// hide and show form import upah
function showImportUpah() {
    document.getElementById("formImportUpah").style.display = "block";
    document.getElementById("formEditUpah").style.display = "none";
}

function hideImportUpah() {
    document.getElementById("formImportUpah").style.display = "none";
    document.querySelector(".table-responsive").style.display = "block";
}

// hide and show edit upah
function showEditUpah() {
    document.getElementById("formEditUpah").style.display = "block";
    document.getElementById("formImportUpah").style.display = "none";
}

function hideEditUpah() {
    document.getElementById("formEditUpah").style.display = "none";
    document.querySelector(".table-responsive").style.display = "block";
}

document.addEventListener("DOMContentLoaded", function() {

    document.addEventListener("click", function(event) {
        let editButton = event.target.closest(".edit-btn-upah");
        if (editButton) {
            let dataID = editButton.getAttribute("data-id"); // Correct way to get the ID
            console.log(dataID);
            window.location = '{{ url('master-data-upah-karyawan-edit') }}-'+dataID;
        }
    });

    const importButton = document.getElementById("iImportUpah");
    if (importButton) {
        importButton.addEventListener("click", function() {
            showImportUpah();
        });
    }

    const editButton = document.getElementById("iEditUpah");
    if (editButton) {
        editButton.addEventListener("click", function() {
            showEditUpah();
        });
    }

    const exportUpah = document.getElementById("iBtnExportUpah");
    if (exportUpah) {
        exportUpah.addEventListener("click", function(e) {
            e.preventDefault();
            window.open('{{ url('dashboard/master-data/upah-karyawan/export-gaji') }}');
        });
    }
    const exportUpahDataUser = document.getElementById("iBtnExportDataUser");
    if (exportUpahDataUser) {
        exportUpahDataUser.addEventListener("click", function(e) {
            e.preventDefault();
            window.open('{{ url('dashboard/master-data/upah-karyawan/export') }}');
        });
    }
    
});

document.addEventListener('DOMContentLoaded', loadUpah);
</script>