<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price_amd'); ?>
		<?php echo $form->textField($model,'price_amd'); ?>
		<?php echo $form->error($model,'price_amd'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'price_rur'); ?>
		<?php echo $form->textField($model,'price_rur'); ?>
		<?php echo $form->error($model,'price_rur'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'price_usd'); ?>
		<?php echo $form->textField($model,'price_usd'); ?>
		<?php echo $form->error($model,'price_usd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cost_price'); ?>
		<?php echo $form->textField($model,'cost_price'); ?>
		<?php echo $form->error($model,'cost_price'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->