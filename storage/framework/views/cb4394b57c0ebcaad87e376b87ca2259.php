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
                <div class="card-datatable table-responsive">
                    <table class="table border-top" id="userScoreTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Virtues</th>
                                <th>Score</th>
                                <th>Rank</th>
                                <th>Increase/Decrease</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr>
                               <td>1</td>
                               <td>Responsibility & Accountability</td>
                               <td>65%</td>
                               <td>Aspirant</td>
                               <td><p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                                    <i class="icon-base ti tabler-chevron-up"></i>
                                    6
                                </p></td>
                            </tr>
                              <tr>
                               <td>2</td>
                               <td>Honesty & Integrity</td>
                               <td>40%</td>
                               <td>Initiator</td>
                               <td><p class="text-danger fw-medium mb-0 d-flex align-items-center gap-1">
                                    <i class="icon-base ti tabler-chevron-down"></i>
                                    2
                                </p></td>
                            </tr>
                              <tr>
                               <td>3</td>
                               <td>Empathy & Compassion</td>
                               <td>83%</td>
                               <td>Influencer</td>
                               <td><p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                                    <i class="icon-base ti tabler-chevron-up"></i>
                                    9
                                </p></td>
                            </tr>
                              <tr>
                               <td>4</td>
                               <td>Humility & Service</td>
                               <td>90%</td>
                               <td>Role Model</td>
                               <td><p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                                    <i class="icon-base ti tabler-chevron-up"></i>
                                    18
                                </p></td>
                            </tr>
                              <tr>
                               <td>5</td>
                               <td>Patience & Gratitude</td>
                               <td>59%</td>
                               <td>Initiator</td>
                               <td><p class="text-danger fw-medium mb-0 d-flex align-items-center gap-1">
                                    <i class="icon-base ti tabler-chevron-down"></i>
                                    8
                                </p></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Permission Table -->
            <br>
            <!-- Permission Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table border-top" id="userScoreTable1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Virtues</th>
                                <th>Score</th>
                                <th>Rank</th>
                                <th>Increase/Decrease</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr>
                               <td>1</td>
                               <td>Responsibility & Accountability</td>
                               <td>59%</td>
                               <td>Initiator</td>
                               <td><p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                                    <i class="icon-base ti tabler-chevron-up"></i>
                                    9
                                </p></td>
                            </tr>
                              <tr>
                               <td>2</td>
                               <td>Honesty & Integrity</td>
                               <td>65%</td>
                               <td>Aspirant</td>
                               <td><p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                                    <i class="icon-base ti tabler-chevron-up"></i>
                                    18
                                </p></td>
                            </tr>
                              <tr>
                               <td>3</td>
                               <td>Empathy & Compassion</td>
                               <td>40%</td>
                               <td>Initiator</td>
                               <td><p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                                    <i class="icon-base ti tabler-chevron-up"></i>
                                    6
                                </p></td>
                            </tr>
                              <tr>
                               <td>4</td>
                               <td>Humility & Service</td>
                               <td>83%</td>
                               <td>Influencer</td>
                               <td><p class="text-danger fw-medium mb-0 d-flex align-items-center gap-1">
                                    <i class="icon-base ti tabler-chevron-down"></i>
                                    2
                                </p></td>
                            </tr>
                              <tr>
                               <td>5</td>
                               <td>Patience & Gratitude</td>
                               <td>90%</td>
                               <td>Role Model</td>
                               <td><p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                                    <i class="icon-base ti tabler-chevron-up"></i>
                                    9
                                </p></td>
                            </tr>
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
                                    text: "Attempt 3"
                                }
                            },
                            {
                                buttons: [
                                    {
                                        text: '<i class="icon-base tabler icon-tabler-eye icon-xs me-0 me-sm-2"></i> <span class="d-none d-sm-inline-block">Latest Report</span>',
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
             $('#userScoreTable1').DataTable({
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
                                    text: "Attempt 2"
                                }
                            }
                        ]
                    }
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ipza8kynww9c/public_html/assessment.digitaldiraction.com/resources/views/admin/self_feedback.blade.php ENDPATH**/ ?>