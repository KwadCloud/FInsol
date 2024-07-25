-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 04, 2023 at 07:47 PM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finsolprj_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'administrator@gmail.com', '$2y$10$ljaTKT.GhUT5tKiLt3M/NuJ/gIm1huR1O3lnrP6OUk2A2QZFThHW6', 'ncLfL8X3pFdYHdgcBpuURHO28altcE4IwjVd5dwenQEEy0BGukcQhPoRQgKY', '2023-04-19 13:00:28', '2023-04-19 13:00:28'),
(2, 'Moderator', 'moderator@gmail.com', '$2y$10$2f4NRZSKpjtPpkZm20uCduefIfcyg28pxTC32XMQ8DrxdXFAirUKW', NULL, '2023-04-19 13:00:29', '2023-04-19 13:00:29'),
(3, 'Manager', 'manager@gmail.com', '$2y$10$ZJ71zbyVepI5c/gMx9lpXuiTnCt2fNUwQEqwRRmldWUqqUg65U8LG', NULL, '2023-04-19 13:00:29', '2023-04-19 13:00:29');

-- --------------------------------------------------------

--
-- Table structure for table `copy_of_returns`
--

DROP TABLE IF EXISTS `copy_of_returns`;
CREATE TABLE IF NOT EXISTS `copy_of_returns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_gst_id` int(11) NOT NULL,
  `trade_name` varchar(300) NOT NULL,
  `gst_number` varchar(100) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `month` varchar(30) DEFAULT NULL,
  `quarter` varchar(30) DEFAULT NULL,
  `form_type` varchar(30) DEFAULT NULL,
  `documents` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `copy_of_returns`
--

