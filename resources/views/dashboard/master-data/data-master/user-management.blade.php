<!-- Form Add User Start -->
<!-- <div id="formAddUser" class="card border" style="display:none;">
    <div class="card-header">
        <h4>Tambah User Baru</h4>
    </div>
    <form id="formData">
    <input type="hidden" name="type" value="baru">
        <div class="modal-body">
            <div class="form-group">
                <label for="dept">Departemen</label>
                <select style="width: 100%" id="iDepartemenUsers" name="departemen" required></select>
            </div>

            <div class="form-group">
                <label for="sub-dept">Sub Departemen</label>
                <select style="width: 100%" id="iSubDepartemen" name="subDepartemen" required></select>
            </div>

            <div class="form-group">
                <label>Pos</label>
                <input id="iPos" name="pos" type="text" class="form-control" autofocus>
            </div>

            <div class="form-group">
                <label for="grade">Grade</label>
                <select style="width: 100%" id="iGrade" name="grade" required></select>
            </div>

            <div class="form-group">
                <label>ID Absen (4 digit)</label>
                <input  id="iAbsen" name="idAbsen" type="text" class="form-control" autofocus>

            </div>

            <div class="form-group">
                <label>NIP</label>
                <input id="iPassword" name="username" type="text" class="form-control" autofocus>
                <small>Password untuk user baru sama dengan NIP. Setiap user dapat mengganti password melalui menu User
                    Profile.</small>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input id="iName" name="name" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input id="iEmail" name="email" type="text" class="form-control">
            </div>

            <label for="skema">Skema Hari Kerja</label>
            <div class="form-group">
                <select style="width: 100%" id="iSkemaHariKerja" required></select>
            </div>

            <label for="tgl-gabung">Tanggal Bergabung</label>
            <div class="form-group">
                <input type="text" id="iTanggalBergabung" name="tanggalBergabung" class="form-control">
            </div>

            <label for="tgl-lahir">Tanggal Lahir</label>
            <div class="form-group">
                <input type="text" id="iTanggalLahir" name="tanggalLahir" class="form-control">
            </div>

            <div class="form-group">
                <label for="iSystem">System</label>
                <select class="form-control" id="iSystem" name="system">
                    <option value="1">Karyawan</option>
                    <option value="2">Super User</option>
                </select>
            </div>

        </div>
        <div class="card-footer bg-whitesmoke">
            <div class="row justify-content-end">
                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                    <button type="button" class="btn btn-block btn-outline-danger" onclick="hideFormAddUser()">
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
</div> -->
<!-- Form Add User End -->

<!-- Form Edit User Start -->
<!-- <div id="formEditUser" class="card border" style="display:none;">
    <div class="card-header">
        <h4>Edit User</h4>
    </div>
    <form id="formData">
    <input type="hidden" name="type" value="edit">
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
                <label>Nama</label>
                <input name="name" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input name="email" type="text" class="form-control">
            </div>

            <div class="form-group">
                <label for="skema">Skema Hari Kerja</label>
                <select style="width: 100%" id="iSkemaHariKerja_1" required></select>
            </div>

            <label for="tgl-gabung">Tanggal Bergabung</label>
            <div class="form-group">
                <input type="text" id="iTanggalBergabung" name="tanggalBergabung" class="form-control">
            </div>

            <label for="tgl-lahir">Tanggal Lahir</label>
            <div class="form-group">
                <input type="text" id="iTanggalLahir" name="tanggalLahir" class="form-control">
            </div>

            <div class="form-group">
                <label for="iSystem">System</label>
                <select class="form-control" id="iSystem" name="system">
                    <option value="1">Karyawan</option>
                    <option value="2">Super User</option>
                </select>
            </div>

        </div>
        <div class="card-footer bg-whitesmoke">
            <div class="row justify-content-end">
                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                    <button type="button" class="btn btn-block btn-outline-danger" onclick="hideFormEditUser()">
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
</div> -->
<!-- Form Edit User End -->

