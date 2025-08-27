<!-- Form Add Hutang Start -->
<div id="formAddHutang" class="card border" style="display:none;">
    <div class="card-header">
        <h4>Tambah Data Hutang</h4>
    </div>
    <form id="formData">
    <input type="hidden" name="type" value="baru">
        <div class="modal-body">
            <div class="form-group">
                <label>Nama Karyawan</label>
                <select style="width: 100%" id="iNama" name="idKaryawan" required></select>
            </div>
            <div class="form-group">
                <label>Nominal</label>
                <input name="nominal" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>Tenor (bulan)</label>
                <input name="tenor" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Keterangan</label>
                <textarea class="form-control" name="note" style="height: 150px;"></textarea>
            </div>
        </div>
        <div class="card-footer bg-whitesmoke">
            <div class="row justify-content-end">
                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                    <button type="button" class="btn btn-block btn-outline-danger" onclick="hideFormAddHutang()">
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
<!-- Form Add Hutang End -->

<!-- Form Edit Hutang Start -->
<div id="formEditHutang" class="card border" style="display:none;">
    <div class="card-header">
        <h4>Edit Data Hutang</h4>
    </div>
    <form id="formData">
    <input type="hidden" name="type" value="edit">
    <div class="modal-body">
            <div class="form-group">
                <label>ID Hutang</label>
                <input  name="idHutang" type="text" class="form-control" readOnly>
            </div>
            <div class="form-group">
                <label>Nama Karyawan</label>
                <input  name="name" type="text" class="form-control" readOnly>
            </div>
            <div class="form-group">
                <label>Nominal</label>
                <input name="nominal" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>Tenor (bulan)</label>
                <input name="tenor" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Keterangan</label>
                <textarea class="form-control" name="note" style="height: 150px;"></textarea>
            </div>
        </div>
        <div class="card-footer bg-whitesmoke">
            <div class="row justify-content-end">
                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                    <button type="button" class="btn btn-block btn-outline-danger" onclick="hideFormEditHutang()">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </button>
                </div>
                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                    <button id="btnPelunasan" type="button" class="btn btn-block btn-warning">
                        <i class="fas fa-wallet mr-2"></i>Pelunasan
                    </button>
                </div>
                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                    <button type="submit" class="btn btn-block btn-success">
                        <i class="fas fa-check mr-2"></i>Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Form Edit Hutang End -->

<button type="button" id="iTambahHutang" class="btn btn-primary w-auto mb-3">
    <i class="fas fa-plus mr-3"></i>Tambah
</button>

<div class="table-responsive">
    <table id="tableHutang" class="table table-striped table-bordered display nowrap" style="width: 100%">
        <thead>
            <tr>
                <th><input type="checkbox" id="allCheckboxHutang"></th>
                <th>Status</th>
                <th>Departemen</th>
                <th>Sub Departemen</th>
                <th>Grade</th>
                <th>ID Karyawan</th>
                <th>Nama</th>
                <th>Nominal Hutang</th>
                <th>Tenor</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<script>
