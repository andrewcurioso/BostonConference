<div class="hotels form">
<?php echo $this->Form->create('Hotel');?>
	<fieldset>
		<legend><?php echo __('Admin Add Hotel'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('website');
		echo $this->Form->input('address');
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

		<li><?php echo $this->Html->link(__('List Hotels'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Event Hotels'), array('controller' => 'event_hotels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event Hotel'), array('controller' => 'event_hotels', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
