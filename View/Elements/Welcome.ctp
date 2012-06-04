<?php
$this->append('before-header');
?>
<h2>Welcome</h2>

<p>Thank you for installing the Boston Conference Management system.</p>

<p>To edit this message and remove the instructions in the sidebar to your right, please create the following file:</p>

<pre style="margin-bottom: 40px;">
<?php

$path = array(
	'View',
	'Plugin',
	'BostonConference',
	'Elements',
	'Welcome.ctp'
);

echo APP.implode(DS,$path);

?>
</pre>

<?php
$this->end();

$this->append('pre-sidebar');
?>
<h2>Next Steps</h2>
<ol>
  <li>Customize the site name</li>
  <li>Customize the style</li>
  <li>Replace the default welcome element</li>
</ol>
<?php
$this->end();
?>


