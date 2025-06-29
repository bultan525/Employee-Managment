<?php include(APPPATH . 'Views/admin/include/header.php'); ?>
<script src="<?= base_url('assets/js/core/jquery-3.7.1.min.js')?>"></script>
<!-- Datatables -->
<script src="<?= base_url('assets/js/plugin/datatables/datatables.min.js') ?>"></script>


<!-- DataTables Bootstrap 5 Integration JS -->
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<!-- jQuery Confirm CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

<!-- jQuery Confirm JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>


<script>
    const baseUrl = `<?= base_url() ?>`;
</script>
<!-- 🔹 Main Content Section -->
<?= $this->renderSection('content') ?>

<!-- 🔹 Optional JS Section -->
<?= $this->renderSection('scripts') ?>

<?php include(APPPATH . 'Views/admin/include/footer.php'); ?>