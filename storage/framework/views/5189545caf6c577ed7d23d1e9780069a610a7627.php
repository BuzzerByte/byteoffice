<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('/assets/admin/js/jquery.PrintArea.js')); ?>"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">INVENTORY <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?php echo e(route('inventory.import')); ?>">Import Inventory Excel(csv)</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Import csv inventories</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">

                            <div class="row">
                                <div class="col-md-12">

                                    <div class="row">

                                        <div class="col-md-10">

                                            <strong>Download Sample CSV File</strong><br>
                                            <a href="<?php echo e(route('inventory.download')); ?>"><i class="fa fa-download"
                                                    aria-hidden="true"></i> Sample CSV
                                                File</a>

                                            <br>
                                            <br>
                                            <p>Product Type:</p>
                                            <p>Inventory Product Type use -&gt; '<strong>Inventory</strong>'</p>
                                            <p>Non Inventory Product Type use -&gt; '<strong>Non-Inventory</strong>'</p>
                                            <p>Service Product Type use -&gt; '<strong>Service</strong>'</p>


                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Import Product</label>
                                <form action="<?php echo e(route('inventory.importInventory')); ?>" class="form-horizontal" method="POST"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <h4><label for="import_file">Please Select File (CSV only):</label>
                                        <input type="file" id="import_file" name="import_file" /></h4>
                                    <h4><input class="btn bg-navy" type="submit" name="upload" value="Import" /></h4>
                                </form>
                            </div>

                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Use Product Category ID and Tax ID when prepare CSV file.</h5>
                                    <br>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Product Category</th>
                                            </tr>
                                            <tr>
                                                <th>Category ID</th>
                                                <th>Category</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!$categories->isEmpty()): ?>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($category->id); ?></td>
                                                <td><?php echo e($category->name); ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                            <tr>
                                                No Category
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-6">
                                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th colspan="3">Tax Table</th>
                                            </tr>
                                            <tr>
                                                <th>Tax ID</th>
                                                <th>Tax Rate</th>
                                                <th>Tax Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!$taxes->isEmpty()): ?>
                                            <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($tax->id); ?></td>
                                                <td><?php echo e($tax->rate); ?></td>
                                                <td><?php echo e($tax->type); ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                            <tr>
                                                No Tax
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout-basic', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>