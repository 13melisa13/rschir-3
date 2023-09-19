CREATE DATABASE IF NOT EXISTS appDB;

USE appDB;


CREATE TABLE IF NOT EXISTS city (
  ID INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(20) NOT NULL UNIQUE ,
  PRIMARY KEY (ID)
);

INSERT IGNORE INTO city (name) values ('Paris'), ('Moscow'), ('Milan');
CREATE TABLE IF NOT EXISTS `shops` (
                                            `id` int NOT NULL AUTO_INCREMENT,
                                            `name` varchar(256) NOT NULL UNIQUE,
                                            primary key (`id`)
                                            );
INSERT IGNORE INTO shops (name) values ('ParisLife'), ('QWERTYMoscow'), ('TGMilan');

CREATE TABLE IF NOT EXISTS `categories` (
                        `id` int NOT NULL AUTO_INCREMENT,
                        `name` varchar(256) NOT NULL UNIQUE ,
                        `shop_id` int NOT NULL,
                        `description` text NOT NULL,
                        `created` timestamp NOT NULL DEFAULT NOW(),
                        `modified` timestamp NOT NULL on update current_timestamp() DEFAULT NOW(),
                        PRIMARY KEY (`id`),
                        FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ;
INSERT INTO categories (`id`, `shop_id`,`name`, `description`,   `created`, `modified`) VALUES
(1, 2,'Fashion', 'Category for anything related to fashion.', '2014-06-01 00:35:07', '2014-05-30 17:34:33'),
(2,  1,'Electronics', 'Gadgets, drones and more.', '2014-06-01 00:35:07', '2014-05-30 17:34:33'),
(3,  1,'Motors', 'Motor sports and more', '2014-06-01 00:35:07', '2014-05-30 17:34:54'),
(5,  3,'Movies', 'Movie products.', '2019-05-20 10:22:05', '2019-08-20 10:30:15'),
(6,  3,'Books', 'Kindle books, audio books and more.', '2018-03-14 08:05:25', '2019-05-20 11:29:11'),
(13, 1, 'Sports', 'Drop into new winter gear.', '2016-01-09 02:24:24', '2016-01-09 01:24:24');




CREATE TABLE IF NOT EXISTS `categories` (
`id` int NOT NULL AUTO_INCREMENT,
`name` varchar(256) NOT NULL UNIQUE ,
`description` text NOT NULL,
`created` timestamp NOT NULL DEFAULT NOW(),
`modified` timestamp NOT NULL on update current_timestamp() DEFAULT NOW(),
PRIMARY KEY (`id`)
) ;

CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `article` varchar(10) NOT NULL UNIQUE,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `category_id` int NOT NULL,
  `created` timestamp NOT NULL DEFAULT NOW(),
  `modified` timestamp NOT NULL on update current_timestamp() DEFAULT NOW(),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO `products` (`id`, `article`, `name`, `description`, `price`, `category_id`, `created`, `modified`) VALUES
(1,'1020909111', 'LG P880 4X HD', 'My first awesome phone!', '336', 3, '2014-06-01 01:12:26', '2014-05-31 17:12:26'),
(2, '1020909110','Google Nexus 4', 'The most awesome phone of 2013!', '299', 2, '2014-06-01 01:12:26', '2014-05-31 17:12:26'),
(3,'1020909112', 'Samsung Galaxy S4', 'How about no?', '600', 3, '2014-06-01 01:12:26', '2014-05-31 17:12:26'),
(6, '1020909113', 'Bench Shirt', 'The best shirt!', '29', 1, '2014-06-01 01:12:26', '2014-05-31 02:12:21'),
(7,'1020909114', 'Lenovo Laptop', 'My business partner.', '399', 2, '2014-06-01 01:13:45', '2014-05-31 02:13:39'),
(8,'1020909117','Samsung Galaxy Tab 10.1', 'Good tablet.', '259', 2, '2014-06-01 01:14:13', '2014-05-31 02:14:08'),
(9,'1020909116','Spalding Watch', 'My sports watch.', '199', 1, '2014-06-01 01:18:36', '2014-05-31 02:18:31'),
(10, '1020909115', 'Sony Smart Watch', 'The coolest smart watch!', '300', 2, '2014-06-06 17:10:01', '2014-06-05 18:09:51');
