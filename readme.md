## How to set it up

1. run command `composer install`
1. create mysql database
1. Create table 'users' in database

CREATE TABLE `appointments` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) NOT NULL,
 `lastname` varchar(255) NOT NULL,
 `date` date NOT NULL,
 `time` int(11) NOT NULL,
 `month` int(11) NOT NULL,
 `week` int(11) NOT NULL,
 `day` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8

1. copy .env_example to .env
    1. change db name
    1. change db user
    1. change gb password

