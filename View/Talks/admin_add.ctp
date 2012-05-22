<div class="talks form">
<?php echo $this->Form->create('Talk');?>
	<fieldset>
		<legend><?php echo __('Admin Add Talk'); ?></legend>
	<?php
		$minYear = date('Y');
		$maxYear = $minYear + 1;

		$dateOptions = array(
			'empty' => true,
			'interval'=>15,
			'minYear' => $minYear,
			'maxYear' => $maxYear
		);

		$durationOptions = array(
			'options' => array(
				15 => '15 minutes',
				30 => '30 minutes',
				45 => '45 minutes',
				60 => '1 hour'
			),
			'value' => 60
		);

		echo $this->Form->input('event_id');
		echo $this->Form->input('speaker_id');
		echo $this->Form->input('topic');
		echo $this->Form->input('abstract');
		echo $this->Form->input('start_time',$dateOptions);
		echo $this->Form->input('duration',$durationOptions);
		echo $this->Form->input('approved');
		echo $this->Form->input('track_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<?php
$this->start('sidebar');
?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Talks'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Speakers'), array('controller' => 'speakers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Speaker'), array('controller' => 'speakers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tracks'), array('controller' => 'tracks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Track'), array('controller' => 'tracks', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
$this->end();
?>
