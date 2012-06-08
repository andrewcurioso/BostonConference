<?php
$this->append('header');
?>
<div class="speakers index">
	<h2><?php echo __('Speakers');?></h2>
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
					if( !empty( $speaker['Speaker']['portrait_url'] ) ) {
						echo $this->Html->image( $speaker['Speaker']['portrait_url'] );
					} elseif( isset( $speaker['Speaker']['email'] ) ) {
						echo $this->Gravatar->image($speaker['Speaker']['email']);
					} else {
						echo $this->Gravatar->image( 'someone@example.com' ); // Gets a default Gravatar
					}
					?>
				</td>
				<td><h3><?php echo $this->Html->clean($speaker['Speaker']['display_name']);?></h3>
				<p class='speaker-bio'><?php echo $this->Html->clean(nl2br($speaker['Speaker']['bio']));?></p>

				<? if( !empty( $speaker['Talk'] ) ) : ?>
					<?php
						$talks = array();
						foreach( $speaker['Talk'] as $talk ) {
							$talks[] = $talk['topic'];
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
