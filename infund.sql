-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2024 at 02:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infund`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `BankCode` varchar(10) DEFAULT NULL,
  `BankName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`BankCode`, `BankName`) VALUES
('110072', '78 FINANCE COMPANY LIMITED (BANK78)'),
('110005', '3LINE CARD MANAGEMENT LIMITED'),
('120001', '9 PAYMENT SOLUTIONS BANK'),
('050005', 'AAA FINANCE AND INVESTMENT COMPANY LIMITED'),
('090270', 'AB MICROFINANCE BANK'),
('070010', 'ABBEY MORTGAGE BANK'),
('090260', 'ABOVE ONLY MICROFINANCE BANK'),
('090197', 'ABU MICROFINANCE BANK'),
('090545', 'ABULESORO MICROFINANCE BANK'),
('090202', 'ACCELEREX NETWORK LIMITED'),
('000014', 'ACCESS BANK'),
('100013', 'ACCESS MONEY'),
('100052', 'ACCESS YELLO & BETA'),
('000005', 'ACCESS(DIAMOND) BANK'),
('090134', 'ACCION MICROFINANCE BANK'),
('000109', 'ADA MICROFINANCE BANK'),
('090160', 'ADDOSSER MICROFINANCE BANK'),
('090268', 'ADEYEMI COLLEGE STAFF MICROFINANCE BANK'),
('090155', 'ADVANS LA FAYETTE  MICROFINANCE BANK'),
('090292', 'AFEKHAFE MICROFINANCE BANK'),
('100028', 'AG MORTGAGE BANK'),
('090371', 'AGOSASA MICROFINANCE BANK'),
('090531', 'AKU MICROFINANCE'),
('090561', 'AKUCHUKWU MICROFINANCE BANK'),
('090133', 'AL-BARAKAH MICROFINANCE BANK'),
('090259', 'ALEKUN MICROFINANCE BANK'),
('090297', 'ALERT MICROFINANCE BANK'),
('090277', 'AL-HAYAT MICROFINANCE BANK'),
('090131', 'ALLWORKERS MICROFINANCE BANK'),
('090548', 'ALLY MICROFINANCE BANK'),
('090169', 'ALPHA KAPITAL MICROFINANCE BANK'),
('000037', 'ALTERNATIVE BANK LIMITED'),
('090489', 'ALVANA MICROFINANCE BANK'),
('090394', 'AMAC MICROFINANCE BANK'),
('090629', 'AMEGY MICROFINANCE BANK'),
('090180', 'AMJU UNIQUE MICROFINANCE BANK'),
('090116', 'AMML MICROFINANCE BANK'),
('090529', 'AMPERSAND MICROFINANCE BANK (BANKLY)'),
('090645', 'AMUCHA MICROFINANCE BANK'),
('090476', 'ANCHORAGE MICROFINANCE BANK'),
('090143', 'APEKS MICROFINANCE BANK'),
('090376', 'APPLE MICROFINANCE BANK'),
('090282', 'ARISE MICROFINANCE BANK'),
('090001', 'ASO SAVINGS'),
('090544', 'ASPIRE MICROFINANCE BANK'),
('090287', 'ASSETMATRIX MICROFINANCE BANK'),
('090172', 'ASTRAPOLARIS MICROFINANCE BANK'),
('090451', 'ATBU MICROFINANCE BANK'),
('090633', 'AWACASH MICROFINANCE BANK'),
('090264', 'AUCHI MICROFINANCE BANK'),
('090478', 'AVUENEGBE MICROFINANCE BANK'),
('090625', 'BABURA MICROFINANCE BANK'),
('090188', 'BAINES CREDIT MICROFINANCE BANK'),
('090563', 'BALERA MICROFINANCE BANK'),
('090181', 'BALOGUN FULANI MICROFINANCE BANK'),
('090326', 'BALOGUN GAMBARI MICROFINANCE BANK'),
('090581', 'BANC CORP MICROFINANCE BANK'),
('090425', 'BANEX MICROFINANCE BANK'),
('000107', 'BAOBAB MICROFINANCE BANK'),
('090316', 'BAYERO UNIVERSITY MICROFINANCE BANK'),
('090127', 'BC KASH MICROFINANCE BANK'),
('090618', 'BERACHAH MICROFINANCE BANK'),
('090615', 'BESTSTAR MICROFINANCE BANK'),
('090336', 'BIPC MICROFINANCE BANK'),
('090555', 'BISHOPGATE MICROFINANCE BANK'),
('090117', 'BOCTRUST MICROFINANCE BANK LIMITED'),
('090444', 'BOI MICROFINANCE BANK'),
('090319', 'BONGHE MICROFINANCE BANK'),
('090395', 'BORGU  MICROFINANCE BANK'),
('090454', 'BORSTAL MICROFINANCE BANK'),
('090176', 'BOSAK MICROFINANCE BANK'),
('090148', 'BOWEN MICROFINANCE BANK'),
('050006', 'BRANCH INTERNATIONAL FINANCIAL SERVICES'),
('070015', 'BRENT MORTGAGE BANK'),
('090293', 'BRETHREN MICROFINANCE BANK'),
('090393', 'BRIDGEWAY MICROFINANACE BANK'),
('090308', 'BRIGHTWAY MICROFINANCE BANK'),
('090568', 'BROADVIEW MICROFINANCE BANK'),
('090661', 'BUNDI MICROFINANCE BANK'),
('090655', 'BUNKURE MICROFINANCE BANK'),
('090406', 'BUSINESS SUPPORT MICROFINANCE BANK'),
('090415', 'CALABAR MICROFINANCE BANK'),
('090647', 'CANAAN MICROFINANCE BANK'),
('090445', 'CAPSTONE MICROFINANCE BANK'),
('100026', 'CARBON'),
('090634', 'CASHBRIDGE MICROFINANCE BANK'),
('090360', 'CASHCONNECT MICROFINANCE BANK'),
('090649', 'CASHRITE MICROFINANCE BANK'),
('090498', 'CATLAND MICROFINANCE BANK'),
('090562', 'CEDAR MICROFINANCE BANK'),
('100005', 'CELLULANT'),
('090154', 'CEMCS MICROFINANCE BANK'),
('000028', 'CENTRAL BANK OF NIGERIA'),
('100015', 'CHAMS MOBILE'),
('090397', 'CHANELLE MICROFINANCE BANK'),
('090470', 'CHANGHAN RTS MICROFINANCE BANK'),
('090440', 'CHERISH MICROFINANCE BANK'),
('090416', 'CHIBUEZE MICROFINANCE BANK'),
('090141', 'CHIKUM MICROFINANCE BANK'),
('090490', 'CHUKWUNENYE MICROFINANCE BANK'),
('090144', 'CIT MICROFINANCE BANK'),
('000009', 'CITI BANK'),
('090254', 'COALCAMP MICROFINANCE BANK'),
('090374', 'COASTLINE MICROFINANCE BANK'),
('090530', 'CONFIDENCE MICROFINANCE BANK'),
('090553', 'CONSISTENT TRUST MICROFINANCE BANK'),
('090130', 'CONSUMER MICROFINANCE BANK'),
('070021', 'COOPERATIVE MORTGAGE BANK'),
('090365', 'CORESTEP MICROFINANCE BANK'),
('060001', 'CORONATION MERCHANT BANK'),
('050001', 'COUNTY FINANCE LIMITED'),
('070006', 'COVENANT MFB'),
('090159', 'CREDIT AFRIQUE MICROFINANCE BANK'),
('090611', 'CREDITVILLE MICROFINANCE BANK'),
('090526', 'CRESCENT MICROFINANCE BANK'),
('090429', 'CROSS RIVER MICROFINANCE BANK'),
('110017', 'CROWDFORCE MICROFINANCE BANK'),
('090414', 'CRUTECH MICROFINANCE BANK'),
('050017', 'CS ADVANCE FINANCE COMPANY LIMITED'),
('110014', 'CYBERSPACE LIMITED'),
('090596', 'DAL MICROFINANCE BANK'),
('090391', 'DAVODANI  MICROFINANCE BANK'),
('090167', 'DAYLIGHT MICROFINANCE BANK'),
('070023', 'DELTA TRUST MORTGAGE BANK'),
('050013', 'DIGNITY FINANCE AND INVESTMENT LIMITED'),
('090643', 'DIOBU MICROFINANCE BANK'),
('090294', 'EAGLE FLIGHT MICROFINANCE BANK'),
('100021', 'EARTHOLEUM'),
('090156', 'E-BARCS MICROFINANCE BANK'),
('050016', 'E-FINANCE'),
('090427', 'EBONYI STATE MICROFINANCE BANK'),
('000010', 'ECOBANK'),
('100008', 'ECOBANK XPRESS ACCOUNT'),
('100030', 'ECOMOBILE'),
('090310', 'EDFIN MICROFINANCE BANK'),
('090097', 'EKONDO MICROFINANCE BANK'),
('090389', 'EK-RELIABLE MICROFINANCE BANK'),
('090273', 'EMERALD MICROFINANCE BANK'),
('090114', 'EMPIRE TRUST MICROFINANCE BANK'),
('050012', 'ENCO FINANCE COMPANY LTD'),
('000019', 'ENTERPRISE BANK'),
('090656', 'ENTITY MICROFINANCE BANK'),
('090189', 'ESAN MICROFINANCE BANK'),
('090166', 'ESO-E MICROFINANCE BANK'),
('100006', 'eTRANZACT'),
('090572', 'EWT Microfinance Bank'),
('090304', 'EVANGEL MICROFINANCE BANK'),
('090332', 'EVERGREEN MICROFINANCE BANK'),
('090541', 'EXCELLENT MICROFINANCE BANK'),
('090328', 'EYOWO'),
('090551', 'FairMoney'),
('090330', 'FAME MICROFINANCE BANK'),
('050009', 'FAST CREDIT LIMITED'),
('090179', 'FAST MICROFINANCE BANK'),
('060002', 'FBNQUEST MERCHANT BANK'),
('100031', 'FCMB MOBILE'),
('090290', 'FCT MICROFINANCE BANK'),
('090398', 'FEDERAL POLYTECHNIC NEKEDE MICROFINANCE BANK'),
('090318', 'FEDERAL UNIVERSITY DUTSE MICROFINANCE BANK'),
('090184', 'FEDERAL UNIVERSITY OF TECHNOLOGY MICROFINANCE BANK (FUT MINNA)'),
('090402', 'FEDPONEK MICROFINANCE BANK'),
('090190', 'FEL MICROFINANCE BANK'),
('000007', 'FIDELITY BANK'),
('090354', 'FIDELITY MOBILE'),
('090532', 'FINATRUST MICROFINANCE BANK'),
('090164', 'FIRST CAPITAL MICROFINANCE BANK'),
('090151', 'FIRST GENERATION MORTGAGE BANK'),
('000016', 'FIRST BANK OF NIGERIA'),
('100014', 'FIRST MONIE'),
('070009', 'FIRST TRUST MORTGAGE BANK PLC'),
('090234', 'FIRSTPLUS MICROFINANCE BANK'),
('090347', 'FIRSTROYAL MICROFINANCE BANK'),
('090324', 'FITC MICROFINANCE BANK'),
('000008', 'FIRST CITY MONUMENT BANK'),
('100031', 'FCMB MOBILE'),
('090514', 'FITY TRUST MICROFINANCE BANK'),
('000004', 'GT BANK PLC'),
('090281', 'GTI MICROFINANCE BANK'),
('090297', 'HAGGAI MICROFINANCE BANK'),
('000027', 'HERITAGE BANK'),
('070007', 'IMPERIAL HOMES MORTGAGE BANK'),
('100002', 'INTERSWITCH PAYMATE'),
('050011', 'IAPAGE FINANCE'),
('100019', 'iPARTNER SQUAD'),
('000001', 'ACCESS DIAMOND'),
('110005', 'ITEX TERMINALS'),
('100001', 'ACCESS MOBILE'),
('070005', 'ASPIRE MFB'),
('100011', 'PAGA'),
('110013', 'MONIEPOINT BANK'),
('090278', 'KAPITAL MICROFINANCE BANK'),
('110017', 'OKRIKA MICROFINANCE BANK'),
('090246', 'POLARIS BANK'),
('090399', 'PROVIDENCE BANK'),
('090625', 'UNITY BANK PLC');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `university` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `department` varchar(1000) NOT NULL,
  `level` varchar(255) NOT NULL,
  `matric_no` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `creator_id`, `name`, `university`, `faculty`, `department`, `level`, `matric_no`, `price`, `start_date`, `end_date`, `created_at`) VALUES
