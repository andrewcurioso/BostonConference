<?php
$this->append('header')
?>
<div class="hotels index">
	<h2><?php echo __('Hotels');?></h2>
</div>
<?php
$this->end();
?>
<div class="hotels index">
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($hotels as $hotel): ?>
	<tr>
		<td><?php echo h($hotel['Hotel']['id']); ?>&nbsp;</td>
		<td><?php echo h($hotel['Hotel']['name']); ?>&nbsp;</td>
		<td><?php echo h($hotel['Hotel']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $hotel['Hotel']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $hotel['Hotel']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $hotel['Hotel']['id']), null, __('Are you sure you want to delete # %s?', $hotel['Hotel']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Hotel'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Event Hotels'), array('controller' => 'event_hotels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event Hotel'), array('controller' => 'event_hotels', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
