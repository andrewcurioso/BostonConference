<?php
$this->set('skinny_sidebar',true);
$this->set('title_for_layout','Schedule');

if ( count( $tracks ) > 0 )
{
	$this->append('sidebar');
?>

<h2>Tracks</h2>
<ul class="tracks">
<?php

	$trackCss = "";

	foreach( $tracks as $track )
	{
		echo '<li class="track-'.$track['id'].'">'.$track['name'].'</li>';

		if ( !empty($track['color']) ) {
			$trackCss .= '#content .track-'.$track['id'].' { background-color: #'.$track['color'].'; } ';
		}
	}

	if ( !empty($trackCss) )
		$this->append('css',$this->Html->tag('style',$trackCss));
?>
</ul>
<?php
	$this->end();
}
?>
<h2>Schedule</h2>

<?php



if ( count( $talks ) == 0 )
{
?>
	<p>We have not yet posted the schedule online. Please check back later for more updates.</p>
<?php
}
else
{
	echo $this->Schedule->calandar($talks);
}
?>
