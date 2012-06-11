<?php
$this->append('header')
?>
<div class="talks index">
	<h2><?php echo __('Talks');?></h2>
</div>
<?php
$this->end();
?>
<div class="talks index">
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('speaker_id');?></th>
			<th><?php echo $this->Paginator->sort('topic');?></th>
			<th><?php echo $this->Paginator->sort('start_time');?></th>
			<th><?php echo $this->Paginator->sort('duration');?></th>
			<th><?php echo $this->Paginator->sort('track_id');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($talks as $talk): ?>
	<tr>
		<td><?php echo h($talk['Talk']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($talk['Speaker']['last_name'], array('controller' => 'speakers', 'action' => 'view', $talk['Speaker']['id'])); ?>
		</td>
		<td><?php echo h($talk['Talk']['topic']); ?>&nbsp;</td>
		<td><?php echo h($talk['Talk']['start_time']); ?>&nbsp;</td>
		<td><?php echo h($talk['Talk']['duration']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($talk['Track']['name'], array('controller' => 'tracks', 'action' => 'view', $talk['Track']['id'])); ?>
		</td>
		<td><?php echo h($talk['Talk']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $talk['Talk']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $talk['Talk']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $talk['Talk']['id']), null, __('Are you sure you want to delete # %s?', $talk['Talk']['id'])); ?>
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
$this->append('sidebar');
?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Talk'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Add Multiple Talks'), array('action' => 'add_multiple')); ?></li>
		<li><?php echo $this->Html->link(__('List Speakers'), array('controller' => 'speakers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Speaker'), array('controller' => 'speakers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tracks'), array('controller' => 'tracks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Track'), array('controller' => 'tracks', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
