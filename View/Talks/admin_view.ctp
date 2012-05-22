<div class="talks view">
<h2><?php  echo __('Talk');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($talk['Talk']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event'); ?></dt>
		<dd>
			<?php echo $this->Html->link($talk['Event']['name'], array('controller' => 'events', 'action' => 'view', $talk['Event']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Speaker'); ?></dt>
		<dd>
			<?php echo $this->Html->link($talk['Speaker']['id'], array('controller' => 'speakers', 'action' => 'view', $talk['Speaker']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Topic'); ?></dt>
		<dd>
			<?php echo h($talk['Talk']['topic']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Abstract'); ?></dt>
		<dd>
			<?php echo h($talk['Talk']['abstract']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Time'); ?></dt>
		<dd>
			<?php echo h($talk['Talk']['start_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Duration'); ?></dt>
		<dd>
			<?php echo h($talk['Talk']['duration']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Approved'); ?></dt>
		<dd>
			<?php echo h($talk['Talk']['approved']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Track'); ?></dt>
		<dd>
			<?php echo $this->Html->link($talk['Track']['name'], array('controller' => 'tracks', 'action' => 'view', $talk['Track']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($talk['Talk']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($talk['Talk']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Talk'), array('action' => 'edit', $talk['Talk']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Talk'), array('action' => 'delete', $talk['Talk']['id']), null, __('Are you sure you want to delete # %s?', $talk['Talk']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Talks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Talk'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Speakers'), array('controller' => 'speakers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Speaker'), array('controller' => 'speakers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tracks'), array('controller' => 'tracks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Track'), array('controller' => 'tracks', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
