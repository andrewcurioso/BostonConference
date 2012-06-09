<?php
$this->append('header');
?>
<div class="speakers index">
	<h2><?php echo ( $this->action == 'view' ) ? __('Speaker Profile') : __('Speakers');?></h2>
</div>
<?php
$this->end();
?>
<div class="speakers index">
	<table cellpadding='0' cellspacing='0'>
		<tbody>
			<?php foreach( $speakers AS $speaker ) : ?>
			<tr>
				<td><?php
					$speakerLink = array( 'controller'=>'speakers','action'=>'view', $speaker['Speaker']['id'] );
					if( !empty( $speaker['Speaker']['portrait_url'] ) ) {
						echo $this->Html->image( $speaker['Speaker']['portrait_url'], array('url'=>$speakerLink) );
					} elseif( isset( $speaker['Speaker']['email'] ) ) {
						echo $this->Gravatar->image($speaker['Speaker']['email'], null, array('url'=>$speakerLink));
					} else {
						echo $this->Gravatar->image( 'someone@example.com', null, array('url'=>$speakerLink) ); // Gets a default Gravatar
					}
					?>
				</td>
				<td><h3><?php echo $this->Html->clean($speaker['Speaker']['display_name']);?></h3>
				<p class='speaker-bio'><?php echo $this->Html->clean(nl2br($speaker['Speaker']['bio']));?></p>

				<? if( !empty( $speaker['Talk'] ) ) : ?>
					<?php
						$talks = array();
						foreach( $speaker['Talk'] as $talk ) {
							$talks[] = $this->Html->link($talk['topic'], array('controller'=>'talks','action'=>'view', $talk['id']));
						}
					?>
					<cite><?php echo __('My talks:');?>&nbsp;<?php echo implode(', ', $talks); ?></cite>
				<? endif; ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
