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
                        <!-- <div class="card-title"></div> -->
                    </div>
                    <form id="form-edit-employee" action="<?= base_url('admin/employee/update-employee-data') ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="emp_name">Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="emp_name" id="emp_name" value="<?= $details['name'] ?>" placeholder="Enter Name" />
                                                <span class="text-danger error-input-feedback"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="designation">Designation<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="designation" id="designation" value="<?= $details['designation'] ?>" placeholder="Enter Designation" />
                                                <span class="text-danger error-input-feedback"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="salary">Salary<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="salary" id="salary" value="<?= $details['salary'] ?>" placeholder="Enter Salary" />
                                                <span class="text-danger error-input-feedback"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="picture">Picture</label>
                                                <input type="file" class="form-control" name="picture" id="picture" />
                                                <span class="text-danger error-input-feedback"></span>
                                            </div>
                                        </div>
                                        <?php if (!empty($details['picture'])): ?>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <a href="<?= base_url('uploads/employees/'.$details['picture']) ?>" data-lightbox="employee-image">
                                                    <img src="<?= base_url('uploads/employees/'.$details['picture']) ?>" alt="Employee Picture" alt="Im age" style="width: 50px; height: 50px;" class="img-thumbnail mt-2">
                                                </a>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea class="form-control" name="address" id="address" rows="2"><?= $details['address'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= $details['id'] ?>">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button class="btn btn-danger cancel-btn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script src="<?= base_url('assets/js/admin/employee.js?v=' . time()) ?>"></script>
<?= $this->endSection() ?>