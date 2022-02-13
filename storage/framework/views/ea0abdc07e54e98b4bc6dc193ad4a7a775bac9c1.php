<?php $__env->startSection('content'); ?>

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href=""> الاقسام الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item active"> تعديل - <?php echo e($mainCategory -> name); ?>

                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تعديل قسم رئيسي </h4>
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
                                    <div class="card-body">
                                        <form class="form"
                                              action="<?php echo e(route('admin.maincategories.update',$mainCategory -> id)); ?>"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>

                                            <input name="id" value="<?php echo e($mainCategory -> id); ?>" type="hidden">

                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img
                                                        src="<?php echo e($mainCategory -> photo); ?>"
                                                        class="rounded-circle  height-150" alt="صورة القسم  ">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label> صوره القسم </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="photo">
                                                    <span class="file-custom"></span>
                                                </label>
                                                <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات القسم </h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم القسم
                                                                - <?php echo e(__('messages.'.$mainCategory -> translation_lang)); ?> </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="<?php echo e($mainCategory -> name); ?>"
                                                                   name="category[0][name]">
                                                            <?php $__errorArgs = ["category.0.name"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6 hidden">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> أختصار
                                                                اللغة <?php echo e(__('messages.'.$mainCategory -> translation_lang)); ?> </label>
                                                            <input type="text" id="abbr"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="<?php echo e($mainCategory -> translation_lang); ?>"
                                                                   name="category[0][abbr]">

                                                            <?php $__errorArgs = ["category.0.abbr"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1"
                                                                   name="category[0][active]"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   <?php if($mainCategory -> active == 1): ?>checked <?php endif; ?>/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة <?php echo e(__('messages.'.$mainCategory -> translation_lang)); ?> </label>

                                                            <?php $__errorArgs = ["category.0.active"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="text-danger"> </span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> تحديث
                                                </button>
                                            </div>
                                        </form>

                                        <ul class="nav nav-tabs">
                                            <?php if(isset($mainCategory -> categories)): ?>
                                                <?php $__currentLoopData = $mainCategory -> categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index =>  $translation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link <?php if($index ==  0): ?> active <?php endif; ?>  " id="homeLable-tab"  data-toggle="tab"
                                                           href="#homeLable<?php echo e($index); ?>" aria-controls="homeLable"
                                                            aria-expanded="<?php echo e($index ==  0 ? 'true' : 'false'); ?>">
                                                            <?php echo e($translation -> translation_lang); ?></a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </ul>
                                        <div class="tab-content px-1 pt-1">

                                            <?php if(isset($mainCategory -> categories)): ?>
                                                <?php $__currentLoopData = $mainCategory -> categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index =>  $translation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <div role="tabpanel" class="tab-pane  <?php if($index ==  0): ?> active  <?php endif; ?>  " id="homeLable<?php echo e($index); ?>"
                                                 aria-labelledby="homeLable-tab"
                                                 aria-expanded="<?php echo e($index ==  0 ? 'true' : 'false'); ?>">

                                                <form class="form"
                                                      action="<?php echo e(route('admin.maincategories.update',$translation -> id)); ?>"
                                                      method="POST"
                                                      enctype="multipart/form-data">
                                                    <?php echo csrf_field(); ?>

                                                    <input name="id" value="<?php echo e($translation -> id); ?>" type="hidden">


                                                    <div class="form-body">

                                                        <h4 class="form-section"><i class="ft-home"></i> بيانات القسم </h4>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> اسم القسم
                                                                        - <?php echo e(__('messages.'.$translation -> translation_lang)); ?> </label>
                                                                    <input type="text" id="name"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           value="<?php echo e($translation -> name); ?>"
                                                                           name="category[0][name]">
                                                                    <?php $__errorArgs = ["category.0.name"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6 hidden">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> أختصار
                                                                        اللغة <?php echo e(__('messages.'.$translation -> translation_lang)); ?> </label>
                                                                    <input type="text" id="abbr"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           value="<?php echo e($translation -> translation_lang); ?>"
                                                                           name="category[0][abbr]">

                                                                    <?php $__errorArgs = ["category.0.abbr"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mt-1">
                                                                    <input type="checkbox" value="1"
                                                                           name="category[0][active]"
                                                                           id="switcheryColor4"
                                                                           class="switchery" data-color="success"
                                                                           <?php if($translation -> active == 1): ?>checked <?php endif; ?>/>
                                                                    <label for="switcheryColor4"
                                                                           class="card-title ml-1">الحالة <?php echo e(__('messages.'.$translation -> translation_lang)); ?> </label>

                                                                    <?php $__errorArgs = ["category.0.active"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="text-danger"> </span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-actions">
                                                        <button type="button" class="btn btn-warning mr-1"
                                                                onclick="history.back();">
                                                            <i class="ft-x"></i> تراجع
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="la la-check-square-o"></i> تحديث
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\ecommerce\resources\views/admin/maincategories/edit.blade.php ENDPATH**/ ?>