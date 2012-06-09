# Boston Conference Management System
## Introduction
Boston Conference Management System is an open-source conference management system that provides basic functionality for running a conference.
It is implemented as a CakePHP 2.1 plugin.

## Planned Features

- Sponsor management
- Speaker and schedule management
- Easily customizable themes
- Tickets
- Support for upcoming and archived events
- Attendee networking
- Event blog

## What is not supported
### User Management and Access Control
User management and access control is designed to be done at the app level in CakePHP. That way the system can easily be integrated with existing projects. A default user model may be provided in the future to make integration easier.

## Installation
Installing the Boston Conference Management system is quick and easy.

1. Install [CakePHP 2.1][cakephp]. Configure it, with no errors, and set it up with an empty database.
2. Disable the loading of CakePHP default routes in CAKE/app/Config/routes.php. Just comment the line out.
3. Remove all the two predefined default routes ('/' & '/pages/*') found in CAKE/app/Config/routes.php. Just comment these lines out.
4. Enable admin prefix routing in CAKE/app/core.php. Just uncomment the line.
5. Copy the BostonConference directory into your CAKE/app/Plugins directory.
6. Open up your CAKE/app/Config/bootstrap.php and load the Plugin. See the sample code below.
7. Install the schema with `cake schema create -p BostonConference`

In CAKE/app/Config/bootstrap.php

```php
CakePlugin::load('BostonConference', array('routes' => true));
```

You can then test it by going to your domain. You should see a welcome message and the Boston Conference UI.

## Configuring
The Boston Conference Management System is extremely configurable. You should never have to edit the Controllers or Models at all.

### Routing
By default the plugin maps itself to your CakePHP root directory. To change this behavior you can configure a prefix. For example, if you want all your paths to be inside of the /events/ directory:

In your app/Config/core.php file:

```php
Configure::write('BostonConference.routePrefix','events');
```

### Site and Organization Name
You'll probably want to have a site and organization name specified. The organization name is the name of the company or organization coordinating the event and the site name is what appears in the title bar and various other places. For example, in your app/Config/core.php file:

```php
Configure::write('BostonConference.organizationName','Acme Inc.');
Configure::write('BostonConference.siteName','A Wicked Awesome Conference');
```

### Date and Time
By default the time is displayed in "g:i a" format so that "13:00" is displayed as "1:00 pm" in the calandar and other places. This format is configurable. So, for example if you want a 24-hour display you would set that in your in your app/Config/core.php file:

```php
Configure::write('BostonConference.timeFormat','H:i');
```

By default the date is displayed in the "l, F jS, Y" format. For example the date "2012/5/1" becomes "Tuesday, May 1st, 2012" in the calander, news, and other places. The format is also configurable. So, for example, to display just "May 1, 2012" you can put the following in your app/Config/core.php file:


```php
Configure::write('BostonConference.dateFormat','F j, Y');
```

For more information on date formatting see the [PHP manual page for date](http://us2.php.net/manual/en/function.date.php).

## Customizing Views

### Changing The Logo, Images, or CSS
You can change the logo or image by create a folder "CAKE/app/webroot/boston_conference" then creating a file of the same name as the file in the plugin. For example, to change the logo you could create a filder called "img" and place a "logo.png" file into it.

Unless you plan on changing the entire structure of the CSS, it is not recommended that you replace the stylesheet entirely. Doing so will cause upgrades in the CSS to potentially break. If you look at the "base.css" file in the plugin you may notice that the plugin also imports the CakePHP stylesheet as well.

Instead, create a new element to embed on every page (see the next section) and add a line of code similar to this (where "mystyle.css" is the name of a stylesheet you created in your webroot):

```php
$this->Html->css('mystyle.css', null, array('inline' => false));
```

### Adding Content Using Elements
You can easily include more content onto the page via elements. Elements can be included in all pages or only specific pages.

First, create an element in your app/View/Elements directory. An element is just like a normal CakePHP view and should have a ".ctp" extension.

You can include an element on all pages in the conference by setting a configuration variable in your app/Config/core.php file. For example, say your element is in the file "app/Elements/Welcome.ctp" and it is in your core CakePHP application (not a plugin):

```php
Configure::write('BostonConference.Elements',array('app.Welcome'));
```

You can also include an element only on specific pages. For example, to include it only on the News index page (the default homepage for the event):

```php
Configure::write('BostonConference.Elements.News.index',array('app.Welcome'))
```

Or to include it on all pages in the News controller:

```php
Configure::write('BostonConference.Elements.News',array('app.Welcome'))
```

The order you include your elements matters. For example, if you specify "BostonConference.Elements.News" after "BostonConference.Elements.News.index" in your configuration then the index will be overriden. The easiest way to ensure the desired behavior is to specify all elements at once:

```php
Configure::write('BostonConference.Elements', array(
  'Welcome',
  'News' => array( 'NewsHeader' )
));
```

It is also worth noting that elements are not included on administration pages. If you wish to include an element on an admin page than change "BostonConference.Elements" to "BostonConference.Elements.Admin" instead.

Elements will appear in the order they are defined; however, higher specificity elements always included after the lower specificity elements. In other words, an element that should be included on all pages will be included before an element that is only on a specific page.

By default the text in the elemnt appears after the content of the page (but before the footer). To have more control over the content placement you can use blocks. For example, to make the content appear before the sidebar you can use the "pre-sidebar" block like so:

```php
$this->append('pre-sidebar');
<p>This is some content.</p>
$this->end();
```

The allowed blocks are:

* before-sidebar
* sidebar
* after-sidebar
* before-header
* header
* before-content
* after-content

# Optional pages for Speakers and Talks
There is a page for Speakers that shows a list of all the approved Speakers who have talks. There is also a page for
Talks which shows a listing of all talks that have Speakers. You can get to these pages with the following links:

* Speakers page - http://yourdomain.com/bostonconference/speakers
* Talks page - http://yourdomain.com/bostonconference/talks

# Adding your own menus

If you would like to add additional menus, you can do so as follows.

1. Edit your CAKE/app/Controller/AppController.php
2. Load the component 'BostonConference.Menu'
3. Add a beforeFilter callback method and use addLink as follows

```php
public function beforeFilter() {

	if (strpos($this->action, "admin_") === false) { // Only display for non admin views

		// Add link to Speakers page
		$this->Menu->addLink(
			'Speakers',
			array(
				'plugin' => 'BostonConference',
				'admin' => false,
				'controller' => 'speakers',
				'action' => 'index'
			),
			20
		);
	}
}
```
You can also use this method to load any static pages in CAKE/app/View/Pages/

```php
	// Add link to my own page at CAKE/app/View/Pages/organizers.ctp
	$this->Menu->addLink(
		'Organizers',
		array(
			'plugin' => null,
			'admin' => false,
			'controller' => 'pages',
			'action' => 'display'
		),
		100
	);
```

## Contributing
You can contribute to the project by forking it on Github and submitting pull requests.

[cakephp]: http://www.cakephp.org/
