<div class="sponsorshipLevels view">
<h2><?php  echo __('Sponsorship Level');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sponsorshipLevel['SponsorshipLevel']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Label'); ?></dt>
		<dd>
			<?php echo h($sponsorshipLevel['SponsorshipLevel']['label']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sponsorshipLevel['Event']['name'], array('controller' => 'events', 'action' => 'view', $sponsorshipLevel['Event']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Position'); ?></dt>
		<dd>
			<?php echo h($sponsorshipLevel['SponsorshipLevel']['position']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sponsors Count'); ?></dt>
		<dd>
			<?php echo h($sponsorshipLevel['SponsorshipLevel']['sponsor_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($sponsorshipLevel['SponsorshipLevel']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($sponsorshipLevel['SponsorshipLevel']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?
$this->start('sidebar');
?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sponsorship Level'), array('action' => 'edit', $sponsorshipLevel['SponsorshipLevel']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sponsorship Level'), array('action' => 'delete', $sponsorshipLevel['SponsorshipLevel']['id']), null, __('Are you sure you want to delete # %s?', $sponsorshipLevel['SponsorshipLevel']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sponsorship Levels'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sponsorship Level'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sponsors'), array('controller' => 'sponsors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sponsor'), array('controller' => 'sponsors', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
<div class="related">
	<h3><?php echo __('Related Sponsors');?></h3>
	<?php if (!empty($sponsorshipLevel['Sponsor'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Organization'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($sponsorshipLevel['Sponsor'] as $sponsor): ?>
		<tr>
			<td><?php echo $sponsor['id'];?></td>
			<td><?php echo $sponsor['organization'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sponsors', 'action' => 'view', $sponsor['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sponsors', 'action' => 'edit', $sponsor['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sponsors', 'action' => 'delete', $sponsor['id']), null, __('Are you sure you want to delete # %s?', $sponsor['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Sponsor'), array('controller' => 'sponsors', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
