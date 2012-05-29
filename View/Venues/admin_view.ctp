<div class="venues view">
<h2><?php  echo __('Venue');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($venue['Venue']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($venue['Venue']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Website'); ?></dt>
		<dd>
			<?php echo h($venue['Venue']['website']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($venue['Venue']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transportation Instructions'); ?></dt>
		<dd>
			<?php echo h($venue['Venue']['transportation_instructions']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($venue['Venue']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($venue['Venue']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php
$this->append('sidebar');
?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Venue'), array('action' => 'edit', $venue['Venue']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Venue'), array('action' => 'delete', $venue['Venue']['id']), null, __('Are you sure you want to delete # %s?', $venue['Venue']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Venues'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Venue'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
<div class="related">
	<h3><?php echo __('Related Events');?></h3>
	<?php if (!empty($venue['Event'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Venue Id'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($venue['Event'] as $event): ?>
		<tr>
			<td><?php echo $event['id'];?></td>
			<td><?php echo $event['name'];?></td>
			<td><?php echo $event['description'];?></td>
			<td><?php echo $event['created'];?></td>
			<td><?php echo $event['modified'];?></td>
			<td><?php echo $event['venue_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'events', 'action' => 'view', $event['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'events', 'action' => 'edit', $event['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'events', 'action' => 'delete', $event['id']), null, __('Are you sure you want to delete # %s?', $event['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
