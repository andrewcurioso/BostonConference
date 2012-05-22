<div class="speakers form">
<?php echo $this->Form->create('Speaker');?>
	<fieldset>
		<legend><?php echo __('Admin Edit Speaker'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id',array('empty' => true));
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('bio');
		echo $this->Form->input('website');
		echo $this->Form->input('featured');
		echo $this->Form->input('portrait_url');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Speaker.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Speaker.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Speakers'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Talks'), array('controller' => 'talks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Talk'), array('controller' => 'talks', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
