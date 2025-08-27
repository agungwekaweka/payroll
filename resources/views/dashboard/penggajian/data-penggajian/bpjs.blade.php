<!-- Form Add BPJS Start -->
<div id="formAddBPJS" class="card border" style="display:none;">
    <div class="card-header">
        <h4>Tambah Data BPJS</h4>
    </div>
    <form id="formData">
        <div class="modal-body">
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
                <label for="nama">Nama</label>
                <select style="width: 100%" id="iNamaKaryawan" name="idKaryawan" required></select>
            </div>
            <div class="form-group">
                <label for="provi">Skema BPJS</label>
                <select style="width: 100%" id="iSkema" name="idSkema" required></select>
            </div>
            <div class="form-group">
                <label>BPJS TK</label>
                <input name="nominal" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>BPJS JP</label>
                <input name="tenor" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>BPJS Kesehatan</label>
                <input name="tenor" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>BPJS TK-Perusahaan</label>
                <input name="tenor" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>BPJS JP-Perusahaan</label>
                <input name="tenor" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>BPJS Kesehatan-Perusahaan</label>
                <input name="tenor" type="text" class="form-control" autofocus>
            </div>
        </div>
        <div class="card-footer bg-whitesmoke">
            <div class="row justify-content-end">
                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                    <button type="button" class="btn btn-block btn-outline-danger" onclick="hideFormAddBPJS()">
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
<!-- Form Add BPJS End -->

<!-- Form Edit BPJS Start -->
<div id="formEditBPJS" class="card border" style="display:none;">
    <div class="card-header">
        <h4>Edit Data BPJS</h4>
    </div>
    <form id="formData">
        <div class="modal-body">
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
                <label for="nama">Nama</label>
                <select style="width: 100%" id="iNamaKaryawan" name="idKaryawan" required></select>
            </div>
            <div class="form-group">
                <label for="provi">Skema BPJS</label>
                <select style="width: 100%" id="iSkema" name="idSkema" required></select>
            </div>
            <div class="form-group">
                <label>BPJS TK</label>
                <input name="nominal" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>BPJS JP</label>
                <input name="tenor" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>BPJS Kesehatan</label>
                <input name="tenor" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>BPJS TK-Perusahaan</label>
                <input name="tenor" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>BPJS JP-Perusahaan</label>
                <input name="tenor" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>BPJS Kesehatan-Perusahaan</label>
                <input name="tenor" type="text" class="form-control" autofocus>
            </div>
        </div>
        <div class="card-footer bg-whitesmoke">
            <div class="row justify-content-end">
                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                    <button type="button" class="btn btn-block btn-outline-danger" onclick="hideFormEditBPJS()">
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
<!-- Form Edit BPJS End -->

<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3 pt-4">
    <!-- <div class="d-flex align-items-center gap-3 mb-3 mb-md-0">
        <select class="form-select p-2 border border-gray-300 rounded-md" aria-label="Default select example">
            <option selected>-- PILIH PERIODE --</option>
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
        </select>

        <button type="button" id="iTambahBPJS" class="btn btn-primary w-auto ml-3">
            <i class="fas fa-plus mr-3"></i>Tambah
        </button>
    </div> -->
    <!-- <div class="dropdown">
        <button class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Action Export
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" id="iExportSelectedCheckBox">Export Selected Checkbox</a>
            <a class="dropdown-item" id="iExportAll">Export All</a>
        </div>
    </div> -->
</div>

<div class="table-responsive">
    <table id="tableBPJS" class="table table-striped table-bordered display nowrap" style="width: 100%">
        <thead>
            <tr>
                <th>
                    <input type="checkbox" id="selectAllCheckbox" />
                </th>
                <th>Departemen</th>
                <th>Sub Departemen</th>
                <th>Pos</th>
                <th>Grade</th>
                <th>ID Absen / Username</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Skema BPJS</th>
                <th>BPJS TK</th>
                <th>BPJS JP</th>
                <th>BPJS Kesehatan</th>
                <th>BPJS TK-Perusahaan</th>
                <th>BPJS JP-Perusahaan</th>
                <th>BPJS Kesehatan-Perusahaan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Total</th>
                <th><input style="text-align: right;width:150px" class="form-control" id="iTotalBpjsTk" type="text"
                        name="totalBpjsTk" readonly></th>
                <th><input style="text-align: right;width:150px" class="form-control" id="iTotalBpjsJp" type="text"
                        name="totalBpjsJp" readonly></th>
                <th><input style="text-align: right;width:150px" class="form-control" id="iTotalBpjsKesehatan"
                        type="text" name="totalBpjsKes" readonly></th>
                <th><input style="text-align: right;width:150px" class="form-control" id="iTotalBpjsTkPerusahaan"
                        type="text" name="totBpjsTkPerusahaan" readonly></th>
                <th><input style="text-align: right;width:150px" class="form-control" id="iTotalBpjsJpPerusahaan"
                        type="text" name="totBpjsJpPerusahaan" readonly></th>
                <th><input style="text-align: right;width:150px" class="form-control" id="iTotalBpjsKesPerusahaan"
                        type="text" name="totBpjsKesPerusahaan" readonly></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
