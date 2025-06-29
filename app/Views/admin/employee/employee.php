<?= $this->extend('admin/include/layout') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3"><?= $title; ?></h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <!-- <h4 class="card-title">Basic</h4> -->
                            <a href="<?= base_url('admin/employee/create-employee') ?>" class="btn btn-primary btn-round ms-auto" >
                                <i class="fa fa-plus"></i>
                                Add Employee
                            </a >
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dtEmployee" class="display table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Salary</th>
                                        <th>Picture</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/admin/employee.js') ?>"></script>
<?= $this->endSection() ?>