<input type="text" name="pic" class="form-control" value="{{ request()->session()->get('name') }}" hidden>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3 pt-4">
    <div class="d-flex align-items-center gap-3 mb-3 mb-md-0">
        <!-- <select class="form-select p-2 border border-gray-300 rounded-md" aria-label="Default select example">
            <option selected>-- PILIH PERIODE --</option>
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
        </select> -->
        <!-- <button type="button" id="btnCheckThp" class="btn btn-block btn-warning ml-3">
            <i class="fas fa-undo mr-2"></i>Cek THP
        </button> -->
    </div>
    <div class="dropdown">
        <button class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Action Export
        </button>
        <div class="dropdown-menu">
            <!-- <a class="dropdown-item" id="iExportSelected">Export Selected (.pdf)</a>
            <a class="dropdown-item" id="iExportSelectedCheckBox">Export CheckBox(.pdf)</a> -->
            <a class="dropdown-item" id="iExportAllPaycheck">Export All (.xls)</a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table id="tablePayCheck" class="table table-striped table-bordered display nowrap" style="width: 100%">
        <thead>
            <tr>
                <th>
                    <input type="checkbox" id="allCheckboxPay" />
                </th>
                <th>Status Check</th>
                <th>Departemen</th>
                <th>Sub Departemen</th>
                <th>Pos</th>
                <th>Grade</th>
                <th>ID Absen / Username</th>
                <th>NIK</th>
                <th class="sticky-col first-col">Nama</th>
                <th>Tipe Kontrak</th>
                <th>Tanggal Bergabung</th>
                <th>Masa Kerja</th>
                <th>No Rekening</th>
                <th>Skema BPJS</th>
                <th>Take Home Pay (THP)</th>
                <th>Updated At</th>
                <th>Gaji Pokok</th>
                <th>Jabatan</th>
                <th>Keahlian</th>
                <th>Transport</th>
                <th>Komunikasi</th>
                <th>Lembur</th>
                <th>Tambahan Lainnya</th>
                <th>Alfa</th>
                <th>Ijin</th>
                <th>Potongan Lainnya</th>
                <th>BPJS-Kesehatan</th>
                <th>BPJS-TK</th>
                <th>BPJS-JP</th>
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
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Total</th>
                <th><input style="text-align: right;width:150px" class="form-control" id="iTotThp" type="text"
                        name="totThp" readonly></th>
                <th></th>
                <th><input style="text-align: right;width:150px" class="form-control" id="iTotGajiPokok" type="text"
                        name="totGajiPokok" readonly></th>
                <th><input style="text-align: right;width:150px" class="form-control" id="iTotJabatan" type="text"
                        name="totJabatan" readonly></th>
                <th><input style="text-align: right;width:150px" class="form-control" id="iTotKeahlian" type="text"
                        name="totKeahlian" readonly></th>
                <th><input style="text-align: right;width:150px" class="form-control" id="iTotTransport" type="text"
                        name="totTransport" readonly></th>
                <th><input style="text-align: right;width:150px" class="form-control" id="iTotKomunikasi" type="text"
                        name="totKomunikasi" readonly></th>

                <th><input style="text-align: right;width:150px" class="form-control" id="iLembur" type="text"
                        name="totLembur" readonly></th>
                <th><input style="text-align: right;width:150px" class="form-control" id="iTambahanLainnya" type="text"
                        name="totTambahanLainnya" readonly></th>
                <th><input style="text-align: right;width:150px" class="form-control" id="iAlfa" type="text" name="alfa"
                        readonly></th>
                <th><input style="text-align: right;width:150px" class="form-control" id="iIjin" type="text"
                        name="iIjin" readonly></th>
                <th><input style="text-align: right;width:150px" class="form-control" id="iPotonganLainnya" type="text"
                        name="totPotonganLainnya" readonly></th>

                <th><input style="text-align: right;width:150px" class="form-control" id="iTotBpjsKes" type="text"
                        name="totBpjsKes" readonly></th>
                <th><input style="text-align: right;width:150px" class="form-control" id="iTotBpjsTk" type="text"
                        name="totBpjsTk" readonly></th>
                <th><input style="text-align: right;width:150px" class="form-control" id="iTotBpjsJp" type="text"
                        name="totBpjsJp" readonly></th>

            </tr>
        </tfoot>
    </table>
</div>
<div class="card-footer bg-whitesmoke">
       
       <div class="row justify-content-end">
           <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
               <button type="button" id="btnEdit" class="btn btn-block btn-primary" hidden>
                   <i class="fas fa-pencil-alt mr-2"></i>Edit
               </button>
           </div>
           <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
               <button type="button" id="btnCheckThp" class="btn btn-block btn-warning">
                   <i class="fas fa-undo mr-2"></i>Cek THP
               </button>
           </div>
           <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
               <button type="button" id="btnSubmit" class="btn btn-block btn-success">
               <i class="fas fa-check-circle"></i> Submit
               </button>
           </div>
       </div>
   </div>