(1, 1, 'Programming Fundamentals Handbook', 'FUNAAB', 'Engineering', 'Mathematics', '100', 'ALL', 15000.00, '2024-01-01', '2024-11-30', '2024-01-01 09:00:00'),
(2, 2, 'Data Structures Manual', 'FUNAAB', 'Engineering', 'Computer Science', '100', 'ALL', 12000.00, '2024-01-01', '2024-11-25', '2024-01-01 09:00:00'),
(3, 1, 'Database Systems Guide', 'FUNAAB', 'Engineering', 'Mathematics', '100', 'ALL', 18000.00, '2024-01-01', '2024-12-15', '2024-01-01 09:00:00'),
(4, 3, 'Software Engineering Project Guide', 'FUNAAB', 'Engineering', 'Mathematics', '100', 'ALL', 20000.00, '2024-01-01', '2024-12-01', '2024-01-01 09:00:00'),
(5, 2, 'Computer Networks Manual', 'FUNAAB', 'Engineering', 'Mathematics', '100', 'ALL', 16500.00, '2024-01-01', '2024-11-20', '2024-01-01 09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bill_invoice`
--

CREATE TABLE `bill_invoice` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `bill_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `reference_id` varchar(1000) NOT NULL,
  `gateway_reference` varchar(200) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('Pending','Paid','Cancelled') DEFAULT 'Pending',
  `got_funded` enum('True','False') DEFAULT 'False',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill_invoice`
--

INSERT INTO `bill_invoice` (`id`, `name`, `bill_id`, `uid`, `reference_id`, `gateway_reference`, `due_date`, `total_amount`, `status`, `got_funded`, `created_at`, `updated_at`) VALUES
(2, 'Software Engineering Project Guide', 4, 3, 'FUNAAB-0CD-08D-BC1-8', 'P-C-20241114-FMWH1JCTB4', '2024-12-01', 20000.00, 'Paid', 'False', '2024-11-14 22:57:15', '2024-11-14 22:57:39'),
(3, 'Programming Fundamentals Handbook', 1, 3, 'FUNAAB-9C6-E8F-BC9-2', 'P-C-20241115-NFRG7A9DTQ', '2024-11-30', 15000.00, 'Paid', 'False', '2024-11-14 23:03:32', '2024-11-15 00:32:35'),
(4, 'Data Structures Manual', 2, 4, 'FUNAAB-23D-416-3CA-B', 'P-C-20241115-RB5UDSJG3L', '2024-11-25', 12000.00, 'Paid', 'False', '2024-11-15 01:19:31', '2024-11-15 01:19:54');

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `impact` text DEFAULT NULL,
  `importance` text DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `goal_amount` decimal(15,2) NOT NULL,
  `amount_raised` decimal(15,2) DEFAULT 0.00,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','completed','cancelled') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image1` varchar(1000) NOT NULL,
  `image2` varchar(1000) DEFAULT NULL,
  `image3` varchar(1000) DEFAULT NULL,
  `image4` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `title`, `description`, `impact`, `importance`, `uid`, `goal_amount`, `amount_raised`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`, `image1`, `image2`, `image3`, `image4`) VALUES
(1, 'Lorel Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sapien est, interdum sed aliquam non, tempus sit amet elit. Aenean non tristique felis. Aliquam efficitur euismod arcu, eget finibus turpis aliquam at. In hac habitasse platea dictumst. Integer semper hendrerit diam, quis dictum erat scelerisque eget. Morbi malesuada sapien at urna dictum, ut varius ligula porta. Proin sodales, leo nec pellentesque finibus, ex tortor hendrerit sem, sit amet pulvinar nibh nunc quis nunc. Curabitur lectus orci, feugiat at ipsum ut, interdum feugiat leo. Quisque et semper augue, eget ullamcorper nisl. Quisque magna diam, congue ac enim et, finibus elementum diam. Phasellus nibh nunc, interdum ut dignissim eget, aliquet sit amet nisl. Sed tincidunt faucibus erat, feugiat sollicitudin lectus tincidunt in. Vivamus ac elit sit amet ante fringilla blandit. Vivamus pretium, massa tincidunt volutpat rhoncus, nunc lectus faucibus sem, eget congue justo neque eu enim. Aenean rutrum egestas suscipit. Duis id congue sapien.\r\n', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sapien est, interdum sed aliquam non, tempus sit amet elit. Aenean non tristique felis. Aliquam efficitur euismod arcu, eget finibus turpis aliquam at. In hac habitasse platea dictumst. Integer semper hendrerit diam, quis dictum erat scelerisque eget. Morbi malesuada sapien at urna dictum, ut varius ligula porta. Proin sodales, leo nec pellentesque finibus, ex tortor hendrerit sem, sit amet pulvinar nibh nunc quis nunc. Curabitur lectus orci, feugiat at ipsum ut, interdum feugiat leo. Quisque et semper augue, eget ullamcorper nisl. Quisque magna diam, congue ac enim et, finibus elementum diam. Phasellus nibh nunc, interdum ut dignissim eget, aliquet sit amet nisl. Sed tincidunt faucibus erat, feugiat sollicitudin lectus tincidunt in. Vivamus ac elit sit amet ante fringilla blandit. Vivamus pretium, massa tincidunt volutpat rhoncus, nunc lectus faucibus sem, eget congue justo neque eu enim. Aenean rutrum egestas suscipit. Duis id congue sapien.\r\n\r\nPellentesque iaculis rhoncus lacinia. Aenean dignissim nisi leo, et vehicula tellus euismod vitae. Aliquam ac volutpat justo. Morbi a mollis lacus, nec pulvinar dolor. In auctor mi id velit maximus placerat. Integer ultricies quis leo iaculis vestibulum. Curabitur viverra porttitor eros et efficitur. Aenean lectus velit, consequat ut enim quis, bibendum luctus nunc. Maecenas dictum, est nec accumsan lobortis, risus nulla porta quam, quis feugiat lacus nibh a sem. Vivamus ut rutrum erat. Nam accumsan pulvinar turpis id faucibus. Ut in mi in lacus dictum fringilla sed eget arcu. Aliquam lobortis in eros eu efficitur. Quisque vel egestas mauris. Duis neque augue, dignissim at tempus vel, ultricies euismod metus. Praesent luctus elit nec metus ornare tristique.', '\r\nPellentesque iaculis rhoncus lacinia. Aenean dignissim nisi leo, et vehicula tellus euismod vitae. Aliquam ac volutpat justo. Morbi a mollis lacus, nec pulvinar dolor. In auctor mi id velit maximus placerat. Integer ultricies quis leo iaculis vestibulum. Curabitur viverra porttitor eros et efficitur. Aenean lectus velit, consequat ut enim quis, bibendum luctus nunc. Maecenas dictum, est nec accumsan lobortis, risus nulla porta quam, quis feugiat lacus nibh a sem. Vivamus ut rutrum erat. Nam accumsan pulvinar turpis id faucibus. Ut in mi in lacus dictum fringilla sed eget arcu. Aliquam lobortis in eros eu efficitur. Quisque vel egestas mauris. Duis neque augue, dignissim at tempus vel, ultricies euismod metus. Praesent luctus elit nec metus ornare tristique.', 3, 4000.00, 6000.00, '2024-11-10', '2024-11-19', 'completed', '2024-11-10 08:23:35', '2024-11-10 12:26:50', 'campaign_1731227015_67306d87e42b8.png', NULL, NULL, NULL),
(2, 'Help me go to Rema\'s concert', 'Your support extends beyond attending a concert; it fuels fandom, community, and cultural appreciation. By contributing, you\'ll: 1. Enable a devoted fan to experience pure joy 2. Promote African music and cultural exchange 3. Encourage enthusiasm and dedication 4. Create lifelong memories Every donation counts! Thank you for helping make my Rema concert dream a reality!', 'Rema\'s music resonates deeply with me, providing motivation, comfort, and happiness. His artistry inspires me to pursue my passions, embrace individuality, and celebrate African culture. Attending the concert will be an unforgettable experience, allowing me to connect with fellow fans and witness his electrifying performance live. Your contribution will bring me closer to realizing this dream, fostering unforgettable memories.', 'Rema\'s music resonates deeply with me, providing motivation, comfort, and happiness. His artistry inspires me to pursue my passions, embrace individuality, and celebrate African culture. Attending the concert will be an unforgettable experience, allowing me to connect with fellow fans and witness his electrifying performance live. Your contribution will bring me closer to realizing this dream, fostering unforgettable memories.', 3, 50000.00, 26507.00, '2024-11-11', '2024-12-15', 'active', '2024-11-11 03:35:46', '2024-11-15 01:15:59', 'campaign_1731296146_67317b9222ddc.png', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `creators`
--

CREATE TABLE `creators` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `role` enum('admin','lecturer','headofclass') NOT NULL,
  `department` varchar(1000) NOT NULL,
  `university` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `creators`
--

INSERT INTO `creators` (`id`, `fullname`, `email`, `role`, `department`, `university`, `created_at`) VALUES
(1, 'Dr. John Smith', 'john.smith@uni.edu', 'lecturer', 'Computer Science', 'UNI', '2024-01-01 09:00:00'),
(2, 'Prof. Sarah Johnson', 'sarah.j@uni.edu', 'admin', 'Computer Science', 'FUNAAB', '2024-01-01 09:00:00'),
(3, 'Mr. James Wilson', 'james.w@uni.edu', 'headofclass', 'Computer Science', 'UNI', '2024-01-01 09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `donor_name` varchar(255) DEFAULT 'Anonymous',
  `amount` decimal(15,2) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `campaign_id`, `donor_name`, `amount`, `email`, `created_at`) VALUES
(1, 1, 'Baqee', 1000.00, 'baqee20072007@gmail.com', '2024-11-10 12:04:20'),
(2, 1, 'Corsair', 5000.00, 'baqeecodes@gmail.com', '2024-11-10 12:26:50'),
(3, 2, '', 100.00, 'bgoldbaqee@yahoo.com', '2024-11-11 03:37:51'),
(4, 2, 'Maddy', 10000.00, 'baqee20072007@gmail.com', '2024-11-11 04:47:44'),
(5, 2, 'Corsair', 5000.00, 'baqee20072007@gmail.com', '2024-11-11 08:36:48'),
(6, 2, '', 100.00, 'baqee20072007@gmail.com', '2024-11-11 17:05:39'),
(7, 2, 'Baqee', 400.00, 'baqee20072007@gmail.com', '2024-11-14 23:10:29'),
(8, 2, '', 500.00, NULL, '2024-11-14 23:19:55'),
(9, 2, '', 107.00, NULL, '2024-11-14 23:24:32'),
(12, 2, 'Anonymous Anonymous', 100.00, 'baqee20072007@gmail.com', '2024-11-15 00:25:44'),
(13, 2, 'Anonymous Anonymous', 100.00, 'baqee20072007@gmail.com', '2024-11-15 00:31:43'),
(14, 2, 'Anonymous Anonymous', 100.00, 'baqee20072007@gmail.com', '2024-11-15 00:49:55'),
(15, 2, 'Baqx Baqx', 10000.00, 'baqeecodes@gmail.com', '2024-11-15 01:15:59');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `reference_id` varchar(1000) DEFAULT NULL,
  `gateway_reference` varchar(200) DEFAULT NULL,
  `bill_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `amount_paid` decimal(10,2) DEFAULT 0.00,
  `status` enum('Unpaid','Partially Paid','Paid') NOT NULL DEFAULT 'Unpaid',
  `last_payment_date` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `uid`, `reference_id`, `gateway_reference`, `bill_id`, `student_id`, `total_amount`, `amount_paid`, `status`, `last_payment_date`, `created_at`, `updated_at`) VALUES
