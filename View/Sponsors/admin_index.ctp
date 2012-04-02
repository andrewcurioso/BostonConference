<div class="sponsors index">
	<h2><?php echo __('Sponsors');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('organization');?></th>
			<th><?php echo $this->Paginator->sort('sponsorship_level_id');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($sponsors as $sponsor): ?>
	<tr>
		<td><?php echo h($sponsor['Sponsor']['id']); ?>&nbsp;</td>
		<td><?php echo h($sponsor['Sponsor']['organization']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($sponsor['SponsorshipLevel']['label'], array('controller' => 'sponsorship_levels', 'action' => 'view', $sponsor['SponsorshipLevel']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $sponsor['Sponsor']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $sponsor['Sponsor']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $sponsor['Sponsor']['id']), null, __('Are you sure you want to delete # %s?', $sponsor['Sponsor']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Sponsor'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Sponsorship Levels'), array('controller' => 'sponsorship_levels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sponsorship Level'), array('controller' => 'sponsorship_levels', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
