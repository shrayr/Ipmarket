<?php
/* @var $this BannerController */
/* @var $data Banner */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_id')); ?>:</b>
	<?php echo CHtml::encode($data->site_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('size')); ?>:</b>
	<?php echo CHtml::encode($data->size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo')); ?>:</b>
	<?php echo CHtml::encode($data->photo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_amd')); ?>:</b>
	<?php echo CHtml::encode($data->price_amd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_us')); ?>:</b>
	<?php echo CHtml::encode($data->price_us); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('price_rur')); ?>:</b>
	<?php echo CHtml::encode($data->price_rur); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('duration')); ?>:</b>
	<?php echo CHtml::encode($data->duration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('placement')); ?>:</b>
	<?php echo CHtml::encode($data->placement); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('placement_type')); ?>:</b>
	<?php echo CHtml::encode($data->placement_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_type')); ?>:</b>
	<?php echo CHtml::encode($data->price_type); ?>
	<br />

	*/ ?>

</div>