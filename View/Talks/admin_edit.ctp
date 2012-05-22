<div class="talks form">
<?php echo $this->Form->create('Talk');?>
	<fieldset>
		<legend><?php echo __('Admin Edit Talk'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('event_id');
		echo $this->Form->input('speaker_id');
		echo $this->Form->input('topic');
		echo $this->Form->input('abstract');
		echo $this->Form->input('start_time',array('empty' => true));
		echo $this->Form->input('end_time',array('empty' => true));
		echo $this->Form->input('approved');
		echo $this->Form->input('track_id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Talk.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Talk.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Talks'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Speakers'), array('controller' => 'speakers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Speaker'), array('controller' => 'speakers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tracks'), array('controller' => 'tracks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Track'), array('controller' => 'tracks', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