(1, 3, 'FUNAAB-0CD-08D-BC1-8', 'P-C-20241114-FMWH1JCTB4', 4, 3, 20000.00, 20000.00, 'Paid', '2024-11-14 22:59:54', '2024-11-14 22:59:54', '2024-11-14 22:59:54'),
(2, 3, 'FUNAAB-9C6-E8F-BC9-2', 'P-C-20241115-NFRG7A9DTQ', 1, 3, 15000.00, 15000.00, 'Paid', '2024-11-15 00:32:35', '2024-11-15 00:32:35', '2024-11-15 00:32:35'),
(3, 4, 'FUNAAB-23D-416-3CA-B', 'P-C-20241115-RB5UDSJG3L', 2, 4, 12000.00, 12000.00, 'Paid', '2024-11-15 01:19:54', '2024-11-15 01:19:54', '2024-11-15 01:19:54');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `reference_id` varchar(2000) DEFAULT NULL,
  `gateway_reference` varchar(200) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `transaction_type` enum('credit','debit','donate') NOT NULL,
  `details` text DEFAULT NULL,
  `type` enum('donate','bill-payment','received-donation','bill-funded') NOT NULL,
  `type_id` int(11) NOT NULL,
  `status` enum('success','pending','failed','reversed','abandoned') NOT NULL DEFAULT 'pending',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `uid`, `reference_id`, `gateway_reference`, `name`, `amount`, `transaction_type`, `details`, `type`, `type_id`, `status`, `timestamp`) VALUES
