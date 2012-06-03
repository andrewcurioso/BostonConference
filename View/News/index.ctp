<?php

$this->set('title_for_layout','Home');

if ( count( $news ) > 0 )
{
	foreach ($news as $news)
	{
?>
<article>
	<h2><?php echo h($news['News']['title']); ?>&nbsp;</h2>
	<time><?php echo date(Configure::read('BostonConference.dateFormat'),strtotime($news['News']['created'])); ?>&nbsp;</time>
	<p><?php echo $this->Html->clean($news['News']['body']); ?>&nbsp;</p>
</article>
<?php
	}
?>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
<?php
}
else
{
?>
<p>Please check back later for the latest news and updates.</p>
<?php
}
?>
