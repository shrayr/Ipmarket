<?php
/* @var $this SitesController */
/* @var $data Sites */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visits')); ?>:</b>
	<?php echo CHtml::encode($data->visits); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('circle_link')); ?>:</b>
	<?php echo CHtml::encode($data->circle_link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cost_price_type')); ?>:</b>
	<?php echo CHtml::encode($data->cost_price_type); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cost_price_value')); ?>:</b>
	<?php echo CHtml::encode($data->cost_price_value); ?>
	<br />

	*/ ?>

</div>