<!-- Form Import User Start -->
<!-- <div id="formImportUser" class="card border" style="display:none;">
    <div class="card">
        <div class="card-header">
            <h4>Import User Baru</h4>
        </div>
        <div class="row justify-content-end">
            <div class="card-body pt-0 pb-0">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="post" action="/dashboard/master/user-management/import-user"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="file" name="file" class="form-control">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                        <button type="button" class="btn btn-outline-danger" onclick="hideFormImportUser()">
                            <i class=" fas fa-arrow-left mr-2"></i>Kembali
                        </button>
                        <button type="button"
                            onclick="location.href='{{ asset('assets/excel/sample-userManagement.xls') }}'"
                            id="iBtnExportSample" class="btn btn-danger disabled">
                            <i class="fas fa-file-export mr-2"></i>Download Sample
                        </button>
                        <button type="button" id="iBtnExport" class="btn btn-danger ">
                            <i class="fas fa-file-export mr-2"></i>EXPORT
                        </button>
                        <button type="button" id="iResetPasswordAllUser" class="btn btn-warning ">
                            <i class="fas fa-file-export mr-2"></i>RESET PIN All User
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Form Import User End -->


<!-- <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3 pt-4">
    <div class="d-flex align-items-center gap-3 mb-3 mb-md-0">
        <button type="button" id="iTambahUser" class="btn btn-primary w-auto mr-3">
            <i class="fas fa-plus mr-2"></i>Tambah
        </button>

        <button type="button" id="iImportUser" class="btn btn-success w-auto">
            <i class="fas fa-plus mr-2"></i>Import
        </button>
    </div>
</div> -->

<div class="table-responsive">
    <table id="tableUserManagement" class="table table-striped table-bordered display nowrap" style="width: 100%">
        <thead>
            <tr>
                <th><input type="checkbox" id="allCheckboxUser"></th>
                <th class="sticky-col first-col">Status</th>
                <th>Departemen</th>
                <th>Sub Departemen</th>
                <th>Pos</th>
                <th>Grade</th>
                <th>ID Absen / Username</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Skema Hari Kerja</th>
                <th>Total hari Kerja</th>
                <th>Jam Kerja</th>
                <th>Tanggal Bergabung</th>
                <th>Masa Kerja</th>
                <th>Tanggal Lahir</th>
                <th>Usia</th>
                <th>System</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
<div class="card-footer bg-whitesmoke">
                        <div class="row justify-content-end">
                        <div class="col-sm-12 col-lg-3 mt-2 mt-lg-0">
                                <div class="btn-group btn-block mb-3" role="group" aria-label="Basic example">
                                    <button type="button" id="btnDisable" class="btn btn-danger ">
                                        <i class="fas fa-times mr-2"></i>Disable
                                    </button>
                                    <button type="button" id="btnActivate" class="btn btn-success ">
                                        <i class="fas fa-check mr-2"></i>Activate
                                    </button>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
                                <button type="button" id="btnReset" class="btn btn-block btn-warning" disabled>
                                    <i class="fas fa-undo mr-2"></i>Reset Password
                                </button>
                            </div>
                            <!-- <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
                                <button type="button" id="btnEdit" class="btn btn-block btn-primary" disabled>
                                    <i class="fas fa-pencil-alt mr-2"></i>Edit
                                </button>
                            </div> -->
                        </div>
                    </div>
<script>
var selectedIds = new Set(); 

