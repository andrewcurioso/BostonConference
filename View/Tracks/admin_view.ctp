<?php
$this->append('header')
?>
<div class="tracks view">
	<h2><?php  echo __('Track');?></h2>
</div>
<?php
$this->end();
?>
<div class="tracks view">
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($track['Track']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($track['Track']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color'); ?></dt>
		<dd>
			<?php echo h($track['Track']['color']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Position'); ?></dt>
		<dd>
			<?php echo h($track['Track']['position']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Talk Count'); ?></dt>
		<dd>
			<?php echo h($track['Track']['talk_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($track['Track']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($track['Track']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Track'), array('action' => 'edit', $track['Track']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Track'), array('action' => 'delete', $track['Track']['id']), null, __('Are you sure you want to delete # %s?', $track['Track']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tracks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Track'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Talks'), array('controller' => 'talks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Talk'), array('controller' => 'talks', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
<div class="related">
	<h3><?php echo __('Related Talks');?></h3>
	<?php if (!empty($track['Talk'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Event Id'); ?></th>
		<th><?php echo __('Speaker Id'); ?></th>
		<th><?php echo __('Topic'); ?></th>
		<th><?php echo __('Abstract'); ?></th>
		<th><?php echo __('Start Time'); ?></th>
		<th><?php echo __('End Time'); ?></th>
		<th><?php echo __('Approved'); ?></th>
		<th><?php echo __('Track Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($track['Talk'] as $talk): ?>
		<tr>
			<td><?php echo $talk['id'];?></td>
			<td><?php echo $talk['event_id'];?></td>
			<td><?php echo $talk['speaker_id'];?></td>
			<td><?php echo $talk['topic'];?></td>
			<td><?php echo $talk['abstract'];?></td>
			<td><?php echo $talk['start_time'];?></td>
			<td><?php echo $talk['end_time'];?></td>
			<td><?php echo $talk['approved'];?></td>
			<td><?php echo $talk['track_id'];?></td>
			<td><?php echo $talk['created'];?></td>
			<td><?php echo $talk['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'talks', 'action' => 'view', $talk['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'talks', 'action' => 'edit', $talk['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'talks', 'action' => 'delete', $talk['id']), null, __('Are you sure you want to delete # %s?', $talk['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Talk'), array('controller' => 'talks', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
