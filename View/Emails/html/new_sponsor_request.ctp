<p>Dear conference administrator,</p>

<p>You have received a new sponsor request. You may view it in the administrator area or reply to contact the potential sponsor directly.</p>

<p>
<i>Organization:</i> <?php echo h($sponsor['Sponsor']['organization']); ?><br />
<i>Contact name:</i> <?php echo h($sponsor['Sponsor']['contact_name']); ?><br/>
<i>Email:</i> <?php echo h($sponsor['Sponsor']['contact_email']); ?><br/>
<i>Phone:</i> <?php echo h($sponsor['Sponsor']['contact_phone']); ?><br/>
<i>Website:</i> <?php echo h($sponsor['Sponsor']['website']); ?>
</p>

<p>
<i>Sponsor Notes:</i><br />
<?php echo h($sponsor['Sponsor']['notes']); ?>
</p>