function loadUserManagement() {
    if ($.fn.DataTable.isDataTable('#tableUserManagement')) {
        $('#tableUserManagement').DataTable().destroy();
    }

    $('#tableUserManagement').DataTable({
        ajax: {
                    url: "{{ url('dashboard/master/user-management/data') }}" 
                },
                columns: [
                    {data: 'id'},
                  
                    {data: 'status',
                        className: 'sticky-col first-col', 
                        render: function(data, type) {
                            let color;
                        if (data == '1') {
                            status = 'ACTIVE';
                            color = 'green';
                        }
                        
                        else if (data == '2') {
                            status = 'NON ACTIVE';
                            color = 'red';
                        }
                        else {
                            status = 'Error Status';
                            color = 'orange';
                        }
                        return '<span style="color:' + color + '">' + status + '</span>';
                    }
                    },
                    {data: 'departemen'},
                    {data: 'subDepartemen'},
                    {data: 'pos'},
                    {data: 'grade'},
                    {data: 'idAbsen'},
                    {data: 'nip'},
                    {data: 'name'},
                    {data: 'idSkemaHariKerja'},
                    {data: 'jmlHari'},
                    {data: 'jamKerja'},
                    {data: 'doj'},
                    {data: 'masaKerja'},
                    {data: 'dob'},
                    {data: 'usia'},
                    {data: 'system',
                        render: function(data, type) {
                            let color;
                        if (data == '0') {
                            status = 'Karyawan & Super User';
                            color = 'green';
                        }
                        
                        else if (data == '1') {
                            status = 'Karyawan';
                            color = 'green';
                        }

                        else if (data == '2') {
                            status = 'Super User';
                            color = 'green';
                        }
                        return '<span style="color:' + color + '">' + status + '</span>';
                    }
                    },
                    { 
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <button type="button" id="iEditGrade" class="btn btn-warning edit-btn-userMgn" data-id="${row.nip}">
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

    $('#allCheckboxUser').on('change', function() {
        const checked = $(this).is(':checked');
        $('.rowCheckbox').prop('checked', checked);
    });

    $(document).on('change', '.rowCheckbox', function() {

        var table = $('#tableUserManagement').DataTable();
        var row = $(this).closest('tr');
        var rowData = table.row(row).data(); 

        if (rowData) {
            var rowId = rowData.id; 
            var form = $('id'); // Ganti dengan ID form yang benar

            if ($(this).is(':checked')) {
                // Tambahkan ID jika checkbox dicentang
                selectedIds.add(rowId);
            } else {
                // Hapus ID jika checkbox di-uncheck
                selectedIds.delete(rowId);
            }

            // Hapus semua input hidden lama sebelum menambahkan yang baru
            form.find('input[name="id[]"]').remove();

            // Tambahkan input hidden berdasarkan Set yang sudah diperbarui
            selectedIds.forEach(id => {
                form.append(
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'id[]')
                        .val(id)
                );
            });
        } else {
            console.log("Data tidak ditemukan");
        }


        // Jika ada satu pun checkbox yang tidak tercentang, uncheck "select all"
        if (!$('.rowCheckbox:checked').length) {
            $('#allCheckboxPay').prop('checked', false);
        }

        // Jika semua checkbox individu tercentang, centang "select all"
        if ($('.rowCheckbox:checked').length === $('.rowCheckbox').length) {
            $('#allCheckboxPay').prop('checked', true);
        }
    });

    $('#iTanggalLahir').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'DD MMMM YYYY'
        }
    });

    $('#iTanggalBergabung').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'DD MMMM YYYY'
        }
    });
}


// hide and show form add user
function showFormAddUser() {
    document.getElementById("formAddUser").style.display = "block";
    document.getElementById("formEditUser").style.display = "none";
    document.getElementById("formImportUser").style.display = "none";
}

function hideFormAddUser() {
    document.getElementById("formAddUser").style.display = "none";
    document.querySelector(".table-responsive").style.display = "block";
}

document.addEventListener("DOMContentLoaded", function() {
    const addUserButton = document.getElementById("iTambahUser");
    if (addUserButton) {
        addUserButton.addEventListener("click", function() {
            showFormAddUser();
        });
    }
});

// hide and show form add user
function showFormEditUser(nip) {
    document.getElementById("formEditUser").style.display = "block";
    document.getElementById("formAddUser").style.display = "none";
    document.getElementById("formImportUser").style.display = "none";

    // Make an AJAX request to fetch the grade data
    // $.ajax({
    //     url: `/dashboard/master/grade/dataList`, // Laravel route
    //     type: "POST",
    //     data: {
    //         _token: $('meta[name="csrf-token"]').attr('content'), // CSRF Token
    //         id_grade: gradeId // Input variable to send
    //     },
    //     success: function(response) {

    //         let gradeData = response[0]; // Ambil objek pertama dalam array
    //         console.log(gradeData);
    //         // Populate the form fields with response data
    //         $('input[name="iDepartemenUser"]').val(gradeData.id_grade);
    //         $('input[name="iSubDepartemen"]').val(gradeData.level);
    //         $('input[name="iPos"]').val(nominalTnjTransport);
    //         $('input[name="iGrade"]').val(gradeData.interval_bln);
    //         $('input[name="iAbsen"]').val(gradeData.interval_bln);
    //         $('input[name="iPassword"]').val(gradeData.interval_bln);
    //         $('input[name="iName"]').val(gradeData.interval_bln);
    //         $('input[name="iEmail"]').val(gradeData.interval_bln);
    //         $('input[name="iSkemaHariKerja"]').val(gradeData.interval_bln);
    //         $('input[name="iTanggalBergabung"]').val(gradeData.interval_bln);
    //         $('input[name="iTanggalLahir"]').val(gradeData.interval_bln);
    //         $('input[name="iSystem"]').val(gradeData.interval_bln);
       
    //         // Store the ID for updating the record later
    //         $('#formData').attr('data-id', nip);

    //         // Show the modal form
    //         $('#editGradeModal').modal('show');
    //     },
    //     error: function(xhr) {
    //         console.error("Error fetching data: ", xhr);
    //     }
    // });
}

