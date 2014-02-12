<?php
/* @var $this ProductController */
/* @var $data Product */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_amd')); ?>:</b>
	<?php echo CHtml::encode($data->price_amd); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('price_rur')); ?>:</b>
    <?php echo CHtml::encode($data->price_rur); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('price_usd')); ?>:</b>
    <?php echo CHtml::encode($data->price_usd); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cost_price')); ?>:</b>
	<?php echo CHtml::encode($data->cost_price); ?>
	<br />


</div>