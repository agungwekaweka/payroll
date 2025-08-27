<!-- Form Add Lembur Start -->
<div id="overtimeForm" class="card border" style="display:none;">
    <div class="card-header">
        <h4>Tambah Data Lembur</h4>
    </div>
    <form id="formData">
            <input type="hidden" name="type" value="baru">
        <div class="modal-body">
            <div class="form-group">
                <label for="provi">Nama Karyawan</label>
                <select style="width: 100   %" id="iNamaKaryawan" name="idKaryawan" required></select>
            </div>

            <div class="form-group">
                <label for="iTglLahir">Tanggal Lembur</label>
                <input type="text" id="iTanggalLembur" name="tglLembur" class="form-control">
            </div>

            <div class="form-group">
                <label>Jam Lembur</label>
                <input name="jamLembur" type="text" class="form-control" autofocus>
                <small>*Untuk penulisan tanda koma wajib menggunakan tanda titik (.)</small>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <input name="keterangan" type="text" class="form-control" autofocus>
            </div>
        </div>
        <div class="card-footer bg-whitesmoke">
            <div class="row justify-content-end">
                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                    <button type="button" class="btn btn-block btn-outline-danger" onclick="hideOvertimeForm()">
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
<!-- Form Add Lembur End -->

<!-- Form Edit Lembur Start -->
<div id="formEditLembur" class="card border" style="display:none;">
    <div class="card-header">
        <h4>Edit Data Lembur</h4>
    </div>
    <form id="formData">
            <input type="hidden" name="type" value="edit">
        <div class="modal-body">
            <div class="form-group">
                <label>ID Lembur</label>
                <input  name="idLembur" type="text" class="form-control" readOnly>
            </div>
            <div class="form-group">
                <label>Nama Karyawan</label>
                <input  name="name" type="text" class="form-control" readOnly>
            </div>
            <div class="form-group">
                <label>Jam Lembur</label>
                <input name="jamLembur" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>Nominal</label>
                <input name="nominal" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Keterangan</label>
                <textarea class="form-control" name="note" style="height: 150px;"></textarea>
            </div>
        </div>
        <div class="card-footer bg-whitesmoke">
            <div class="row justify-content-end">
                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                    <button type="button" class="btn btn-block btn-outline-danger" onclick="hideFormEditLembur()()">
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
<!-- Form Edit Lembur End -->

<!-- Form Import Lembur Start -->
<div id="importLembur" class="card" style="display:none;">
    <div class="card-header mb-3">
        <h4>Import Data</h4>
    </div>
    <div class="card-body pt-0 pb-0">
        <div class="modal-content">

            <div class="modal-body">
                <form method="post" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="file" name="file" class="form-control">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>

                <button type="button" onclick="location.href='{{ asset('assets/excel/sample-importLembur.xls') }}'"
                    id="iBtnExportSample" class="btn btn-danger disabled">
                    <i class="fas fa-file-export mr-2"></i>Download Sample
                </button>


            </div>

            <div class="card-footer bg-whitesmoke">
                <div class="row justify-content-end">
                    <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                        <button type="button" class="btn btn-block btn-outline-danger" onclick="hideImportForm()">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Form Import Lembur End -->

<!-- Button Start -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3 pt-4">
    <div class="d-flex align-items-center gap-3 mb-3 mb-md-0">
        <div class="dropdown ms-auto ml-3">
            <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown">
                ACTION
            </button>
            <div class="dropdown-menu">
                <!-- Button dalam dropdown -->
                <a class="dropdown-item" id="iTambahLembur" href="javascript:void(0)">Add Lembur</a>
                <a class="dropdown-item" id="iGetFromLokaryawan">Get From Lokaryawan</a>
                <a class="dropdown-item" id="iImportExcel">Import Excel</a>
                <hr>
                <a class="dropdown-item" id="iRemoveSelectedCheckbox">Remove Selected Checkbox</a>
            </div>
        </div>
    </div>
    <div class="dropdown">
        <button class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Action Export
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" id="iExportSelectedCheckBox">Export Selected Checkbox</a>
            <a class="dropdown-item" id="iExportAll">Export All</a>
        </div>
    </div>
</div>
<!-- Button End -->


