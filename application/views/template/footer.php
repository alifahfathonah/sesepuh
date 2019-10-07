     <!-- Footer -->
     <footer class="sticky-footer bg-white">
         <div class="container my-auto">
             <div class="copyright text-center my-auto">
                 <span>Copyright &copy; PENGINAPAN <?= date('Y') ?></span>
             </div>
         </div>
     </footer>
     <!-- End of Footer -->

     </div>
     <!-- End of Content Wrapper -->

     </div>
     <!-- End of Page Wrapper -->

     <!-- Scroll to Top Button-->
     <a class="scroll-to-top rounded" href="#page-top">
         <i class="fas fa-angle-up"></i>
     </a>

     <!-- Logout Modal-->
     <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                     <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">×</span>
                     </button>
                 </div>
                 <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                 <div class="modal-footer">
                     <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                     <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
                 </div>
             </div>
         </div>
     </div>

     <!-- <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin akan menghapus submenu ini ?</h5>
                     <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">×</span>
                     </button>
                 </div>
                 <div class="modal-body">Select "yes" below if you are ready to delete submenu.</div>
                 <div class="modal-footer">
                     <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                     <a class="btn btn-primary a-delete">Yes</a>
                 </div>
             </div>
         </div>
     </div> -->



     <!-- Bootstrap core JavaScript-->
     <script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
     <script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

     <!-- Core plugin JavaScript-->
     <script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

     <!-- Custom scripts for all pages-->
     <script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>
     <script src="<?= base_url('assets/') ?>js/jquery.dataTables.min.js"></script>
     <script>
         $(document).ready(function() {
             $('.table').DataTable();
         });

         $('.custom-file-input').on('change', function() {
             let filename = $(this).val().split('\\').pop();
             $(this).next('.custom-file-label').addClass('selected').html(filename);
         });

         $('.form-check-input').on('click', function() {
             const menuId = $(this).data('menu');
             const roleId = $(this).data('role');

             $.ajax({
                 url: "<?= base_url('admin/changeaccess') ?>",
                 type: "post",
                 data: {
                     menuId: menuId,
                     roleId: roleId
                 },
                 success: function() {
                     document.location.href = "<?= base_url('admin/roleaccess/') ?>" + roleId;
                 }
             })

         })
     </script>
     </body>

     </html>