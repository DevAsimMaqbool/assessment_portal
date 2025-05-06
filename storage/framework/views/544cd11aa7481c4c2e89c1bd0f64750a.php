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
        <>
            <!-- Permission Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table border-top" id="userScoreTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Attempt</th>
                                <th>Score</th>
                                <!-- <th>View Attempt Detail</th> -->
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $userScore; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $score): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e(str_replace('and', '&', $score->category->name)); ?></td>
                                    <td><?php echo e($score->attempt); ?></td>
                                    <td><?php echo e($score->average_score); ?>%</td>
                                    <!-- <td><a
                                                                                                                                                                                                                                        href="<?php echo e(route('admin.self_feedback.details', ['attempt' => $score->attempt, 'category_id' => $score->category_id])); ?>">
                                                                                                                                                                                                                                        Click here
                                                                                                                                                                                                                                    </a></td> -->
                                    <td><?php echo e($score->created_at); ?></td>
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
                ],
                layout: {
                    topStart: {
                        rowClass: "row m-3 my-0 justify-content-between",
                        features: [
                            {
                                pageLength: {
                                    menu: [10, 25, 50, 100],
                                    text: "Show _MENU_"
                                }
                            },
                            {
                                buttons: [
                                    {
                                        text: '<i class="icon-base tabler icon-tabler-eye icon-xs me-0 me-sm-2"></i> <span class="d-none d-sm-inline-block">View Self Report</span>',
                                        className: "btn",
                                        action: function () {
                                            window.open('<?php echo e(asset('admin/assets/img/pdf/ReportFormat.pdf')); ?>', '_blank');
                                        }
                                    }
                                ]
                            }
                        ]
                    }
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/AssessmentPortal/resources/views/admin/self_feedback.blade.php ENDPATH**/ ?>