function loadBPJS() {
    if ($.fn.DataTable.isDataTable('#tableBPJS')) {
        $('#tableBPJS').DataTable().destroy();
    }

    $('#tableBPJS').DataTable({
    ajax: {
        type: "GET",
        url: "{{ url('dashboard/penggajian/bpjs/data') }}",
        dataSrc: "data",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        },
        complete: function(xhr) {
            if (xhr.status !== 200) { // Periksa jika respons tidak berhasil
                console.log("Error:", xhr);
            } else if (xhr.responseJSON && xhr.responseJSON.total) {
                $('input[name="totalBpjsTk"]').val(xhr.responseJSON.total["iTotalBpjsTk"]);
                $('input[name="totalBpjsJp"]').val(xhr.responseJSON.total["iTotalBpjsJp"]);
                $('input[name="totalBpjsKes"]').val(xhr.responseJSON.total["iTotalBpjsKesehatan"]);
                $('input[name="totBpjsTkPerusahaan"]').val(xhr.responseJSON.total["iTotalBpjsTkPerusahaan"]);
                $('input[name="totBpjsJpPerusahaan"]').val(xhr.responseJSON.total["iTotalBpjsJpPerusahaan"]);
                $('input[name="totBpjsKesPerusahaan"]').val(xhr.responseJSON.total["iTotalBpjsKesPerusahaan"]);
            }
        }
    },
    processing: true,  
    // serverSide: true,  
    paging: true,
    searching: true,
    ordering: true,
    pageLength: 10,
    lengthMenu: [10, 25, 50, 100],
    scrollY: '400px',
    fixedHeader: true,
    responsive: true,
    scrollX: true,
    language: {
        search: "Search:",
        lengthMenu: "Show _MENU_ entries",
        info: "Showing _START_ to _END_ of _TOTAL_ entries",
        paginate: {
            first: "Awal",
            last: "Akhir",
            next: "Next",
            previous: "Previous"
        }
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
        {data: 'tipeBpjs',
            render: function(data) {
                let status, color;
                if (data == '0') {
                    status = 'Normal';
                    color = 'green';
                } else if (data == '1') {
                    status = 'Perusahaan';
                    color = 'orange';
                } else if (data == '2') {
                    status = 'Tidak Ikut';
                    color = 'red';
                } else {
                    status = 'Unknown';
                    color = 'gray';
                }
                return `<span style="color:${color}">${status}</span>`;
            }
        },                  
        {data: 'bpjsTk', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'bpjsJp', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'bpjsKes', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'bpjsTkPerusahaan', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'bpjsJpPerusahaan', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'bpjsKesPerusahaan', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        { 
            data: 'action', 
            name: 'action', 
            orderable: false, 
            searchable: false,
            render: function(data, type, row) {
                return `
                    <button type="button" id="iEditBpjs" class="btn btn-warning edit-btn-bpjs" data-id="${row.id_absen}">
                        <i class="fas fa-edit"></i>
                    </button>
                `;
            }
        }
    ],
    columnDefs: [{
        targets: 0,
        orderable: false,
        className: 'dt-body-center',
        render: function() {
            return `<input type="checkbox" class="rowCheckbox" />`;
        }
    }]
    });


    $('#selectAllCheckbox').on('change', function() {
        const checked = $(this).is(':checked');
        $('.rowCheckbox').prop('checked', checked);
    });

    $(document).on('change', '.rowCheckbox', function() {
        if (!$(this).is(':checked')) {
            $('#selectAllCheckbox').prop('checked', false);
        }
    });
}


// hide and show form tambah bpjs
function showFormAddBPJS() {
    document.getElementById("formAddBPJS").style.display = "block";
    document.getElementById("formEditBPJS").style.display = "none";
}

function hideFormAddBPJS() {
    document.getElementById("formAddBPJS").style.display = "none";
    document.querySelector(".table-responsive").style.display = "block";
}

document.addEventListener("DOMContentLoaded", function() {
    const addBPJSButton = document.getElementById("iTambahBPJS");
    if (addBPJSButton) {
        addBPJSButton.addEventListener("click", function() {
            showFormAddBPJS();
        });
    }
});

// hide and show form edit bpjs
function showFormEditBPJS() {
    document.getElementById("formEditBPJS").style.display = "block";
    document.getElementById("formAddBPJS").style.display = "none";
}

function hideFormEditBPJS() {
    document.getElementById("formEditBPJS").style.display = "none";
    document.querySelector(".table-responsive").style.display = "block";
}

document.addEventListener("DOMContentLoaded", function() {
    document.addEventListener("click", function(event) {
        let editButton = event.target.closest(".edit-btn-bpjs");
        if (editButton) {
            let dataID = editButton.getAttribute("data-id"); // Correct way to get the ID
            window.location = '{{ url('dashboard/penggajian/bpjs/data/edit') }}/'+dataID;
        }
    });
})

document.addEventListener('DOMContentLoaded', loadBPJS);
</script>