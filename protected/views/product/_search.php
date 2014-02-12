<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price_amd'); ?>
		<?php echo $form->textField($model,'price_amd'); ?>
	</div>

    <div class="row">
        <?php echo $form->label($model,'price_rur'); ?>
        <?php echo $form->textField($model,'price_rur'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'price_usd'); ?>
        <?php echo $form->textField($model,'price_usd'); ?>
    </div>

	<div class="row">
		<?php echo $form->label($model,'cost_price'); ?>
		<?php echo $form->textField($model,'cost_price'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->