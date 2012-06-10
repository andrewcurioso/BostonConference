<div class="ticketOptions index">
	<h2><?php echo __('Ticket Options');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('label');?></th>
			<th><?php echo $this->Paginator->sort('ticket_count');?></th>
			<th><?php echo $this->Paginator->sort('available');?></th>
			<th><?php echo $this->Paginator->sort('price');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($ticketOptions as $ticketOption): ?>
	<tr>
		<td><?php echo h($ticketOption['TicketOption']['label']); ?>&nbsp;</td>
		<td><?php echo h($ticketOption['TicketOption']['ticket_count']); ?>&nbsp;</td>
		<td><?php echo h($ticketOption['TicketOption']['available']); ?>&nbsp;</td>
		<td><?php echo h($ticketOption['TicketOption']['price']); ?>&nbsp;</td>
		<td><?php echo h($ticketOption['TicketOption']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $ticketOption['TicketOption']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $ticketOption['TicketOption']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ticketOption['TicketOption']['id']), null, __('Are you sure you want to delete # %s?', $ticketOption['TicketOption']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<?php
$this->start('sidebar');
?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Ticket Option'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tickets'), array('controller' => 'tickets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ticket'), array('controller' => 'tickets', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
