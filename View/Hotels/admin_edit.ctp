<div class="hotels form">
<?php echo $this->Form->create('Hotel');?>
	<fieldset>
		<legend><?php echo __('Admin Edit Hotel'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('website');
		echo $this->Form->input('address');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Hotel.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Hotel.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Hotels'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Event Hotels'), array('controller' => 'event_hotels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event Hotel'), array('controller' => 'event_hotels', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
