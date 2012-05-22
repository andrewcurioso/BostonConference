<div class="eventHotels form">
<?php echo $this->Form->create('EventHotel');?>
	<fieldset>
		<legend><?php echo __('Admin Add Event Hotel'); ?></legend>
	<?php
		echo $this->Form->input('event_id');
		echo $this->Form->input('hotel_id');
		echo $this->Form->input('group_rate');
		echo $this->Form->input('group_rate_instructions');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<?php
$this->start('sidebar');
?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Event Hotels'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Hotels'), array('controller' => 'hotels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Hotel'), array('controller' => 'hotels', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
