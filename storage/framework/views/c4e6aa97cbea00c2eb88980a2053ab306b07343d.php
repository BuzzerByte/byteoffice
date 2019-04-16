<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('/assets/admin/js/jquery.PrintArea.js')); ?>"></script>

<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        function init() {
            
        }
        init();
        
        $('.edit').click(function () {
            var id = $(this).siblings('.inventory_id').attr('id');
            $('#form-inventory').attr('action', '/admin/inventory/' + id);
    
            $.get("/admin/inventory/" + id + "/edit", function (data) {
                if (data['inventory'][0]['type'] !== 'Inventory') {
                    $('.quantity').hide();
                } else {
                    $('.quantity').show();
                }
                $('#inp_name').val(data['inventory'][0]['name']);
                $('#inp_model_no').val(data['inventory'][0]['model_no']);
                $('#inp_house_no').val(data['inventory'][0]['in_house']);
                $('#inp_category').val(data['inventory'][0]['category_id']);
                $('#edit_p_image').attr('src', "/images/" + data['inventory'][0]['image']);
                $('#inp_s_cost').val(data['inventory'][0]['s_price']);
                $('#inp_s_info').val(data['inventory'][0]['s_information']);
                $('#inp_p_cost').val(data['inventory'][0]['p_price']);
                $('#inp_p_info').val(data['inventory'][0]['p_information']);
                $('#inp_tax').val(data['inventory'][0]['tax_id']);
                $('#inp_quantity').val(data['inventory'][0]['quantity']);
            });
        });
    
        $('.delete').click(function () {
            var id = $(this).parents('li').siblings('.inventory_id').attr('id');
            $('#form-d-inventory').attr('action', '/admin/inventory/' + id + '/delete');
        });
    
        $('.inventory').click(function () {
            $('.type').val('Inventory');
        });
        $('.n_inventory').click(function () {
            $('.type').val('Non-Inventory');
            $('.quantity').hide();
        });
        $('.service').click(function () {
            $('.type').val('Service');
            $('.quantity').hide();
        });
    
        $(document.body).on('click', '.withdraw', function () {
            var id = $(this).siblings('.inventory_id').attr('id');
            $('.inv_id').val(id);
            $.get("/admin/inventory/" + id, function (data) {
                $('#w_quantity').attr('placeholder',data['inventory'][0]['quantity']);
                $('#withdraw_name').val(data['inventory'][0]['name']);
            });
        });
    
        
        $(document.body).on('keyup','#w_quantity',function(){
            $limit = $('#w_quantity').attr('placeholder');
            $inp = $(this).val();
            if(parseInt($(this).val()) > parseInt($limit)){
                $('#exceed_qty').attr('class','');
                $('#submit_withdraw').attr('disabled','disabled');
            }else{
                $('#exceed_qty').attr('class','hidden');
                $('#submit_withdraw').removeAttr('disabled');
            }
        });
    
        $(document.body).on('change','#parent_present',function(){
            if(this.checked){
                $('.child_present').prop('checked',true);
            }else{
                $('.child_present').prop('checked',false);
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">INVENTORY <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?php echo e(route('inventory.index')); ?>">Products and Services</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12 col-xs-12">
            
            <div class="card">
                <form action="<?php echo e(route('inventory.delete')); ?>" method="post" accept-charset="utf-8">
                        <?php echo csrf_field(); ?>
                <div class="card-header bg-info">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="caption">
                                <h6>Inventories</h6>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <?php if (\Entrust::can('product-create')) : ?>
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-outline-default dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Add Product and Services
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item inventory" href="#" data-toggle="modal" data-target="#modal-create">
                                        Inventory
                                        Product</a>
                                    <a class="dropdown-item n_inventory" href="#" data-toggle="modal" data-target="#modal-create">Non-Inventory</a>
                                    <a class="dropdown-item service" href="#" data-toggle="modal" data-target="#modal-create">Service</a>
                                </div>
                            </div>
                            <?php endif; // Entrust::can ?>
                            <?php if (\Entrust::can('product-delete')) : ?>
                            <button type="submit" onclick="return confirm('Are you sure want to delete selected inventories?');"
                                class="btn btn-danger btn-md btn-flat" id="deleteInventories"><i class="fa fa-trash"></i>Delete</button>
                            <?php endif; // Entrust::can ?>
                        </div>
                    </div>
                </div>
                
                <div class="card-body table-responsive">
                    <?php if (\Entrust::can('product-list')) : ?>
                    <table id="responsive-datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr role="row">
                                <th><input type="checkbox" id="parent_present">No.</th>
                                <th>Pic</th>
                                <th>Category</th>
                                <th>Product</th>
                                <th>Part/Model No</th>
                                <th>In House Part No</th>
                                <th>Sales
                                    Cost</th>
                                <th>Buying
                                    Cost</th>
                                <th>Current Quantity</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <?php if(!$inventories->isEmpty()): ?>
                        <tbody>
                            <?php if(Session::has('success')): ?>
                            <button class="btn btn-success" data-toastr="success" data-message="<?php echo e(Session::get('success')); ?>"
                                data-title="Success!">
                            </button>
                            <?php endif; ?>
                            <?php if(Session::has('failure')): ?>
                            <button class="btn btn-danger" data-toastr="error" data-message="<?php echo e(Session::get('failure')); ?>"
                                data-title="Error!">
                            </button>
                            <?php endif; ?>
                            <?php if(Session::has('warning')): ?>
                            <button class="btn btn-warning" data-toastr="warning" data-message="<?php echo e(Session::get('warning')); ?>"
                                data-title="Warning!">
                            </button>
                            <?php endif; ?>
                            <?php $__currentLoopData = $inventories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$inventory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr role="row" class="odd">
                                <td><?php echo e($index+1); ?><br><input type="checkbox" class="child_present pull-left" name="inventory[]"
                                        value="<?php echo e($inventory->id); ?>"></td>
                                <td>
                                    <img id="show_p_image" class="pull-right" src="/images/<?php echo e($inventory->image); ?>"
                                        width="60" height="60" alt="<?php echo e($inventory->image); ?>" style="pointer-events: none"></td>
                                <td>
                                    <?php echo e($inventory->category($inventory->id)); ?>

                                    </td>
                                <td><?php echo e($inventory->name); ?></td>
                                <td><?php echo e($inventory->model_no); ?></td>
                                <td><?php echo e($inventory->in_house); ?></td>
                                <td><?php echo e($inventory->s_price); ?></td>
                                <td><?php echo e($inventory->p_price); ?></td>
                                <?php if($inventory->quantity == null): ?>
                                <td> - </td>
                                <?php else: ?>
                                <td><?php echo e($inventory->quantity); ?></td>
                                <?php endif; ?>

                                <td><?php echo e($inventory->type); ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-outline-default dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <input type="hidden" class="inventory_id" id="<?php echo e($inventory->id); ?>">
                                            <a class="dropdown-item withdraw" href="#" data-toggle="modal"
                                                data-target="#modal-withdraw">Withdraw</a>
                                            <?php if (\Entrust::can('product-edit')) : ?>
                                            <a class="dropdown-item edit" href="#" data-toggle="modal" data-target="#modal-edit">Edit</a>
                                            <?php endif; // Entrust::can ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <?php else: ?>
                        <tbody>
                            <div class="card text-white bg-info text-sm-center">
                                <div class="card-body">
                                    <blockquote class="card-bodyquote">
                                        <p>Hi, you don't have any inventory yet</p>

                                    </blockquote>
                                </div>
                            </div>
                        </tbody>
                        <?php endif; ?>


                    </table>
                    <?php endif; // Entrust::can ?>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-create" style="display: none;">
    <?php echo $__env->make('admin.inventory.create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="modal fade" id="modal-edit" style="display: none;">
    <?php echo $__env->make('admin.inventory.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="modal fade" id="modal-delete" style="display: none;">
    <?php echo $__env->make('admin.inventory.delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="modal fade" id="modal-withdraw" style="display: none;">
    <?php echo $__env->make('admin.withdrawals.create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<!-- /.row (main row) -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout-basic', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>