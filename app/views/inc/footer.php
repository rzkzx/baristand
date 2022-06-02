</div>

<!-- Modal Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelLogout">BSPJI BANJARBARU</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <p>Anda yakin ingin keluar?</p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
        <a href="<?= URLROOT; ?>/auth/logout" class="btn btn-primary">Keluar</a>
        </div>
    </div>
    </div>
</div>

</div>
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
    <div class="copyright text-center my-auto">
        <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
        <b>BSPJI Banjarbaru</b>
        </span>
    </div>
    </div>
</footer>
<!-- Footer -->
</div>
</div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<script src="<?= URLROOT; ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= URLROOT; ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= URLROOT; ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= URLROOT; ?>/js/ruang-admin.min.js"></script>

<script src="<?= URLROOT; ?>/vendor/chart.js/Chart.min.js"></script>
<script src="<?= URLROOT; ?>/js/demo/chart-area-demo.js"></script>  
<!-- Page level plugins -->
<script src="<?= URLROOT; ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= URLROOT; ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Sweetalert2 JS -->
<script src="<?= URLROOT; ?>/vendor/sweetalert2/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="<?= URLROOT; ?>/vendor/select2/dist/js/select2.min.js"></script>
<!-- Bootstrap Datepicker -->
<script src="<?= URLROOT; ?>/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap Touchspin -->
<script src="<?= URLROOT; ?>/vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
<!-- ClockPicker -->
<script src="<?= URLROOT; ?>/vendor/clock-picker/clockpicker.js"></script>
<!-- Page level custom scripts -->
<script>
$(document).ready(function () {
    $('.select2-pegawai-pejabat').select2({
        placeholder: "Pilih Pegawai",
        allowClear: true
    }); 
    $('.select2-atasan').select2({
        placeholder: "Pilih Atasan",
        allowClear: true
    }); 
    $('.select2-pengusul').select2({
        placeholder: "Pilih Pengusul",
        allowClear: true
    }); 
    $('.select2-penanggung').select2({
        placeholder: "Pilih Penanggung Jawab",
        allowClear: true
    });
    $('.select2-ppk').select2({
        placeholder: "Pilih PPK",
        allowClear: true
    }); 
    $('.select2-pemohon').select2({
        placeholder: "Pilih Pemohon",
        allowClear: true
    }); 
    // Select2 Multiple
    $('.select2-multiple').select2();

    $('#dataTable').DataTable(); // ID From dataTable 
    $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    
    del();
});

function fileValidation(){
    var inputFile = document.getElementById('file');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.pdf|\.doc|\.docx)$/i;
    if(inputFile.files[0].size > 50000 * 1000){ // ini untuk ukuran1000000 untuk 1 MB.
        alert("Maaf. File Terlalu Besar ! Maksimal Upload 50mb");
        inputFile.value = '';
        return false;
    };
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang memiliki ekstensi .pdf/.doc/.docx');
        inputFile.value = '';
        return false;
    }else{
        //Pratinjau gambar
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // document.getElementById('previewGambar').innerHTML = '<img src="'+e.target.result+'"/>';
            };
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}
function fileValidation2(){
    var inputFile = document.getElementById('file2');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.pdf|\.doc|\.docx)$/i;
    if(inputFile.files[0].size > 50000 * 1000){ // ini untuk ukuran1000000 untuk 1 MB.
        alert("Maaf. File Terlalu Besar ! Maksimal Upload 50mb");
        inputFile.value = '';
        return false;
    };
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang memiliki ekstensi .pdf/.doc/.docx');
        inputFile.value = '';
        return false;
    }else{
        //Pratinjau gambar
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // document.getElementById('previewGambar').innerHTML = '<img src="'+e.target.result+'"/>';
            };
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}
</script>

</body>

</html>