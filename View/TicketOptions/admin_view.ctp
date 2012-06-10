<div class="ticketOptions view">
<h2><?php  echo __('Ticket Option');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ticketOption['TicketOption']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event'); ?></dt>
		<dd>
			<?php echo $this->Html->link($ticketOption['Event']['name'], array('controller' => 'events', 'action' => 'view', $ticketOption['Event']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Label'); ?></dt>
		<dd>
			<?php echo h($ticketOption['TicketOption']['label']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ticket Count'); ?></dt>
		<dd>
			<?php echo h($ticketOption['TicketOption']['ticket_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Available'); ?></dt>
		<dd>
			<?php echo h($ticketOption['TicketOption']['available']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($ticketOption['TicketOption']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Refundable'); ?></dt>
		<dd>
			<?php echo h($ticketOption['TicketOption']['refundable']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sale Start'); ?></dt>
		<dd>
			<?php echo h($ticketOption['TicketOption']['sale_start']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sale End'); ?></dt>
		<dd>
			<?php echo h($ticketOption['TicketOption']['sale_end']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($ticketOption['TicketOption']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($ticketOption['TicketOption']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php
$this->start('sidebar');
?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ticket Option'), array('action' => 'edit', $ticketOption['TicketOption']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Ticket Option'), array('action' => 'delete', $ticketOption['TicketOption']['id']), null, __('Are you sure you want to delete # %s?', $ticketOption['TicketOption']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ticket Options'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ticket Option'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tickets'), array('controller' => 'tickets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ticket'), array('controller' => 'tickets', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
<div class="related">
	<h3><?php echo __('Related Tickets');?></h3>
	<?php if (!empty($ticketOption['Ticket'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Ticket Option Id'); ?></th>
		<th><?php echo __('Badge Name'); ?></th>
		<th><?php echo __('Organization'); ?></th>
		<th><?php echo __('Paid'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($ticketOption['Ticket'] as $ticket): ?>
		<tr>
			<td><?php echo $ticket['id'];?></td>
			<td><?php echo $ticket['user_id'];?></td>
			<td><?php echo $ticket['ticket_option_id'];?></td>
			<td><?php echo $ticket['badge_name'];?></td>
			<td><?php echo $ticket['organization'];?></td>
			<td><?php echo $ticket['paid'];?></td>
			<td><?php echo $ticket['created'];?></td>
			<td><?php echo $ticket['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'tickets', 'action' => 'view', $ticket['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'tickets', 'action' => 'edit', $ticket['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'tickets', 'action' => 'delete', $ticket['id']), null, __('Are you sure you want to delete # %s?', $ticket['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Ticket'), array('controller' => 'tickets', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
