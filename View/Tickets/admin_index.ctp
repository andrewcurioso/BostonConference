<div class="tickets index">
	<h2><?php echo __('Tickets');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('ticket_option_id');?></th>
			<th><?php echo $this->Paginator->sort('badge_name');?></th>
			<th><?php echo $this->Paginator->sort('organization');?></th>
			<th><?php echo $this->Paginator->sort('paid');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($tickets as $ticket): ?>
	<tr>
		<td><?php echo h($ticket['Ticket']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($ticket['User']['last_name'], array('controller' => 'users', 'action' => 'view', $ticket['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($ticket['TicketOption']['label'], array('controller' => 'ticket_options', 'action' => 'view', $ticket['TicketOption']['id'])); ?>
		</td>
		<td><?php echo h($ticket['Ticket']['badge_name']); ?>&nbsp;</td>
		<td><?php echo h($ticket['Ticket']['organization']); ?>&nbsp;</td>
		<td><?php echo h($ticket['Ticket']['paid']); ?>&nbsp;</td>
		<td><?php echo h($ticket['Ticket']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $ticket['Ticket']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $ticket['Ticket']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ticket['Ticket']['id']), null, __('Are you sure you want to delete # %s?', $ticket['Ticket']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Ticket'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Ticket Options'), array('controller' => 'ticket_options', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ticket Option'), array('controller' => 'ticket_options', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
