<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('admin/assets/vendor/libs/bs-stepper/bs-stepper.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('admin/assets/vendor/libs/bootstrap-select/bootstrap-select.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('admin/assets/vendor/libs/select2/select2.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('admin/assets/vendor/libs/%40form-validation/form-validation.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="col-12 d-flex justify-content-between">
                    <!-- <a href="<?php echo e(route('questions')); ?>"><button type="button" class="btn btn-primary btn-next">
                        <span class="align-middle d-sm-inline-block d-none me-sm-2">Self</span>

                    </button></a> -->

                        <div class="mb-6 ecommerce-select2-dropdown">
                            <select class="select2 form-select" id="stakeholderSelect" name="stakeholder">
                                <option disabled <?php echo e(!isset($UserIDUserID) ? 'selected' : ''); ?>>Select</option>
                                <?php $__currentLoopData = $userTree; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>" <?php echo e(isset($UserID) && $UserID == $user->id ? 'selected' : ''); ?>>
                                        <?php echo e($user->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                </div>
            </div></br></br>

            <!-- Default Wizard -->
            <div class="col-12 mb-6">

                <div class="bs-stepper wizard-numbered mt-2">
                    <div class="bs-stepper-header">
                        <?php if(isset($questions)): ?>
                            <?php if($questions->isNotEmpty()): ?>
                                    <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="step" data-target="#step<?php echo e($index + 1); ?>" style="display: none;">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-circle"><?php echo e($index + 1); ?></span>
                                                <span class="bs-stepper-label">
                                                    <span class="bs-stepper-title"><?php echo e($question->question); ?></span>
                                                    <span class="bs-stepper-subtitle">Please select an answer</span>
                                                </span>
                                            </button>
                                        </div>
                                        <?php if(!$loop->last): ?>
                                            <div class="line" style="display: none;">
                                                <i class="icon-base ti tabler-chevron-right"></i>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="bs-stepper-content">
                        <form method="POST" action="<?php echo e(route('survey.submit')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="for_user_id" id="forUserIdHidden" value="<?php echo e($UserID); ?>">
                        <input type="hidden" name="survey_id" id="forUserIdHidden" value="1">
                        <?php if(isset($questions)): ?>
                            <?php if($questions->isNotEmpty()): ?>
                                <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div id="step<?php echo e($index + 1); ?>" class="content">
                                        <div class="content-header mb-4">
                                            <h6 class="mb-0"><?php echo e($index + 1); ?>- <?php echo e($question->question); ?></h6>
                                        </div>

                                        <div class="row g-6">
                                            <?php $__currentLoopData = $question->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-sm-6">
                                                    <div class="form-check mb-4">
                                                        <input class="form-check-input" type="radio" name="answer[<?php echo e($question->id); ?>]"
                                                            id="answer_<?php echo e($question->id); ?>_<?php echo e($answer->id); ?>" value="<?php echo e($answer->answer_value); ?>"
                                                            data-ans_id="<?php echo e($question->id); ?>" data-ans_val="<?php echo e($answer->answer_value); ?>">
                                                        <label class="form-check-label" for="answer_<?php echo e($question->id); ?>_<?php echo e($answer->id); ?>">
                                                            <span class="mb-1 h6"><?php echo e($answer->answer_title); ?></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <div class="col-12 d-flex justify-content-between">
                                                <button type="button" class="btn btn-label-secondary btn-prev">
                                                    <i class="icon-base ti tabler-arrow-left icon-xs me-sm-2 me-0"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                <?php if($loop->last): ?>
                                                    <button type="submit" class="btn btn-success btn-submit">
                                                        <span class="align-middle d-sm-inline-block d-none me-sm-2">Submit</span>
                                                    </button>
                                                <?php else: ?>
                                                    <button type="button" class="btn btn-primary btn-next">
                                                        <span class="align-middle d-sm-inline-block d-none me-sm-2">Next</span>
                                                        <i class="icon-base ti tabler-arrow-right icon-xs"></i>
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        $('.select2').on('change', function () {
                const selectedUserId = $(this).val();
                $('#forUserIdHidden').val(selectedUserId);
                if (selectedUserId) {
                    window.location.href = `/stakeholder_question/${selectedUserId}`;
                }
            });
    </script>
        <script src="<?php echo e(asset('admin/assets/vendor/libs/bs-stepper/bs-stepper.js')); ?>"></script>
        <script src="<?php echo e(asset('admin/assets/vendor/libs/bootstrap-select/bootstrap-select.js')); ?>"></script>
        <script src="<?php echo e(asset('admin/assets/vendor/libs/select2/select2.js')); ?>"></script>
        <script src="<?php echo e(asset('admin/assets/vendor/libs/%40form-validation/popular.js')); ?>"></script>
        <script src="<?php echo e(asset('admin/assets/vendor/libs/%40form-validation/bootstrap5.js')); ?>"></script>
        <script src="<?php echo e(asset('admin/assets/vendor/libs/%40form-validation/auto-focus.js')); ?>"></script>
        <script src="<?php echo e(asset('admin/assets/js/form-wizard-numbered.js')); ?>"></script>
        <script src="<?php echo e(asset('admin/assets/js/form-wizard-validation.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ipza8kynww9c/public_html/assessment.digitaldiraction.com/resources/views/stakeholder_question.blade.php ENDPATH**/ ?>