<?php
$this->set('title_for_layout','Home');

$this->append('sidebar');
?>
<h2>Next Steps</h2>
<ol>
	<li>Customize site name.</li>
	<li>Customize organization name.</li>
	<li>Change logo.</li>
</ol>
<?php
$this->end('sidebar');
?>
<h2>Welcome</h2>
<p>Thank you for installing the Boston Conference Management System.</p>
<p>To change this file, edit:</p>
<pre><?php echo str_replace('CAKE','CAKE/',str_replace(APP,'APP/',__FILE__)); ?></pre>


