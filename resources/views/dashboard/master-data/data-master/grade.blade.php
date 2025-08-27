<!-- Form Add Grade Start -->
<div id="formAddGrade" class="card border" style="display:none;">
    <div class="card-header">
        <h4>Tambah Grade Baru</h4>
    </div>
    <form id="formData">
    <input type="hidden" name="type" value="baru">
        <div class="modal-body">
            <div class="form-group">
                <label>Level</label>
                <input name="level" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Nominal Tunjangan Transport</label>
                <input name="nominalTnjTransport" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Interval Bulan</label>
                <input name="intervalBulan" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Nominal Tunjangan Jabatan</label>
                <input name="nominalTnjJabatan" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Interval Bulan Jabatan</label>
                <input name="intervalBulanJabatan" type="text" class="form-control">
            </div>
        </div>
        <div class="card-footer bg-whitesmoke">
            <div class="row justify-content-end">
                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                    <button type="button" class="btn btn-block btn-outline-danger" onclick="hideFormAddGrade()">
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
<!-- Form Add Grade End -->

<!-- Form Edit Grade Start -->
<div id="formEditGrade" class="card border" style="display:none;">
    <div class="card-header">
        <h4>Edit Grade</h4>
    </div>
    <form id="formData">
    <input type="hidden" name="type" value="edit">
        <div class="modal-body">
            <div class="form-group">
                <label>ID Grade</label>
                <input name="idGrade" type="text" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label>Level</label>
                <input name="level" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Nominal Tunjangan Transport</label>
                <input name="nominalTnjTransport" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Interval Bulan</label>
                <input name="intervalBulan" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Nominal Tunjangan Jabatan</label>
                <input name="nominalTnjJabatan" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Interval Bulan Jabatan</label>
                <input name="intervalBulanJabatan" type="text" class="form-control">
            </div>
        </div>
        <div class="card-footer bg-whitesmoke">
            <div class="row justify-content-end">
                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                    <button type="button" class="btn btn-block btn-outline-danger" onclick="hideFormEditGrade()">
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
<!-- Form Add Grade End -->

<button type="button" id="iTambahGrade" class="btn btn-block btn-primary mb-3" style="width: 15%">
    <i class="fas fa-plus mr-2"></i>Tambah
</button>

<div class="table-responsive">
    <table id="tableGrade" class="table table-striped table-bordered display nowrap" style="width: 100%">
        <thead>
            <tr>
                <th>Status</th>
                <th>ID</th>
                <th>Level</th>
                <th>Nominal Tunjangan Transport</th>
                <th>Interval Bulan (Transport)</th>
                <th>Nominal Tunjangan Jabatan</th>
                <th>Interval Bulan (Jabatan)</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<script>   
function loadGrade() {
    if ($.fn.DataTable.isDataTable('#tableGrade')) {
        $('#tableGrade').DataTable().destroy();
    }

    $('#tableGrade').DataTable({
        ajax: {
                url: '{{ url('dashboard/master/grade/data') }}'
            },
                columns: [
                    {data: 'isDell',
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
                            status = 'Error';
                            color = 'orange';
                        }
                        return '<span style="color:' + color + '">' + status + '</span>';
                    }
                    },
                    {data: 'id_grade'},
                    {data: 'level'},      
                    {data: 'nominal_tnj_transport',
                    className: "text-right" ,
                    render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    {data: 'interval_bln'},
                    {data: 'nominal_tnj_jabatan',
                    className: "text-right" ,
                    render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    {data: 'interval_bln_jabatan'},
                    {data: 'updated_at'},
                    { 
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <button type="button" id="iEditGrade" class="btn btn-warning edit-btn" data-id="${row.id_grade}">
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
    });
}

// hide and show form add grade
function showFormAddGrade() {
    document.getElementById("formAddGrade").style.display = "block";
    document.getElementById("formEditGrade").style.display = "none";
}

function hideFormAddGrade() {
    document.getElementById("formAddGrade").style.display = "none";
    document.querySelector(".table-responsive").style.display = "block";
}

document.addEventListener("DOMContentLoaded", function() {
    const addGradeButton = document.getElementById("iTambahGrade");
    if (addGradeButton) {
        addGradeButton.addEventListener("click", function() {
            showFormAddGrade();
        });
    }
});

// hide and show form edit grade
function showFormEditGrade(gradeId) {
    document.getElementById("formEditGrade").style.display = "block";
    document.getElementById("formAddGrade").style.display = "none";
 
    // Make an AJAX request to fetch the grade data
    $.ajax({
        url: `/dashboard/master/grade/dataList`, // Laravel route
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'), // CSRF Token
            id_grade: gradeId // Input variable to send
        },
        success: function(response) {

            let gradeData = response[0]; // Ambil objek pertama dalam array
        
            // Populate the form fields with response data
            $('input[name="idGrade"]').val(gradeData.id_grade);
            $('input[name="level"]').val(gradeData.level);
            let nominalTnjTransport = numeral(gradeData.nominal_tnj_transport).value();
            $('input[name="nominalTnjTransport"]').val(nominalTnjTransport);
            $('input[name="intervalBulan"]').val(gradeData.interval_bln);
            let nominalTnjJabatan = numeral(gradeData.nominal_tnj_jabatan).value();
            $('input[name="nominalTnjJabatan"]').val(nominalTnjJabatan);
            $('input[name="intervalBulanJabatan"]').val(gradeData.interval_bln_jabatan);

            // Store the ID for updating the record later
            $('#formData').attr('data-id', gradeId);

            // Show the modal form
            $('#editGradeModal').modal('show');
        },
        error: function(xhr) {
            console.error("Error fetching data: ", xhr);
        }
    });
}

function hideFormEditGrade() {
    document.getElementById("formEditGrade").style.display = "none";
    document.querySelector(".table-responsive").style.display = "block";
}

document.addEventListener("DOMContentLoaded", function() {
   document.addEventListener("click", function(event) {
        let editButton = event.target.closest(".edit-btn");
        if (editButton) {
            let gradeId = editButton.getAttribute("data-id"); // Correct way to get the ID
            showFormEditGrade(gradeId);
        }
    });
});

document.addEventListener('DOMContentLoaded', loadGrade);

document.addEventListener("DOMContentLoaded", function() {
    // Tangani submit form tambah
    document.querySelector("#formAddGrade form").addEventListener("submit", function(event) {
        event.preventDefault(); // Mencegah reload halaman
        
        let formData = new FormData(this); // Ambil data form
        $.ajax({
            url: "{{ url('dashboard/master/grade/submit') }}", // Sesuaikan dengan route Laravel
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            success: function(response) {
                location.reload(); // Refresh halaman setelah sukses
            },
            error: function(xhr) {
                console.error("Error:", xhr.responseText);
                alert("Terjadi kesalahan saat menambahkan data.");
            }
        });
    });

    // Tangani submit form edit
    document.querySelector("#formEditGrade form").addEventListener("submit", function(event) {
        event.preventDefault(); // Mencegah reload halaman
        let formData = new FormData(this); // Ambil data form
        $.ajax({
            url: "{{ url('dashboard/master/grade/submit') }}", // Sesuaikan dengan route Laravel
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            success: function(response) {
                location.reload(); // Refresh halaman setelah sukses
            },
            error: function(xhr) {
                console.error("Error:", xhr.responseText);
                alert("Terjadi kesalahan saat mengubah data.");
            }
        });
    });
});
</script>