# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.35-0ubuntu0.12.04.2)
# Database: erp
# Generation Time: 2015-10-02 02:03:31 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table erp_allocation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_allocation`;

CREATE TABLE `erp_allocation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(10) unsigned NOT NULL,
  `to_product_id` int(10) unsigned NOT NULL,
  `from_product_id` int(10) unsigned NOT NULL,
  `to_warehouse_id` int(10) unsigned NOT NULL,
  `from_warehouse_id` int(10) unsigned NOT NULL,
  `num` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `allocation_status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_area
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_area`;

CREATE TABLE `erp_area` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_branch
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_branch`;

CREATE TABLE `erp_branch` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `area_id` int(10) unsigned NOT NULL,
  `line_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `day` int(11) NOT NULL,
  `last_visit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_ship_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `stock` int(11) NOT NULL,
  `memo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `check` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_branch_good
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_branch_good`;

CREATE TABLE `erp_branch_good` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(10) unsigned NOT NULL,
  `pay_status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `memo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_branch_good_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_branch_good_items`;

CREATE TABLE `erp_branch_good_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(10) unsigned NOT NULL,
  `branch_id` int(10) unsigned NOT NULL,
  `sell` int(11) NOT NULL,
  `empty` int(11) NOT NULL,
  `capsule` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_delivery
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_delivery`;

CREATE TABLE `erp_delivery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `real_bn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ship_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ship_addr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ship_mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `t_begin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `t_send` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `t_confirm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `branch_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `money` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('1','2','3') COLLATE utf8_unicode_ci NOT NULL,
  `pay_status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `memo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `warehouse_id` int(10) unsigned NOT NULL,
  `type` enum('0','1','2','3','4','5') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_delivery_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_delivery_items`;

CREATE TABLE `erp_delivery_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_id` int(10) unsigned NOT NULL,
  `branch_id` int(10) unsigned NOT NULL,
  `good_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `good_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `spec_info` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `presentation` int(11) NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `money` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `life_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `warehouse_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_good_capsule
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_good_capsule`;

CREATE TABLE `erp_good_capsule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(10) unsigned NOT NULL,
  `branch_id` int(10) unsigned NOT NULL,
  `capsule` int(11) NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `money` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_good_damage
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_good_damage`;

CREATE TABLE `erp_good_damage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `damage` int(11) NOT NULL,
  `damage_bn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `damage_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_good_empty
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_good_empty`;

CREATE TABLE `erp_good_empty` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mode` enum('1','2','3') COLLATE utf8_unicode_ci NOT NULL,
  `good_id` int(10) unsigned NOT NULL,
  `branch_id` int(10) unsigned NOT NULL,
  `empty` int(11) NOT NULL,
  `money` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_good_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_good_log`;

CREATE TABLE `erp_good_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alttime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('purchase','new','picking','price','edit','damage','replacement','allocation','empty','capsule') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_goods
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_goods`;

CREATE TABLE `erp_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `barcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `purchase` int(11) NOT NULL,
  `sell` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `damage` int(11) NOT NULL,
  `replacement` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `empty` int(11) NOT NULL,
  `empty_unit` int(11) NOT NULL,
  `capsule_unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_line
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_line`;

CREATE TABLE `erp_line` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_migrations`;

CREATE TABLE `erp_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_notice
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_notice`;

CREATE TABLE `erp_notice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `type` enum('1','2','3','4','5') COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `read` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `timeline` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_products`;

CREATE TABLE `erp_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(10) unsigned NOT NULL,
  `purchase` int(11) NOT NULL,
  `sell` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `damage` int(11) NOT NULL,
  `replacement` int(11) NOT NULL,
  `cost` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `production_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `life` int(11) NOT NULL,
  `cost_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `life_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `warehouse_id` int(10) unsigned NOT NULL,
  `empty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_replacement
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_replacement`;

CREATE TABLE `erp_replacement` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(10) unsigned NOT NULL,
  `good_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `delivery_id` int(10) unsigned NOT NULL,
  `new_product_id` int(10) unsigned NOT NULL,
  `product_num` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `alttime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_type`;

CREATE TABLE `erp_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `day` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_users`;

CREATE TABLE `erp_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grade` enum('1','5','6','7','10') COLLATE utf8_unicode_ci NOT NULL,
  `disable` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `last_signin_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_visit
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_visit`;

CREATE TABLE `erp_visit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `check` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table erp_warehouse
# ------------------------------------------------------------

DROP TABLE IF EXISTS `erp_warehouse`;

CREATE TABLE `erp_warehouse` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
