<?php $__env->startPush('style'); ?>

  <link rel="stylesheet" href="<?php echo e(asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')); ?>" />
  <link rel="stylesheet"
    href="<?php echo e(asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')); ?>" />
  <link rel="stylesheet" href="<?php echo e(asset('admin/assets/vendor/css/pages/page-profile.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Navbar pills -->
    <div class="row">
    <div class="col-md-12">
      <div class="nav-align-top">
      <ul class="nav nav-pills flex-column flex-sm-row mb-6 gap-sm-0 gap-2">
        <li class="nav-item">
        <a id="stakeholder_one" class="nav-link active">Vertical Stakeholder</a>
        </li>
        <li class="nav-item">
        <a id="stakeholder_two" class="nav-link active" id="showProfile">Horizontal Stakeholder</a>
        </li>
      </ul>
      </div>
    </div>
    </div>
    <!--/ Navbar pills -->
    <div class="card" id="one_stakeholder">
    <div class="card-datatable table-responsive">
      <table class="table border-top" id="permissionsTable">
      <thead>
        <tr>
        <th>#</th>
        <th>NAME</th>
        <th>Email</th>
        <th>Designation</th>
        <th>Status</th>
        <th>Submission Date</th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $userTree; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
      <td><?php echo e($index + 1); ?></td>
      <td><?php echo e($user->name); ?></td>
      <td><?php echo e($user->email); ?></td>
      <td><?php echo e($user->level); ?></td>
      <td><a href="<?php echo e(route('question.stakeholder', ['UserID' => $user->id])); ?>">Pending</a></td>
      <td>NULL</td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


      </tbody>
      </table>
    </div>
    </div>

    <div class="card d-none" id="two_stakeholder">
    <p style="text-align:center;color:green">Horizontal Stakeholder Data</p>
    <div class="card-datatable table-responsive">
      <table class="table border-top" id="permissionsTable">
      <thead>
        <tr>
        <th>#</th>
        <th>NAME</th>
        <th>Email</th>
        <th>Designation</th>
        <th>Status</th>
        <th>Submission Date</th>
        </tr>
      </thead>
      <tbody>
        <tr>
        <td>1</td>
        <td>Alice Johnson</td>
        <td>alice@example.com</td>
        <td>Manager</td>
        <td>Done</td>
        <td>2025-05-06</td>
        </tr>
      </tbody>
      </table>
    </div>
    </div>
  </div>
  <!-- / Content -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
  <script src="<?php echo e(asset('admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/assets/js/app-user-view-account.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
  <script>
    $(document).ready(function () {

    $('#stakeholder_one').click(function () {
      $('#two_stakeholder').addClass('d-none');
      $('#one_stakeholder').removeClass('d-none');
    });

    $('#stakeholder_two').click(function () {
      $('#one_stakeholder').addClass('d-none');
      $('#two_stakeholder').removeClass('d-none');
    });
    });
  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ipza8kynww9c/public_html/assessment.digitaldiraction.com/resources/views/admin/stakeholder.blade.php ENDPATH**/ ?>