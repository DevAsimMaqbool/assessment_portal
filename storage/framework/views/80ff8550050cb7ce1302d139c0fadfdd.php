
<?php $__env->startPush('style'); ?>

  <link rel="stylesheet" href="<?php echo e(asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')); ?>" />
  <link rel="stylesheet"
    href="<?php echo e(asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')); ?>" />
  <link rel="stylesheet" href="<?php echo e(asset('admin/assets/vendor/css/pages/page-profile.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row">
    <!-- View sales -->
    <div class="col-xl-4">
      <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-7">
        <div class="card-body text-nowrap">
          <h5 class="card-title mb-0">Welcom <?php echo e(Auth::user()->name); ?></h5>
          <!-- <p class="mb-2">Best seller of the month</p> -->
          <h4 class="text-primary mb-1">81.00%</h4>
          <a href="javascript:;" class="btn btn-primary">View Report</a>
        </div>
        </div>
        <div class="col-5 text-center text-sm-left">
        <div class="card-body pb-0 px-0 px-md-4">
          <img src="<?php echo e(asset('admin/assets/img/illustrations/card-advance-sale.png')); ?>" height="140"
          alt="view sales" />
        </div>
        </div>
      </div>
      </div>
    </div>
    <!-- View sales -->

    <!-- Statistics -->
    <div class="col-xl-8 col-md-12">
      <div class="card h-100">
      <div class="card-header d-flex justify-content-between">
        <h5 class="card-title mb-0">Statistics</h5>
        <small class="text-body-secondary">Updated 1 month ago</small>
      </div>
      <div class="card-body d-flex align-items-end">
        <div class="w-100">
        <div class="row gy-3">
          <div class="col-md-3 col-6">
          <div class="d-flex align-items-center">
            <div class="badge rounded bg-label-primary me-4 p-2"><i
              class="icon-base ti tabler-chart-pie-2 icon-lg"></i></div>
            <div class="card-info">
            <h5 class="mb-0">3</h5>
            <small>Self Feedback</small>
            </div>
          </div>
          </div>
          <div class="col-md-3 col-6">
          <div class="d-flex align-items-center">
            <div class="badge rounded bg-label-info me-4 p-2"><i class="icon-base ti tabler-users icon-lg"></i>
            </div>
            <div class="card-info">
            <h5 class="mb-0">12</h5>
            <small>Stakeholder Feedback</small>
            </div>
          </div>
          </div>
          <div class="col-md-3 col-6">
          <div class="d-flex align-items-center">
            <div class="badge rounded bg-label-danger me-4 p-2"><i
              class="icon-base ti tabler-shopping-cart icon-lg"></i></div>
            <div class="card-info">
            <h5 class="mb-0">15</h5>
            <small>Team Members</small>
            </div>
          </div>
          </div>
          <div class="col-md-3 col-6">
          <div class="d-flex align-items-center">
            <div class="badge rounded bg-label-success me-4 p-2"><i
              class="icon-base ti tabler-currency-dollar icon-lg"></i></div>
            <div class="card-info">
            <h5 class="mb-0">3</h5>
            <small>Other</small>
            </div>
          </div>
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    <!--/ Statistics -->
    <!-- <div class="col-12">
    <div class="card mb-6">
    <div class="user-profile-header-banner">
    <img src="<?php echo e(asset('admin/assets/img/pages/profile-banner.png')); ?>" alt="Banner image" class="rounded-top" />
    </div>
    <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-5">
    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
    <img src="<?php echo e(asset('admin/assets/img/avatars/1.png')); ?>"
    class="d-block h-auto ms-0 ms-sm-6 rounded user-profile-img" />
    </div>
    <div class="flex-grow-1 mt-3 mt-lg-5">
    <div
    class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
    <div class="user-profile-info">
    <h4 class="mb-2 mt-lg-6"></h4>
    <ul
    class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 my-2">
    <li class="list-inline-item d-flex gap-2 align-items-center"><i
    class="icon-base ti tabler-palette icon-lg"></i><span
    class="fw-medium"><?php echo e(Auth::user()->level); ?></span></li>
    </ul>
    </div>
    <a href="javascript:void(0)" class="btn btn-primary mb-1"> <i
    class="icon-base ti tabler-user-check icon-xs me-2"></i>Connected </a>
    </div>
    </div>
    </div>
    </div>
    </div> -->
    </div>
    <!--/ Header -->

    <!-- User Profile Content -->
    <!-- <div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5"> -->
    <!-- About User -->
    <!-- <div class="card mb-6">
    <div class="card-body">
    <p class="card-text text-uppercase text-body-secondary small mb-0">About</p>
    <ul class="list-unstyled my-3 py-1">
    <li class="d-flex align-items-center mb-4"><i class="icon-base ti tabler-user icon-lg"></i><span
    class="fw-medium mx-2">Full Name:</span> <span><?php echo e(Auth::user()->name); ?></span></li>
    <li class="d-flex align-items-center mb-4"><i class="icon-base ti tabler-check icon-lg"></i><span
    class="fw-medium mx-2">Status:</span> <span><?php echo e(Auth::user()->status); ?></span></li>
    <li class="d-flex align-items-center mb-4"><i class="icon-base ti tabler-crown icon-lg"></i><span
    class="fw-medium mx-2">Role:</span> <span><?php echo e(Auth::user()->level); ?></span></li>
    </ul>
    <p class="card-text text-uppercase text-body-secondary small mb-0">Contacts</p>
    <ul class="list-unstyled my-3 py-1">
    <li class="d-flex align-items-center mb-4">
    <i class="icon-base ti tabler-phone-call icon-lg"></i><span class="fw-medium mx-2">Contact:</span>
    <span>(123) 456-7890</span>
    </li>
    <li class="d-flex align-items-center mb-4">
    <i class="icon-base ti tabler-mail icon-lg"></i><span class="fw-medium mx-2">Email:</span>
    <span><?php echo e(Auth::user()->email); ?></span>
    </li>
    </ul>

    </div>
    </div> -->
    <!--/ About User -->
    <!-- </div>
    </div> -->
    <!--/ User Profile Content -->
    <!-- </div> -->
    <!-- Topic and Instructors -->
    <br>
    <div class="row mb-6 g-6">
    <div class="col-12 col-xl-8">
      <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">My Virtues</h5>
        <div class="dropdown">
        <button class="btn p-0" type="button" id="topic" data-bs-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">
          <i class="icon-base ti tabler-dots-vertical icon-22px text-body-secondary"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="topic">
          <a class="dropdown-item" href="javascript:void(0);">Highest Views</a>
          <a class="dropdown-item" href="javascript:void(0);">See All</a>
        </div>
        </div>
      </div>
      <div class="card-body row g-3">
        <div class="col-md-8">
        <div id="horizontalBarChart"></div>
        </div>
        <div class="col-md-4 d-flex justify-content-around align-items-center">
        <div>
          <div class="d-flex align-items-baseline">
          <span class="text-primary me-2"><i class="icon-base ti tabler-circle-filled icon-12px"></i></span>
          <div>
            <p class="mb-0">Responsibility and Accountability</p>
            <h5>35%</h5>
          </div>
          </div>
          <div class="d-flex align-items-baseline my-12">
          <span class="text-success me-2"><i class="icon-base ti tabler-circle-filled icon-12px"></i></span>
          <div>
            <p class="mb-0">Honesty and Integrity</p>
            <h5>14%</h5>
          </div>
          </div>
          <div class="d-flex align-items-baseline">
          <span class="text-danger me-2"><i class="icon-base ti tabler-circle-filled icon-12px"></i></span>
          <div>
            <p class="mb-0">Empathy and Compassion</p>
            <h5>10%</h5>
          </div>
          </div>
        </div>

        <div>
          <div class="d-flex align-items-baseline">
          <span class="text-info me-2"><i class="icon-base ti tabler-circle-filled icon-12px"></i></span>
          <div>
            <p class="mb-0">Humility and Service</p>
            <h5>20%</h5>
          </div>
          </div>
          <div class="d-flex align-items-baseline my-12">
          <span class="text-secondary me-2"><i class="icon-base ti tabler-circle-filled icon-12px"></i></span>
          <div>
            <p class="mb-0">Patience and Gratitude</p>
            <h5>12%</h5>
          </div>
          </div>
          <div class="d-flex align-items-baseline">
          <span class="text-warning me-2"><i class="icon-base ti tabler-circle-filled icon-12px"></i></span>
          <div>
            <p class="mb-0">Courage and Drive</p>
            <h5>9%</h5>
          </div>
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>

    <div class="col-12 col-xl-4 col-md-6">
      <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <div class="card-title mb-0">
        <h5 class="m-0 me-2">Popular Instructors</h5>
        </div>
        <div class="dropdown">
        <button class="btn text-body-secondary p-0" type="button" id="popularInstructors" data-bs-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="icon-base ti tabler-dots-vertical icon-22px"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="popularInstructors">
          <a class="dropdown-item" href="javascript:void(0);">Select All</a>
          <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
          <a class="dropdown-item" href="javascript:void(0);">Share</a>
        </div>
        </div>
      </div>
      <div class="px-5 py-4 border border-start-0 border-end-0">
        <div class="d-flex justify-content-between align-items-center">
        <p class="mb-0 text-uppercase">Virtue</p>
        <p class="mb-0 text-uppercase">budies</p>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-6">
        <div class="d-flex align-items-center">
          <div class="avatar avatar me-4">
          <img src="<?php echo e(asset('admin/assets/img/avatars/1.png')); ?>" alt="Avatar" class="rounded-circle" />
          </div>
          <div>
          <div>
            <h6 class="mb-0 text-truncate">Asim</h6>
            <small class="text-truncate text-body">Business</small>
          </div>
          </div>
        </div>
        <div class="text-end">
          <h6 class="mb-0">33</h6>
        </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-6">
        <div class="d-flex align-items-center">
          <div class="avatar avatar me-4">
          <img src="<?php echo e(asset('admin/assets/img/avatars/3.png')); ?>" alt="Avatar" class="rounded-circle" />
          </div>
          <div>
          <div>
            <h6 class="mb-0 text-truncate">Ahmad</h6>
            <small class="text-truncate text-body">Digital Marketing</small>
          </div>
          </div>
        </div>
        <div class="text-end">
          <h6 class="mb-0">52</h6>
        </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-6">
        <div class="d-flex align-items-center">
          <div class="avatar avatar me-4">
          <img src="<?php echo e(asset('admin/assets/img/avatars/3.png')); ?>" alt="Avatar" class="rounded-circle" />
          </div>
          <div>
          <div>
            <h6 class="mb-0 text-truncate">Abdul Wahab</h6>
            <small class="text-truncate text-body">UI/UX Design</small>
          </div>
          </div>
        </div>
        <div class="text-end">
          <h6 class="mb-0">12</h6>
        </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
          <div class="avatar avatar me-4">
          <img src="<?php echo e(asset('admin/assets/img/avatars/4.png')); ?>" alt="Avatar" class="rounded-circle" />
          </div>
          <div>
          <div>
            <h6 class="mb-0 text-truncate">Dania Khan</h6>
            <small class="text-truncate text-body">React Js</small>
          </div>
          </div>
        </div>
        <div class="text-end">
          <h6 class="mb-0">8</h6>
        </div>
        </div>
      </div>
      </div>
    </div>

    </div>
  </div>
  <!--  Topic and Instructors  End-->
  <!-- / Content -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
  <script src="<?php echo e(asset('admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/assets/js/app-user-view-account.js')); ?>"></script>
  <!-- Vendors JS -->
  <script src="<?php echo e(asset('admin/assets/vendor/libs/moment/moment.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/assets/vendor/libs/apex-charts/apexcharts.js')); ?>"></script>
  <!-- Page JS -->
  <script src="<?php echo e(asset('admin/assets/js/app-academy-dashboard.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/AssessmentPortal/resources/views/admin/dashbord.blade.php ENDPATH**/ ?>