function hideFormEditUser() {
    document.getElementById("formEditUser").style.display = "none";
    document.querySelector(".table-responsive").style.display = "block";
}

document.addEventListener("DOMContentLoaded", function() {
    const editUserButton = document.getElementById("iEditUser");
    if (editUserButton) {
        editUserButton.addEventListener("click", function() {
            showFormEditUser();
        });
    }
});

// hide and show form import user
function showFormImportUser() {
    document.getElementById("formImportUser").style.display = "block";
    document.getElementById("formAddUser").style.display = "none";
    document.getElementById("formEditUser").style.display = "none";
}

function hideFormImportUser() {
    document.getElementById("formImportUser").style.display = "none";
    document.querySelector(".table-responsive").style.display = "block";
}

document.addEventListener("DOMContentLoaded", function() {
    const importUserButton = document.getElementById("iImportUser");
    const btnDisable = document.getElementById("btnDisable");
    const btnActivate = document.getElementById("btnActivate");
    const btnReset = document.getElementById("btnReset");
    
    
    if (importUserButton) {
        importUserButton.addEventListener("click", function() {
            showFormImportUser();
        });
    }
    if (btnDisable) {
        btnDisable.addEventListener("click", function() {
                    Swal.fire({
                    title: "Apakah ingin Disable data ini",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Disable'
                    }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: '{{ url('dashboard/master/user-management/disable') }}',
                            method: 'post',
                            data: {id: Array.from(selectedIds)},
                            success: function (response) {
                                console.log(response);
                                if (response === 'success') {
                                    Swal.fire({
                                        title: 'Data tersimpan!',
                                        type: 'success',
                                        onClose: function () {
                                            loadUserManagement();
                                        }
                                    })
                                } else {
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: 'Silahkan coba lagi',
                                        type: 'error',
                                    })
                                }
                            }
                        });
                    }
            });
        });
    }

    if (btnActivate) {
        btnActivate.addEventListener("click", function() {
                    Swal.fire({
                    title: "Apakah ingin Activate data ini",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Active'
                    }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: '{{ url('dashboard/master/user-management/activate') }}',
                            method: 'post',
                            data: {id: Array.from(selectedIds)},
                            success: function (response) {
                                console.log(response);
                                if (response === 'success') {
                                    Swal.fire({
                                        title: 'Data tersimpan!',
                                        type: 'success',
                                        onClose: function () {
                                            loadUserManagement();
                                        }
                                    })
                                } else {
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: 'Silahkan coba lagi',
                                        type: 'error',
                                    })
                                }
                            }
                        });
                    }
            });
        });
    }

    if (btnReset) {
        btnReset.addEventListener("click", function() {
            Swal.fire({
                    title: 'Reset password?',
                    text: "Password akan sama seperti NIK",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Reset Password'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: '{{ url('dashboard/master/user-management/reset-password') }}',
                            method: 'post',
                            data: {username: dataID},
                            success: function (response) {
                                if (response === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Password berhasil direset',
                                        onClose(modalElement) {
                                            window.location.reload();
                                        }
                                    });
                                } else {
                                    console.log(response);
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Gagal',
                                        text: 'Gagal reset Password, silahkan coba lagi.',
                                    });
                                }
                            },
                            error: function (response) {
                                console.log(response);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'System Error',
                                    text: 'Silahkan hubungi Developerf',
                                });
                            }
                        });
                    }
                })                  
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
   document.addEventListener("click", function(event) {
        let editButton = event.target.closest(".edit-btn-userMgn");
        if (editButton) {
            let nip = editButton.getAttribute("data-id"); // Correct way to get the ID
            window.location = '{{ url('dashboard/master/user-management/edit') }}/'+nip;
        }
    });
});
</script>
