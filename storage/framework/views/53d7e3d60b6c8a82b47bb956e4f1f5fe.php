
<?php $__env->startPush('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('admin/assets/vendor/libs/chartjs/chartjs.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
    <!-- Bar Charts -->
    
    <!-- /Bar Charts -->

    <!-- Horizontal Bar Charts -->
    
    <!-- /Horizontal Bar Charts -->

    <!-- Line Charts -->
    
    <!-- /Line Charts -->

    <!-- Radar Chart -->
    <div class="col-12 mb-6">
      <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">Radar Chart</h5>
      </div>
      <div class="card-body pt-2">
        <canvas class="chartjs" id="radarChart" data-height="355"></canvas>
      </div>
      </div>
    </div>
    <!-- /Radar Chart -->

    <!-- Polar Area Chart -->
    
    <!-- /Polar Area Chart -->

    <!-- Bubble Chart -->
    
    <!-- /Bubble Chart -->

    <!-- Line Area Charts -->
    
    <!-- /Line Area Charts -->

    <!-- Doughnut Chart -->
    
    <!-- /Doughnut Chart -->

    <!-- Scatter Chart -->
    
    <!-- /Scatter Chart -->
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
  <script>
    const chartLabels = <?php echo json_encode($labels, 15, 512) ?>;
    const dataset1 = <?php echo json_encode($dataset1, 15, 512) ?>;
    const dataset2 = <?php echo json_encode($dataset2, 15, 512) ?>;
</script>
  <script src="<?php echo e(asset('admin/assets/vendor/libs/chartjs/chartjs.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/assets/js/charts-chartjs-legend.js')); ?>"></script>
  <script src="<?php echo e(asset('admin/assets/js/charts-chartjs.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/AssessmentPortal/resources/views/admin/chart.blade.php ENDPATH**/ ?>