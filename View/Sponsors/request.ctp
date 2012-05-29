<?php
$this->append('sidebar');
?>
  <h2>Thank You For Your Interest</h2>

  <p>
    We will do our best to accomodate all budget ranges.
  </p>

  <p>
    Multiple opportunities are available.
  </p>

  <p>
    Please use the form on the left and we will get back
    to you within 5 business days.
  </p>
<?php
$this->end();
?>

<div class="sponsors form">

<?php echo $this->Form->create('Sponsor');?>
	<fieldset>
 		<legend><?php echo __('Request Information About Sponsorship'); ?></legend>

		<?php

		echo $this->Form->input('organization', array('label' => 'Organization Name')); 	
		echo $this->Form->input('website', array('label' => 'Organization Website (will be linked to)')); 	
		echo $this->Form->input('contact_name');
		echo $this->Form->input('contact_email');
		echo $this->Form->input('contact_phone');
		echo $this->Form->input('budget', array( 'options' => $budgetOptions, 'label' => 'Estimated Budget') );
		echo $this->Form->input('notes', array('label' => 'Additional Notes'));
	?>

	<p>
	  Requesting more information does not put you under an obligation to sponsor the event. We will get back
	  to you as soon as we can.
	</p>
	</fieldset>
<?php echo $this->Form->end(__('Send Request', true));?>
</div>
