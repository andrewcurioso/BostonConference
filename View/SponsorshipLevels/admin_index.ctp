<div class="sponsorshipLevels index">
	<h2><?php echo __('Sponsorship Levels');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('label');?></th>
			<th><?php echo $this->Paginator->sort('position','Pos');?></th>
			<th><?php echo $this->Paginator->sort('sponsors_count','Count');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($sponsorshipLevels as $sponsorshipLevel): ?>
	<tr>
		<td><?php echo h($sponsorshipLevel['SponsorshipLevel']['id']); ?>&nbsp;</td>
		<td><?php echo h($sponsorshipLevel['SponsorshipLevel']['label']); ?>&nbsp;</td>
		<td><?php echo h($sponsorshipLevel['SponsorshipLevel']['position']); ?>&nbsp;</td>
		<td><?php echo h($sponsorshipLevel['SponsorshipLevel']['sponsors_count']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $sponsorshipLevel['SponsorshipLevel']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $sponsorshipLevel['SponsorshipLevel']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $sponsorshipLevel['SponsorshipLevel']['id']), null, __('Are you sure you want to delete # %s?', $sponsorshipLevel['SponsorshipLevel']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Sponsorship Level'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sponsors'), array('controller' => 'sponsors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sponsor'), array('controller' => 'sponsors', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