function loadHutang() {
    if ($.fn.DataTable.isDataTable('#tableHutang')) {
        $('#tableHutang').DataTable().destroy();
    }

    $('#tableHutang').DataTable({
        ajax: {
                url: '{{ url('dashboard/hutang-perusahaan/anggota/data') }}'
            },
                columns: [
                    {data: 'id_hutang'},
                    {data: 'status',
                        render: function(data, type) {
                            let color;
                        if (data == '0') {
                            status = 'Hutang';
                            color = 'red';
                        }
                        else if (data == '1') {
                            status = 'Lunas';
                            color = 'green';
                        }
                        else {
                            status = 'Error';
                            color = 'orange';
                        }
                        return '<span style="color:' + color + '">' + status + '</span>';
                    }
                    },
                    {data: 'departemen'},
                    {data: 'sub_departemen'},      
                    {data: 'grade'},
                    {data: 'id_karyawan'},  
                    {data: 'name'},
                    {data: 'total'},
                    {data: 'tenor'},
                    {data: 'note'},
                    { 
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <button type="button" id="iEditHutang" class="btn btn-warning edit-btn-hutang" data-id="${row.id_hutang}">
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
    $('#allCheckboxHutang').on('change', function() {
        const checked = $(this).is(':checked');
        $('.rowCheckbox').prop('checked', checked);
    });

    $(document).on('change', '.rowCheckbox', function() {
        if (!$(this).is(':checked')) {
            $('#allCheckboxHutang').prop('checked', false);
        }
    });
}

// hide and show form add hutang
function showFormAddHutang() {
    document.getElementById("formAddHutang").style.display = "block";
    document.getElementById("formEditHutang").style.display = "none";
}

function hideFormAddHutang() {
    document.getElementById("formAddHutang").style.display = "none";
    document.querySelector(".table-responsive").style.display = "block";
}

// hide and show form edit hutang
function showFormEditHutang(idHutang) {
    document.getElementById("formEditHutang").style.display = "block";
    document.getElementById("formAddHutang").style.display = "none";

    // Make an AJAX request to fetch the grade data
    $.ajax({
        url: `/dashboard/hutang-perusahaan/anggota/dataList`, // Laravel route
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'), // CSRF Token
            id_hutang: idHutang // Input variable to send
        },
        success: function(response) {

            let hutangData = response[0]; // Ambil objek pertama dalam array
      
            // Populate the form fields with response data
            $('input[name="idHutang"]').val(hutangData['id_hutang']);
            $('input[name="name"]').val(hutangData['name']);
            $('input[name="nominal"]').val(hutangData['total']);
            $('input[name="tenor"]').val(hutangData['tenor']);
            $('textarea[name="note"]').val(hutangData['note']);
         
            // Store the ID for updating the record later
            $('#formData').attr('data-id', idHutang);

            // Show the modal form
            $('#editHutangModal').modal('show');
        },
        error: function(xhr) {
            console.error("Error fetching data: ", xhr);
        }
    });
}

function hideFormEditHutang() {
    document.getElementById("formEditHutang").style.display = "none";
    document.querySelector(".table-responsive").style.display = "block";
}

// Button Add Hutang
document.addEventListener("DOMContentLoaded", function() {
    const addHutangButton = document.getElementById("iTambahHutang");
    if (addHutangButton) {
        addHutangButton.addEventListener("click", function() {
            showFormAddHutang();
        });
    }
});

// Drop down name
document.addEventListener("DOMContentLoaded", function () {
    let namaKaryawanDropdown = document.getElementById("iNama");

    let dataID;
    if (!namaKaryawanDropdown) {
        console.error("Dropdown nama tidak ditemukan!");
        return;
    }

    function loadNamaKaryawan() {
        $(namaKaryawanDropdown).select2({
            ajax: {
                url: '{{ url('list_karyawan') }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    console.log("Parameter Pencarian:", params);
                    return { search: params.term };
                },
                processResults: function (data) {
                    console.log("Hasil API:", data);
                    return { results: data.results };
                }
            },
            // minimumInputLength: 1 // Hanya mulai mencari setelah 1 karakter diketik
        });
     
        $(namaKaryawanDropdown).change(function(){
                var value = $(this).val();
                dataID = value;   
        });
    }

    setTimeout(() => {
        loadNamaKaryawan();
    }, 500);
});

// Action Edit
document.addEventListener("DOMContentLoaded", function() {
   document.addEventListener("click", function(event) {
        let editButton = event.target.closest(".edit-btn-hutang");
        if (editButton) {
            let idHutang = editButton.getAttribute("data-id"); // Correct way to get the ID
            showFormEditHutang(idHutang);
        }
    });
});

// Button Pelunasan
document.addEventListener("DOMContentLoaded", function () {
    const addPelunasan = document.getElementById("btnPelunasan");
   
    if (addPelunasan) {
        addPelunasan.addEventListener("click", function () {
            let idHutang = $('input[name="idHutang"]').val();
            $.ajax({
                url: `/dashboard/hutang-perusahaan/anggota/pelunasan`, // Laravel route
                type: "POST",
                data: {
                        _token: $('meta[name="csrf-token"]').attr('content'), // CSRF Token
                        id_hutang: idHutang // Input variable to send
                    },
                    success: function(response) {
                        console.log(response);
                        loadHutang();
                        hideFormEditHutang();
                    },
                    error: function(xhr) {
                        console.error("Error update data: ", xhr);
                    }
            });
        })
    }
});

// Button Submit
document.addEventListener("DOMContentLoaded", function() {
    // Tangani submit form tambah
    document.querySelector("#formAddHutang form").addEventListener("submit", function(event) {
        event.preventDefault(); // Mencegah reload halaman
        let formData = new FormData(this); // Ambil data form
        $.ajax({
            url: "{{ url('dashboard/hutang-perusahaan/anggota/submit') }}", // Sesuaikan dengan route Laravel
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            success: function(response) {
                loadHutang();
                hideFormAddHutang();
            },
            error: function(xhr) {
                console.error("Error:", xhr.responseText);
                alert("Terjadi kesalahan saat menambahkan data.");
            }
        });
    });

    // Tangani submit form edit
    document.querySelector("#formEditHutang form").addEventListener("submit", function(event) {
        event.preventDefault(); // Mencegah reload halaman
        let formData = new FormData(this); // Ambil data form
        $.ajax({
            url: "{{ url('dashboard/hutang-perusahaan/anggota/submit') }}", // Sesuaikan dengan route Laravel
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            success: function(response) {
                loadHutang();
                hideFormEditHutang();
            },
            error: function(xhr) {
                console.error("Error:", xhr.responseText);
                alert("Terjadi kesalahan saat mengubah data.");
            }
        });
    });
});

</script>