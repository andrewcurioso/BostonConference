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

1. Install [CakePHP 2.1][cakephp]
2. Copy the BostonConference directory into your CAKE/app/Plugins directory
3. Open up your Config/bootstrap.php and register the Plugin
4. Install the schema with `cake schema create -P BostonConference`

In app/Config/bootstrap.php

```php
CakePlugin::load('BostonConference', array('routes' => true));
```

You can then test it by going to your domain.

## Routing
By default the plugin maps itself to your CakePHP root directory. To change this behavior you can configure a prefix. For example, if you want all your paths to be inside of the /events/ directory:

In your app/Config/core.php

```php
Config.write('BostonConference.routePrefix','events');
```

## Contributing
You can contribute to the project by forking it on Github and submitting pull requests.

[cakephp]: http://www.cakephp.org/
