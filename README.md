# Wordpress Elastic Beanstalk App boilerplate.
Boilerplate for wordpress deployment to elastic beanstalk without the need to include wordpress core files.
## Installation:
```sh
$ git clone https://github.com/LostinOrchid/aws-eb-wp-boilerplate.git wp-app
$ cd wp-app
$ php install.php
```

## The `wp.json` file:
The `version` key tells the __wp core download__ command the version of wordpress to be downloaded everytime the `.ebextensions/wordpress.config` is executed.
For example: