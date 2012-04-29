/*
SQLyog Community v9.02 
MySQL - 5.5.16 : 
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `account_buyout` */

CREATE TABLE `account_buyout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `time_date` int(11) NOT NULL,
  `service_type` int(11) NOT NULL,
  `guid` int(11) NOT NULL,
  `realm_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25817 DEFAULT CHARSET=utf8;

/*Table structure for table `account_points` */

CREATE TABLE `account_points` (
  `account_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `amount_used` int(11) NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `paypal_history` */

CREATE TABLE `paypal_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `txn_id` text,
  `payment_date` text NOT NULL,
  `verify_sign` text NOT NULL,
  `payer_email` text NOT NULL,
  `receiver_email` text NOT NULL,
  `payer_id` text NOT NULL,
  `receiver_id` text NOT NULL,
  `item_number` text NOT NULL,
  `amount` int(11) NOT NULL,
  `gross` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=508 DEFAULT CHARSET=utf8;

/*Table structure for table `sms_codes` */

CREATE TABLE `sms_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) NOT NULL,
  `code` varchar(64) NOT NULL,
  `cel` int(18) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `type` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46066 DEFAULT CHARSET=utf8;

/*Table structure for table `store_session` */

CREATE TABLE `store_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `session_id` text NOT NULL,
  `amount` int(11) NOT NULL,
  `date_time` int(11) NOT NULL,
  `used` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1394 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
