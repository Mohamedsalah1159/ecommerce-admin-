<?php $__env->startSection('content'); ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> الاقسام الرئيسية </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active">
                                <a href="<?php echo e(route('admin.maincategories')); ?>">الرئيسية</a>
                                    المتاجر 
                                
                                </li>
                                <li class="breadcrumb-item active"> اضافة
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع المتاجر    </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <?php echo $__env->make('admin.includes.alerts.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('admin.includes.alerts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead>
                                            <tr>
                                                <th>الاسم</th>
                                                <th>اللوجو</th>
                                                <th>الهاتف</th>
                                                <th>القسم الرئيسي</th>
                                                <th>الحالة </th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php if(isset($vendors)): ?>
                                                <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($vendor -> name); ?></td>
                                                        <td><img style="width:100%; height:100px;" src="<?php echo e($vendor -> logo); ?>"></td>
                                                        <td><?php echo e($vendor -> mobile); ?></td>

                                                        <td><?php echo e($vendor -> maincategory['name']); ?></td>
                                                        <td><?php echo e($vendor -> getActive()); ?></td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="<?php echo e(route('admin.vendors.edit',$vendor->id)); ?>"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>


                                                                <a href="<?php echo e(route('admin.vendors.delete', $vendor->id)); ?>"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>
                                                                
                                                                <a href="<?php echo e(route('admin.maincategories.changestatus', $vendor->id)); ?>"
                                                                class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1"><?php if($vendor->active == 0): ?> تفعيل  <?php else: ?> الغاء التفعيل  <?php endif; ?></a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>


                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\ecommerce\resources\views/admin/vendors/index.blade.php ENDPATH**/ ?>