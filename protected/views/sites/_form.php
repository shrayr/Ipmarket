<?php
/* @var $this SitesController */
/* @var $model Sites */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sites-form',
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
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'visits'); ?>
		<?php echo $form->textField($model,'visits',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'visits'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'circle_link'); ?>
		<?php echo $form->textField($model,'circle_link',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'circle_link'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cost_price_type'); ?>
		<?php echo $form->dropDownList($model,'cost_price_type',array('sell'=>'Sell %','price'=>'Price %','fixed'=>'Fixed price')); ?>
		<?php echo $form->error($model,'cost_price_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cost_price_value'); ?>
		<?php echo $form->textField($model,'cost_price_value'); ?>
		<?php echo $form->error($model,'cost_price_value'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->