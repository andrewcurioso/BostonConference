<?php

if ( count( $tickets ) > 0 )
{
?>

	<h2>My Tickets</h2>

	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo __('Package'); ?></th>
		<th><?php echo __('Badge Name');?></th>
		<th><?php echo __('Organization');?></th>
	</tr>
<?php

	foreach( $tickets as $ticket ) {

		echo '<tr>';
		echo '<td>'.h($ticket['TicketOption']['label']).'</td>';
		echo '<td>'.h($ticket['Ticket']['badge_name']).'</td>';
		echo '<td>'.h($ticket['Ticket']['organization']).'</td>';
		echo '</tr>';
	}
?>
	</table>
<?php
}

if ( count( $ticketOptions ) > 0 )
{

	echo $this->Form->create('Ticket');

	$availableToBuy = false;
?>

	<h2>Buy Tickets</h2>

	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo __('Package'); ?></th>
		<th><?php echo __('Price');?></th>
		<th><?php echo __('Quantity');?></th>
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

				if ( $ticketOption['Event']['available_tickets'] !== null )
					$canBuy = min($ticketOption['Event']['available_tickets']-$ticketOption['Event']['ticket_count'],$canBuy);

				if ( $canBuy <= 0 )
					echo __('Sold Out');
				else {
					$availableToBuy = true;

					$options = array();

					for ( $i=0; $i <= $canBuy && $i <= 10; $i++ )
						$options[] = number_format($i,0);

					echo $this->Form->select('quantity.'.$ticketOption['TicketOption']['id'],$options,array('empty'=>false));
				}

				?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>

<?php

	echo $this->Form->end( $availableToBuy ? __('Continue') : null );

} else {
?>
<p><?php echo __('There are no ticket options available yet. Please check back later.'); ?></p>
<?php
}
?>
