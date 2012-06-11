<?php

if ( count( $ticketOptions ) > 0 )
{

	echo $this->Form->create('Ticket');
	
	$availableToBuy = false;
?>

	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo __('Package'); ?></th>
			<th><?php echo __('Price');?></th>
			<th><?php echo __('Quality');?></th>
	</tr>
	<?php
	foreach ($ticketOptions as $ticketOption): ?>
	<tr>
		<td><?php echo h($ticketOption['TicketOption']['label']); ?>&nbsp;</td>
		<td><?php

			if ( $ticketOption['TicketOption']['price'] > 0 )
				echo '$'.number_format($ticketOption['TicketOption']['price'],2);
			else
				echo 'Free';
			?>
		&nbsp;</td>
		<td>
				<?php

				if ( $ticketOption['TicketOption']['available'] !== null )
					$canBuy = $ticketOption['TicketOption']['available']-$ticketOption['TicketOption']['ticket_count'];
				else
					$canBuy = 999;

				if ( $canBuy <= 0 )
					echo "Sold Out";
				else {
					$availableToBuy = true;

					$options = array();

					for ( $i=0; $i < $canBuy && $i <= 10; $i++ )
						$options[] = number_format($i,0);

					echo $this->Form->select('quantity.'.$ticketOption['TicketOption']['id'],$options,array('empty'=>false));
				}

				?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>

<?php

	echo $this->Form->end( $availableToBuy ? __('Continue') : false );

} else {
?>
<p><?php echo __('There are no ticket options available yet. Please check back later.'); ?></p>
<?php
}
?>
