<?php
$this->append('header')
?>
<div class="eventHotels view">
	<h2><?php  echo __('Event Hotel');?></h2>
</div>
<?php
$this->end();
?>
<div class="eventHotels view">
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($eventHotel['EventHotel']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event'); ?></dt>
		<dd>
			<?php echo $this->Html->link($eventHotel['Event']['name'], array('controller' => 'events', 'action' => 'view', $eventHotel['Event']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hotel'); ?></dt>
		<dd>
			<?php echo $this->Html->link($eventHotel['Hotel']['name'], array('controller' => 'hotels', 'action' => 'view', $eventHotel['Hotel']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group Rate'); ?></dt>
		<dd>
			<?php echo h($eventHotel['EventHotel']['group_rate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group Rate Instructions'); ?></dt>
		<dd>
			<?php echo h($eventHotel['EventHotel']['group_rate_instructions']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Event Hotel'), array('action' => 'edit', $eventHotel['EventHotel']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Event Hotel'), array('action' => 'delete', $eventHotel['EventHotel']['id']), null, __('Are you sure you want to delete # %s?', $eventHotel['EventHotel']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Event Hotels'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event Hotel'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Hotels'), array('controller' => 'hotels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Hotel'), array('controller' => 'hotels', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