<div class="table-responsive">
    <table id="tableLembur" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <th><input type="checkbox" id="allCheckboxLembur"></th>

                <th>Departemen</th>
                <th>Sub Departemen</th>
                <th>Pos</th>
                <th>Grade</th>
                <th>ID Absen/Username</th>
                <th>NIK</th>
                <th class="sticky-col first-col">Nama</th>
                <th>Tipe Kontrak</th>
                <th>Tanggal</th>
                <th>Jam Lembur</th>
                <th>Total Upah</th>
                <th>Total Jam</th>
                <th>Nominal</th>
                <th>Keterangan</th>
                <th>Pic</th>
                <th>Updated AT</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    <div class="d-flex align-items-center mt-4">
        <b style="text-align: center; margin-right: 10px;">Total :</b>
        <input style="text-align: right; width: 350px;" class="form-control" id="iNominal" type="text" name="nominal"
            readonly>
    </div>
</div>


<script>
function loadLembur() {
    if ($.fn.DataTable.isDataTable('#tableAbsensi')) {
        $('#tableLembur').DataTable().destroy();
    }

    $('#tableLembur').DataTable({
    ajax: {
        type: "GET",
        url: "{{ url('dashboard/penggajian/data-lembur/data') }}",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        },
        complete: function(xhr) {
            if (xhr.status !== 200) { // Periksa jika respons tidak berhasil
                console.log("Error:", xhr);
            } else if (xhr.responseJSON && xhr.responseJSON.total) {
                iNominal.value = xhr.responseJSON.total["nominal"];
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
        {data: 'name',
               className: 'sticky-col first-col'
        },
        {data: 'tieKontrak'},
        {data: 'tanggal'},
        {data: 'jamLembur'},
        {data: 'totalUpah', className: "text-right"},
        {data: 'totalJam'},
        {data: 'nominal', className: "text-right"},
        {data: 'keterangan'},
        {data: 'pic'},
        {data: 'updatedAt'},
        { 
            data: 'action', 
            name: 'action', 
            orderable: false, 
            searchable: false,
            render: function(data, type, row) {
                return `
                    <button type="button" id="iEditLembur" class="btn btn-warning edit-btn-lembur" data-id="${row.id}">
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
        render: function(data, type, row) {
            return `<input type="checkbox" class="rowCheckbox" value="${row.id}" />`;
        }
    }]
    });

    $('#tableLembur').on('draw.dt', function () {
        $('#allCheckboxLembur').prop('checked', false);
    });


    $('#allCheckboxLembur').on('change', function() {
        const checked = $(this).is(':checked');
        $('.rowCheckbox').prop('checked', checked);
        
        // Cek semua baris yang sedang muncul
        table.rows({ search: 'applied' }).nodes().to$().find('.rowCheckbox').prop('checked', checked);
    });

    $(document).on('change', '.rowCheckbox', function() {
        if (!$(this).is(':checked')) {
            $('#allCheckboxLembur').prop('checked', false);
        }
    });

    let table = $('#tableLembur').DataTable();

    $('#iNamaKaryawan').select2({
        ajax: {
            url: '{{ url("namaKaryawanPeriode") }}',
            dataType: 'json',
            data: function(params) {
                return {
                    search: params.term
                };
            }
        }
    });

    $('#iTanggalLembur').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'DD MMMM YYYY'
        }
    });

    $('#iEditNamaKaryawanLembur').select2({
        ajax: {
            url: '{{ url("namaKaryawanPeriode") }}',
            dataType: 'json',
            data: function(params) {
                return {
                    search: params.term
                };
            }
        }
    });

    $('#iEditTanggalLembur').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'DD MMMM YYYY'
        }
    });
}

// hide and show form tambah lembur
function showOvertimeForm() {
    document.getElementById("overtimeForm").style.display = "block";
    document.getElementById("importLembur").style.display = "none";
    document.getElementById("formEditLembur").style.display = "none";
}

function hideOvertimeForm() {
    document.getElementById("overtimeForm").style.display = "none";
    document.querySelector(".table-responsive").style.display = "block";
}

document.addEventListener("DOMContentLoaded", function() {
    const addLemburButton = document.getElementById("iTambahLembur");
    if (addLemburButton) {
        addLemburButton.addEventListener("click", function() {
            showOvertimeForm();
        });
    }
});


// hide and show form edit lembur
function showFormEditLembur(idLembur) {
    document.getElementById("formEditLembur").style.display = "block";
    document.getElementById("overtimeForm").style.display = "none";
    document.getElementById("importLembur").style.display = "none";

    // Make an AJAX request to fetch
    $.ajax({
        url: `/dashboard/penggajian/data-lembur/list/data-edit`, // Laravel route
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'), // CSRF Token
            id: idLembur // Input variable to send
        },
        success: function(response) {
            console.log(response)
            let lemburData = response; // Ambil objek pertama dalam array
      
            // Populate the form fields with response data
            $('input[name="idLembur"]').val(lemburData['id']);
            $('input[name="name"]').val(lemburData['name']);
            $('input[name="jamLembur"]').val(lemburData['totalJam']);
            $('input[name="nominal"]').val(lemburData['nominal']);
            $('textarea[name="note"]').val(lemburData['keterangan']);
         
            // Store the ID for updating the record later
            $('#formData').attr('data-id', idLembur);

            // Show the modal form
            $('#editLemburModal').modal('show');
        },
        error: function(xhr) {
            console.error("Error fetching data: ", xhr);
        }
    });
}

function hideFormEditLembur() {
    document.getElementById("formEditLembur").style.display = "none";
    document.querySelector(".table-responsive").style.display = "block";
}

document.addEventListener("DOMContentLoaded", function() {
    document.addEventListener("click", function(event) {
        let editButton = event.target.closest(".edit-btn-lembur");
        if (editButton) {
            let idLembur = editButton.getAttribute("data-id"); // Correct way to get the ID
            showFormEditLembur(idLembur);
        }
    });
});

// hide and show form import lembur
function showImportForm() {
    document.getElementById("importLembur").style.display = "block";
    document.getElementById("overtimeForm").style.display = "none";
    document.getElementById("formEditLembur").style.display = "none";

}

function hideImportForm() {
    document.getElementById("importLembur").style.display = "none";
    document.querySelector(".table-responsive").style.display = "block";
}

document.addEventListener("DOMContentLoaded", function() {
    addSyncButtonLembur();
    const addImportLembur = document.getElementById("iImportExcel");
  

    if (addImportLembur) {
        addImportLembur.addEventListener("click", function() {
            showImportForm();
        });
    }

    const iExportAll = document.getElementById("iExportAll");
    if (iExportAll) {
        iExportAll.addEventListener("click", function(e) {
            e.preventDefault();
            window.open('{{ url('penggajian/data-lembur/actionExport') }}/' + 'exportAll/'+'-' );
        });
    }

    
document.addEventListener("click", function(e) {
    const removeBtn = e.target.closest("#iRemoveSelectedCheckbox");
    if (removeBtn) {
        console.log("removeSelected clicked");
  
        e.preventDefault();

        let rows_selected = [];
        $('.rowCheckbox:checked').each(function() {
            const val = $(this).val();
            if (val !== 'on') {
                rows_selected.push(val);
            }
        });

        console.log("Selected IDs:", rows_selected);

        if (rows_selected.length === 0) {
            Swal.fire('Tidak ada data terpilih', '', 'info');
            return;
        }

        Swal.fire({
            title: 'Hapus Data Terpilih?',
            text: "Semua Data Lembur yang Terpilih Akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '{{ url('penggajian/data-lembur/action') }}',
                    method: 'post',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        typeActionData: 'removeCheckBox',
                        idData: rows_selected
                    },
                    success: function (response) {
                        if (response === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data Berhasil dihapus',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            $('#tableLembur').DataTable().ajax.reload();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Gagal',
                                text: 'Gagal Menghapus Data, silahkan coba lagi.',
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'System Error',
                            text: 'Silahkan hubungi Developer',
                        });
                    }
                });
            }
        });
    }
});


//      const removeSelected = document.getElementById("iRemoveSelectedCheckbox");
// if (removeSelected) {
//     removeSelected.addEventListener("click", function(e) {
//         console.log("removeSelected clicked");
//         e.preventDefault();
//         let rows_selected = [];
//         $('.rowCheckbox:checked').each(function() {
//             rows_selected.push($(this).val()); // Ambil value ID
//         });

//         console.log("Selected IDs:", rows_selected); // Untuk debug

//         if (rows_selected.length === 0) {
//             Swal.fire('Tidak ada data terpilih', '', 'info');
//             return;
//         }

//         Swal.fire({
//             title: 'Hapus Data Terpilih?',
//             text: "Semua Data Lembur yang Terpilih Akan dihapus",
//             icon: 'warning',
//             showCancelButton: true,
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             confirmButtonText: 'Hapus'
//         }).then((result) => {
//             if (result.value) {
//                 $.ajax({
//                     url: '{{ url('penggajian/data-lembur/action') }}',
//                     method: 'post',
//                     data: {
//                         _token: $('meta[name="csrf-token"]').attr('content'),
//                         typeActionData: 'removeCheckBox',
//                         idData: rows_selected
//                     },
//                     success: function (response) {
//                         if (response === 'success') {
//                             Swal.fire({
//                                 icon: 'success',
//                                 title: 'Berhasil',
//                                 text: 'Data Berhasil dihapus',
//                                 timer: 2000,
//                                 showConfirmButton: false
//                             });
//                             $('#tableLembur').DataTable().ajax.reload(); // Reload DataTable tanpa reload halaman
//                         } else {
//                             Swal.fire({
//                                 icon: 'warning',
//                                 title: 'Gagal',
//                                 text: 'Gagal Menghapus Data, silahkan coba lagi.',
//                             });
//                         }
//                     },
//                     error: function () {
//                         Swal.fire({
//                             icon: 'error',
//                             title: 'System Error',
//                             text: 'Silahkan hubungi Developer',
//                         });
//                     }
//                 });
//             }
//         });
//     });
// }

    document.querySelector("#formEditLembur form").addEventListener("submit", function(event) {
        event.preventDefault(); // Mencegah reload halaman
        let formData = new FormData(this); // Ambil data form
        $.ajax({
            url: "{{ url('dashboard/penggajian/data-lembur/submit') }}", // Sesuaikan dengan route Laravel
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            success: function(response) {
                loadLembur();
                hideFormEditLembur();
            },
            error: function(xhr) {
                console.error("Error:", xhr.responseText);
                alert("Terjadi kesalahan saat mengubah data.");
            }
        });
    });
});


// Sync Lembur from lokaryawan
function addSyncButtonLembur() {
    const btnSyncronise = document.getElementById('iGetFromLokaryawan');
    if (btnSyncronise) {
        btnSyncronise.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Syncronise Data Lokaryawan",
                text: "Apakah kamu yakin ingin Syncronise Data? Data dari lokaryawan akan otomatis terinput pada tabel lembur",
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: "#cbd5e1",
                confirmButtonText: "Syncronise",
                cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        title: 'Mohon Ditunggu !',
                        html: 'sedang memproses data...',// add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                        Swal.showLoading()
                        },
                        });
                    $.ajax({
                            url: '{{ url('penggajian/data-lembur-syncronise') }}',
                            method: 'get',
                            success: function (response) {
                                if (response === 'success') {
                                    $.ajax({
                                    url: '{{ url('penggajian/data-lembur/submitModule') }}',
                                    method: 'post',
                                    data: {idModule: 'GG-004'},
                                    success: function (response) {
                                        if (response === 'success') {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil',
                                                text: 'Data Berhasil ditambahkan',
                                                onClose(modalElement) {
                                                    loadLembur();
                                                }
                                            });
                                        } else {
                                            console.log(response);
                                            Swal.fire({
                                                icon: 'warning',
                                                title: 'Gagal',
                                                text: response,
                                            });
                                        }
                                    },
                                    error: function (response) {
                                        console.log(response);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'System Error',
                                            text: 'Silahkan hubungi Developer',
                                        });
                                    }
                                });
                                } else {
                                    console.log(response);
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Gagal',
                                        text: 'Gagal syncronise Data, silahkan coba lagi.',
                                    });
                                }
                            },
                            error: function (response) {
                                console.log(response);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'System Error',
                                    text: 'Silahkan hubungi Developer',
                                });
                            }
                        });
                }
            });
        });
    } else {
        console.error("Tombol Synchronise tidak ditemukan!");
    }
}
</script>