(1, 3, NULL, NULL, 'Donation to Scholarship Fund', 150.00, 'debit', 'Contribution to university scholarship fund', 'donate', 102, 'success', '2024-11-11 17:49:54'),
(2, 3, NULL, NULL, 'Payment for Library Bill', 30.00, 'debit', 'Payment for overdue library fees', 'bill-payment', 202, 'success', '2024-11-11 17:49:54'),
(3, 3, NULL, NULL, 'Received Donation from Alumni Fund', 200.00, 'credit', 'Scholarship fund donation received from alumni association', 'received-donation', 102, 'success', '2024-11-11 17:49:54'),
(4, 3, NULL, NULL, 'Failed Donation Attempt', 50.00, 'debit', 'Attempt to donate to environmental club campaign', 'donate', 103, 'failed', '2024-11-11 17:49:54'),
(5, 3, NULL, NULL, 'Partially Funded University Bill', 300.00, 'debit', 'Partial payment toward university fee bill', 'bill-funded', 203, 'pending', '2024-11-11 17:49:54'),
(6, 3, '5', NULL, 'Reversal of Failed Donation', 50.00, 'credit', 'Refund for previously failed donation attempt', 'donate', 103, 'reversed', '2024-11-11 17:49:54'),
(7, 3, '1', NULL, 'Paid - ', 16500.00, 'debit', NULL, 'bill-payment', 0, 'success', '2024-11-13 21:35:18'),
(8, 3, '1', NULL, 'Paid - ', 16500.00, 'debit', NULL, 'bill-payment', 0, 'success', '2024-11-13 21:36:30'),
(9, 3, '1', NULL, 'Paid - ', 16500.00, 'debit', NULL, 'bill-payment', 0, 'success', '2024-11-13 21:38:56'),
(10, 3, '1', NULL, 'Paid - ', 16500.00, 'debit', NULL, 'bill-payment', 0, 'success', '2024-11-13 21:39:31'),
(11, 3, '0', NULL, 'Paid - Computer Networks Manual', 16500.00, 'debit', NULL, 'bill-payment', 5, 'success', '2024-11-13 21:41:14'),
(12, 3, 'FUNAAB-78A-D77-5D7-8', NULL, 'Paid - Software Engineering Project Guide', 20000.00, 'debit', NULL, 'bill-payment', 4, 'success', '2024-11-13 21:50:31'),
(13, 3, 'FUNAAB-5D6-3E0-422-2', NULL, 'Paid - Database Systems Guide', 18000.00, 'debit', NULL, 'bill-payment', 3, 'success', '2024-11-13 22:01:07'),
(14, 4, 'FUNAAB-D5B-ED4-C39-A', NULL, 'Paid - Data Structures Manual', 12000.00, 'debit', NULL, 'bill-payment', 2, 'success', '2024-11-14 22:48:47'),
(15, 3, 'FUNAAB-0CD-08D-BC1-8', NULL, 'Paid - Software Engineering Project Guide', 20000.00, 'debit', NULL, 'bill-payment', 4, 'success', '2024-11-14 22:57:39'),
(16, 3, 'FUNAAB-0CD-08D-BC1-8', 'P-C-20241114-FMWH1JCTB4', 'Paid - Software Engineering Project Guide', 20000.00, 'debit', NULL, 'bill-payment', 4, 'success', '2024-11-14 22:59:54'),
(17, 3, 'FUNAAB-9C6-E8F-BC9-2', 'P-C-20241115-NFRG7A9DTQ', 'Paid - Programming Fundamentals Handbook', 15000.00, 'debit', NULL, 'bill-payment', 1, 'success', '2024-11-15 00:32:35'),
(18, 3, 'CAMPAIGN-A35-B54-E21-3', 'P-C-20241115-MLPSCGVU1Z', 'Received fund from campaign - ', 100.00, 'debit', NULL, 'received-donation', 2, 'success', '2024-11-15 00:49:55'),
(19, 3, 'CAMPAIGN-A35-B54-E21-3', 'P-C-20241115-MLPSCGVU1Z', 'Donated funds via gateway to campaign - ', 100.00, 'donate', NULL, 'donate', 2, 'success', '2024-11-15 00:49:55'),
(20, 3, 'CAMPAIGN-439-988-FEC-7', 'P-C-20241115-N2A69UZSMG', 'Received fund from campaign - ', 10000.00, 'credit', NULL, 'received-donation', 2, 'success', '2024-11-15 01:15:59'),
(21, 4, 'CAMPAIGN-439-988-FEC-7', 'P-C-20241115-N2A69UZSMG', 'Donated funds via gateway to campaign - ', 10000.00, 'donate', NULL, 'donate', 2, 'success', '2024-11-15 01:15:59'),
(22, 4, 'FUNAAB-23D-416-3CA-B', 'P-C-20241115-RB5UDSJG3L', 'Paid - Data Structures Manual', 12000.00, 'debit', NULL, 'bill-payment', 2, 'success', '2024-11-15 01:19:54');

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `abbreviation` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('Federal','State','Uniformed','Private') NOT NULL,
  `country` varchar(50) DEFAULT 'Nigeria'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`id`, `abbreviation`, `name`, `type`, `country`) VALUES
