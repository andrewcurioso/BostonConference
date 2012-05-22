<div class="hotels view">
<h2><?php  echo __('Hotel');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($hotel['Hotel']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($hotel['Hotel']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Website'); ?></dt>
		<dd>
			<?php echo h($hotel['Hotel']['website']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($hotel['Hotel']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($hotel['Hotel']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($hotel['Hotel']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Event Hotels');?></h3>
	<?php if (!empty($hotel['EventHotel'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Event Id'); ?></th>
		<th><?php echo __('Hotel Id'); ?></th>
		<th><?php echo __('Group Rate'); ?></th>
		<th><?php echo __('Group Rate Instructions'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($hotel['EventHotel'] as $eventHotel): ?>
		<tr>
			<td><?php echo $eventHotel['id'];?></td>
			<td><?php echo $eventHotel['event_id'];?></td>
			<td><?php echo $eventHotel['hotel_id'];?></td>
			<td><?php echo $eventHotel['group_rate'];?></td>
			<td><?php echo $eventHotel['group_rate_instructions'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'event_hotels', 'action' => 'view', $eventHotel['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'event_hotels', 'action' => 'edit', $eventHotel['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'event_hotels', 'action' => 'delete', $eventHotel['id']), null, __('Are you sure you want to delete # %s?', $eventHotel['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Event Hotel'), array('controller' => 'event_hotels', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<?php
$this->start('sidebar');
?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Hotel'), array('action' => 'edit', $hotel['Hotel']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Hotel'), array('action' => 'delete', $hotel['Hotel']['id']), null, __('Are you sure you want to delete # %s?', $hotel['Hotel']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Hotels'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Hotel'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Event Hotels'), array('controller' => 'event_hotels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event Hotel'), array('controller' => 'event_hotels', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
