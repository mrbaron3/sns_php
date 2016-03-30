create database test_sns_php;

grant all on test_sns_php.* to dbuser@localhost identified by 'testapp';

use test_sns_php


create table users(
	id int not null auto_increment primary key,
	email varchar(225) unique,
	password varchar(225),
	created datetime,
	modified datetime
);

create table preusers(
	id int not null auto_increment primary key,
	email varchar(225) unique,
	password varchar(225),
	created datetime,
	modified datetime
);
desc users;