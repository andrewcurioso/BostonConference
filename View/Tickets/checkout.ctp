<?php

echo $this->Form->create('Ticket');

echo '<h3>'.__('Organization (optional)').'</h3>';

echo $this->Form->input('organization',array('label' => false));

echo '<h3>'.__('Name for badges').'</h3>';

foreach( $ticketOptions as $ticketOption )
{
	for ( $i = 0; $i < $ticketOption['TicketOption']['quantity']; $i++ ) {
		echo $this->Form->input(
			'badge_name_'.$ticketOption['TicketOption']['id'].'_'.((int)$i),
			array(
				'type' => 'text',
				'label' => __('Ticket #%d: %s',$i+1,$ticketOption['TicketOption']['label']),
			)
		);
	}
}

echo '<h3>'.__('Total Price').'</h3>';

echo '<p>';

if ( $totalPrice > 0 )
	echo '$'.number_format($totalPrice,2);
else
	echo __('Free');

echo '</p>';

echo $this->Form->input('submit',array(
	'type' => 'image',
	'src' => 'https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif',
	'style' => 'width:auto;height:auto',
	'label' => false
));

echo $this->Form->end();

?>
