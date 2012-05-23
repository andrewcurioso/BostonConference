<?php

$this->set('skinny_sidebar',true);
$this->set('title_for_layout','Schedule');

if ( count( $tracks ) > 0 )
{
	$this->start('sidebar');
?>

<h2>Tracks</h2>
<ul>
<?php

	foreach( $tracks as $track )
	{
		echo '<li>'.$track['name'].'</li>';
	}
?>
</ul>
<?php
	$this->end();
}
?>
<h2>Schedule</h2>

<?php

function getTalkClass( $duration, $talks, $i )
{
	$duration = floor($duration/15);
	$class = '';

	if ( $duration == 0 || $duration == 1 )
		$class = 'minutes-15';
	else if ( $duration == 2 )
		$class = 'minutes-30';
	else if ( $duration == 3 )
		$class = 'minutes-45';
	else
		$class = 'minutes-60';

	if ( $talks > 1 )
		$class .= ' ';

	if ( $talks == 2 )
		$class .= 'double-block';
	else if ( $talks == 3 )
		$class .= 'tripple-block';
	else if ( $talks == 4 )
		$class .= 'quad-block';

	if ( $i > 0 )
		$class .= ' talk-'.($i+1);

	return $class;
}

function getTalksInBlock( $block, $talks, $startIndex=0 )
{
	$talkBlock = array();
	$c = count($talks);

	for ( $i = $startIndex; $i < $c; $i++ ) {
		$nextTalk = $talks[$i];

		$tmp = strtotime($nextTalk['Talk']['start_time']);
		if ( $tmp-(date('i',$tmp)%30*60) == $block ) {
			$talkBlock[] = $nextTalk;
		}
		else {
			break;
		}
	}

	return $talkBlock;
}

if ( ($c = count( $talks )) > 0 )
{
	echo '<div class="schedule">';

	// Stores the current day for day headers
	$day = null;
	$dayIndex = 0;

	// Stores the block state for time display
	$previousBlock = 0;
	$blockEnd = 0;

	// Stores the status of multi-block talks
	$blockMap = array( 0, 0, 0, 0 );
	$colCount = 0;

	// Loop through all the blocks (note: $c is set in the previous `if`)
	for( $i = 0; $i < $c; $i++ )
	{
		$talk = $talks[$i];

		$startTime = strtotime($talk['Talk']['start_time']);

		// Echo the day header if appropriate
		if ( date('z',$startTime) != $day ) {
			$day = date('z',$startTime);
			$previousBlock = 0;

			echo '<div class="day">Day '.(++$dayIndex).' - '.date('l, F jS, Y',$startTime).'</div>';
		}

		// Calulate the current block
		$block = $startTime - (date('i',$startTime)%30*60);
		$blockEnd = $block + $talk['Talk']['duration']*60;

		// Fill in "empty" time blocks if appropriate
		if ( $previousBlock != 0 ) {
			$emptyBlocks = 1;	

			for ( $b = $previousBlock + 30*60; $b < $block; $b += 30*60 ) {
				echo '<div class="block">';
				echo '<div class="time"><p>'.date('h:i a',$b).'</p></div>';
				echo '</div>';
				$emptyBlocks++;
			}

			$resetColCount = true;

			foreach ( $blockMap as $bi => $blockHeight ) {
				if ( $blockHeight > $emptyBlocks ) {
					$blockMap[$bi] -= $emptyBlocks;
					if ( $blockMap[$bi] != 0 )
						$resetColCount = false;
				} else {
					$blockMap[$bi] = 0;
				}
			}

			if ( $resetColCount )
				$colCount = 0;
		}
		$previousBlock = $block;

		// Start the current time block
		echo '<div class="block">';


		// Create an array of talks in this time block
		$talkBlock = getTalksInBlock($block,$talks,$i);

		if ( count($talkBlock) > 1 )
		{
			$workingDuration = $talk['Talk']['duration'];
			foreach( $talkBlock as $tmpTalk )
			{
				if ( $tmpTalk['Talk']['duration'] > $workingDuration ) {
					$workingDuration = $tmpTalk['Talk']['duration'];
					$blockEnd = $block + $workingDuration*60;
				}
			}

			$i += count($talkBlock)-1;
		}

		// Set the column count if we're not still using the count from
		// a previous block
		// This is currently not recursive so it only produces accurate
		// results if the next blocks do not require additional empty
		// columns
		if ( $colCount == 0 )
		{
			$colCount = count($talkBlock);
			$j = 1;

			for ( $b = $block+30*60; $b < $blockEnd; $b += 30*60 ) {
				$blockCount = count( getTalksInBlock($b,$talks,$i+$j) );
				$j += $blockCount;

				if ( $blockCount >= $colCount )
					$colCount = $blockCount+1;
			}
		}

		// Echo the time for this block
		echo '<div class="time"><p>'.date('h:i a',$block).'</p></div>';

		$col = 0;
		foreach ( $talkBlock as $ii => $talk ) {
			if ( $blockMap[$col] > 0 )
				$col++;

			echo '<div class="talk '.getTalkClass($talk['Talk']['duration'],$colCount, $col).'"><p>'.$talk['Talk']['topic'];

			if ( !empty($talk['Speaker']['display_name']) )
				echo '<span> -&nbsp;'.$talk['Speaker']['display_name'].'</span>';


			echo '</p></div>';
			$blockMap[$col] += ceil($talk['Talk']['duration']/30);

			$col++;
		}

		echo '</div>';
	}

	if ( $previousBlock != 0 ) {
		for ( $b = $previousBlock + 30*60; $b < $blockEnd; $b += 30*60 ) {
			echo '<div class="block">';
			echo '<div class="time"><p>'.date('h:i a',$b).'</p></div>';
			echo '</div>';
		}
	}


	echo '</div>';
}
?>
