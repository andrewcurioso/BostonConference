<div class="sponsorshipLevels form">
<?php echo $this->Form->create('SponsorshipLevel');?>
	<fieldset>
		<legend><?php echo __('Admin Edit Sponsorship Level'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('label');
		echo $this->Form->input('event_id');
		echo $this->Form->input('position');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SponsorshipLevel.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SponsorshipLevel.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Levels'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sponsors'), array('controller' => 'sponsors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sponsor'), array('controller' => 'sponsors', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
