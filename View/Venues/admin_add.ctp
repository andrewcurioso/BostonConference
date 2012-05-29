<div class="venues form">
<?php echo $this->Form->create('Venue');?>
	<fieldset>
		<legend><?php echo __('Admin Add Venue'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('website');
		echo $this->Form->input('address');
		echo $this->Form->input('transportation_instructions');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<?php
$this->append('sidebar');
?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Venues'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
