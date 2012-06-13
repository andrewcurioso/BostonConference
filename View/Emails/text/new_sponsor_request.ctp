Dear conference administrator,

You have received a new sponsor request. You may view it in the administrator area or reply to contact the potential sponsor directly.

Review this request: <?php echo $this->Html->url( array('controller'=>'sponsors','action'=>'view','admin'=>true, $id), true );?><?php echo "\n";?>
Organization: <?php echo $sponsor['Sponsor']['organization']; ?><?php echo "\n";?>
Contact name: <?php echo $sponsor['Sponsor']['contact_name']; ?><?php echo "\n";?>
Email: <?php echo $sponsor['Sponsor']['contact_email']; ?><?php echo "\n";?>
Budget: <?php echo '$ '.sprintf('%0.2f', $sponsor['Sponsor']['budget']); ?><?php echo "\n";?>
Phone: <?php echo $sponsor['Sponsor']['contact_phone']; ?><?php echo "\n";?>
Website: <?php echo $sponsor['Sponsor']['website']; ?><?php echo "\n";?>

Sponsor Notes:
<?php echo $sponsor['Sponsor']['notes']; ?>