<script>
function loadPayCheck() {
    if ($.fn.DataTable.isDataTable('#tablePayCheck')) {
        $('#tablePayCheck').DataTable().destroy();
    }

    $('#tablePayCheck').DataTable({
    ajax: {
        type: "GET",
        url: "{{ url('dashboard/penggajian/paycheck/data') }}",
        dataSrc: "data",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        },
        complete: function(xhr) {
            if (xhr.status !== 200) { // Periksa jika respons tidak berhasil
                console.log("Error:", xhr);
            } else if (xhr.responseJSON && xhr.responseJSON.total) {
            
                $('input[name="totThp"]').val(xhr.responseJSON.thp["total"]);
                $('input[name="totGajiPokok"]').val(xhr.responseJSON.total["iTotGajiPokok"]);
                $('input[name="totJabatan"]').val(xhr.responseJSON.total["iTotJabatan"]);
                $('input[name="totKeahlian"]').val(xhr.responseJSON.total["iTotKeahlian"]);
                $('input[name="totTransport"]').val(xhr.responseJSON.total["iTotTransport"]);
                $('input[name="totKomunikasi"]').val(xhr.responseJSON.total["iTotKomunikasi"]);
                $('input[name="totLembur"]').val(xhr.responseJSON.total["iLembur"]);
                $('input[name="totTambahanLainnya"]').val(xhr.responseJSON.total["iTambahanLainnya"]);
                $('input[name="alfa"]').val(xhr.responseJSON.total["iAlfa"]);
                $('input[name="iIjin"]').val(xhr.responseJSON.total["iIjin"]);
                $('input[name="totPotonganLainnya"]').val(xhr.responseJSON.total["iPotonganLainnya"]);
                $('input[name="totBpjsKes"]').val(xhr.responseJSON.total["iTotBpjsKes"]);
                $('input[name="totBpjsTk"]').val(xhr.responseJSON.total["iTotBpjsTk"]);
                $('input[name="totBpjsJp"]').val(xhr.responseJSON.total["iTotBpjsJp"]);
         
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
        {data: 'reffPaycheck',
            render: function(data) {
                let status = (data === '-') ? 'Belum di Cek' : data;
                let color = (data === '-') ? 'orange' : 'green';
                return `<span style="color:${color}">${status}</span>`;
            }
        },
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
        {data: 'doj'},
        {data: 'masaKerja'},
        {data: 'noRekening'},
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
        {data: 'thp', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'updatedAt'},
        {data: 'gajiPokok', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'tunjanganJabatan', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'tunjanganKeahlian', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'tunjanganTransport', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'tunjanganKomunikasi', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'lembur', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'tambahanLainnya', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'alfa', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'ijin', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'potonganLainnya', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'bpjsKes', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'bpjsTk', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'bpjsJp', className: "text-right", render: $.fn.dataTable.render.number(',', '.', 2)},
        { 
            data: 'action', 
            name: 'action', 
            orderable: false, 
            searchable: false,
            render: function(data, type, row) {
                return `
                    <button type="button" id="iEditGrade" class="btn btn-warning edit-btn-paycheck" data-id="${row.id_absen}">
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


    $('#allCheckboxPay').on('change', function() {
        const checked = $(this).is(':checked');
        $('.rowCheckbox').prop('checked', checked);
    });

    $(document).on('change', '.rowCheckbox', function() {
        if (!$(this).is(':checked')) {
            $('#allCheckboxPay').prop('checked', false);
            
        }
    });

    addSyncButtonListener();
}

function addSyncButtonListener() {
    const btnSyncronise = document.getElementById('btnCheckThp');
    const btnSubmit = document.getElementById('btnSubmit');
    let iPic = $('input[name="pic"]').val();
    

    if (btnSyncronise) {
        btnSyncronise.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                        title: 'Mohon Ditunggu !',
                        html: 'sedang memproses data...',// add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                        });
                        $.ajax({
                            url: '{{ url('dashboard/penggajian/paycheck/cekThp') }}',
                            method: 'get',
                            success: function (response) {
                                console.log(response);
                                if (response === 'success') {
                                    Swal.fire({
                                        title: 'Data tersimpan!',
                                        type: 'success',
                                        onClose: function () {
                                            loadPayCheck();
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
        });
    } else {
        console.error("Tombol Synchronise tidak ditemukan!");
    }

    if (btnSubmit) {
        btnSubmit.addEventListener('click', function(e) {
            e.preventDefault();
            
            Swal.fire({
                    icon: 'warning',
                    title: 'Paycheck Penggajian',
                    inputLabel: 'Reff : '+ iPic,
                    text: "Periode Penggajian Akan Terkunci dan Tidak Dapat di Edit Kembali",
                    input: 'password',
                        inputLabel: 'Password',
                        inputPlaceholder: 'Enter your password',
                        inputAttributes: {
                            maxlength: 15,
                            autocapitalize: 'off',
                            autocorrect: 'off'
                        },
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
                            url: '{{ url('penggajian/paycheck/submitModule') }}',
                            method: 'post',
                            data: {idModule: 'GG-006',password:result.value},
                            success: function (response) {
                                if (response === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Data Berhasil ditambahkan',
                                        onClose(modalElement) {
                                            window.location = '{{ url('dashboard') }}';
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
                    }
                })
        });
    } else {
        console.error("Tombol Synchronise tidak ditemukan!");
    }

}

document.addEventListener('DOMContentLoaded', loadPayCheck);


document.addEventListener("DOMContentLoaded", function() {

    document.addEventListener("click", function(event) {
        let editButton = event.target.closest(".edit-btn-paycheck");
        if (editButton) {
            let dataID = editButton.getAttribute("data-id"); // Correct way to get the ID
            window.location = '{{ url('dashboard/penggajian/upah-karyawan/edit') }}/'+dataID;
        }
    });

    const exportPaycheck = document.getElementById("iExportAllPaycheck");
    // const exportSelected = document.getElementById("iExportSelected");

    if (exportPaycheck) {
        exportPaycheck.addEventListener("click", function(e) {
            e.preventDefault();
            console.log("Tombol Export All diklik!");
            window.open('{{ url('dashboard/penggajian/paycheck/export-gaji') }}');
        });
    }

    // if(exportSelected) {
    //     e.preventDefault();
    //     window.open('{{ url('dashboard/penggajian/paycheck/export-gaji/selected') }}/'+dataID);
    // }
});
</script>