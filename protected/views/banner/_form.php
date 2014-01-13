<?php
/* @var $this BannerController */
/* @var $model Banner */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'banner-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'site_id'); ?>
		<?php echo $form->dropDownList($model,'site_id',CHtml::listData(Sites::model()->findAll(), 'id', 'name'), array('empty'=>'select Type')); ?>
		<?php echo $form->error($model,'site_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('maxlength'=>255,)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'size'); ?>
		<?php echo $form->textField($model,'size',array('maxlength'=>45)); ?>
		<?php echo $form->error($model,'size'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photo'); ?>
		<?php echo $form->fileField($model,'photo'); ?>
		<?php echo $form->error($model,'photo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price_amd'); ?>
		<?php echo $form->textField($model,'price_amd'); ?>
		<?php echo $form->error($model,'price_amd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price_us'); ?>
		<?php echo $form->textField($model,'price_us'); ?>
		<?php echo $form->error($model,'price_us'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price_rur'); ?>
		<?php echo $form->textField($model,'price_rur'); ?>
		<?php echo $form->error($model,'price_rur'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ctr'); ?>
		<?php echo $form->textField($model,'ctr'); ?>
		<?php echo $form->error($model,'ctr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'duration'); ?>
		<?php echo $form->textField($model,'duration',array('maxlength'=>45)); ?>
		<?php echo $form->error($model,'duration'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'placement'); ?>
        <?php echo $form->dropDownList($model,'placement',CHtml::listData(Placement::model()->findAll(), 'name', 'name'), array('empty'=>'Select Type')); ?>
        <?php echo $form->error($model,'placement'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
        <?php echo $form->dropDownList($model,'type',CHtml::listData(MediaType::model()->findAll(), 'name', 'name'), array('empty'=>'Select Type')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->