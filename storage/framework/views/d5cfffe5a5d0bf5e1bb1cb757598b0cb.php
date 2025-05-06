<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')); ?>" />
    <link rel="stylesheet"
        href="<?php echo e(asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('admin/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('admin/assets/vendor/libs/%40form-validation/form-validation.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('admin/assets/vendor/libs/animate-css/animate.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Permission Table -->
        <div class="card">
            <h2>Attempt #<?php echo e($scoreEntry->attempt); ?> - <?php echo e($scoreEntry->category->name); ?></h2>
            <div class="card-datatable table-responsive">
                <table class="table border-top" id="userScoreTable">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Your Answer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $userAnswers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($answer->question->question); ?></td>
                                <td><?php echo e($answer->answer); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Permission Table -->
    </div>
    <!-- / Content -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/assets/vendor/libs/%40form-validation/popular.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/assets/vendor/libs/%40form-validation/bootstrap5.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/assets/vendor/libs/%40form-validation/auto-focus.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/assets/js/extended-ui-sweetalert2.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        $(document).ready(function () {
            $('#userScoreTable').DataTable({
                processing: true,
                paging: true,
                searching: true,
                ordering: true,
                order: [[2, 'desc']], // Default order by attempt desc
                columnDefs: [
                    { targets: 0, searchable: false, orderable: false }, // disable ordering on index
                ]
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/AssessmentPortal/resources/views/admin/self_feedback_detail.blade.php ENDPATH**/ ?>