<div class="talks form">
<?php echo $this->Form->create('Talk', array('onsubmit'=>"return confirm('Be careful, this can create a lot of data! Are you sure?')"));?>
	<fieldset>
		<legend><?php echo __('Admin Add Multiple Talks'); ?></legend>
		<p>This will automatically add a series of talks that you can edit later. Just specify
		the date and time for the first talk. Then specify the time when your conference ends.
		Set a duration of each talk, and the time between the start of each talk.</p>
	<?php
		$minYear = date('Y');
		$maxYear = $minYear + 1;

		$dateOptions = array(
			'interval'=>15,
			'minYear' => $minYear,
			'maxYear' => $maxYear,
			'default' => time()
		);

		$talkDurations = array(
				15  => '15 minutes',
				30  => '30 minutes',
				45  => '45 minutes',
				55  => '55 minutes',
				60  => '1 hour',
				75  => '1 hour 15 minutes',
				90  => '1 hour 30 minutes',
				105 => '1 hour 45 minutes',
				115 => '1 hour 55 minutes',
				120 => '2 hours',
				135 => '2 hour 15 minutes',
				150 => '2 hour 30 minutes',
				165 => '2 hour 45 minutes',
				175 => '2 hour 55 minutes',
				180 => '3 hours'
		);

		$talkIntervals = array(
				30  => '30 minutes',
				45  => '45 minutes',
				60  => '1 hour',
				75  => '1 hour 15 minutes',
				90  => '1 hour 30 minutes',
				105 => '1 hour 45 minutes',
				115 => '1 hour 55 minutes',
				120 => '2 hours',
				135 => '2 hour 15 minutes',
				150 => '2 hour 30 minutes',
				165 => '2 hour 45 minutes',
				175 => '2 hour 55 minutes',
				180 => '3 hours'
		);

		echo $this->Form->input('event_id');
		echo $this->Form->input('speaker_id', array('empty' => true));
		echo $this->Form->input('topic', array('label'=>'Default Topic Name','after'=>__('An index number will be appended to the end')));
		echo $this->Form->input('abstract', array('label'=>'Default Abstract'));

		$dateOptions['type']='datetime';
		echo $this->Form->input('start_of_day',$dateOptions);

		$dateOptions['type']='time';
		echo $this->Form->input('end_of_day',$dateOptions);
		echo $this->Form->input('duration', array('options'=>$talkDurations, 'label'=>'How long is each talk?', 'value'=>60));

		echo $this->Form->input('interval', array('options'=>$talkIntervals, 'label'=>'Create a new talk every...', 'value'=>0));
		echo $this->Form->input('approved');
		echo $this->Form->input('track_id',array('empty'=>true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<?php
$this->append('sidebar');
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
