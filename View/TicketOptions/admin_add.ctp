<div class="ticketOptions form">
<?php echo $this->Form->create('TicketOption');?>
	<fieldset>
		<legend><?php echo __('Admin Add Ticket Option'); ?></legend>
	<?php
		echo $this->Form->input('event_id');
		echo $this->Form->input('label');
		echo $this->Form->input('available');
		echo $this->Form->input('price');
		echo $this->Form->input('refundable');
		echo $this->Form->input('sale_start',array('empty'=>true));
		echo $this->Form->input('sale_end',array('empty'=>true));
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

		<li><?php echo $this->Html->link(__('List Ticket Options'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tickets'), array('controller' => 'tickets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ticket'), array('controller' => 'tickets', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
