<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3 pt-4">
    <div class="d-flex align-items-center gap-3 mb-3 mb-md-0">
        <!-- <select class="form-select p-2 border border-gray-300 rounded-md" aria-label="Default select example">
            <option selected>-- PILIH PERIODE --</option>
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
        </select> -->

        <button type="button" id="btnSyncronise" class="btn btn-primary ml-3">
            <i class="fas fa-undo mr-2"></i>GET DATA
        </button>
    </div>

    <div class="dropdown ms-auto">
        <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown">
            ACTION
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" id="iRemoveSelectedCheckbox">Remove Selected Checkbox</a>
            <a class="dropdown-item" id="iRemoveAll">Remove All</a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table id="tableAbsensi" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <th><input type="checkbox" id="allCheckboxAbsensi"></th>
          
                <th>ID Periode</th>
                <th>Departemen</th>
                <th>Sub Departemen</th>
                <th>Pos</th>
                <th>Grade</th>
                <th>NIK</th>
                <th class="sticky-col first-col">Nama</th>
                <th>Tipe Kontrak</th>
                <th>Skema</th>
                <th>Total Hari</th>
                <th>Gaji Pokok</th>
                <th>Upah Harian</th>
                <th>Total Masuk</th>
                <th>Ph</th>
                <th>Izin</th>
                <th>Alfa</th>
                <th>Sakit</th>
                <th>Reff</th>
            </tr>
        </thead>
    </table>
</div>

<script>
function loadAbsensi() {
    if ($.fn.DataTable.isDataTable('#tableAbsensi')) {
        $('#tableAbsensi').DataTable().destroy();
    }

    $('#tableAbsensi').DataTable({
    ajax: {
        url: "{{ url('dashboard/penggajian/absensi-karyawan/listData') }}",
        dataSrc: 'data',
        error: function(xhr, error, thrown) {
            $('#tableAbsensi tbody').html(
                `<tr><td colspan="5" class="text-center">Gagal memuat data. Silakan coba lagi.</td></tr>`
            );
        }
    },
    processing: true,  // Menampilkan indikator loading
    // serverSide: true,  // Gunakan mode server-side untuk data besar
    deferRender: true, // Optimasi render tabel
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
    fixedHeader: true,
    responsive: true,
    scrollX: true,
    columns: [
        {data: 'id'},
        {data: 'idPeriode'},
        {data: 'departemen'},
        {data: 'subDepartemen'},
        {data: 'pos'},
        {data: 'grade'},
        {data: 'nik'},
        {data: 'name',
            className: 'sticky-col first-col'
        },
        {data: 'tipeKontrak'},
        {data: 'skema'},
        {data: 'totHari'},
        {data: 'gajiPokok',
            className: "text-right",
            render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'upahHarian',
            className: "text-right",
            render: $.fn.dataTable.render.number(',', '.', 2)},
        {data: 'totMasuk'},
        {data: 'totPh'},
        {data: 'totIzin'},
        {data: 'totAlfa'},
        {data: 'totSakit'},
        {data: 'reff'}
    ],
    columnDefs: [{
        targets: 0,
        orderable: false,
        className: 'dt-body-center',
        render: function(data, type, row) {
            return `<input type="checkbox" class="rowCheckbox" />`;
        }
    }]
    });

    $('#allCheckboxAbsensi').on('change', function() {
        const checked = $(this).is(':checked');
        $('.rowCheckbox').prop('checked', checked);
    });

    $(document).on('change', '.rowCheckbox', function() {
        if (!$(this).is(':checked')) {
            $('#allCheckboxAbsensi').prop('checked', false);
        }
    });
}

document.addEventListener("DOMContentLoaded", function() {
    const btnSyncronise = document.getElementById("btnSyncronise");
    if (btnSyncronise) {
 
        btnSyncronise.addEventListener("click", function() {
            Swal.fire({
                title: "Syncronise Absensi",
                text: "Apakah kamu yakin ingin Syncronise Absensi? Data akan otomatis terinput pada tabel absensi",
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
                            url: '{{ url('GetPivotPeriode') }}',
                            method: 'post',
                            data: $(this).serialize(),
                            success: function (response) {
                                console.log(response);
                                if (response === 'success') {
                                    $.ajax({
                                    url: '{{ url('dashboard/penggajian/absensi-karyawan/submit') }}',
                                    method: 'post',
                                    data: $(this).serialize(),
                                    success: function (response) {
                                        console.log(response);
                                        if (response === 'success') {
                                            Swal.fire({
                                                title: 'Data tersimpan!',
                                                type: 'success',
                                                onClose: function () {
                                                    window.location.reload();
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
});

document.addEventListener('DOMContentLoaded', loadAbsensi);
</script>