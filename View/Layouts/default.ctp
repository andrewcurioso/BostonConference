<?php

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout.' :: '.Configure::read('BostonConference.siteName'); ?>
	</title>
	<?php
		echo $this->fetch('meta');
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('/boston_conference/css/base.css');

		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
		<?php
			echo $this->Html->link(
				$this->Html->image('/boston_conference/img/logo.png', array('alt'=> Configure::read('BostonConference.siteName'), 'border' => '0')),
				array('plugin' => 'BostonConference', 'controller' => 'BostonConference', 'action' => 'index'),
				array('escape' => false)
			);
		?>
		</div>
		<div id="contentWrapper">
			<div id="content">
				<div id="navigation">
					<ul>
					<?php
					foreach( $navigation_links as $link )
						echo '<li>'.$this->Html->link($link[0],$link[1]).'</li>';
					?>
					</ul>
					<div class="sidebar-block"> </div>
				</div>

				<div id="sidebar">
					<?php echo $this->fetch('sidebar'); ?>
				</div>
				<div id="mainContent">
					<?php echo $this->fetch('content'); ?>
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
		<p>
			Copyright &copy; <?php
				echo date('Y');

				$organizationName = Configure::read('BostonConference.organizationName');
				echo ' '.( $organizationName ? $organizationName : Configure::read('BostonConference.siteName') );
			?>
			<?php echo $this->fetch('footer'); ?>
		</p>

		<?php
			echo $this->Html->link(
				$this->Html->image('cake.power.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),
				'http://www.cakephp.org/',
				array('target' => '_blank', 'escape' => false)
			);
		?>
	</div>

        <div class="water-light right"> </div>
        <div class="water-light left"> </div>

	<?php
		echo $this->element('sql_dump');
	?>
</body>
</html>