(1, 'ATBU', 'Abubakar Tafawa Balewa University, Bauchi', 'Federal', 'Nigeria'),
(2, 'ABU', 'Ahmadu Bello University, Zaria', 'Federal', 'Nigeria'),
(3, 'AE-FUNAI', 'Alex Ekwueme Federal University Ndufu Alike Ikwo', 'Federal', 'Nigeria'),
(4, 'BUK', 'Bayero University, Kano', 'Federal', 'Nigeria'),
(5, 'FUNAAB', 'Federal University of Agriculture, Abeokuta', 'Federal', 'Nigeria'),
(6, 'FUBK', 'Federal University Birnin Kebbi', 'Federal', 'Nigeria'),
(7, 'FUD', 'Federal University Dutse', 'Federal', 'Nigeria'),
(8, 'FUDMA', 'Federal University Dutsin Ma', 'Federal', 'Nigeria'),
(9, 'FUG', 'Federal University Gashua', 'Federal', 'Nigeria'),
(10, 'FUGUS', 'Federal University Gusau', 'Federal', 'Nigeria'),
(11, 'FUHSO', 'Federal University of Health Sciences, Otukpo', 'Federal', 'Nigeria'),
(12, 'FUHSA', 'Federal University of Health Sciences, Azare', 'Federal', 'Nigeria'),
(13, 'FUK', 'Federal University Kashere', 'Federal', 'Nigeria'),
(14, 'FUL', 'Federal University Lafia', 'Federal', 'Nigeria'),
(15, 'FULOKOJA', 'Federal University Lokoja', 'Federal', 'Nigeria'),
(16, 'FUMA', 'Federal University of Agriculture, Makurdi', 'Federal', 'Nigeria'),
(17, 'FUPRE', 'Federal University of Petroleum Resources, Effurun', 'Federal', 'Nigeria'),
(18, 'FUTA', 'Federal University of Technology, Akure', 'Federal', 'Nigeria'),
(19, 'FUTMINNA', 'Federal University of Technology, Minna', 'Federal', 'Nigeria'),
(20, 'FUTY', 'Federal University of Technology, Yola', 'Federal', 'Nigeria'),
(21, 'FUO', 'Federal University Otuoke', 'Federal', 'Nigeria'),
(22, 'FUWUKARI', 'Federal University Wukari', 'Federal', 'Nigeria'),
(23, 'IBBUL', 'Ibrahim Badamasi Babangida University, Lapai', 'Federal', 'Nigeria'),
(24, 'JABU', 'Joseph Ayo Babalola University, Ikeji-Arakeji', 'Federal', 'Nigeria'),
(25, 'KWASU', 'Kwara State University, Malete', 'Federal', 'Nigeria'),
(26, 'MOUA', 'Michael Okpara University of Agriculture, Umudike', 'Federal', 'Nigeria'),
(27, 'NAUB', 'Nigerian Army University Biu', 'Federal', 'Nigeria'),
(28, 'NSUK', 'Nasarawa State University, Keffi', 'Federal', 'Nigeria'),
(29, 'OAU', 'Obafemi Awolowo University, Ile-Ife', 'Federal', 'Nigeria'),
(30, 'UNIJOS', 'University of Jos', 'Federal', 'Nigeria'),
(31, 'UNILAG', 'University of Lagos', 'Federal', 'Nigeria'),
(32, 'UNILORIN', 'University of Ilorin', 'Federal', 'Nigeria'),
(33, 'UNIMAID', 'University of Maiduguri', 'Federal', 'Nigeria'),
(34, 'UNIPORT', 'University of Port Harcourt', 'Federal', 'Nigeria'),
(35, 'UNN', 'University of Nigeria, Nsukka', 'Federal', 'Nigeria'),
(36, 'ABSU', 'Abia State University, Uturu', 'State', 'Nigeria'),
(37, 'ADSU', 'Adamawa State University, Mubi', 'State', 'Nigeria'),
(38, 'AAUA', 'Adekunle Ajasin University, Akungba-Akoko', 'State', 'Nigeria'),
(39, 'AKSU', 'Akwa Ibom State University, Uyo', 'State', 'Nigeria'),
(40, 'ADUSTECH', 'Aliko Dangote University of Science and Technology, Wudil', 'State', 'Nigeria'),
(41, 'AAU', 'Ambrose Alli University, Ekpoma', 'State', 'Nigeria'),
(42, 'ANSU', 'Anambra State University, Uli', 'State', 'Nigeria'),
(43, 'BAUCHISTAT', 'Bauchi State University, Gadau', 'State', 'Nigeria'),
(44, 'BSU', 'Benue State University, Makurdi', 'State', 'Nigeria'),
(45, 'YUMSUK', 'Yusuf Maitama Sule University, Kano', 'State', 'Nigeria'),
(46, 'COOU', 'Chukwuemeka Odumegwu Ojukwu University, Uli', 'State', 'Nigeria'),
(47, 'CRUTECH', 'Cross River University of Technology, Calabar', 'State', 'Nigeria'),
(48, 'DSU', 'Delta State University, Abraka', 'State', 'Nigeria'),
(49, 'EBSU', 'Ebonyi State University, Abakaliki', 'State', 'Nigeria'),
(50, 'EUI', 'Edo University, Iyamho', 'State', 'Nigeria'),
(51, 'ESUT', 'Enugu State University of Science and Technology, Enugu', 'State', 'Nigeria'),
(52, 'GOMSU', 'Gombe State University, Gombe', 'State', 'Nigeria'),
(53, 'GSU', 'Gombe State University of Science and Technology', 'State', 'Nigeria'),
(54, 'IAUE', 'Ignatius Ajuru University of Education, Port Harcourt', 'State', 'Nigeria'),
(55, 'IKUN', 'Ibrahim Gbadamosi Babangida University, Lapai', 'State', 'Nigeria'),
(56, 'IMSU', 'Imo State University, Owerri', 'State', 'Nigeria'),
(57, 'KASU', 'Kaduna State University, Kaduna', 'State', 'Nigeria'),
(58, 'KSUSTA', 'Kebbi State University of Science and Technology, Aliero', 'State', 'Nigeria'),
(59, 'KSUST', 'Kogi State University, Anyigba', 'State', 'Nigeria'),
(60, 'LAUTECH', 'Ladoke Akintola University of Technology, Ogbomoso', 'State', 'Nigeria'),
(61, 'LASU', 'Lagos State University, Ojo', 'State', 'Nigeria'),
(62, 'AFIT', 'Nigeria Airforce University, Kaduna', 'Uniformed', 'Nigeria'),
(63, 'NMU', 'Nigeria Maritime University, Warri', 'Uniformed', 'Nigeria'),
(64, 'POLAC', 'Nigeria Police Academy Wudil, Kano', 'Uniformed', 'Nigeria'),
(65, 'NUAB', 'Nigerian Army University Biu, Borno', 'Uniformed', 'Nigeria'),
(66, 'NDA', 'Nigerian Defence Academy, Kaduna', 'Uniformed', 'Nigeria'),
(67, 'AC', 'Achievers University, Owo', 'Private', 'Nigeria'),
(68, 'AUE', 'Adeleke University, Ede', 'Private', 'Nigeria'),
(69, 'ABUAD', 'Afe Babalola University, Ado-Ekiti', 'Private', 'Nigeria'),
(70, 'AUST', 'African University of Science and Technology, Abuja', 'Private', 'Nigeria'),
(71, 'APU', 'Ahman Pategi University, Pategi', 'Private', 'Nigeria'),
(72, 'ACU', 'Ajayi Crowther University, Oyo', 'Private', 'Nigeria'),
(73, 'ALHIKMAH', 'Al-Hikmah University, Ilorin', 'Private', 'Nigeria'),
(74, 'AUN', 'American University of Nigeria, Yola', 'Private', 'Nigeria'),
(75, 'AB', 'Augustine University, Ilara', 'Private', 'Nigeria'),
(76, 'BabcockU', 'Babcock University, Ilishan Remo', 'Private', 'Nigeria'),
(77, 'BU', 'Baze University, Abuja', 'Private', 'Nigeria'),
(78, 'BCU', 'Bells University of Technology, Ota', 'Private', 'Nigeria'),
(79, 'BNU', 'Benson Idahosa University, Benin City', 'Private', 'Nigeria'),
(80, 'BUI', 'Bingham University, Karu', 'Private', 'Nigeria'),
(81, 'BUK', 'Bowen University, Iwo', 'Private', 'Nigeria'),
(82, 'CU', 'Covenant University, Ota', 'Private', 'Nigeria'),
(83, 'CBU', 'Chrisland University, Abeokuta', 'Private', 'Nigeria'),
(84, 'GOU', 'Godfrey Okoye University, Enugu', 'Private', 'Nigeria'),
(85, 'GU', 'Gregory University, Uturu', 'Private', 'Nigeria'),
(86, 'HEGT', 'Hallmark University, Ijebu-Itele', 'Private', 'Nigeria'),
(87, 'KCU', 'Kwararafa University, Wukari', 'Private', 'Nigeria'),
(88, 'LSU', 'Landmark University, Omu-Aran', 'Private', 'Nigeria'),
(89, 'LU', 'Lead City University, Ibadan', 'Private', 'Nigeria'),
(90, 'MCU', 'McPherson University, Seriki Sotayo', 'Private', 'Nigeria');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(1000) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `username` varchar(30) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `dob` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `state` varchar(1000) DEFAULT NULL,
  `university` varchar(1000) DEFAULT NULL,
  `faculty` varchar(1000) DEFAULT NULL,
  `department` varchar(1000) DEFAULT NULL,
  `matric_no` varchar(1000) NOT NULL,
  `password` varchar(1000) DEFAULT NULL,
  `level` varchar(200) NOT NULL DEFAULT '100',
  `bank_id` varchar(200) DEFAULT NULL,
  `bank_account_name` varchar(200) DEFAULT NULL,
  `account_number` int(30) DEFAULT NULL,
  `created_at` varchar(1000) DEFAULT current_timestamp(),
  `last_login` varchar(1000) DEFAULT current_timestamp(),
  `gender` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `balance`, `username`, `phone`, `dob`, `country`, `state`, `university`, `faculty`, `department`, `matric_no`, `password`, `level`, `bank_id`, `bank_account_name`, `account_number`, `created_at`, `last_login`, `gender`) VALUES
