<p>Dear conference administrator,</p>

<p>You have received a new sponsor request. You may view it in the administrator area or reply to contact the potential sponsor directly.</p>

<?php echo $this->Html->link( 'Review this request', array('controller'=>'sponsors','action'=>'view','admin'=>true, 'full_base' => true, $id), true );?>

<p>
<i>Organization:</i> <?php echo h($sponsor['Sponsor']['organization']); ?><br />
<i>Contact name:</i> <?php echo h($sponsor['Sponsor']['contact_name']); ?><br/>
<i>Email:</i> <?php echo h($sponsor['Sponsor']['contact_email']); ?><br/>
<i>Budget:</i> <?php echo h('$ '.sprintf('%0.2f', $sponsor['Sponsor']['budget'])); ?><br/>
<i>Phone:</i> <?php echo h($sponsor['Sponsor']['contact_phone']); ?><br/>
<i>Website:</i> <?php echo h($sponsor['Sponsor']['website']); ?>
</p>

<p>
<i>Sponsor Notes:</i><br />
<?php echo h($sponsor['Sponsor']['notes']); ?>
</p>
