-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 08:53 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epldt_landers_abandoned_cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `sms_batch_summary`
--

CREATE TABLE `sms_batch_summary` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Journey_Label` varchar(200) DEFAULT NULL,
  `Journey_Date` date DEFAULT NULL,
  `Journey_StartTime` datetime DEFAULT NULL,
  `Journey_EndTime` datetime DEFAULT NULL,
  `Total_Received` int(11) DEFAULT 0,
  `Total_Sent_OK` int(11) DEFAULT 0,
  `Total_Sent_Error` int(11) DEFAULT 0,
  `Journey_File` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sms_batch_summary`
--

INSERT INTO `sms_batch_summary` (`Id`, `Journey_Label`, `Journey_Date`, `Journey_StartTime`, `Journey_EndTime`, `Total_Received`, `Total_Sent_OK`, `Total_Sent_Error`, `Journey_File`) VALUES
(1, 'scs announcement', '2023-05-23', '2023-05-23 14:23:57', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(12, 'Test Batch EOP', '2023-05-31', '2023-05-31 03:29:31', '2023-05-31 03:29:32', 3, 1, 2, 'genlog/_sms_journey_genlog_20230531.txt'),
(13, 'Demo For No Errors', '2023-05-31', '2023-05-31 03:47:15', '2023-05-31 03:47:16', 3, 3, 0, 'genlog/_sms_journey_genlog_20230531.txt'),
(14, 'Solane Batch 1', '2023-06-01', '2023-06-01 17:40:08', '2023-06-01 17:40:13', 10, 10, 0, 'genlog/_sms_journey_genlog_20230601.txt'),
(16, 'Solane Batch 2', '2023-06-01', '2023-06-01 18:10:06', '2023-06-01 18:10:16', 20, 18, 2, 'genlog/_sms_journey_genlog_20230601.txt'),
(17, 'Landers 7th Anniversary', '2023-06-01', '2023-06-01 19:16:09', '2023-06-01 19:16:18', 18, 15, 3, 'genlog/_sms_journey_genlog_20230601.txt'),
(66, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(67, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(68, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(69, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(70, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(71, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(72, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(73, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(74, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(75, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(76, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(77, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(78, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(79, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(80, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(81, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(82, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(83, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(84, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(85, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(86, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(87, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(88, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(89, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(90, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(91, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(92, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(93, 'scs announcement', '2023-05-23', '2023-05-23 14:23:54', '2023-05-23 19:34:28', 948475, 942292, 6183, 'genlog/_sms_journey_genlog_20230523.txt'),
(95, 'Cebu Announcement', '2023-06-01', '2023-06-01 23:13:22', '2023-06-01 23:13:30', 16, 12, 4, 'genlog/_sms_journey_genlog_20230601.txt'),
(96, 'Fairview Opening Announcement', '2023-06-02', '2023-06-02 00:06:06', '2023-06-02 00:06:11', 12, 12, 0, 'genlog/_sms_journey_genlog_20230602.txt'),
(97, 'Test For SendType or SendLabel', '2023-06-05', '2023-06-05 17:09:27', '2023-06-05 17:09:28', 3, 3, 0, 'genlog/_sms_journey_genlog_20230605.txt'),
(98, 'Test Label or Type', '2023-06-05', '2023-06-05 17:17:22', '2023-06-05 17:17:23', 3, 3, 0, 'genlog/_sms_journey_genlog_20230605.txt'),
(99, 'Test Type', '2023-06-05', '2023-06-05 17:24:04', '2023-06-05 17:24:05', 3, 3, 0, 'genlog/_sms_journey_genlog_20230605.txt'),
(100, 'Demo For Sir Kiestle', '2023-06-15', '2023-06-15 16:34:06', '2023-06-15 16:34:15', 19, 16, 3, 'genlog/_sms_journey_genlog_20230615.txt'),
(101, 'welcome sms', '2023-06-28', '2023-06-28 15:58:22', '2023-06-28 17:22:17', 26, 26, 0, '_sms_journey_errors-20230628-welcome_sms.txt'),
(102, 'ecom payday offline', '2023-06-28', '2023-06-28 10:22:35', '2023-06-28 14:22:12', 584579, 584578, 1, '_sms_journey_errors-20230628-ecom_payday_offline.txt'),
(103, 'ecom payday online', '2023-06-28', '2023-06-28 10:20:26', '2023-06-28 10:51:11', 73707, 73641, 66, '_sms_journey_errors-20230628-ecom_payday_online.txt');

-- --------------------------------------------------------

--
-- Table structure for table `sms_template`
--

CREATE TABLE `sms_template` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Template_Number` tinyint(3) UNSIGNED DEFAULT NULL,
  `Template_Title` text DEFAULT NULL,
  `Message_Type` char(1) DEFAULT NULL,
  `Message_Body` text DEFAULT NULL,
  `Is_Tested` tinyint(3) UNSIGNED DEFAULT 0,
  `CreatedDate` datetime DEFAULT NULL,
  `LastModifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sms_template`
--

INSERT INTO `sms_template` (`Id`, `Template_Number`, `Template_Title`, `Message_Type`, `Message_Body`, `Is_Tested`, `CreatedDate`, `LastModifiedDate`) VALUES
(1, 1, 'Birthday Greeting', 'P', 'Dear <custom1>. You’re in for a SUPER celebration on your birthday month this 2022 because we’re treating you to 50% OFF on our membership renewal fees and 30% OFF on either our chocolate or vanilla Dough & Co. cake! CHECK OUT MECHANICS BELOW ON HOW YOU CAN ENJOY YOUR BIRTHDAY AT LANDERS:\r\n\r\n1. This promo will run in-store from January 1 to December 31, 2022\r\n2. Active members can get 50% OFF on renewal fees (P400 for Premium and P500 for Business) on their birthday month.\r\n3. They can also get a Dough & Co. Vanilla or Chocolate Birthday Cake at 30% OFF or only P258.83 on their birthday month.\r\n4. Extension members are not eligible for this promo.\r\n5. Availing of the birthday cake is limited to one (1) cake per day per 1234567890123451234567890123456789011\r\n1. This promo will run in-store from January 1 to December 31, 2022\r\n2. Active members can get 50% OFF on renewal fees (P400 for Premium and P500 for\r ... truncated here ...', 1, '2023-05-01 19:01:40', '2023-06-01 17:43:16'),
(2, 2, 'DFS', 'S', 'Enjoy twice the fuel savings every Tuesday because it\'s DOUBLE FUEL COUPON day! Just spend a minimum of P4,000 in-store or at www.landers.ph to qualify for this deal.', 1, '2023-05-01 19:02:09', NULL),
(3, 3, 'Solane', 'P', 'Dear <custom1>, \r\nwe\'ve got one more surprise for you this Super Crazy Sale! Solane LPG tanks are on sale at 50% OFF in-store & at www.landers.ph from April 10 to 15! Have great cook-outs with friends and family this summer. Shop now! 1 tank per member only!\r\nwe\'ve got one more surprise for you this Super Crazy Sale! Solane LPG tanks are on sale at 50% OFF in-store & at www.landers.ph from April 10 to 15! Have great cook-outs with friends and family this summer. Shop now! 1 tank per member only!\r\nwe\'ve got one more surprise for you this Super Crazy Sale! Solane LPG tanks are on sale at 50% OFF in-store & at www.landers.ph from April 10 to 15! Have great cook-outs with friends and family this summer. Shop now! 1 tank per member only!\r\nwe\'ve got one more surprise for you this Super Crazy Sale! Solane LPG tanks are on sale at 50% OFF in-store & at www.landers.ph from April 10 to 15! Have great cook-outs with ... truncated here ...', 0, '2023-05-01 19:02:23', NULL),
(4, 4, 'Membership Renewal Reminder', 'P', 'Dear <custom1>, renew your membership 90 days before expiration here: https://landers.ph/lofcustomermembership/buy to avoid shopping hassle!', 1, '2023-05-01 19:02:34', NULL),
(5, 5, 'SMS For Chaio Only', 'S', 'Hi Chaio! How is the testing of your SMS blast using PHP in GCP2? Adding more to message body. Adding another line.', 1, '2023-05-01 19:02:46', NULL),
(6, 6, 'Welcome SMS Message Template', 'P', 'Hi <custom1>, Welcome to Landers. Thank you for the registration. If you haven\'t claimed your Membership Card <custom2>, we would like you to claim it already so you can enjoy the benefits of shopping with Landers. Come to our store nearest you and have a free cup of coffee on your first visit..', 1, '2023-05-01 19:02:58', '2023-07-27 14:07:39'),
(7, 7, 'Demo SMS Message Template', 'S', 'Hi. We are now offering a 50% discount on membership renewal. Happy Birthday!', 1, '2023-05-01 19:03:09', NULL),
(8, 8, 'Lorem Ipsum', 'P', 'Dear <custom1>, \r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, '2023-05-01 19:03:19', NULL),
(9, 9, 'Abandoned Cart SMS Message', 'P', 'Hi <custom1>. We noticed that you have abandoned your cart. That is not allowed! hahahaha', 1, '2023-05-01 19:03:34', NULL),
(10, 10, 'Claim Card First Reminder', 'P', 'Dear <custom1>, we would like to reminder you to claim your Membership Card in the any Landers Store near you. Thank you!', 1, '2023-05-01 19:03:43', NULL),
(11, 11, 'Claimed Card Thank You', 'P', 'Dear <custom1>, thank you for claiming your card.', 1, '2023-05-01 19:03:56', NULL),
(12, 12, 'Second Claim Card Reminder', 'P', 'Dear <custom1>, we would like to inform you that we have an ongoing promo in store. Claim your card and Shop now!', 1, '2023-05-01 19:04:04', NULL),
(13, 13, 'Three Months Before Expiry', 'P', 'Dear <custom1>, your Membership is about to expire in 3 months. To be able to continue enjoying the benefits of shopping with Landers, you can do an early renewal. Your remaining months will be added to the new expiry date. Thank you..', 1, '2023-05-01 19:04:18', NULL),
(14, 14, 'Renewal Reminder', 'P', 'Dear <custom1>, you have 2 months more to go before expiration. Please make an early renewal to continue enjoying your shopping benefits. Thank you.', 0, '2023-05-01 19:04:26', NULL),
(15, 15, 'Renewal Reminder - Last Month', 'P', 'Dear <custom1>, you have one more month to go before your Membership expires. We really hope that you could renew your Membership either in-store or online at https://Landers.ph. Thank you.', 1, '2023-05-01 19:04:34', NULL),
(16, 16, 'Testing Only', 'S', 'This is a test template!..', 0, '2023-05-01 19:04:41', NULL),
(17, 17, 'Another Test Template', 'P', 'Hi <custom1>, this is another test template.', 0, '2023-05-01 19:04:48', NULL),
(18, 18, 'Promo to Claim the Card', 'P', 'Dear <custom1>, You may claim your card and use the promo CLAIMED.', 1, '2023-05-01 19:05:04', NULL),
(19, 19, 'First Visit Reminder', 'P', 'Dear <custom1>, we would like to remind you to visit and shop at any landers store near you.', 1, '2023-05-01 19:05:11', NULL),
(20, 21, 'Promo to Visit Store', 'P', 'Dear <custom1>, You may shop and use your promo code SHOPPING for 10% discount.', 1, '2023-05-01 19:05:25', NULL),
(21, 20, 'Second Visit Reminder', 'P', 'Dear <custom1>, we would like to remind you to visit  and shop any landers store near you. Happy Shopping!', 1, '2023-05-01 19:05:55', NULL),
(22, 25, 'Customer Survey', 'S', 'Hi, Your response is important to use. Please click below to answer the survey. https://epldtinc-c-dev-ed.develop.my.site.com/portal/survey/runtimeApp.app?invitationId=0Ki2w000000ZYLR&surveyName=customer_survey&UUID=de39d64b-62be-49f4-a68d-6b8c28f900e3. Thank you!', 1, '2023-05-23 14:43:58', '2023-05-23 14:44:27'),
(23, 26, 'Test SMS Opted Out', 'P', 'Hi <custom1>, Kindly confirm with edelyn if you received this test sms. Thank you', 0, '2023-06-06 14:10:16', NULL),
(24, 27, 'SMS Template 1', 'S', 'Hello, It\'s our pleasure to serve you. We, the Salesforce associates as a worldwide and proliferate industry. We are a customer related establishment, as we put our customers at the center of everything we do.', 1, '2023-06-09 16:41:58', '2023-06-11 15:53:28'),
(25, 28, 'Onboarding', 'P', 'Hi <custom1>, welcome to landers. This is your card number <custom2>, you may claim in any landers store near you.', 0, '2023-07-26 22:31:51', NULL),
(26, 29, 'Onboarding SMS', 'P', 'Dear <custom1>, Welcome to Landers! Your card ending in <custom2> is now available for pick-up at any Landers store.\r\n\r\nThis is a test only by Edelyn.', 1, '2023-07-27 14:15:06', '2023-07-27 14:16:57'),
(27, 30, 'Holiday', 'S', 'Happy Holiday! \r\nFrom Cloud Business Apps Family', 1, '2023-11-09 10:05:39', '2023-11-09 10:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `Parameter` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Description` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `Value` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `Is_Active` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `Last_Modified_By` varchar(50) DEFAULT NULL,
  `Last_Modified_Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`Parameter`, `Description`, `Value`, `Is_Active`, `Last_Modified_By`, `Last_Modified_Date`) VALUES
('EMAIL_ADDRESS_ADMIN', 'Email address of Membership Desk Administrator', 'ntolabing@epldt.com', 1, NULL, NULL),
('MC_ACCOUNT_ID', NULL, '546001205', 1, NULL, NULL),
('MC_API_CLIENTID', NULL, '0ajwi9avmyz0xfawac8d6scs', 1, NULL, NULL),
('MC_API_CLIENTSECRET', NULL, 'N3IlHfRJGSiWJ2dZt04XbXAV', 1, NULL, NULL),
('SF_CRED_PASSWORD', 'Login credential used by super admin when APIs not available', 'S@l3sf0rc3!11', 1, 'Nasario Tolabing', NULL),
('SF_CRED_USERNAME', 'Login credential used by super admin when APIs not available', 'ntolabing@landersdev.com', 1, NULL, NULL),
('SF_CRED_USERTOKEN', 'Login credential used by super admin when APIs not available', 'on0tr1kAqZrYxBNFP4melFr1f', 1, 'Nasario Tolabing', NULL),
('SMS_CRED_PASSWORD', 'SMS provider account password', '0T!sLNdr', 1, 'Nasario Tolabing', NULL),
('SMS_CRED_USERNAME', 'SMS provider account name/id', 'lndsysad@landers.ph', 1, 'Nasario Tolabing', NULL),
('SMS_URL_BATCH_SEND', 'SMS Batch Send endpoint URL', 'https://messagingsuite.smart.com.ph/cgphttp/servlet/sendbatch', 1, 'Nasario Tolabing', NULL),
('SMS_URL_BATCH_START', 'SMS Batch Start endpoint URL', 'https://messagingsuite.smart.com.ph/cgphttp/servlet/startbatch', 1, 'Nasario Tolabing', NULL),
('SMS_URL_SEND', 'SMS Send (without template) URL', 'https://messagingsuite.smart.com.ph/cgphttp/servlet/sendmsg', 1, 'Nasario Tolabing', NULL),
('SYSTEM_ENVIRONMENT', 'Can be TEST, PLAY or PROD', 'PLAY', 1, 'Nasario Tolabing', NULL),
('TEST_SMS_CONTENT', 'Content for SMS system test', 'Test SMS message from GCP2!', 1, NULL, NULL),
('TEST_SMS_NUMBER', 'SMS number for message testing', '639190618631', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sms_batch_summary`
--
ALTER TABLE `sms_batch_summary`
  ADD PRIMARY KEY (`Id`) USING BTREE,
  ADD KEY `Journey_Label` (`Journey_Label`) USING BTREE;

--
-- Indexes for table `sms_template`
--
ALTER TABLE `sms_template`
  ADD PRIMARY KEY (`Id`) USING BTREE,
  ADD KEY `Template_Number` (`Template_Number`) USING BTREE;

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`Parameter`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sms_batch_summary`
--
ALTER TABLE `sms_batch_summary`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `sms_template`
--
ALTER TABLE `sms_template`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