(3, 'Adegbola AbdulBaqee', 'baqee20072007@gmail.com', 10200.00, 'baqx', '09019659410', '2007-07-08', 'Nigeria', 'Ogun', 'FUNAAB', 'Engineering', 'Mathematics', 'baqx', '$2y$10$ZezJMEaMs5VWm7iIZ5VlbOV3YENFQY7w7p7AxTqIan1OCUEIP/1nq', '100', NULL, NULL, NULL, '2024-11-10 07:28:45', '2024-11-13 22:55:57', 'male'),
(4, 'Code Corsair ', 'baqeecodes@gmail.com', 0.00, 'iambaqx', '09019659420', '2007-11-10', 'Nigeria', 'Ogun', 'BabcockU', 'Engineering', 'Computer Science', '20243900', '$2y$10$9dGg1v6.UVAwtH2Ixm1ajOCCQlgf9Mzi4WsRWVCeaAtZBuH5lyB1G', '100', NULL, NULL, NULL, '2024-11-10 13:25:38', '2024-11-15 02:14:40', 'male'),
(5, 'Adeknle Gold', 'bgoldbaqee@yahoo.com', 0.00, 'baqxes', '09119659410', '2007-07-08', 'Nigeria', 'Ogun', 'FUNAAB', 'Engineering', 'Computer Science', '20143905', '$2y$10$5lcYZVBH5yrggt7H70HB5e3b689YL30FZhN97Ts39NihiT799RSQ6', '100', NULL, NULL, NULL, '2024-11-11 06:04:05', '2024-11-11 08:58:53', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_invoice`
--
ALTER TABLE `bill_invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_id` (`bill_id`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `creators`
--
ALTER TABLE `creators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaign_id` (`campaign_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_id` (`bill_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bill_invoice`
--
ALTER TABLE `bill_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `creators`
--
ALTER TABLE `creators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill_invoice`
--
ALTER TABLE `bill_invoice`
  ADD CONSTRAINT `bill_invoice_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`);

--
-- Constraints for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD CONSTRAINT `campaigns_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
