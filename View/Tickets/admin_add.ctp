<div class="tickets form">
<?php echo $this->Form->create('Ticket');?>
	<fieldset>
		<legend><?php echo __('Admin Add Ticket'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('ticket_option_id');
		echo $this->Form->input('badge_name');
		echo $this->Form->input('organization');
		echo $this->Form->input('paid');
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

		<li><?php echo $this->Html->link(__('List Tickets'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Ticket Options'), array('controller' => 'ticket_options', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ticket Option'), array('controller' => 'ticket_options', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
