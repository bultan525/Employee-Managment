  <footer class="footer">
    <div class="container-fluid d-flex justify-content-end">
      <div>
        Developed by
        <a href="javascript:void(0)">Bultan Das</a>.
      </div>
    </div>
  </footer>
      </div>

    </div>
    <!--   Core JS Files   -->

    <script src="<?= base_url('assets/js/core/popper.min.js')?>"></script>
    <script src="<?= base_url('assets/js/core/bootstrap.min.js')?>"></script>

    <!-- jQuery Scrollbar -->
    <script src="<?= base_url('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')?>"></script>


    <!-- Bootstrap Notify -->
    <script src="<?= base_url('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')?>"></script>


    <!-- Kaiadmin JS -->
    <script src="<?= base_url('assets/js/kaiadmin.min.js')?>"></script>
    <script src="<?= base_url('assets/lightbox/lightbox.js')?>"></script>
    <script>

        $('.attempt-to-logout').on('click', function (e) {
            e.preventDefault();

            $.ajax({
                url: '<?= base_url('admin/logout') ?>',
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                      window.location.href = data.redirect;
                    } else {
                        $.alert({
                          title: "Error!",
                          content: "Logout failed.",
                          type: "red"
                        });
                    }
                },

                error: function () {
                    $.alert({
                      title: "Error!",
                      content: "Something went wrong during logout.",
                      type: "red"
                    });
                }
            });
        });


    </script>
  </body>
</html>
