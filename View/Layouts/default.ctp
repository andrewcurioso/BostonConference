<?php

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');

$elements = Configure::read('BostonConference.Elements');

function includeElements( View $view, $element, $path )
{
	if ( is_string($element) )
	{
		echo $view->element($element);
	}
	else if ( is_array($element) && count($element) > 0 )
	{
		foreach ( $element as $i => $child )
		{
			if ( is_int($i) )
				includeElements($view, $child, $path);
		}

		if ( count($path) > 0 && array_key_exists($path[0],$element) )
		{
			$childPath = $path;
			includeElements($view, $element[array_shift($childPath)], $childPath);
		}
	}
}

if ( $elements )
{
	$this->start('after-content');
	$path = isset($element_path) ? $element_path : array();

	if ( !isset($is_admin_area) || !$is_admin_area )
		includeElements($this, $elements, $path);
	else if ( array_key_exists('Admin',$elements) )
		includeElements($this, $elements['Admin'], $path);

	$this->end();
}

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
				array('plugin' => 'BostonConference', 'controller' => 'news', 'action' => 'index'),
				array('escape' => false)
			);
		?>
		</div>
		<div id="contentWrapper">
<?php

$sidebar_content = $this->fetch('before-sidebar').$this->fetch('sidebar').$this->fetch('after-sidebar');

$content_class = '';

if ( preg_match('/[^\s]/',$sidebar_content) == 0 )
	$content_class = 'no-sidebar';
else if ( isset($skinny_sidebar) && $skinny_sidebar )
	$content_class = 'skinny-sidebar';

?>
			<div id="content" class="<?php echo $content_class; ?>">
				<div id="navigation">
					<ul>
					<?php
					foreach( $navigation_links as $link )
						echo '<li>'.$this->Html->link($link[0],$link[1]).'</li>';

					echo '<li class="auth">';
					if ( !empty($authentication['greeting']) ) {
						echo $this->Html->clean($authentication['greeting']).'&nbsp-&nbsp;';
					}

					if ( !empty($authentication['login_url']) ) {
						echo $this->Html->link('Login',$authentication['login_url']);
					}

					if ( !empty($authentication['logout_url']) ) {
						echo $this->Html->link('Logout',$authentication['logout_url']);
					}
						

					echo '</li>';
					?>
					</ul>
					<div class="sidebar-block"> </div>
				</div>
<?php

?>
				<div id="sidebar">
					<?php
						echo $sidebar_content;
					?>
				</div>
				<div id="mainContent">
					<?php
						echo $this->Session->flash();
						echo $this->fetch('before-header');
						echo $this->fetch('header');
						echo $this->fetch('before-content');
						echo $this->fetch('content');
						echo $this->fetch('after-content');
					?>
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
				$this->Html->image('BostonConference.boston.power.gif', array('alt'=> __('BostonConference: the open source conference framework', true), 'border' => '0')),
				'http://www.github.com/andrewcurioso/BostonConference',
				array('target' => '_blank', 'escape' => false)
			);
			echo '&nbsp;';
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
