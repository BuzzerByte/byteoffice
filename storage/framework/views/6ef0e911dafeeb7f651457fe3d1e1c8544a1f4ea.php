<?php $__env->startSection('scripts'); ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
$('.view').click(function () {
    var id = $(this).siblings('.client_id').attr('id');
    
    $.get("/admin/client/" + id, function (data) {
        console.log(data);
        $('#inp_name').val(data['client'][0]['name']);
        $('#inp_company').val(data['client'][0]['company']);
        $('#inp_phone').val(data['client'][0]['phone']);
        $('#inp_fax').val(data['client'][0]['fax']);
        $('#inp_email').val(data['client'][0]['email']);
        $('#inp_website').val(data['client'][0]['website']);
        $('#inp_b_address').val(data['client'][0]['billing_address']);
        $('#inp_s_address').val(data['client'][0]['shipping_address']);
        $('#inp_note').val(data['client'][0]['note']);
    });
});
Highcharts.chart('salesChart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Monthly Sales'
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Quantity (millions)'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Population in 2017: <b>{point.y:.1f} millions</b>'
    },
    series: [{
        name: 'Population',
        data: [
            ['Shanghai', 24.2],
            ['Beijing', 20.8],
            ['Karachi', 14.9],
            ['Shenzhen', 13.7],
            ['Guangzhou', 13.1],
            ['Istanbul', 12.7],
            ['Mumbai', 12.4],
            ['Moscow', 12.2],
            ['São Paulo', 12.0],
            ['Delhi', 11.7],
            ['Kinshasa', 11.5],
            ['Tianjin', 11.2],
            ['Lahore', 11.1],
            ['Jakarta', 10.6],
            ['Dongguan', 10.6],
            ['Lagos', 10.6],
            ['Bengaluru', 10.3],
            ['Seoul', 9.8],
            ['Foshan', 9.3],
            ['Tokyo', 9.3]
        ],
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-content" id="dashboardPage">
        <div class="row">
            <div class="col-md-12 col-lg-6 col-xl-3">
                <a class="dashbox" href="#">
                    <i class="icon-fa icon-fa-users text-primary"></i>
                    <span class="title">
                      <?php echo e($users); ?>

                    </span>
                    <span class="desc">
                      Users
                    </span>
                </a>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-3">
                <a class="dashbox" href="#">
                    <i class="icon-fa icon-fa-ticket text-success"></i>
                    <span class="title">
                      <?php echo e($purchases); ?>

                    </span>
                    <span class="desc">
                      Purchase(s)
                    </span>
                </a>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-3">
                <a class="dashbox" href="#">
                    <i class="icon-fa icon-fa-shopping-cart text-danger"></i>
                    <span class="title">
                      <?php echo e($orders); ?>

                    </span>
                    <span class="desc">
                      Order(s)
                    </span>
                </a>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-3">
                <a class="dashbox" href="#">
                    <i class="icon-fa icon-fa-cubes text-info"></i>
                    <span class="title">
                      <?php echo e($products); ?>

                    </span>
                    <span class="desc">
                      Inventories
                    </span>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xl-6 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h6><i class="icon-fa icon-fa-line-chart text-warning"></i> Traffic Stats</h6>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-6 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h6><i class="icon-fa icon-fa-bar-chart text-success"></i> Sales Chart</h6>
                    </div>
                    <div class="card-body">
                        <div id="salesChart"></div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xl-6 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h6><i class="icon-fa icon-fa-shopping-cart text-danger"></i> Recent Orders</h6>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                    <?php if($AllOrder != []): ?>
                                    <?php $__currentLoopData = $AllOrder; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                    <td><?php echo e(\buzzeroffice\Client::where('id',$order->client_id)->first()->name); ?></td>
                                    <td><?php echo e($order->invoice_date); ?></td>
                                    <td><?php echo e($order->g_total); ?></td>
                                    <td>
                                        <input type="hidden" class="client_id" id="<?php echo e($order->id); ?>">
                                        <a class="btn btn-default btn-xs" href="/admin/orders/<?php echo e($order->id); ?>">View</a>
                                    </td>
                                    </tr>
                    
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                    No Orders in database
                                    <?php endif; ?>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-6 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h6><i class="icon-fa icon-fa-users text-info"></i> New Customers</h6>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                    <?php if($clients != []): ?>
                                    <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                    <td><?php echo e($client->name); ?></td>
                                    <td><?php echo e($client->created_at); ?></td>
                                    <td><?php echo e($client->open_balance); ?></td>
                                    <td>
                                        <input type="hidden" class="client_id" id="<?php echo e($client->id); ?>">
                                        <a class="btn btn-default btn-xs view" href="#" data-toggle="modal" data-target="#modal-view">View</a>
                                    </td>
                                    </tr>
                    
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                    No Clients in database
                                    <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="modal-view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <?php echo $__env->make('admin.clients.show', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout-basic', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>