INSERT INTO `copy_of_returns` (`id`, `user_id`, `user_gst_id`, `trade_name`, `gst_number`, `year`, `month`, `quarter`, `form_type`, `documents`) VALUES
(1, 1, 39, 'laasasd', '123123123123', 2022, NULL, 'Q1', 'GSTR1', 'abcd.jpg'),
(2, 1, 39, 'laasasd', '123123123123', 2023, 'January', 'Q2', 'GSTR2X', '2324.jpg'),
(3, 1, 40, 'laasasd', '123123123123', 2023, 'January', 'Q3', 'GSTR2X', '2325.jpg'),
(4, 1, 40, '', '123131', 2020, 'January', 'Q4', 'GSTR2X', '2323.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_name` longtext NOT NULL,
  `doc_key_name` varchar(100) NOT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `gst_type_val` tinyint(2) NOT NULL,
  `for_partner_director` tinyint(2) DEFAULT '0',
  `for_multiple` varchar(30) DEFAULT NULL,
  `order` tinyint(2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `doc_name`, `doc_key_name`, `filename`, `status`, `gst_type_val`, `for_partner_director`, `for_multiple`, `order`, `updated_at`) VALUES
(1, 'Pan Card', 'pancard_img', NULL, 1, 1, 0, 'GST', NULL, '2023-04-21 18:40:43'),
(2, 'Aadhar Card', 'aadharcard_img', NULL, 1, 1, 0, 'GST', NULL, '2023-04-21 18:48:20'),
(3, 'Voter Id or Passport', 'voterid_or_passport_img', NULL, 1, 1, 0, 'GST', NULL, '2023-04-21 18:52:03'),
(4, 'Driving License', 'drivinglicence_img', NULL, 1, 1, 0, 'GST', NULL, '2023-04-21 18:52:33'),
(5, 'Your Photo', 'userphoto_img', NULL, 1, 1, 0, 'GST', NULL, '2023-04-21 18:53:21'),
(6, 'Rental Agreement', 'rentalagreement_img', NULL, 1, 1, 0, 'GST', NULL, '2023-04-21 18:53:50'),
(7, 'Electricity Bill', 'electricitybill_img', NULL, 1, 1, 0, 'GST', NULL, '2023-04-21 18:54:19'),
(8, 'Muncipal Reciept', 'municipallandreceipt_img', NULL, 1, 1, 0, 'GST', NULL, '2023-04-21 18:54:49'),
(9, 'Aadhar Card of Land Lord', 'aadharpan_landlord_img', NULL, 1, 1, 0, 'GST', NULL, '2023-04-21 18:55:24'),
(10, 'PAN Card', 'p_pancard_img', NULL, 1, 2, 1, 'GST Firm Partner', NULL, '2023-04-22 20:02:14'),
(11, 'Aadhar Card', 'p_aadharcard_img', NULL, 1, 2, 1, 'GST Firm Partner', NULL, '2023-04-22 20:02:38'),
(12, 'Voter ID Card  Passport', 'p_voterid_or_passport_img', NULL, 1, 2, 1, 'GST Firm Partner', NULL, '2023-04-22 20:03:47'),
(13, 'Driving License', 'p_drivinglicence_img', NULL, 1, 2, 1, 'GST Firm Partner', NULL, '2023-04-22 20:04:08'),
(14, 'Photograph', 'p_userphoto_img', NULL, 1, 2, 1, 'GST Firm Partner', NULL, '2023-04-22 20:05:02'),
(15, 'PAN Card', 'pancard_img', NULL, 1, 2, 0, 'GST Firm', NULL, '2023-04-22 20:02:14'),
(16, 'Aadhar Card', 'aadharcard_img', NULL, 1, 2, 0, 'GST Firm', NULL, '2023-04-22 20:02:38'),
(17, 'PAN Card', 'd_pancard_img', NULL, 1, 3, 2, 'GST Company Director', NULL, '2023-04-22 20:02:14'),
(18, 'Aadhar Card', 'd_aadharcard_img', NULL, 1, 3, 2, 'GST Company Director', NULL, '2023-04-22 20:02:38'),
(19, 'Voter ID Card  Passport', 'd_voterid_or_passport_img', NULL, 1, 3, 2, 'GST Company Director', NULL, '2023-04-22 20:03:47'),
(20, 'Driving License', 'd_drivinglicence_img', NULL, 1, 3, 2, 'GST Company Director', NULL, '2023-04-22 20:04:08'),
(21, 'Photograph', 'd_userphoto_img', NULL, 1, 3, 2, 'GST Company Director', NULL, '2023-04-22 20:05:02'),
(22, 'Company PAN Card', 'pancard_img', NULL, 1, 3, 0, 'GST Company', NULL, '2023-04-22 20:02:14'),
(23, 'MOA', 'moa_img', NULL, 1, 3, 0, 'GST Company', NULL, '2023-04-22 20:02:38'),
(24, 'AOA', 'aoa_img', NULL, 1, 3, 0, 'GST Company', NULL, '2023-04-22 20:02:14'),
(25, 'Aadhar Card Or Voter ID Card Or Passport', 'pan_aadhar_voterid_passport_img', 'pan-avp', 1, 4, 0, 'PAN', NULL, '2023-04-25 21:02:48'),
(26, 'Driving Licence', 'pan_driving_license', 'pan-dl', 1, 4, 0, 'PAN', NULL, '2023-04-25 21:03:12'),
(27, 'Photo', 'pan_your_photo', 'pan-userpic', 1, 4, 0, 'PAN', NULL, '2023-04-25 21:03:33'),
(28, 'Aadhar Card Or Voter ID Card Or Passport', 'tan_aadhar_voterid_passport_img', 'tan-avp', 1, 5, 0, 'TAN', NULL, '2023-04-25 21:04:32'),
(29, 'Driving Licence', 'tan_driving_license_img', 'tan-dl', 1, 5, 0, 'TAN', NULL, '2023-04-25 21:05:02'),
(30, 'Photo', 'tan_your_img', 'tan-userpic', 1, 5, 0, 'TAN', NULL, '2023-04-25 21:05:28'),
(31, 'Pan Card', 'tan_pan_img', 'tan-pan', 1, 5, 0, 'TAN', NULL, '2023-04-25 21:06:25'),
(32, 'PAN Card', 'epf_pan_img', 'epf-pan', 1, 6, 0, 'EPF Company', 1, '2023-04-27 22:08:20'),
(33, 'Firm Documents like Deed / MOA & AOA (if applicable)', 'epf_firm_img', 'epf-firm', 1, 6, 0, 'EPF Company', 2, '2023-04-27 22:09:13'),
(34, 'Rent Agreement / Electricity Bill', 'epf_rent_elec_img', 'epf-rent-elec', 1, 6, 0, 'EPF Company', 3, '2023-04-27 22:10:07'),
(35, 'Declaration', 'epf_declaration_img', 'epf-dec', 1, 6, 0, 'EPF Company', 4, '2023-04-27 22:10:43'),
(36, 'KYC of all Employees', 'epf_kyc_img', 'epf-kyc', 1, 6, 0, 'EPF Company', 5, '2023-04-27 22:11:10'),
(37, 'Other registration certificate like GST, ESIC etc. (if applicable)', 'epf_certificate_img', 'epf-certificate', 1, 6, 0, 'EPF Company', 6, '2023-04-27 22:11:46'),
(38, 'Aadhar', 'epf_sign_aadhar_img', 'epf_sign_aadhar', 1, 6, 0, 'EPF Signatory', 1, '2023-04-27 22:47:16'),
(39, 'PAN', 'epf_sign_pan_img', 'epf_sign_pan', 1, 6, 0, 'EPF Signatory', 2, '2023-04-27 22:48:23'),
(40, 'Photo', 'epf_sign_photo_img', 'epf_sign_photo', 1, 6, 0, 'EPF Signatory', 3, '2023-04-27 22:48:28'),
(41, 'Spaceman signature', 'epf_sign_spaceman_img', 'epf_sign_spaceman', 1, 6, 0, 'EPF Signatory', 4, '2023-04-27 22:48:37'),
(42, 'Declaration', 'epf_sign_declare_img', 'epf_sign_declare', 1, 6, 0, 'EPF Signatory', 5, '2023-04-27 22:48:40'),
(43, 'Aadhar', 'epf_oth_aadhar_img', 'epf_oth_aadhar', 1, 6, 0, 'EPF Others', 1, '2023-04-27 22:47:16'),
(44, 'PAN', 'epf_oth_pan_img', 'epf_oth_pan', 1, 6, 0, 'EPF Others', 2, '2023-04-27 22:48:23'),
(45, 'Photo', 'epf_oth_photo_img', 'epf_oth_photo', 1, 6, 0, 'EPF Others', 3, '2023-04-27 22:48:28'),
(46, 'Spaceman signature', 'epf_oth_spaceman_img', 'epf_oth_spaceman', 1, 6, 0, 'EPF Others', 4, '2023-04-27 22:48:37'),
(47, 'PAN Card', 'esic_pan_img', 'esic_pan', 1, 7, 0, 'ESIC Company', 1, '2023-04-27 22:08:20'),
(48, 'Firm Documents like Deed / MOA & AOA (if applicable)', 'esic_firm_img', 'esic_firm', 1, 7, 0, 'ESIC Company', 2, '2023-04-27 22:09:13'),
(49, 'Rent Agreement / Electricity Bill', 'esic_rent_elec_img', 'esic_rent_elec', 1, 7, 0, 'ESIC Company', 3, '2023-04-27 22:10:07'),
(50, 'Declaration', 'esic_declaration_img', 'esic_dec', 1, 7, 0, 'ESIC Company', 4, '2023-04-27 22:10:43'),
(51, 'KYC of all Employees', 'esic_kyc_img', 'esic_kyc', 1, 7, 0, 'ESIC Company', 5, '2023-04-27 22:11:10'),
(52, 'Other registration certificate like GST, ESIC etc. (if applicable)', 'esic_certificate_img', 'esic_certificate', 1, 7, 0, 'ESIC Company', 6, '2023-04-27 22:11:46'),
(53, 'Aadhar', 'esic_sign_aadhar_img', 'esic_sign_aadhar', 1, 7, 0, 'ESIC Signatory', 1, '2023-04-27 22:47:16'),
(54, 'PAN', 'esic_sign_pan_img', 'esic_sign_pan', 1, 7, 0, 'ESIC Signatory', 2, '2023-04-27 22:48:23'),
(55, 'Photo', 'esic_sign_photo_img', 'esic_sign_photo', 1, 7, 0, 'ESIC Signatory', 3, '2023-04-27 22:48:28'),
(56, 'Spaceman signature', 'esic_sign_spaceman_img', 'esic_sign_spaceman', 1, 7, 0, 'ESIC Signatory', 4, '2023-04-27 22:48:37'),
(57, 'Declaration', 'esic_sign_declare_img', 'esic_sign_declare', 1, 7, 0, 'ESIC Signatory', 5, '2023-04-27 22:48:40'),
(58, 'Aadhar', 'esic_oth_aadhar_img', 'esic_oth_aadhar', 1, 7, 0, 'ESIC Others', 1, '2023-04-27 22:47:16'),
(59, 'PAN', 'esic_oth_pan_img', 'esic_oth_pan', 1, 7, 0, 'ESIC Others', 2, '2023-04-27 22:48:23'),
(60, 'Photo', 'esic_oth_photo_img', 'esic_oth_photo', 1, 7, 0, 'ESIC Others', 3, '2023-04-27 22:48:28'),
(61, 'Spaceman signature', 'esic_oth_spaceman_img', 'esic_oth_spaceman', 1, 7, 0, 'ESIC Others', 4, '2023-04-27 22:48:37'),
(62, 'PAN Card', 'trademark_pan_img', 'trademark_pan', 1, 8, 0, 'TRADEMARK Company', 1, '2023-04-27 22:08:20'),
(63, 'Firm Documents like Deed / MOA & AOA (if applicable)', 'trademark_firm_img', 'trademark_firm', 1, 8, 0, 'TRADEMARK Company', 2, '2023-04-27 22:09:13'),
(64, 'Rent Agreement / Electricity Bill', 'trademark_rent_elec_img', 'trademark_rent_elec', 1, 8, 0, 'TRADEMARK Company', 3, '2023-04-27 22:10:07'),
(65, 'Udamy Registration', 'trademark_udamy_img', 'trademark_udamy', 1, 8, 0, 'TRADEMARK Company', 4, '2023-05-01 22:08:10'),
(66, 'Logo', 'trademark_logo_img', 'trademark_logo', 1, 8, 0, 'TRADEMARK Company', 5, '2023-05-01 22:08:12'),
(67, 'Declaration', 'trademark_declaration_img', 'trademark_dec', 1, 8, 0, 'TRADEMARK Company', 6, '2023-04-27 22:10:43'),
(68, 'KYC of all Employees', 'trademark_kyc_img', 'trademark_kyc', 1, 8, 0, 'TRADEMARK Company', 7, '2023-04-27 22:11:10'),
(69, 'Other registration certificate like GST, ESIC etc. (if applicable)', 'trademark_certificate_img', 'trademark_certificate', 1, 8, 0, 'TRADEMARK Company', 8, '2023-04-27 22:11:46'),
(70, 'Aadhar', 'trademark_sign_aadhar_img', 'trademark_sign_aadhar', 1, 8, 0, 'TRADEMARK Signatory', 1, '2023-04-27 22:47:16'),
(71, 'PAN', 'trademark_sign_pan_img', 'trademark_sign_pan', 1, 8, 0, 'TRADEMARK Signatory', 2, '2023-04-27 22:48:23'),
(72, 'Photo', 'trademark_sign_photo_img', 'trademark_sign_photo', 1, 8, 0, 'TRADEMARK Signatory', 3, '2023-04-27 22:48:28'),
(73, 'Spaceman signature', 'trademark_sign_spaceman_img', 'trademark_sign_spaceman', 1, 8, 0, 'TRADEMARK Signatory', 4, '2023-04-27 22:48:37'),
(74, 'Declaration', 'trademark_sign_declare_img', 'trademark_sign_declare', 1, 8, 0, 'TRADEMARK Signatory', 5, '2023-04-27 22:48:40'),
(75, 'Attorney and affidavit (Formet Attached)', 'trademark_signaff_img', 'trademark_sign_aff', 1, 8, 0, 'TRADEMARK Signatory', 6, '2023-05-01 22:27:06'),
(76, 'Aadhar', 'trademark_oth_aadhar_img', 'trademark_oth_aadhar', 1, 8, 0, 'TRADEMARK Others', 2, '2023-04-27 22:47:16'),
(77, 'PAN', 'trademark_pan_img', 'trademark_pan', 1, 8, 0, 'TRADEMARK Others', 3, '2023-04-27 22:48:23'),
(78, 'Photo', 'trademark_oth_photo_img', 'trademark_oth_photo', 1, 8, 0, 'TRADEMARK Others', 4, '2023-04-27 22:48:28'),
(79, 'Spaceman signature', 'trademark_oth_spaceman_img', 'trademark_oth_spaceman', 1, 8, 0, 'TRADEMARK Others', 5, '2023-04-27 22:48:37'),
(80, 'Declaration', 'trademark_declaration_img', 'trademark_dec', 1, 8, 0, 'TRADEMARK Others', 6, '2023-04-27 22:10:43'),
(81, 'Attorney and affidavit (Formet Attached)', 'trademark_aff_img', 'trademark_aff', 1, 8, 0, 'TRADEMARK Others', 7, '2023-04-27 22:11:10'),
(82, 'Other registration certificate like GST, ESIC etc. (if applicable)', 'trademark_certificate_img', 'trademark_certificate', 1, 8, 0, 'TRADEMARK Others', 8, '2023-04-27 22:11:46'),
(83, 'Logo', 'trademark_logo_img', 'trademark_logo', 1, 8, 0, 'TRADEMARK Others', 1, '2023-05-01 22:08:12'),
(84, 'Rent Agreement / Electricity Bill', 'comp_rent_elec_img', 'comp_rent_elec', 1, 9, 0, 'COMPANY', 1, '2023-04-27 22:10:07'),
(85, 'KYC of all Employees', 'comp_kyc_img', 'comp_kyc', 1, 9, 0, 'COMPANY', 2, '2023-04-27 22:11:10'),
(86, 'Other registration certificate like GST, ESIC etc. (if applicable)', 'comp_certificate_img', 'comp_certificate', 1, 9, 0, 'COMPANY', 3, '2023-04-27 22:11:46'),
(87, 'Aadhar', 'comp_sign_aadhar_img', 'comp_sign_aadhar', 1, 9, 0, 'COMPANY Signatory', 1, '2023-04-27 22:47:16'),
(88, 'PAN', 'comp_sign_pan_img', 'comp_sign_pan', 1, 9, 0, 'COMPANY Signatory', 2, '2023-04-27 22:48:23'),
(89, 'Photo', 'comp_sign_photo_img', 'comp_sign_photo', 1, 9, 0, 'COMPANY Signatory', 3, '2023-04-27 22:48:28'),
(90, 'Spaceman signature', 'comp_sign_spaceman_img', 'comp_sign_spaceman', 1, 9, 0, 'COMPANY Signatory', 4, '2023-04-27 22:48:37'),
(91, 'Declaration', 'comp_sign_declare_img', 'comp_sign_declare', 1, 9, 0, 'COMPANY Signatory', 5, '2023-04-27 22:48:40'),
(92, 'Attorney and affidavit (Formet Attached)', 'comp_sign_aff_img', 'comp_sign_aff', 1, 9, 0, 'COMPANY Signatory', 6, '2023-05-01 22:27:06');

-- --------------------------------------------------------

--
-- Table structure for table `gst_form_type`
--

DROP TABLE IF EXISTS `gst_form_type`;
CREATE TABLE IF NOT EXISTS `gst_form_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gst_form_type`
--

INSERT INTO `gst_form_type` (`id`, `type`, `created_at`) VALUES
(1, 'GSTR1', '2023-05-28 13:22:45'),
(2, 'GSTR2A', '2023-05-28 13:22:45'),
(3, 'GSTR2B', '2023-05-28 13:24:06'),
(4, 'GSTR2X', '2023-05-28 13:24:06'),
(5, 'GSTR9', '2023-05-28 13:24:45'),
(6, 'GSTR9C', '2023-05-28 13:24:45');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_admins_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_07_01_060651_create_permission_tables', 1),
(5, '2019_07_19_174507_create_products_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1),
(2, 'App\\Models\\Admin', 2),
(3, 'App\\Models\\Admin', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('blocked','pending','approved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `main_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_admin_id_foreign` (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'admin', '2023-04-19 13:00:28', '2023-04-19 13:00:28'),
(2, 'moderator', 'admin', '2023-04-19 13:00:28', '2023-04-19 13:00:28'),
(3, 'manager', 'admin', '2023-04-19 13:00:28', '2023-04-19 13:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sheela`
--

DROP TABLE IF EXISTS `sheela`;
CREATE TABLE IF NOT EXISTS `sheela` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sheela`
--

INSERT INTO `sheela` (`id`, `name`, `email`, `created_at`, `updated_at`) VALUES
(1, 'dhanvi', 'dhani@gmail.com', '2023-05-17', '2023-05-17'),
(2, 'yashvi', 'yashvi@gmail.com', '2023-05-17', '2023-05-17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','not_active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not_active',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_year` smallint(5) UNSIGNED DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_image_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `status`, `address`, `birth_year`, `image`, `original_image_path`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Parth', 'test@gmail.com', 'active', NULL, NULL, NULL, NULL, NULL, '$2y$10$hSmJ5QD/cdpBlKDWv3p2V.h20riZ0MEi79qzVvhjs/4AHIAd.mFBy', 'vW8KLurBNEJd3GCYPb7DZSx9ILoE0Modv3VylIcUSv7smP1HXpyLvuFZ0WJ4', '2023-04-19 13:00:29', '2023-04-19 13:00:29'),
(3, 'lavanya', 'lavanya@gmail.com', 'active', NULL, NULL, NULL, NULL, NULL, '$2y$10$hSmJ5QD/cdpBlKDWv3p2V.h20riZ0MEi79qzVvhjs/4AHIAd.mFBy', 'syZBZ0wxZ04LtJ9Obd2yx06a0JRFXoBM8kMs8cq5jos6qsxnJVXtoGHFDodB', '2023-04-19 13:00:29', '2023-04-19 13:00:29'),
(4, 'swati', 'swati@gmail.com', 'active', NULL, NULL, NULL, NULL, NULL, '$2y$10$hSmJ5QD/cdpBlKDWv3p2V.h20riZ0MEi79qzVvhjs/4AHIAd.mFBy', 'HJD9NHBG2MnQpdbsFbELLhg4Kef5NZXeLaF0R18yw6tauaSElj3ASnNe6o1T', '2023-04-19 13:00:29', '2023-04-19 13:00:29');

-- --------------------------------------------------------

--
-- Table structure for table `users_company_details`
--

DROP TABLE IF EXISTS `users_company_details`;
CREATE TABLE IF NOT EXISTS `users_company_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name_of_company` varchar(30) NOT NULL,
  `comp_rent_elec_img` longtext,
  `comp_kyc_img` longtext,
  `comp_certificate_img` longtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_company_signatory`
--

DROP TABLE IF EXISTS `users_company_signatory`;
CREATE TABLE IF NOT EXISTS `users_company_signatory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_comp_id` int(11) NOT NULL,
  `comp_sign_email` int(11) NOT NULL,
  `comp_sign_mobile` int(11) NOT NULL,
  `comp_sign_aadhar_img` longtext NOT NULL,
  `comp_sign_pan_img` longtext NOT NULL,
  `comp_sign_photo_img` longtext NOT NULL,
  `comp_sign_spaceman_img` longtext NOT NULL,
  `comp_sign_declare_img` longtext NOT NULL,
  `comp_sign_aff_img` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_directors`
--

DROP TABLE IF EXISTS `users_directors`;
CREATE TABLE IF NOT EXISTS `users_directors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_gst_id` int(11) NOT NULL,
  `director_mobile` varchar(30) NOT NULL,
  `director_email` varchar(30) NOT NULL,
  `d_pancard_img` varchar(300) DEFAULT NULL,
  `d_aadharcard_img` varchar(300) DEFAULT NULL,
  `d_voterid_or_passport_img` varchar(300) DEFAULT NULL,
  `d_drivinglicence_img` varchar(300) DEFAULT NULL,
  `d_userphoto_img` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_directors`
--

INSERT INTO `users_directors` (`id`, `user_id`, `user_gst_id`, `director_mobile`, `director_email`, `d_pancard_img`, `d_aadharcard_img`, `d_voterid_or_passport_img`, `d_drivinglicence_img`, `d_userphoto_img`, `updated_at`) VALUES
(10, 1, 48, '23123123', '234234@eee.com', '1_1_4875.jpg', '', '', '', '', '2023-05-17 12:40:21'),
(9, 1, 48, '123212123123', '123123123@ggg.com', '1_0_4915.jpg,2_0_8521.jpeg', '', '', '', '', '2023-05-17 12:40:21'),
(11, 3, 61, '123456', 'krishna@gmail.com', NULL, NULL, NULL, NULL, NULL, '2023-06-01 03:53:03'),
(12, 4, 74, '123456', 'krishnass@gmail.com', NULL, NULL, NULL, NULL, NULL, '2023-06-01 12:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_epf_details`
--

DROP TABLE IF EXISTS `users_epf_details`;
CREATE TABLE IF NOT EXISTS `users_epf_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `epf_email` varchar(30) DEFAULT NULL,
  `epf_mobile` varchar(30) DEFAULT NULL,
  `epf_type` varchar(30) NOT NULL,
  `epf_pan_img` longtext,
  `epf_firm_img` longtext,
  `epf_rent_elec_img` longtext,
  `epf_declaration_img` longtext,
  `epf_kyc_img` longtext,
  `epf_certificate_img` longtext,
  `epf_oth_pan_img` longtext,
  `epf_oth_aadhar_img` longtext,
  `epf_oth_photo_img` longtext,
  `epf_oth_spaceman_img` longtext,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_epf_details`
--

INSERT INTO `users_epf_details` (`id`, `user_id`, `epf_email`, `epf_mobile`, `epf_type`, `epf_pan_img`, `epf_firm_img`, `epf_rent_elec_img`, `epf_declaration_img`, `epf_kyc_img`, `epf_certificate_img`, `epf_oth_pan_img`, `epf_oth_aadhar_img`, `epf_oth_photo_img`, `epf_oth_spaceman_img`, `created_at`, `updated_at`) VALUES
(11, 1, '12123@gg.com', '9901204610', 'Others', NULL, NULL, NULL, NULL, NULL, NULL, 'epf_oth_pan_1_87501.jpg,epf_oth_pan_2_45531.jpeg', 'epf_oth_aadhar_1_59931.jpg', 'epf_oth_photo_1_45231.jpg,epf_oth_photo_2_44341.jpg', 'epf_oth_spaceman_1_69851.jpg,epf_oth_spaceman_2_85541.jpeg', '2023-05-01 15:13:35', '2023-05-01 15:13:35'),
(10, 1, NULL, NULL, 'Company', 'epf-pan_1_44361.jpg', 'epf-firm_1_51321.jpg,epf-firm_2_45871.jpeg', 'epf-rent-elec_1_79231.jpg', 'epf-dec_1_69841.jpg', 'epf-kyc_1_82261.jpg', 'epf-certificate_1_44181.jpeg', NULL, NULL, NULL, NULL, '2023-05-01 15:12:56', '2023-05-01 15:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `users_epf_signatory`
--

DROP TABLE IF EXISTS `users_epf_signatory`;
CREATE TABLE IF NOT EXISTS `users_epf_signatory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_epf_id` int(11) NOT NULL,
  `epf_sign_mobile` varchar(30) NOT NULL,
  `epf_sign_email` longtext NOT NULL,
  `epf_sign_pan_img` longtext,
  `epf_sign_aadhar_img` longtext,
  `epf_sign_photo_img` longtext,
  `epf_sign_spaceman_img` longtext,
  `epf_sign_declare_img` longtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_epf_signatory`
--

INSERT INTO `users_epf_signatory` (`id`, `user_id`, `user_epf_id`, `epf_sign_mobile`, `epf_sign_email`, `epf_sign_pan_img`, `epf_sign_aadhar_img`, `epf_sign_photo_img`, `epf_sign_spaceman_img`, `epf_sign_declare_img`, `updated_at`) VALUES
(14, 1, 10, '234234234234', '242324@fff.com', 'epf_sign_pan_1_1_6974.jpg', 'epf_sign_aadhar_1_1_7432.jpg,epf_sign_aadhar_2_1_2504.jpeg', 'epf_sign_photo_1_1_3252.jpg', 'epf_sign_spaceman_1_1_5724.jpeg', 'epf_sign_declare_1_1_8713.jpeg', '2023-05-01 15:12:56'),
(13, 1, 10, '1223123213', 'lavanya@gmail.om', 'epf_sign_pan_1_0_4927.jpg,epf_sign_pan_2_0_6538.jpeg', 'epf_sign_aadhar_1_0_5055.jpg', 'epf_sign_photo_1_0_6848.jpg', 'epf_sign_spaceman_1_0_4257.jpg', 'epf_sign_declare_1_0_6374.jpg', '2023-05-01 15:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `users_esic_details`
--

DROP TABLE IF EXISTS `users_esic_details`;
CREATE TABLE IF NOT EXISTS `users_esic_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `esic_email` varchar(30) DEFAULT NULL,
  `esic_mobile` varchar(30) DEFAULT NULL,
  `esic_type` varchar(30) NOT NULL,
  `esic_pan_img` longtext,
  `esic_firm_img` longtext,
  `esic_rent_elec_img` longtext,
  `esic_declaration_img` longtext,
  `esic_kyc_img` longtext,
  `esic_certificate_img` longtext,
  `esic_oth_pan_img` longtext,
  `esic_oth_aadhar_img` longtext,
  `esic_oth_photo_img` longtext,
  `esic_oth_spaceman_img` longtext,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_esic_details`
--

INSERT INTO `users_esic_details` (`id`, `user_id`, `esic_email`, `esic_mobile`, `esic_type`, `esic_pan_img`, `esic_firm_img`, `esic_rent_elec_img`, `esic_declaration_img`, `esic_kyc_img`, `esic_certificate_img`, `esic_oth_pan_img`, `esic_oth_aadhar_img`, `esic_oth_photo_img`, `esic_oth_spaceman_img`, `created_at`, `updated_at`) VALUES
(21, 1, NULL, NULL, 'Company', 'esic_pan_1_72761.jpg', 'esic_firm_1_89431.jpg,esic_firm_2_27751.jpeg', 'esic_rent_elec_1_62731.jpg', 'esic_dec_1_40331.jpg', 'esic_kyc_1_61311.jpg', 'esic_certificate_1_30131.jpg', NULL, NULL, NULL, NULL, '2023-05-01 14:59:37', '2023-05-01 14:59:37'),
(22, 1, '12123@gg.com', '9901204610', 'Others', NULL, NULL, NULL, NULL, NULL, NULL, 'esic_oth_pan_1_77781.jpg', 'esic_oth_aadhar_1_45401.jpg,esic_oth_aadhar_2_50901.jpeg', NULL, NULL, '2023-05-01 15:01:35', '2023-05-01 15:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `users_esic_signatory`
--

DROP TABLE IF EXISTS `users_esic_signatory`;
CREATE TABLE IF NOT EXISTS `users_esic_signatory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_esic_id` int(11) NOT NULL,
  `esic_sign_mobile` varchar(30) NOT NULL,
  `esic_sign_email` longtext NOT NULL,
  `esic_sign_pan_img` longtext,
  `esic_sign_aadhar_img` longtext,
  `esic_sign_photo_img` longtext,
  `esic_sign_spaceman_img` longtext,
  `esic_sign_declare_img` longtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_esic_signatory`
--

INSERT INTO `users_esic_signatory` (`id`, `user_id`, `user_esic_id`, `esic_sign_mobile`, `esic_sign_email`, `esic_sign_pan_img`, `esic_sign_aadhar_img`, `esic_sign_photo_img`, `esic_sign_spaceman_img`, `esic_sign_declare_img`, `updated_at`) VALUES
(22, 1, 21, '123123123', 'Lavanya@fff.com', 'esic_sign_pan_1_0_4045.jpg', 'esic_sign_aadhar_1_0_8390.jpg,esic_sign_aadhar_2_0_6201.jpeg', 'esic_sign_photo_1_0_4070.jpg', 'esic_sign_spaceman_1_0_6129.jpg', 'esic_sign_declare_1_0_8794.jpg,esic_sign_declare_2_0_8065.jpg', '2023-05-01 14:59:37');

-- --------------------------------------------------------

--
-- Table structure for table `users_gst_details`
--

DROP TABLE IF EXISTS `users_gst_details`;
CREATE TABLE IF NOT EXISTS `users_gst_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `gst_number` varchar(30) DEFAULT NULL,
  `email_id` varchar(50) NOT NULL,
  `gst_type` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `mobile_linked_aadhar` varchar(11) DEFAULT NULL,
  `trade_name` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `pancard_img` longtext,
  `aadharcard_img` longtext,
  `voterid_or_passport_img` longtext,
  `drivinglicence_img` longtext,
  `userphoto_img` longtext,
  `rentalagreement_img` longtext,
  `electricitybill_img` longtext,
  `municipallandreceipt_img` longtext,
  `aadharpan_landlord_img` longtext,
  `moa_img` longtext,
  `aoa_img` longtext,
  `status` int(11) DEFAULT '1',
  `admin_note` longtext,
  `user_note` longtext,
  `additional_img` varchar(500) DEFAULT '',
  `approved_img` varchar(300) DEFAULT NULL,
  `raised_img` varchar(500) DEFAULT NULL,
  `last_update_by` varchar(500) DEFAULT '',
  `last_update_by_id` int(11) DEFAULT NULL,
  `gst_id` varchar(100) DEFAULT NULL,
  `gst_password` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_gst_details`
--

INSERT INTO `users_gst_details` (`id`, `user_id`, `gst_number`, `email_id`, `gst_type`, `mobile_linked_aadhar`, `trade_name`, `pancard_img`, `aadharcard_img`, `voterid_or_passport_img`, `drivinglicence_img`, `userphoto_img`, `rentalagreement_img`, `electricitybill_img`, `municipallandreceipt_img`, `aadharpan_landlord_img`, `moa_img`, `aoa_img`, `status`, `admin_note`, `user_note`, `additional_img`, `approved_img`, `raised_img`, `last_update_by`, `last_update_by_id`, `gst_id`, `gst_password`, `created_at`, `updated_at`) VALUES
(48, 1, NULL, 'test@gmail.com', 'Company', NULL, 'company', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'dasdasd', '', '', '', NULL, 'admin', NULL, NULL, NULL, '2023-05-27 15:02:38', '2023-05-27 09:32:38'),
(82, 1, NULL, 'test@gmail.com', 'Individual', NULL, 'Krishna Enterprises112sss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, '2023-06-04 14:04:28', '2023-06-04 14:04:28'),
(56, 1, NULL, 'test12@gmail.com', 'Firm', NULL, 'test trade name', '1_32371.jpg', '1_84011.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, '2023-05-31 08:39:09', '2023-05-31 08:39:09');

-- --------------------------------------------------------

--
-- Table structure for table `users_gst_upload_documents`
--

DROP TABLE IF EXISTS `users_gst_upload_documents`;
CREATE TABLE IF NOT EXISTS `users_gst_upload_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `gst_id` int(11) NOT NULL,
  `doc_type` varchar(30) DEFAULT 'Quarterly',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `documents` varchar(500) NOT NULL,
  `year` int(30) NOT NULL,
  `month` varchar(30) DEFAULT NULL,
  `quarter` varchar(30) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_gst_upload_documents`
--

INSERT INTO `users_gst_upload_documents` (`id`, `user_id`, `gst_id`, `doc_type`, `created_at`, `documents`, `year`, `month`, `quarter`, `status`) VALUES
(1, 1, 49, 'Quarterly', '2023-06-04 10:12:13', '1_85471.png', 2008, NULL, 'January-March', 2),
(2, 1, 49, 'Quarterly', '2023-06-04 10:12:13', '1_85471.png', 2008, NULL, 'January-March', 1),
(3, 1, 49, 'Quarterly', '2023-06-04 10:12:13', '1_85471.png', 2008, NULL, 'January-March', 1),
(4, 1, 49, 'Quarterly', '2023-06-04 10:12:13', '1_85471.png', 2008, NULL, 'January-March', 1),
(5, 1, 49, 'Quarterly', '2023-06-04 10:12:13', '1_85471.png', 2008, NULL, 'January-March', 2),
(6, 1, 49, 'Quarterly', '2023-06-04 10:12:13', '1_85471.png', 2008, NULL, 'January-March', 1),
(7, 1, 49, 'Quarterly', '2023-06-04 10:12:13', '1_85471.png', 2008, NULL, 'January-March', 1),
(8, 1, 49, 'Quarterly', '2023-06-04 10:12:13', '1_85471.png', 2008, NULL, 'January-March', 1),
(9, 1, 49, 'Quarterly', '2023-06-04 10:12:13', '1_85471.png', 2008, NULL, 'January-March', 2),
(10, 1, 49, 'Quarterly', '2023-06-04 10:12:13', '1_85471.png', 2008, NULL, 'January-March', 1),
(11, 1, 49, 'Quarterly', '2023-06-04 10:12:13', '1_85471.png', 2008, NULL, 'January-March', 1),
(12, 1, 49, 'Quarterly', '2023-06-04 10:12:13', '1_85471.png', 2008, NULL, 'January-March', 1),
(13, 1, 49, 'Quarterly', '2023-06-04 10:12:13', '1_85471.png', 2008, NULL, 'January-March', 2),
(14, 1, 49, 'Quarterly', '2023-06-04 10:12:13', '1_85471.png', 2008, NULL, 'January-March', 1),
(15, 1, 49, 'Quarterly', '2023-06-04 10:12:13', '1_85471.png', 2008, NULL, 'January-March', 1),
(16, 1, 49, 'Quarterly', '2023-06-04 10:12:13', '1_85471.png', 2008, NULL, 'January-March', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_pan_details`
--

DROP TABLE IF EXISTS `users_pan_details`;
CREATE TABLE IF NOT EXISTS `users_pan_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mobile_number` varchar(11) NOT NULL,
  `email_id` varchar(300) NOT NULL,
  `pan_aadhar_voterid_passport_img` varchar(300) DEFAULT NULL,
  `pan_driving_license` varchar(300) DEFAULT NULL,
  `pan_your_photo` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_pan_details`
--

INSERT INTO `users_pan_details` (`id`, `user_id`, `mobile_number`, `email_id`, `pan_aadhar_voterid_passport_img`, `pan_driving_license`, `pan_your_photo`, `updated_at`) VALUES
(7, 1, '9901204614', '12123@gg.com', 'pan-avp_1_52351.jpg,pan-avp_2_54361.jpg', 'pan-dl_1_62461.jpg', 'pan-userpic_1_63841.jpg', '2023-05-01 20:54:40');

-- --------------------------------------------------------

--
-- Table structure for table `users_partners`
--

DROP TABLE IF EXISTS `users_partners`;
CREATE TABLE IF NOT EXISTS `users_partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_gst_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `partner_mobile` varchar(30) NOT NULL,
  `partner_email` varchar(30) NOT NULL,
  `p_pancard_img` varchar(300) DEFAULT NULL,
  `p_aadharcard_img` varchar(300) DEFAULT NULL,
  `p_voterid_or_passport_img` varchar(300) DEFAULT NULL,
  `p_drivinglicence_img` varchar(300) DEFAULT NULL,
  `p_userphoto_img` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_partners`
--

INSERT INTO `users_partners` (`id`, `user_gst_id`, `user_id`, `partner_mobile`, `partner_email`, `p_pancard_img`, `p_aadharcard_img`, `p_voterid_or_passport_img`, `p_drivinglicence_img`, `p_userphoto_img`, `updated_at`) VALUES
(34, 63, 4, '132132', '223123@gmail.com', NULL, NULL, NULL, NULL, NULL, '2023-06-01 12:02:09');

-- --------------------------------------------------------

--
-- Table structure for table `users_tan_details`
--

DROP TABLE IF EXISTS `users_tan_details`;
CREATE TABLE IF NOT EXISTS `users_tan_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mobile_number` varchar(11) NOT NULL,
  `email_id` varchar(300) NOT NULL,
  `tan_aadhar_voterid_passport_img` varchar(300) DEFAULT NULL,
  `tan_driving_license_img` varchar(300) DEFAULT NULL,
  `tan_your_img` varchar(300) DEFAULT NULL,
  `tan_pan_img` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_tan_details`
--

INSERT INTO `users_tan_details` (`id`, `user_id`, `mobile_number`, `email_id`, `tan_aadhar_voterid_passport_img`, `tan_driving_license_img`, `tan_your_img`, `tan_pan_img`, `updated_at`) VALUES
(7, 1, '9901204610', 'lucky2@gmail.com', 'tan-avp_1_80251.jpg,tan-avp_2_69241.jpeg', 'tan-dl_1_52561.jpg', NULL, NULL, '2023-05-01 21:24:36');

-- --------------------------------------------------------

--
-- Table structure for table `users_trademark_details`
--

DROP TABLE IF EXISTS `users_trademark_details`;
CREATE TABLE IF NOT EXISTS `users_trademark_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `trademark_email` varchar(30) DEFAULT NULL,
  `trademark_mobile` varchar(30) DEFAULT NULL,
  `trademark_type` varchar(30) NOT NULL,
  `trademark_pan_img` longtext,
  `trademark_firm_img` longtext,
  `trademark_rent_elec_img` longtext,
  `trademark_declaration_img` longtext,
  `trademark_kyc_img` longtext,
  `trademark_certificate_img` longtext,
  `trademark_udamy_img` longtext,
  `trademark_logo_img` longtext,
  `trademark_oth_aadhar_img` longtext,
  `trademark_oth_photo_img` longtext,
  `trademark_oth_spaceman_img` longtext,
  `trademark_aff_img` longtext,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_trademark_details`
--

INSERT INTO `users_trademark_details` (`id`, `user_id`, `trademark_email`, `trademark_mobile`, `trademark_type`, `trademark_pan_img`, `trademark_firm_img`, `trademark_rent_elec_img`, `trademark_declaration_img`, `trademark_kyc_img`, `trademark_certificate_img`, `trademark_udamy_img`, `trademark_logo_img`, `trademark_oth_aadhar_img`, `trademark_oth_photo_img`, `trademark_oth_spaceman_img`, `trademark_aff_img`, `created_at`, `updated_at`) VALUES
(25, 1, NULL, NULL, 'Company', 'trademark_pan_1_59531.jpg', 'trademark_firm_1_44001.jpg,trademark_firm_2_79121.jpg', 'trademark_rent_elec_1_75411.jpg', 'trademark_dec_1_50141.jpg', 'trademark_kyc_1_61941.jpg', 'trademark_certificate_1_48581.jpg', 'trademark_udamy_1_36051.jpg', 'trademark_logo_1_76861.jpg', NULL, NULL, NULL, NULL, '2023-05-02 15:54:12', '2023-05-02 15:54:12'),
(24, 1, '12123@gg.com', '9901204610', 'Others', 'trademark_pan_1_36481.jpg,trademark_pan_2_49131.jpeg', NULL, NULL, 'trademark_dec_1_41471.jpeg', NULL, 'trademark_certificate_1_86311.jpg', NULL, 'trademark_logo_1_49401.jpg', 'trademark_oth_aadhar_1_75221.jpg', 'trademark_oth_photo_1_22081.jpg', 'trademark_oth_spaceman_1_21931.jpg', 'trademark_aff_1_50731.jpg', '2023-05-02 15:49:34', '2023-05-02 15:49:34');

-- --------------------------------------------------------

--
-- Table structure for table `users_trademark_signatory`
--

DROP TABLE IF EXISTS `users_trademark_signatory`;
CREATE TABLE IF NOT EXISTS `users_trademark_signatory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_trademark_id` int(11) NOT NULL,
  `trademark_sign_mobile` varchar(30) NOT NULL,
  `trademark_sign_email` longtext NOT NULL,
  `trademark_sign_pan_img` longtext,
  `trademark_sign_aadhar_img` longtext,
  `trademark_sign_photo_img` longtext,
  `trademark_sign_spaceman_img` longtext,
  `trademark_sign_declare_img` longtext,
  `trademark_signaff_img` longtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_trademark_signatory`
--

INSERT INTO `users_trademark_signatory` (`id`, `user_id`, `user_trademark_id`, `trademark_sign_mobile`, `trademark_sign_email`, `trademark_sign_pan_img`, `trademark_sign_aadhar_img`, `trademark_sign_photo_img`, `trademark_sign_spaceman_img`, `trademark_sign_declare_img`, `trademark_signaff_img`, `updated_at`) VALUES
(23, 1, 25, '432234234', 'asAS@GMAIL.COM', 'trademark_sign_pan_1_0_4199.jpg,trademark_sign_pan_2_0_2058.jpg', 'trademark_sign_aadhar_1_0_8574.jpg', 'trademark_sign_photo_1_0_6468.jpg', 'trademark_sign_spaceman_1_0_5353.jpg', NULL, NULL, '2023-05-02 15:54:12'),
(24, 1, 25, '123123213', '234234@ddd.com', 'trademark_sign_pan_1_1_9000.jpg', 'trademark_sign_aadhar_1_1_4535.jpeg', 'trademark_sign_photo_1_1_3883.jpg', 'trademark_sign_spaceman_1_1_3737.jpg', NULL, NULL, '2023-05-02 15:54:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

DROP TABLE IF EXISTS `user_settings`;
CREATE TABLE IF NOT EXISTS `user_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `value` varchar(30) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_settings`
--

INSERT INTO `user_settings` (`id`, `user_id`, `type`, `value`, `status`) VALUES
(1, 1, 'Upload Document', '1', 1),
(2, 1, 'Upload Document', '2', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
