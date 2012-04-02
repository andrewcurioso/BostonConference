<div class="sponsors form">
<?php echo $this->Form->create('Sponsor');?>
	<fieldset>
		<legend><?php echo __('Admin Add Sponsor'); ?></legend>
	<?php
		echo $this->Form->input('organization');
		echo $this->Form->input('website');
		echo $this->Form->input('logo_url');
		echo $this->Form->input('sponsorship_level_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Sponsors'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Sponsorship Levels'), array('controller' => 'sponsorship_levels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sponsorship Level'), array('controller' => 'sponsorship_levels', 'action' => 'add')); ?> </li>
	</ul>
</div>
