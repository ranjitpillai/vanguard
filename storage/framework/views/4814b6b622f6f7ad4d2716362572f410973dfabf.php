<div class="panel panel-default">
    <div class="panel-heading"><?php echo app('translator')->getFromJson('app.company_logo'); ?></div>
    <div class="panel-body avatar-wrapper">
        <div class="spinner">
            <div class="spinner-dot"></div>
            <div class="spinner-dot"></div>
            <div class="spinner-dot"></div>
        </div>
        <input type="hidden" name="page" value="<?php echo e($profile ? 'profile' : 'edit'); ?>">
        <div id="avatar"></div>
        <div>
            <img class="avatar avatar-preview img-circle" src="<?php echo e($edit ? url('upload/companies/'.$company->avatar) : url('assets/img/profile.png')); ?>">
            <div id="change-picture" class="btn btn-default btn-block" data-toggle="modal" data-target="#choose-modal">
                <i class="fa fa-camera"></i>
                <?php echo app('translator')->getFromJson('app.change_photo'); ?>
            </div>
            <div class="row avatar-controls">
                <div class="col-md-6">
                    <div id="cancel-upload" style="text-align: center;" class="btn btn-block btn-danger">
                        <i class="fa fa-times"></i> <?php echo app('translator')->getFromJson('app.cancel'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="submit" id="save-photo" style="text-align: center;" class="btn btn-success btn-block">
                        <i class="fa fa-check"></i> <?php echo app('translator')->getFromJson('app.save'); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="choose-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 avatar-source" id="no-photo"
                         data-url="<?php echo e($updateUrl); ?>">
                        <img src="<?php echo e(url('assets/img/profile.png')); ?>" class="img-circle">
                        <p><?php echo app('translator')->getFromJson('app.no_photo'); ?></p>
                    </div>
                    <div class="col-md-4 avatar-source">
                        <div class="btn btn-default btn-upload">
                            <i class="fa fa-upload"></i>
                            <input type="file" name="avatar" id="avatar-upload">
                        </div>
                        <p><?php echo app('translator')->getFromJson('app.upload_photo'); ?></p>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div style="display: none;">
    <input type="hidden" name="points[x1]" id="points_x1">
    <input type="hidden" name="points[y1]" id="points_y1">
    <input type="hidden" name="points[x2]" id="points_x2">
    <input type="hidden" name="points[y2]" id="points_y2">
</div>
