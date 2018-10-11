-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.29-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table yccl.account
DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(500) DEFAULT NULL,
  `account_username` varchar(50) DEFAULT NULL,
  `account_password` varchar(150) DEFAULT NULL,
  `account_type` int(11) DEFAULT NULL,
  `account_creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table yccl.account: ~0 rows (approximately)
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` (`account_id`, `account_name`, `account_username`, `account_password`, `account_type`, `account_creationDate`) VALUES
	(1, 'John Doe', 'admin', 'admin', 1, '2018-10-03 14:42:07');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;

-- Dumping structure for table yccl.center_details
DROP TABLE IF EXISTS `center_details`;
CREATE TABLE IF NOT EXISTS `center_details` (
  `center_id` int(11) NOT NULL AUTO_INCREMENT,
  `center_name` varchar(150) DEFAULT NULL,
  `center_address` varchar(500) DEFAULT NULL,
  `center_contact` varchar(50) DEFAULT NULL,
  `center_status` varchar(1) DEFAULT NULL,
  `center_discount` float DEFAULT NULL,
  PRIMARY KEY (`center_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table yccl.center_details: ~7 rows (approximately)
/*!40000 ALTER TABLE `center_details` DISABLE KEYS */;
INSERT INTO `center_details` (`center_id`, `center_name`, `center_address`, `center_contact`, `center_status`, `center_discount`) VALUES
	(1, 'Kaduwela Medical', 'NO 999, Kaduwela', '799999992', '2', 1.12),
	(2, 'Hanwella Medicals', 'Kaluthara, Nagodas', '799999992', '2', 32.12),
	(4, 'Mission Hospital', 'Iloilo City						', '09452485640', '2', 32),
	(5, 'Doctors Iloilo', 'Iloilo City						', '09271804046', '2', 101),
	(6, 'T', 'Nsns	hdhdb					', 'Hxjfn', '2', 2),
	(7, '12', '123', '123', '2', 123),
	(8, 'Yap Clinical', 'San Jose Antique					', '09876868', '2', 0);
/*!40000 ALTER TABLE `center_details` ENABLE KEYS */;

-- Dumping structure for table yccl.doctor_details
DROP TABLE IF EXISTS `doctor_details`;
CREATE TABLE IF NOT EXISTS `doctor_details` (
  `doctor_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_name` varchar(150) DEFAULT NULL,
  `doctor_address` varchar(500) DEFAULT NULL,
  `doctor_contact` varchar(50) DEFAULT NULL,
  `doctor_status` varchar(1) DEFAULT NULL,
  `doctor_discount` float DEFAULT NULL,
  PRIMARY KEY (`doctor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table yccl.doctor_details: ~4 rows (approximately)
/*!40000 ALTER TABLE `doctor_details` DISABLE KEYS */;
INSERT INTO `doctor_details` (`doctor_id`, `doctor_name`, `doctor_address`, `doctor_contact`, `doctor_status`, `doctor_discount`) VALUES
	(4, 'Dr. Sarana Jeewa', 'NO 998, Kaduwela', '799999999', '2', 2),
	(5, 'Dr. Suwajeewa', 'NO 2, Kaduwela', '2147483647', '2', 50),
	(6, 'Ytg', '						bhgv', 'Fvv', '2', 5),
	(7, 'Dr. Yap', 'San Jose, Antique			', '0976868686', '2', 10);
/*!40000 ALTER TABLE `doctor_details` ENABLE KEYS */;

-- Dumping structure for table yccl.package_category
DROP TABLE IF EXISTS `package_category`;
CREATE TABLE IF NOT EXISTS `package_category` (
  `package_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_code` varchar(50) DEFAULT NULL,
  `package_name` varchar(150) DEFAULT NULL,
  `package_description` varchar(1000) DEFAULT NULL,
  `package_price` double NOT NULL DEFAULT '0',
  `package_createdDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `package_status` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;

-- Dumping data for table yccl.package_category: ~4 rows (approximately)
/*!40000 ALTER TABLE `package_category` DISABLE KEYS */;
INSERT INTO `package_category` (`package_id`, `package_code`, `package_name`, `package_description`, `package_price`, `package_createdDate`, `package_status`) VALUES
	(32, 'PKG0003', 'Package 3', 'Clinical Package Delux', 2002, '2018-10-11 02:41:21', '2'),
	(33, 'PKG0004', 'Package 4', 'Deluxe Package', 300, '2018-10-06 03:05:04', '2'),
	(109, '21', '211212', '21', 21, '2018-10-10 03:41:38', '2'),
	(110, 'asd', 'asd', 'asdasd', 123, '2018-10-10 05:49:15', '2');
/*!40000 ALTER TABLE `package_category` ENABLE KEYS */;

-- Dumping structure for table yccl.package_item
DROP TABLE IF EXISTS `package_item`;
CREATE TABLE IF NOT EXISTS `package_item` (
  `pi_id` int(11) NOT NULL AUTO_INCREMENT,
  `pi_code` varchar(150) DEFAULT NULL,
  `pi_name` varchar(150) DEFAULT NULL,
  `pi_price` varchar(150) DEFAULT NULL,
  `pi_referencerange` varchar(50) DEFAULT NULL,
  `pi_unit` varchar(50) DEFAULT NULL,
  `pi_createdDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pi_status` varchar(1) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=latin1;

-- Dumping data for table yccl.package_item: ~15 rows (approximately)
/*!40000 ALTER TABLE `package_item` DISABLE KEYS */;
INSERT INTO `package_item` (`pi_id`, `pi_code`, `pi_name`, `pi_price`, `pi_referencerange`, `pi_unit`, `pi_createdDate`, `pi_status`, `package_id`) VALUES
	(21, 'LFT', 'ALT', '125', 'U/L	', '250- 450	', '2018-10-06 04:00:39', '2', 33),
	(22, 'T0002', 'Postprandial Blood Glucose	', '200', 'mg/dl', '< 140', '2018-10-06 09:14:38', '2', NULL),
	(23, 'T0001', 'Fasting Blood Sugar', '100', 'mg/dl', '74-100	', '2018-10-06 09:29:22', '2', 0),
	(24, 'T0003', 'Hypersensitive TSH	', '200', 'uIU/ml', '0.34-5.60	', '2018-10-06 09:30:46', '2', 33),
	(25, 'T0003', 'Hypersensitive TSH	', '200', 'uIU/ml', '0.34-5.60	', '2018-10-06 09:32:18', '2', 32),
	(26, 'T0002', 'Postprandial Blood Glucose	', '200', 'mg/dl', '< 140', '2018-10-06 09:32:23', '2', 32),
	(27, 'T0001', 'Fasting Blood Sugar', '100', 'mg/dl', '74-100	', '2018-10-06 09:32:32', '2', 32),
	(30, 'T0002', 'Postprandial Blood Glucose	', '200', 'mg/dl', '< 140', '2018-10-08 17:03:16', '2', 0),
	(31, 'T0001', 'Fasting Blood Sugar', '100', 'mg/dl', '74-100	', '2018-10-08 17:03:27', '2', 0),
	(32, 'T0002', 'Postprandial Blood Glucose	', '200', 'mg/dl', '< 140', '2018-10-08 17:03:54', '2', 0),
	(125, 'T0001', 'Fasting Blood Sugar', '100', 'mg/dl', '74-100	', '2018-10-10 03:37:16', '2', 109),
	(126, 'T0001', 'Fasting Blood Sugar', '100', 'mg/dl', '74-100	', '2018-10-10 05:49:15', '2', 110),
	(127, 'T0003', 'Hypersensitive TSH	', '200', 'uIU/ml', '0.34-5.60	', '2018-10-10 05:49:15', '2', 110),
	(128, 'T0004', 'Mammography', '400', 'U/K', '210-300', '2018-10-10 05:49:15', '2', 110),
	(129, 'T0005', 'Chemotherapeutic Claim', '200.2', 'U/L ', '30-100', '2018-10-10 05:49:15', '2', 110);
/*!40000 ALTER TABLE `package_item` ENABLE KEYS */;

-- Dumping structure for table yccl.patient_package
DROP TABLE IF EXISTS `patient_package`;
CREATE TABLE IF NOT EXISTS `patient_package` (
  `invoice_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `package_code` varchar(50) DEFAULT NULL,
  `package_name` varchar(150) DEFAULT NULL,
  `package_description` varchar(1000) DEFAULT NULL,
  `package_price` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table yccl.patient_package: ~6 rows (approximately)
/*!40000 ALTER TABLE `patient_package` DISABLE KEYS */;
INSERT INTO `patient_package` (`invoice_id`, `package_id`, `package_code`, `package_name`, `package_description`, `package_price`) VALUES
	(14, 32, 'PKG0003', 'Package 3', 'Clinical Package Delux', 2002),
	(14, 109, '21', '211212', '21', 21),
	(19, 32, 'PKG0003', 'Package 3', 'Clinical Package Delux', 2002),
	(19, 109, '21', '211212', '21', 21),
	(20, 32, 'PKG0003', 'Package 3', 'Clinical Package Delux', 2002),
	(20, 33, 'PKG0004', 'Package 4', 'Deluxe Package', 300),
	(21, 33, 'PKG0004', 'Package 4', 'Deluxe Package', 300);
/*!40000 ALTER TABLE `patient_package` ENABLE KEYS */;

-- Dumping structure for table yccl.patient_profile
DROP TABLE IF EXISTS `patient_profile`;
CREATE TABLE IF NOT EXISTS `patient_profile` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_title` varchar(50) DEFAULT NULL,
  `patient_name` varchar(150) DEFAULT NULL,
  `patient_birthdate` date DEFAULT NULL,
  `patient_sex` varchar(50) DEFAULT NULL,
  `patient_contact` varchar(50) DEFAULT NULL,
  `patient_address` varchar(500) DEFAULT NULL,
  `patient_center` varchar(50) DEFAULT NULL,
  `patient_doctor` varchar(50) DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `amount_total` float DEFAULT NULL,
  `amount_net` float DEFAULT NULL,
  `invoice_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Dumping data for table yccl.patient_profile: ~8 rows (approximately)
/*!40000 ALTER TABLE `patient_profile` DISABLE KEYS */;
INSERT INTO `patient_profile` (`invoice_id`, `patient_title`, `patient_name`, `patient_birthdate`, `patient_sex`, `patient_contact`, `patient_address`, `patient_center`, `patient_doctor`, `payment_type`, `amount_total`, `amount_net`, `invoice_date`) VALUES
	(14, 'Mr.', 'Jaden Smith', '2018-10-03', 'Female', '0935468720', 'Eastwood Palm Tree Avenue, Bagumbayan, Quezon City, 1800 Metro Manila', 'Hanwella Medicals', 'Dr. Sarana Jeewa', 'Cash', 2856.2, 2799.08, '2018-10-11 02:22:14'),
	(15, 'Mr.', 'Yy', '2018-10-02', 'Male', '0', 'Eastwood Palm Tree Avenue, Bagumbayan, Quezon City, 1800 Metro Manila', 'Kaduwela Medical', 'Dr. Suwajeewa', 'Cash', 8, 4, '2018-10-11 02:22:14'),
	(16, 'Mr.', 'Jaden Smith', '2018-10-02', 'Male', '0935468720', 'Eastwood Palm Tree Avenue, Bagumbayan, Quezon City, 1800 Metro Manila', 'Kaduwela Medical', 'Dr. Suwajeewa', 'Cash', 8, 4, '2018-10-11 02:22:14'),
	(17, 'Mr.', 'Jerwin H Simon', '1980-10-10', 'Male', '097123132', 'Poblacion', 'Doctors Iloilo', 'Dr. Yap', 'Cash', 100, 90, '2018-10-11 02:35:03'),
	(18, 'Mr.', 'Jerwin H Simon', '1980-10-10', 'Male', '091212313', 'Poblacion', 'Yap Clinical', 'Dr. Yap', 'Cash', 200, 180, '2018-10-11 02:36:39'),
	(19, 'Mrs.', 'Chrystal Gale Alquisada', '1996-11-03', 'Male', '09271804046', 'Eastwood Palm Tree Avenue, Bagumbayan, Quezon City, 1800 Metro Manila', 'Hanwella Medicals', 'Dr. Sarana Jeewa', 'Cash', 3231, 3166.38, '2018-10-11 02:55:56'),
	(20, 'Mr.', 'Benj Mayor', '2018-10-02', 'Male', '0927180923', 'Eastwood Palm Tree Avenue, Bagumbayan, Quezon City, 1800 Metro Manila', 'Hanwella Medicals', 'Dr. Sarana Jeewa', 'Card', 3827.2, 3750.66, '2018-10-11 09:42:35'),
	(21, 'Mr.', 'Lennon Pajar', '2018-10-02', 'Male', '1', 'Burgos Street Lapaz', 'Mission Hospital', 'Dr. Yap', 'Cash', 400, 360, '2018-10-11 10:32:02'),
	(22, 'Mr.', 'sds', '2018-10-03', 'Male', '1', '			1			  		\r\n						  	', 'Hanwella Medicals', 'Dr. Suwajeewa', 'Cash', 125, 62.5, '2018-10-11 10:44:36');
/*!40000 ALTER TABLE `patient_profile` ENABLE KEYS */;

-- Dumping structure for table yccl.patient_test
DROP TABLE IF EXISTS `patient_test`;
CREATE TABLE IF NOT EXISTS `patient_test` (
  `invoice_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `test_code` varchar(50) DEFAULT NULL,
  `test_name` varchar(500) DEFAULT NULL,
  `test_price` double DEFAULT NULL,
  `test_referencerange` varchar(50) DEFAULT NULL,
  `test_unit` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table yccl.patient_test: ~21 rows (approximately)
/*!40000 ALTER TABLE `patient_test` DISABLE KEYS */;
INSERT INTO `patient_test` (`invoice_id`, `test_id`, `test_code`, `test_name`, `test_price`, `test_referencerange`, `test_unit`) VALUES
	(14, 1, 'T0001', 'Fasting Blood Sugar', 100, 'mg/dl', '74-100	'),
	(14, 4, 'LFT', 'ALT', 125, 'U/L	', '250- 450	'),
	(14, 8, 'T0004', 'Mammography', 400, 'U/K', '210-300'),
	(14, 9, 'T0005', 'Chemotherapeutic Claim', 200.2, 'U/L ', '30-100'),
	(14, 11, 'T', 'T', 8, 'T', 'T'),
	(15, 11, 'T', 'T', 8, 'T', 'T'),
	(17, 1, 'T0001', 'Fasting Blood Sugar', 100, 'mg/dl', '74-100	'),
	(18, 2, 'T0002', 'Postprandial Blood Glucose	', 200, 'mg/dl', '< 140'),
	(19, 1, 'T0001', 'Fasting Blood Sugar', 100, 'mg/dl', '74-100	'),
	(19, 2, 'T0002', 'Postprandial Blood Glucose	', 200, 'mg/dl', '< 140'),
	(19, 3, 'T0003', 'Hypersensitive TSH	', 200, 'uIU/ml', '0.34-5.60	'),
	(19, 8, 'T0004', 'Mammography', 400, 'U/K', '210-300'),
	(19, 11, 'T', 'T', 8, 'T', 'T'),
	(19, 12, 'T1001', 'CBC', 300, '70-100', 'mol/ml'),
	(20, 1, 'T0001', 'Fasting Blood Sugar', 100, 'mg/dl', '74-100	'),
	(20, 2, 'T0002', 'Postprandial Blood Glucose	', 200, 'mg/dl', '< 140'),
	(20, 3, 'T0003', 'Hypersensitive TSH	', 200, 'uIU/ml', '0.34-5.60	'),
	(20, 4, 'LFT', 'ALT', 125, 'U/L	', '250- 450	'),
	(20, 8, 'T0004', 'Mammography', 400, 'U/K', '210-300'),
	(20, 9, 'T0005', 'Chemotherapeutic Claim', 200.2, 'U/L ', '30-100'),
	(20, 12, 'T1001', 'CBC', 300, '70-100', 'mol/ml'),
	(21, 1, 'T0001', 'Fasting Blood Sugar', 100, 'mg/dl', '74-100	'),
	(22, 4, 'LFT', 'ALT', 125, 'U/L	', '250- 450	');
/*!40000 ALTER TABLE `patient_test` ENABLE KEYS */;

-- Dumping structure for table yccl.profile_details
DROP TABLE IF EXISTS `profile_details`;
CREATE TABLE IF NOT EXISTS `profile_details` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_code` varchar(50) NOT NULL,
  `profile_name` varchar(150) NOT NULL,
  `profile_status` varchar(1) NOT NULL,
  `profile_price` float NOT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table yccl.profile_details: ~1 rows (approximately)
/*!40000 ALTER TABLE `profile_details` DISABLE KEYS */;
INSERT INTO `profile_details` (`profile_id`, `profile_code`, `profile_name`, `profile_status`, `profile_price`) VALUES
	(1, 'P0001', 'Urine Full Report', '1', 500),
	(9, '12', '21', '2', 12);
/*!40000 ALTER TABLE `profile_details` ENABLE KEYS */;

-- Dumping structure for table yccl.profile_item
DROP TABLE IF EXISTS `profile_item`;
CREATE TABLE IF NOT EXISTS `profile_item` (
  `pi_id` int(11) NOT NULL AUTO_INCREMENT,
  `pi_code` varchar(50) NOT NULL,
  `pi_name` varchar(150) NOT NULL,
  `pi_price` float NOT NULL,
  `pi_referencerange` varchar(50) NOT NULL,
  `pi_unit` varchar(50) NOT NULL,
  `profile_id` int(11) NOT NULL,
  PRIMARY KEY (`pi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table yccl.profile_item: ~8 rows (approximately)
/*!40000 ALTER TABLE `profile_item` DISABLE KEYS */;
INSERT INTO `profile_item` (`pi_id`, `pi_code`, `pi_name`, `pi_price`, `pi_referencerange`, `pi_unit`, `profile_id`) VALUES
	(1, 'T0001', 'Fasting Blood Sugar', 100, 'mg/dl', '74-100	', 1),
	(2, 'T0005', 'Chemotherapeutic Claim', 200.2, 'U/L ', '30-100', 1),
	(10, 'T0002', 'Postprandial Blood Glucose	', 200, 'mg/dl', '< 140', 9),
	(11, 'LFT', 'ALT', 125, 'U/L	', '250- 450	', 9),
	(12, 'T0005', 'Chemotherapeutic Claim', 200.2, 'U/L ', '30-100', 9),
	(13, 'T', 'T', 8, 'T', 'T', 9),
	(14, 'T0002', 'Postprandial Blood Glucose	', 200, 'mg/dl', '< 140', 1),
	(15, 'LFT', 'ALT', 125, 'U/L	', '250- 450	', 1);
/*!40000 ALTER TABLE `profile_item` ENABLE KEYS */;

-- Dumping structure for table yccl.test_details
DROP TABLE IF EXISTS `test_details`;
CREATE TABLE IF NOT EXISTS `test_details` (
  `test_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_code` varchar(50) DEFAULT NULL,
  `test_name` varchar(500) DEFAULT NULL,
  `test_price` double DEFAULT NULL,
  `test_referencerange` varchar(50) DEFAULT NULL,
  `test_unit` varchar(50) DEFAULT NULL,
  `test_createdDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`test_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table yccl.test_details: ~8 rows (approximately)
/*!40000 ALTER TABLE `test_details` DISABLE KEYS */;
INSERT INTO `test_details` (`test_id`, `test_code`, `test_name`, `test_price`, `test_referencerange`, `test_unit`, `test_createdDate`, `status`) VALUES
	(1, 'T0001', 'Fasting Blood Sugar', 100, 'mg/dl', '74-100	', '2018-10-05 23:56:06', '2'),
	(2, 'T0002', 'Postprandial Blood Glucose	', 200, 'mg/dl', '< 140', '2018-10-05 23:56:06', '2'),
	(3, 'T0003', 'Hypersensitive TSH	', 200, 'uIU/ml', '0.34-5.60	', '2018-10-05 23:56:06', '2'),
	(4, 'LFT', 'ALT', 125, 'U/L	', '250- 450	', '2018-10-05 23:57:41', '2'),
	(8, 'T0004', 'Mammography', 400, 'U/K', '210-300', '2018-10-08 22:05:32', NULL),
	(9, 'T0005', 'Chemotherapeutic Claim', 200.2, 'U/L ', '30-100', '2018-10-08 22:07:37', NULL),
	(11, 'T', 'T', 8, 'T', 'T', '2018-10-10 02:39:16', NULL),
	(12, 'T1001', 'CBC', 300, '70-100', 'mol/ml', '2018-10-11 02:40:37', NULL);
/*!40000 ALTER TABLE `test_details` ENABLE KEYS */;

-- Dumping structure for view yccl.view_packagelisting
DROP VIEW IF EXISTS `view_packagelisting`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_packagelisting` (
	`pi_id` INT(11) NOT NULL,
	`pi_code` VARCHAR(150) NULL COLLATE 'latin1_swedish_ci',
	`pi_name` VARCHAR(150) NULL COLLATE 'latin1_swedish_ci',
	`pi_price` VARCHAR(150) NULL COLLATE 'latin1_swedish_ci',
	`pi_referencerange` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`pi_unit` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`pi_createdDate` TIMESTAMP NULL,
	`pi_status` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`package_code` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`package_id` INT(11) NOT NULL,
	`package_name` VARCHAR(150) NULL COLLATE 'latin1_swedish_ci',
	`package_price` DOUBLE NOT NULL,
	`package_status` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view yccl.view_profilelisting
DROP VIEW IF EXISTS `view_profilelisting`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_profilelisting` (
	`profile_code` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`profile_name` VARCHAR(150) NOT NULL COLLATE 'latin1_swedish_ci',
	`profile_status` VARCHAR(1) NOT NULL COLLATE 'latin1_swedish_ci',
	`profile_price` FLOAT NOT NULL,
	`pi_id` INT(11) NOT NULL,
	`pi_code` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`pi_name` VARCHAR(150) NOT NULL COLLATE 'latin1_swedish_ci',
	`pi_price` FLOAT NOT NULL,
	`pi_referencerange` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`pi_unit` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`profile_id` INT(11) NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for view yccl.view_packagelisting
DROP VIEW IF EXISTS `view_packagelisting`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_packagelisting`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_packagelisting` AS SELECT
	package_item.pi_id,
	package_item.pi_code, 
	package_item.pi_name,
	package_item.pi_price,
	package_item.pi_referencerange,
	package_item.pi_unit,	
	package_item.pi_createdDate,
	package_item.pi_status,
	package_category.package_code,
	package_category.package_id,
	package_category.package_name,
	package_category.package_price,
	package_category.package_status
FROM package_category 
INNER JOIN package_item
ON package_item.package_id = package_category.package_id ;

-- Dumping structure for view yccl.view_profilelisting
DROP VIEW IF EXISTS `view_profilelisting`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_profilelisting`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_profilelisting` AS SELECT
	profile_details.profile_code,
	profile_details.profile_name,
	profile_details.profile_status,
	profile_details.profile_price,
	profile_item.pi_id,
	profile_item.pi_code,
	profile_item.pi_name,
	profile_item.pi_price,
	profile_item.pi_referencerange,
	profile_item.pi_unit,
	profile_item.profile_id
FROM profile_details 
INNER JOIN profile_item
ON profile_details.profile_id = profile_item.profile_id ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
