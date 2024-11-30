-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql107.infinityfree.com
-- Generation Time: Nov 30, 2024 at 03:50 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_37725955_infund`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_transactions`
--

CREATE TABLE `admin_transactions` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `reference_id` varchar(2000) DEFAULT NULL,
  `gateway_reference` varchar(200) DEFAULT NULL,
  `name` varchar(2000) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `transaction_type` enum('credit','debit','donate') NOT NULL,
  `details` text DEFAULT NULL,
  `type` enum('donate','bill-payment','received-donation','bill-funded') NOT NULL,
  `type_id` int(11) NOT NULL,
  `status` enum('success','pending','failed','reversed','abandoned') NOT NULL DEFAULT 'pending',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_transactions`
--

INSERT INTO `admin_transactions` (`id`, `uid`, `reference_id`, `gateway_reference`, `name`, `amount`, `transaction_type`, `details`, `type`, `type_id`, `status`, `timestamp`) VALUES
(39, 2, 'FUNAAB-1EA-117-2B4-7', 'P-C-20241128-VF6B4CGADK', '(20243905) Paid - MTS Exam handbook ', '6000.00', 'credit', NULL, 'bill-payment', 4, 'success', '2024-11-28 15:00:01');

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
('Bank Code', 'Bank Name'),
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
('090482', 'FEDETH MICROFINANCE BANK'),
('090298', 'FEDPOLY NASARAWA MICROFINANCE BANK'),
('100001', 'FETS'),
('050002', 'FEWCHORE FINANCE COMPANY LIMITED'),
('090153', 'FFS MICROFINANCE BANK'),
('000007', 'FIDELITY BANK'),
('100019', 'FIDELITY MOBILE'),
('090126', 'FIDFUND MICROFINANCE Bank'),
('090111', 'FINATRUST MICROFINANCE BANK'),
('090400', 'FINCA MICROFINANCE BANK'),
('090366', 'FIRMUS MICROFINANCE BANK'),
('110004', 'FIRST APPLE LIMITED'),
('000016', 'FIRST BANK OF NIGERIA'),
('000003', 'FIRST CITY MONUMENT BANK'),
('070014', 'FIRST GENERATION MORTGAGE BANK'),
('090479', 'FIRST HERITAGE MICROFINANCE BANK'),
('090285', 'FIRST OPTION MICROFINANCE BANK'),
('090164', 'FIRST ROYAL MICROFINANCE BANK'),
('090107', 'FIRST TRUST MORTGAGE BANK PLC'),
('100014', 'FIRSTMONIE WALLET'),
('090614', 'FLOURISH MICROFINANCE BANK'),
('110002', 'FLUTTERWAVE TECHNOLOGY SOLUTIONS LIMITED'),
('090521', 'FORESIGHT MICROFINANCE BANK'),
('070002', 'FORTIS MICROFINANCE BANK'),
('100016', 'FORTIS MOBILE'),
('090486', 'FORTRESS MICROFINANCE BANK'),
('400001', 'FSDH'),
('090145', 'FULLRANGE MICROFINANCE BANK'),
('090438', 'FUTMINNA MICROFINANCE BANK'),
('090158', 'FUTO MICROFINANCE BANK'),
('090582', 'GABASAWA MICROFINANCE BANK'),
('090591', 'GABSYN MICROFINANCE BANK'),
('090484', 'GARKI MICROFINANCE BANK'),
('090168', 'GASHUA MICROFINANCE BANK'),
('070009', 'GATEWAY MORTGAGE BANK'),
('090475', 'GIANT STRIDE MFB'),
('090621', 'GIDAUNIYAR ALHERI MICROFINANCE BANK'),
('090411', 'GIGINYA MICROFINANCE BANK'),
('090186', 'GIREI MICROFINANACE BANK'),
('090441', 'GIWA MICROFINANCE BANK'),
('090639', 'GLOBAL INITIATIVE MICROFINANCE BANK'),
('000027', 'GLOBUS BANK'),
('090278', 'GLORY MICROFINANCE BANK'),
('090408', 'GMB MICROFINANCE BANK'),
('090586', 'GOMBE MICROFINANCE BANK LIMITED'),
('090467', 'GOOD NEIGHBORS MFB'),
('090495', 'GOODNEWS MICROFINANCE BANK'),
('090122', 'GOWANS MICROFINANCE BANK'),
('090550', 'GREEN ENERGY MICROFINANCE BANK'),
('090599', 'GREENACRES MICROFINANCE BANK LTD'),
('090178', 'GREENBANK MICROFINANCE BANK'),
('090269', 'GREENVILLE MICROFINANCE BANK'),
('060004', 'GREENWICH MERCHANT BANK'),
('090195', 'GROOMING MICROFINANCE BANK'),
('100009', 'GT MOBILE'),
('000013', 'GTBANK PLC'),
('090385', 'GTI MICROFINANCE BANK'),
('090500', 'GWONG MICROFINANCE BANK'),
('090147', 'HACKMAN MICROFINANCE BANK'),
('070017', 'HAGGAI MORTGAGE BANK LIMITED'),
('090291', 'HALALCREDIT MICROFINANCE BANK'),
('090121', 'HASAL MICROFINANCE BANK'),
('090363', 'HEADWAY MICROFINANCE BANK'),
('100017', 'HEDONMARK'),
('000020', 'HERITAGE BANK'),
('090418', 'HIGHLAND MICROFINANCE BANK'),
('070024', 'HOMEBASE MORTGAGE BANK'),
('120002', 'HOPE PAYMENT SERVICE BANK'),
('090439', 'IBETO MICROFINANCE BANK'),
('090118', 'IBILE MICROFINANCE BANK'),
('090532', 'IBOLO MICROFINANCE BANK'),
('090519', 'IBOM FADAMA MICROFINANCE BANK'),
('090520', 'IC GLOBAL MICROFINANCE BANK'),
('090546', 'IJEBU-IFE MICROFINANCE BANK'),
('090324', 'IKENNE MICROFINANCE BANK'),
('090279', 'IKIRE MICROFINANCE BANK'),
('090571', 'ILARO POLY MICROFINANCE BANK'),
('090370', 'ILISAN MICROFINANCE BANK'),
('090430', 'ILORA MICROFINANCE BANK'),
('090350', 'ILORIN MICROFINANCE BANK'),
('090258', 'IMO STATE MICROFINANCE BANK'),
('090417', 'IMOWO MICROFINANCE BANK'),
('100024', 'IMPERIAL HOMES MORTGAGE BANK'),
('090670', 'IMSU MICROFINANCE BANK'),
('090157', 'INFINITY MICROFINANCE BANK'),
('070016', 'INFINITY TRUST MORTGAGE BANK'),
('100029', 'INNOVECTIVES KESH'),
('090434', 'INSIGHTS MICROFINANCE BANK'),
('100027', 'INTELLIFIN'),
('090386', 'INTERLAND MICROFINANCE BANK'),
('110003', 'INTERSWITCH LIMITED'),
('090493', 'IPERU MICROFINANCE BANK'),
('090149', 'IRL MICROFINANCE BANK'),
('090377', 'ISALEOYO MICROFINANCE BANK'),
('090428', 'ISHIE MICROFINANCE BANK'),
('090584', 'ISLAND MICROFINANCE BANK'),
('090543', 'IWOAMA MICROFINANCE BANK'),
('090337', 'IYE OKIN MICROFINANCE BANK LTD'),
('090620', 'IYIN EKITI MICROFINANCE BANK'),
('090421', 'IZON MICROFINANCE BANK'),
('000006', 'JAIZ BANK'),
('090352', 'JESSEFIELD MICROFINANCE BANK'),
('090003', 'JUBILEE-LIFE MORTGAGE BANK'),
('090320', 'KADPOLY MICROFINANCE BANK'),
('090669', 'KADUPE MICROFINANCE BANK'),
('090554', 'KAYVEE MICROFINANCE BANK'),
('090549', 'KC MICROFINANCE BANK'),
('090191', 'KCMB MICROFINANCE BANK'),
('100036', 'KEGOW(CHAMSMOBILE)'),
('000002', 'KEYSTONE BANK'),
('090487', 'KINGDOM COLLEGE MICROFINANCE BANK'),
('090606', 'KKU MICROFINANCE BANK'),
('090480', 'KOLOMONI MICROFINANCE BANK'),
('090299', 'KONTAGORA MICROFINANCE BANK'),
('090617', 'KOPO KOPE MICROFINANCE BANK'),
('090380', 'KREDI MONEY MICROFINANCE BANK'),
('090267', 'KUDA MICROFINANCE BANK'),
('090450', 'KWASU MICROFINANCE BANK'),
('070012', 'LAGOS BUILDING AND INVESTMENT COMPANY'),
('090177', 'LAPO MICROFINANCE BANK'),
('090271', 'LAVENDER MICROFINANCE BANK'),
('090650', 'LEADCITY MICROFINANCE BANK'),
('110044', 'LEADREMIT LIMITED'),
('090372', 'LEGEND MICROFINANCE BANK'),
('090420', 'LETSHEGO MICROFINANCE BANK'),
('090557', 'LIFEGATE MICROFINANCE BANK'),
('090477', 'LIGHT MICROFINANCE BANK'),
('090435', 'LINKS MICROFINANCE BANK'),
('070007', 'LIVINGTRUST MORTGAGE BANK PLC'),
('000029', 'LOTUS BANK'),
('090265', 'LOVONUS MICROFINANCE BANK'),
('050015', 'LUKEFIELD FINANCE COMPANY LIMITED'),
('100035', 'M36'),
('090623', 'MAB ALLIANZ MICROFINANCE BANK'),
('090630', 'MABINAS MICROFINANCE BANK'),
('090603', 'MACROD MICROFINANCE BANK LIMITED'),
('090605', 'MADOBI MICROFINANCE BANK'),
('090465', 'MAIN TRUST MICROFINANCE BANK'),
('090323', 'MAINLAND MICROFINANCE BANK'),
('090171', 'MAINSTREET MICROFINANCE BANK'),
('090174', 'MALACHY MICROFINANCE BANK'),
('090383', 'MANNY MICROFINANCE BANK'),
('090410', 'MARITIME MICROFINANCE BANK'),
('090423', 'MAUTECH MICROFINANCE BANK'),
('090321', 'MAYFAIR MICROFINANCE BANK'),
('070019', 'MAYFRESH MORTGAGE BANK'),
('090612', 'MEDEF MICROFINANCE BANK'),
('090280', 'MEGAPRAISE MICROFINANCE BANK'),
('090432', 'MEMPHIS MICROFINANCE BANK'),
('090589', 'MERCURY MICROFINANCE BANK'),
('090275', 'MERIDAN MFB'),
('090659', 'MICHAEL OKPARA UNIAGRIC MICROFINANCE BANK'),
('090587', 'MICROBIZ MICROFINANCE BANK'),
('090136', 'MICROCRED MICROFINANCE BANK'),
('090113', 'MICROVIS MICROFINANCE BANK'),
('090192', 'MIDLAND MICROFINANCE BANK'),
('090607', 'MINJIBIR MICROFINANCE BANK'),
('090281', 'MINT-FINEX MFB'),
('090455', 'MKOBO MICROFINANCE BANK'),
('100011', 'MKUDI'),
('090362', 'MOLUSI MICROFINANCE BANK'),
('120003', 'MOMO PAYMENT SERVICE BANK'),
('090462', 'MONARCH MICROFINANCE BANK'),
('100020', 'MONEY BOX'),
('090129', 'MONEY TRUST MICROFINANCE BANK'),
('120005', 'Moneymaster PSB'),
('090405', 'MONIEPOINT MICROFINANCE BANK'),
('090448', 'MOYOFADE MICROFINANCE BANK'),
('090392', 'MOZFIN MICROFINANCE BANK'),
('090190', 'MUTUAL BENEFITS MICROFINANCE BANK'),
('090151', 'MUTUAL TRUST MICROFINANCE BANK'),
('090152', 'NAGARTA MICROFINANCE BANK'),
('090128', 'NDIORAH MICROFINANCE BANK'),
('090329', 'NEPTUNE MICROFINANCE BANK'),
('090205', 'NEW DAWN MICROFINANCE BANK'),
('090378', 'NEW GOLDEN PASTURES MICROFINANCE BANK'),
('090108', 'NEW PRUDENTIAL BANK'),
('030001', 'NEXIM BANK'),
('090459', 'NICE MICROFINANCE BANK'),
('090505', 'NIGERIA PRISONS MICROFINANCE BANK'),
('090263', 'NIGERIAN NAVY MICROFINANCE BANK'),
('999999', 'NIP VIRTUAL BANK'),
('090194', 'NIRSAL NATIONAL MICROFINANCE BANK'),
('090283', 'NNEW WOMEN MICROFINANCE BANK'),
('100032', 'NOWNOW DIGITAL SYSTEMS LIMITED'),
('060003', 'NOVA MERCHANT BANK'),
('070001', 'NPF MICROFINANCE BANK'),
('090628', 'NSEHE MICROFINANCE BANK'),
('090364', 'NUTURE MICROFINANCE BANK'),
('090399', 'NWANNEGADI MICROFINANCE BANK'),
('090437', 'OAKLAND MICROFINANCE BANK'),
('090333', 'OCHE MICROFINANCE BANK'),
('090654', 'ODOAKPU Microfinance Bank'),
('090119', 'OHAFIA MICROFINANCE BANK'),
('090626', 'OHHA MICROFINANCE BANK'),
('090565', 'OKE-ARO OREDEGBE MFB'),
('090646', 'OKENGWE MICROFINANCE BANK'),
('090161', 'OKPOGA MICROFINANCE BANK'),
('090566', 'OKUKU MICROFINANCE BANK'),
('090272', 'OLABISI ONABANJO UNIVERSITY MICROFINANCE'),
('090468', 'OLOFIN OWENA MICROFINANCE BANK'),
('090404', 'OLOWOLAGBA MICROFINANCE BANK'),
('090471', 'OLUCHUKWU MFB'),
('090460', 'OLUYOLE MICROFINANCE BANK'),
('090295', 'OMIYE MICROFINANCE BANK'),
('100004', 'OPAY'),
('000036', 'OPTIMUS BANK'),
('090492', 'ORAUKWU MICROFINANCE BANK'),
('090567', 'OROKAM MICROFINANCE BANK'),
('090396', 'OSCOTECH MICROFINANCE BANK'),
('090456', 'OSPOLY MICROFINANCE BANK'),
('090580', 'OTECH MICROFINANCE BANK'),
('090542', 'OTUO MICROFINANCE BANK'),
('090635', 'OYAN MICROFINANCE BANK'),
('100002', 'PAGA'),
('000106', 'PAGE FINANCIALS'),
('070008', 'PAGE MFBank'),
('100033', 'PALMPAY'),
('000030', 'PARALLEX BANK'),
('090390', 'PARKWAY MICROFINANCE BANK'),
('100003', 'PARKWAY-READYCASH'),
('000526', 'PARRALEX'),
('090317', 'PATRICKGOLD MICROFINANCE BANK'),
('110001', 'PAYATTITUDE ONLINE'),
('110006', 'PAYSTACK PAYMENT LIMITED'),
('090402', 'PEACE MICROFINANCE BANK'),
('090137', 'PECANTRUST MICROFINANCE BANK'),
('090196', 'PENNYWISE MICROFINANCE BANK'),
('090135', 'PERSONAL TRUST MICROFINANCE BANK'),
('090165', 'PETRA MICROFINANCE BANK'),
('090289', 'PILLAR MICROFINANCE BANK'),
('070013', 'PLATINUM MORTGAGE BANK'),
('000008', 'POLARIS BANK'),
('090296', 'POLYUNWANA MICROFINANCE BANK'),
('090412', 'PREEMINENT MICROFINANCE BANK'),
('000031', 'PREMIUM TRUST  BANK'),
('090274', 'PRESTIGE MICROFINANCE BANK'),
('090481', 'PRISCO MICROFINANCE BANK'),
('090499', 'PRISTINE DIVITIS MICROFINANCE BANK'),
('000023', 'Providus'),
('090303', 'PURPLEMONEY MICROFINANCE BANK'),
('090261', 'QUICKFUND MICROFINANCE BANK'),
('000024', 'RAND MERCHANT BANK'),
('070011', 'REFUGE MORTGAGE BANK'),
('090125', 'REGENT MICROFINANCE BANK'),
('090463', 'REHOBOTH MICROFINANCE BANK'),
('090173', 'RELIANCE MICROFINANCE BANK'),
('090198', 'RENMONEY MICROFINANCE BANK'),
('090322', 'REPHIDIM MICROFINANCE BANK'),
('090132', 'RICHWAY MICROFINANCE BANK'),
('090433', 'RIGO MICROFINANCE BANK'),
('090515', 'RIMA GROWTH PATHWAY MICROFINANCE BANK'),
('090547', 'ROCKSHIELD MICROFINANCE BANK'),
('090138', 'ROYAL EXCHANGE MICROFINANCE BANK'),
('090175', 'RUBIES MICROFINANCE BANK'),
('090286', 'SAFE HAVEN MICROFINANCE BANK'),
('090485', 'SAFEGATE MICROFINANCE BANK'),
('090006', 'SAFETRUST'),
('090140', 'SAGAMU MICROFINANCE BANK'),
('050003', 'SAGE GREY FINANCE LIMITED'),
('090513', 'SEAP MICROFINANCE BANK'),
('090112', 'SEED CAPITAL MICROFINANCE BANK'),
('090369', 'SEEDVEST MICROFINANCE BANK'),
('090502', 'SHALOM MICROFINANCE BANK'),
('090401', 'SHERPERD TRUST MICROFINANCE BANK'),
('090559', 'SHIELD MICROFINANCE BANK'),
('090558', 'SHONGOM MICROFINANCE BANK'),
('000034', 'SIGNATURE BANK'),
('090449', 'SLS MICROFINANCE BANK'),
('120004', 'SMARTCASH PAYMENT SERVICE BANK'),
('090506', 'SOLID ALLIANZE MICROFINANCE BANK'),
('090524', 'SOLIDROCK MICROFINANCE BANK'),
('090325', 'SPARKLE'),
('090436', 'SPECTRUM MICROFINANCE BANK'),
('100007', 'STANBIC IBTC @Ease WALLET'),
('000012', 'STANBIC IBTC BANK'),
('000021', 'STANDARD CHARTERED BANK'),
('090162', 'STANFORD MICROFINANCE BANK'),
('070022', 'STB MORTGAGE BANK'),
('090262', 'STELLAS MICROFINANCE BANK'),
('000001', 'STERLING BANK'),
('100022', 'GOMONEY (FORMERLY STERLING MOBILE) '),
('090340', 'STOCKCORP MICROFINANCE BANK'),
('090305', 'SULSPAP MICROFINANCE BANK'),
('090302', 'SUNBEAM MICROFINANCE BANK'),
('000022', 'SUNTRUST BANK'),
('090446', 'SUPPORT MICROFINANCE BANK'),
('090564', 'SUPREME MICROFINANCE BANK'),
('100023', 'TAGPAY'),
('000026', 'TAJ BANK'),
('090560', 'TANADI MFB (CRUST)'),
('090426', 'TANGERINE MONEY'),
('090115', 'TCF MICROFINANCE BANK'),
('110007', 'TEAMAPT LIMITED'),
('100010', 'TEASY MOBILE'),
('090373', 'THINK FINANCE MICROFINANCE BANK'),
('000025', 'TITAN TRUST BANK'),
('100039', 'TITAN-PAYSTACK'),
('090146', 'TRIDENT MICROFINANCE BANK'),
('090525', 'TRIPLEA MICROFINANCE BANK'),
('090327', 'TRUST MICROFINANCE BANK'),
('090123', 'TRUSTBANC J6 MICROFINANCE BANK LIMITED'),
('090005', 'TRUSTBOND MORTGAGE BANK'),
('090276', 'TRUSTFUND MICROFINANCE BANK'),
('090315', 'U & C MICROFINANCE BANK'),
('090403', 'UDA MICROFINANCE BANK'),
('090517', 'UHURU MICROFINANCE BANK'),
('090331', 'UNAAB MICROFINANCE BANK'),
('090461', 'UNIBADAN MICROFINANCE BANK'),
('090266', 'UNIBEN MICROFINANCE BANK'),
('090193', 'UNICAL MICROFINANCE BANK'),
('090452', 'UNILAG MICROFINANCE BANK'),
('090341', 'UNILORIN MICROFINANCE BANK'),
('090464', 'UNIMAID MICROFINANCE BANK'),
('000018', 'UNION BANK'),
('000004', 'UNITED BANK FOR AFRICA'),
('000011', 'UNITY BANK'),
('090338', 'UNIUYO MICROFINANCE BANK'),
('090251', 'UNIVERSITY OF NIGERIA, NSUKKA MICROFINANCE BANK'),
('110009', 'VENTURE GARDEN NIGERIA LIMITED'),
('090474', 'VERDANT MICROFINANCE BANK'),
('090110', 'VFD MFB'),
('090150', 'VIRTUE MICROFINANCE BANK'),
('090139', 'VISA MICROFINANCE BANK'),
('100012', 'VT NETWORKS'),
('000017', 'WEMA BANK'),
('090120', 'WETLAND  MICROFINANCE BANK'),
('090124', 'XSLNCE MICROFINANCE BANK'),
('090466', 'YCT MICROFINANCE BANK'),
('090142', 'YES MICROFINANCE BANK'),
('090252', 'YOBE MICROFINANCE  BANK'),
('000015', 'ZENITH BANK'),
('100034', 'ZENITH EASY WALLET'),
('100018', 'ZENITH MOBILE'),
('090504', 'ZIKORA MICROFINANCE BANK'),
('100025', 'ZINTERNET - KONGAPAY');

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
(1, 1, 'MTS 101 Manuals', 'FUNAAB', 'College of Physical Sciences', 'Mathematics', '100', '', '5000.00', '2024-11-18', '2024-11-23', '2024-11-18 12:17:45'),
(2, 1, 'MTS Exam handbook ', 'FUNAAB', 'College of Physical Sciences', 'Mathematics', '100', '', '3000.00', '2024-11-19', '2024-11-24', '2024-11-18 14:03:08'),
(3, 3, 'Computer Science Lab Due', 'UNILAG', 'Sciences', 'Computer Science', '100', '', '10000.00', '2024-11-21', '2024-12-05', '2024-11-20 14:53:19'),
(4, 2, 'MTS Exam handbook ', 'FUNAAB', 'College of Physical Sciences', 'Mathematics', '100', '', '6000.00', '2024-11-29', '2025-01-05', '2024-11-28 13:17:04'),
(5, 2, 'Matriculation Handbook', 'FUNAAB', 'College of Physical Sciences', 'Mathematics', '100', '', '50000.00', '2024-11-30', '2024-12-07', '2024-11-29 10:48:42');

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
(1, 'MTS 101 Manuals', 1, 1, 'FUNAAB-83F-642-690-4', 'P-C-20241118-JH4W8O0XDA', '2024-11-23', '5000.00', 'Paid', 'False', '2024-11-18 13:02:23', '2024-11-18 13:59:55'),
(3, 'MTS Exam handbook ', 2, 1, 'FUNAAB-5CC-CC4-B5C-2', NULL, '2024-11-24', '3000.00', 'Pending', 'False', '2024-11-23 17:16:22', '2024-11-23 17:16:22'),
(6, 'MTS Exam handbook ', 4, 2, 'FUNAAB-1EA-117-2B4-7', 'P-C-20241128-VF6B4CGADK', '2025-01-05', '6000.00', 'Paid', 'False', '2024-11-28 14:59:32', '2024-11-28 15:00:01'),
(7, 'Matriculation Handbook', 5, 2, 'FUNAAB-348-33D-7CA-0', NULL, '2024-12-07', '50000.00', 'Pending', 'False', '2024-11-29 10:49:36', '2024-11-29 10:49:36'),
(8, 'Computer Science Lab Due', 3, 3, 'UNILAG-621-F96-F2E-2', NULL, '2024-12-05', '10000.00', 'Pending', 'False', '2024-11-29 07:27:28', '2024-11-29 07:27:28');

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
  `university` varchar(200) DEFAULT NULL,
  `amount_raised` decimal(15,2) DEFAULT 0.00,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','completed','cancelled') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image1` varchar(1000) NOT NULL,
  `image2` varchar(1000) DEFAULT NULL,
  `image3` varchar(1000) DEFAULT NULL,
  `image4` varchar(1000) DEFAULT NULL,
  `spam_level` decimal(5,2) DEFAULT NULL,
  `ai_classification` varchar(1000) DEFAULT NULL,
  `link` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `title`, `description`, `impact`, `importance`, `uid`, `goal_amount`, `university`, `amount_raised`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`, `image1`, `image2`, `image3`, `image4`, `spam_level`, `ai_classification`, `link`) VALUES
(1, 'Help me buy a new CHM 101 textbook', 'Hello! I\'m Adekunle John, a 100-level student. I\'m struggling to afford a comprehensive CHM Textbook', 'By supporting my campaign, you\'ll have a direct impact on my educational journey. A new CHM textbook will:\r\n\r\n- Improve my understanding of complex chemistry concepts\r\n- Enhance my academic performance and grades\r\n- Increase my confidence in tackling challenging problems\r\n- Prepare me for future exams and assessments\r\n- Equip me with up-to-date knowledge and skills\r\n- Foster a deeper love for learning and STEM subjects\r\n- Open doors to new opportunities and career paths\r\n- Empower me to make a positive impact in my community\r\n\r\nYour contribution will:\r\n\r\n- Bridge the resource gap hindering my education\r\n- Provide access to quality educational materials\r\n- Support the development of a future leader and change-maker\r\n- Inspire others to pursue their educational goals\r\n\r\nLong-term Impact\r\n\r\nYour support today will have a lasting impact on my future:\r\n\r\n- Better career prospects and opportunities\r\n- Increased earning potential\r\n- Improved quality of life\r\n- Enhanced contributions to society\r\n- A ripple effect of positive change in my community\r\n', 'Why is this important?\r\nA new textbook will:\r\n\r\n1. Enhance my learning experience\r\n2. Improve my academic performance\r\n3. Prepare me for future exams and opportunities\r\n\r\nHow will you help?\r\nYour contribution will directly support my education, providing me with:\r\n\r\n1. Accurate and up-to-date information\r\n2. Better comprehension of complex concepts\r\n3. Increased confidence in my studies\r\n', 1, '5000.00', 'FUNAAB', '2000.00', '2024-11-17', '2024-12-10', 'active', '2024-11-18 12:28:56', '2024-11-29 16:54:13', 'campaign_1731878917_673a60052680a.jpg', NULL, NULL, NULL, '0.00', NULL, 'LEFRWJ'),
(2, 'Fuel My Future: Adekunle John\'s 100L Laptop Fund', 'Help me buy a laptop for education', 'Goal: ₦250,000 to cover educational expenses, including:\r\n\r\n- Laptop: ₦150,000\r\n- Textbooks and materials: ₦50,000\r\n- Online courses and tutorials: ₦20,000\r\n- Research and project funding: ₦30,000\r\n\r\nGoal: ₦250,000 to cover educational expenses, including:\r\n\r\n- Laptop: ₦150,000\r\n- Textbooks and materials: ₦50,000\r\n- Online courses and tutorials: ₦20,000\r\n- Research and project funding: ₦30,000\r\n\r\n', 'Why is this important?\r\n\r\nAdequate educational resources will:\r\n\r\n- Enhance my understanding of complex concepts\r\n- Increase my productivity and efficiency\r\n- Provide equal access to educational opportunities\r\n- Prepare me for a competitive future\r\n- Foster a love for lifelong learning\r\n\r\n', 2, '120000.00', 'FUNAAB ', '2500.00', '2024-11-17', '2024-12-05', 'active', '2024-11-18 12:58:19', '2024-11-29 16:54:07', 'campaign_1731880678_673a66e67c442.jpeg', NULL, NULL, NULL, '0.00', NULL, 'FJNRWG GR'),
(3, 'Help me pay my Medical Examination fee', 'Help Janet find her Medical Examination fee', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 4, '5000.00', 'FUNAAB ', '1900.00', '2024-11-19', '2024-11-26', 'active', '2024-11-19 18:49:54', '2024-11-29 16:54:03', 'campaign_1732016985_673c7b591ee11.jpeg', NULL, NULL, NULL, '100.00', NULL, 'FDSFLT'),
(4, 'Help me with hostel Rent', 'Help me pay my hostel rent', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 5, '130000.00', NULL, '800.00', '2024-11-20', '2024-12-28', 'active', '2024-11-20 15:11:01', '2024-11-29 16:53:57', 'campaign_1732090256_673d9990a1797.jpeg', NULL, NULL, NULL, '100.00', NULL, 'fkNDL'),
(5, 'Help me bring my creative ideas to life', 'Lorem ipsum dolor sit amncididunt ut labore et', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor iLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 2, '3000.00', NULL, '0.00', '2024-12-05', '2024-12-23', 'active', '2024-11-26 02:15:04', '2024-11-26 02:15:04', 'campaign_1732558483_6744be93565d9.jpg', NULL, NULL, NULL, '20.00', NULL, 'fVoAIFrl'),
(6, 'Empowering Creativity: Funding Baqee\'s Innovative Textbook on Digital Art Techniques', ' Funding Baqee\'s Innovative Textbook on Digital Art Techniques', 'Ahmed, a talented graphic design student at Creative Minds University, needs a specialized textbook, \"Advanced Digital Art Techniques,\" which combines cutting-edge insights on AI tools, digital artistry, and practical exercises. This book will enable him to master critical skills and complete his final-year project: creating culturally inspired digital art to represent Nigeria\'s heritage.', 'The book, \"Advanced Digital Art Techniques,\" is critical for Ahmed\'s success. Without it, he risks falling behind in his coursework and losing access to key tools needed for his final-year project.By funding this campaign, you’re helping Ahmed not only complete his project but also open up opportunities to represent Nigeria in international digital art exhibitions, inspiring other young talents.', 2, '7000.00', NULL, '200.00', '2024-11-30', '2024-12-05', 'active', '2024-11-29 09:52:03', '2024-11-29 10:12:03', 'campaign_1732845080_67491e183e3c4.jpg', NULL, NULL, NULL, '0.00', 'digital art education, AI in creativity, Nigerian heritage, student support, graphic design textbook, final-year project, international exhibition, talent development, cultural representation, educational funding', 'ziRv53Mp'),
(7, 'Chima\'s Party', 'This campaign is to raise money to attend Chima\'s party', 'This campaign would make a difference because it will help me raise money to attend Chima\'s birthday party \r\n \r\n \r\n \r\n \r\n \r\n \r\n\r\n \r\n \r\n \r\n \r\n\r\n  \r\n  \r\n \r\n \r\n \r\n\r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n    \r\n \r\n \r\n    \r\n\r\n  \r\n \r\n\r\n \r\n \r\n \r\n \r\n\r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n\r\n \r\n \r\n \r\n \r\n \r\n \r\n', 'This campaign is important because Chima is a dear friend of mine and I need money to be able to attend her birthday party and get her a birthday present. Please support this campaign                                    \r\n\r\n\r\n \r\n \r\n      \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n\r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n   \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n  \r\n  \r\n   \r\n \r\n \r\n  \r\n \r\n  \r\n  \r\n\r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n ', 7, '20000.00', NULL, '300.00', '2024-11-29', '2024-12-20', 'active', '2024-11-29 15:57:57', '2024-11-29 16:05:24', 'campaign_1732895868_6749e47c20049.jpg', NULL, NULL, NULL, '100.00', 'friendship celebration, birthday fundraising, gift assistance, financial support, party attendance, special occasion, shared memories, heartfelt contribution, making a difference, being there for friends', 'Vgwa91YS'),
(8, 'Bridging the Skills Gap with Micro-Learning', 'Interactive modules to boost digital skills.', 'Problem: Many high school students graduate without practical skills relevant to todayâ€™s job market. Traditional educational systems often overlook the importance of soft skills (e.g., time management) and technical skills (e.g., coding, digital literacy).\r\nSolution:\r\nThis campaign introduces micro-learning modules, short and engaging lessons (3-5 minutes each), accessible through a mobile app or SMS-based platform.\r\n\r\nModules include:\r\n\r\nDigital Skills: Basic coding, graphic design, and using productivity tools (e.g., Google Suite).\r\nPractical Life Skills: Writing resumes, interview prep, budgeting basics.\r\nPersonal Growth: Emotional intelligence, time management, and conflict resolution.', 'This campaign introduces micro-learning modules, short and engaging lessons (3-5 minutes each), accessible through a mobile app or SMS-based platform.\r\n\r\nModules include:\r\n\r\nDigital Skills: Basic coding, graphic design, and using productivity tools (e.g., Google Suite).\r\nPractical Life Skills: Writing resumes, interview prep, budgeting basics.\r\nPersonal Growth: Emotional intelligence, time management, and conflict resolution.\r\n', 3, '5000.00', NULL, '0.00', '2024-11-30', '2024-12-06', 'active', '2024-11-29 21:44:06', '2024-11-29 21:44:06', 'campaign_1732916632_674a3598743bc.jpeg', NULL, NULL, NULL, '0.00', 'Micro-learning, digital literacy, practical life skills, personal growth, high school students, job market readiness, soft skills development, technical skills training, mobile app, SMS-based learning', 'UkPprsgv');

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
  `university_id` int(11) NOT NULL,
  `password` varchar(1000) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT 0.00,
  `faculty` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone` varchar(200) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `creators`
--

INSERT INTO `creators` (`id`, `fullname`, `email`, `role`, `department`, `university`, `university_id`, `password`, `balance`, `faculty`, `created_at`, `phone`, `faculty_id`, `department_id`) VALUES
(1, 'Prof. Jacob Mathews', 'jacob@funaab.com', 'admin', '', '', 5, '$2y$10$CQTfD6GADsiEmXboPEvJrOJtDWMkODIWQoTDmY7f0wRb8AG1d8clS', '0.00', NULL, '2024-11-18 12:13:42', '09022994499', 1, 1),
(2, 'Prof Odetola', 'odetola@funaab.com', 'admin', '', '', 5, '$2y$10$0H.tJZxoSad7fQwcjffQzeuzj9C.tV/Nrx4Yq1LnDCcaL.meUwaJe', '6000.00', NULL, '2024-11-19 21:28:40', '09022994499', 1, 4),
(3, 'Prof Okafor', 'okafor@unilag.com', 'admin', '', '', 31, '$2y$10$3nZX9HTFsBgdwaobPz7q1.zqxH4Ra0kdl9OQTXvyoIzM2tHlN6Zw2', '0.00', NULL, '2024-11-20 14:51:03', '08044004400', 5, 10);

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
(1, 1, 'Adegbola Abdulbaqee', '2000.00', 'baqee20072007@gmail.com', '2024-11-18 12:39:22'),
(2, 2, 'Adegbola Abdulbaqee', '2000.00', 'baqee20072007@gmail.com', '2024-11-18 13:01:07'),
(3, 3, 'Ayokunle Davies', '500.00', 'janet@gmail.com', '2024-11-19 18:56:20'),
(4, 3, 'James Daniel', '200.00', 'james@gmail.com', '2024-11-20 15:11:57'),
(5, 4, 'Adegbola Abdulbaqee', '300.00', 'baqee20072007@gmail.com', '2024-11-21 13:32:32'),
(6, 3, 'Anonymous Anonymous', '500.00', 'johnadekunle@gmail.com', '2024-11-21 17:49:54'),
(7, 3, 'JOhn Doe', '700.00', 'johnadekunle@gmail.com', '2024-11-22 16:10:57'),
(8, 2, 'Anonymous Anonymous', '500.00', 'johnadekunle@gmail.com', '2024-11-23 15:36:11'),
(9, 4, 'Anini Laura', '500.00', 'okafor@unilag.com', '2024-11-28 13:11:37'),
(10, 6, 'Adetona Adeyemi', '200.00', 'adetadeyemi@gmail.com', '2024-11-29 10:12:03'),
(11, 7, 'Adegbola Abdulbaqee', '300.00', 'baqee20072007@gmail.com', '2024-11-29 16:05:24');

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
(1, 1, 'FUNAAB-83F-642-690-4', 'P-C-20241118-JH4W8O0XDA', 1, 1, '5000.00', '5000.00', 'Paid', '2024-11-18 13:59:55', '2024-11-18 13:59:55', '2024-11-18 13:59:55'),
(7, 2, 'FUNAAB-1EA-117-2B4-7', 'P-C-20241128-VF6B4CGADK', 4, 2, '6000.00', '6000.00', 'Paid', '2024-11-28 15:00:01', '2024-11-28 15:00:01', '2024-11-28 15:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `reset_links`
--

CREATE TABLE `reset_links` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `code` varchar(1000) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `link_opened` enum('0','1','','') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reset_links`
--

INSERT INTO `reset_links` (`id`, `uid`, `code`, `timestamp`, `link_opened`) VALUES
(8, 2, '3c3e7671c420cd4841279bdc3775e92e38406a51d9860a063340197354efc185', '2024-11-28 01:24:53', '1');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `reference_id` varchar(2000) DEFAULT NULL,
  `gateway_reference` varchar(200) DEFAULT NULL,
  `name` varchar(2000) NOT NULL,
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
(1, 1, 'CAMPAIGN-720-F3F-339-3', 'P-C-20241117-MBXDW23G7K', 'Received fund from campaign - Help me buy a new CHM 101 textbook', '2000.00', 'credit', NULL, 'received-donation', 1, 'success', '2024-11-18 12:39:22'),
(2, 2, 'CAMPAIGN-720-F3F-339-3', 'P-C-20241117-MBXDW23G7K', 'Donated funds via gateway to campaign - Help me buy a new CHM 101 textbook', '2000.00', 'donate', NULL, 'donate', 1, 'success', '2024-11-18 12:39:22'),
(3, 2, 'CAMPAIGN-CBC-1BB-208-E', 'P-C-20241117-6OXVEMFI9H', 'Received fund from campaign - Fuel My Future: Adekunle John\'s 100L Laptop Fund', '2000.00', 'credit', NULL, 'received-donation', 2, 'success', '2024-11-18 13:01:07'),
(4, 1, 'FUNAAB-83F-642-690-4', 'P-C-20241118-JH4W8O0XDA', 'Paid - MTS 101 Manuals', '5000.00', 'debit', NULL, 'bill-payment', 1, 'success', '2024-11-18 13:59:55'),
(5, 4, 'CAMPAIGN-588-F3D-BA3-8', 'P-C-20241119-E6CK10LBOQ', 'Received fund from campaign - Help me pay my Medical Examination fee', '500.00', 'credit', NULL, 'received-donation', 3, 'success', '2024-11-19 18:56:20'),
(6, 4, 'CAMPAIGN-588-F3D-BA3-8', 'P-C-20241119-E6CK10LBOQ', 'Donated funds via gateway to campaign - Help me pay my Medical Examination fee', '500.00', 'donate', NULL, 'donate', 3, 'success', '2024-11-19 18:56:20'),
(7, 4, 'CAMPAIGN-833-E40-68D-D', 'P-C-20241120-7GTRQCEWDI', 'Received fund from campaign - Help me pay my Medical Examination fee', '200.00', 'credit', NULL, 'received-donation', 3, 'success', '2024-11-20 15:11:57'),
(8, 5, 'CAMPAIGN-833-E40-68D-D', 'P-C-20241120-7GTRQCEWDI', 'Donated funds via gateway to campaign - Help me pay my Medical Examination fee', '200.00', 'donate', NULL, 'donate', 3, 'success', '2024-11-20 15:11:57'),
(9, 5, 'CAMPAIGN-B9D-795-E7A-3', 'P-C-20241121-E08ATW4KN6', 'Received fund from campaign - Help me with hostel Rent', '300.00', 'credit', NULL, 'received-donation', 4, 'success', '2024-11-21 13:32:32'),
(10, 4, 'CAMPAIGN-DC5-914-7E3-8', 'P-C-20241121-Y5JP9I7A30', 'Received fund from campaign - Help me pay my Medical Examination fee', '500.00', 'credit', NULL, 'received-donation', 3, 'success', '2024-11-21 17:49:54'),
(11, 1, 'CAMPAIGN-DC5-914-7E3-8', 'P-C-20241121-Y5JP9I7A30', 'Donated funds via gateway to campaign - Help me pay my Medical Examination fee', '500.00', 'donate', NULL, 'donate', 3, 'success', '2024-11-21 17:49:54'),
(12, 4, 'CAMPAIGN-86B-50B-D54-1', 'P-C-20241122-NU7GSAVK1D', 'Received fund from campaign - Help me pay my Medical Examination fee', '700.00', 'credit', NULL, 'received-donation', 3, 'success', '2024-11-22 16:10:57'),
(13, 1, 'CAMPAIGN-86B-50B-D54-1', 'P-C-20241122-NU7GSAVK1D', 'Donated funds via gateway to campaign - Help me pay my Medical Examination fee', '700.00', 'donate', NULL, 'donate', 3, 'success', '2024-11-22 16:10:57'),
(14, 2, 'CAMPAIGN-905-082-891-8', 'P-C-20241123-RUG5M7Y2CD', 'Received fund from campaign - Fuel My Future: Adekunle John\'s 100L Laptop Fund', '500.00', 'credit', NULL, 'received-donation', 2, 'success', '2024-11-23 15:36:11'),
(15, 1, 'CAMPAIGN-905-082-891-8', 'P-C-20241123-RUG5M7Y2CD', 'Donated funds via gateway to campaign - Fuel My Future: Adekunle John\'s 100L Laptop Fund', '500.00', 'donate', NULL, 'donate', 2, 'success', '2024-11-23 15:36:11'),
(16, 5, 'CAMPAIGN-688-862-013-6', 'P-C-20241128-7B43Z51GXJ', 'Received fund from campaign - Help me with hostel Rent', '500.00', 'credit', NULL, 'received-donation', 4, 'success', '2024-11-28 13:11:37'),
(17, 2, 'FUNAAB-126-B53-079-A', 'P-C-20241128-FDQ3X07Y6P', 'Paid - MTS Exam handbook ', '6000.00', 'debit', NULL, 'bill-payment', 4, 'success', '2024-11-28 13:24:23'),
(18, 2, 'FUNAAB-F35-97E-802-5', 'P-C-20241128-G2JSH8VLWE', 'Paid - MTS Exam handbook ', '6000.00', 'debit', NULL, 'bill-payment', 4, 'success', '2024-11-28 14:40:48'),
(19, 2, 'FUNAAB-F35-97E-802-5', 'P-C-20241128-G2JSH8VLWE', 'Paid - MTS Exam handbook ', '6000.00', 'debit', NULL, 'bill-payment', 4, 'success', '2024-11-28 14:42:37'),
(20, 2, 'FUNAAB-F35-97E-802-5', 'P-C-20241128-G2JSH8VLWE', 'Paid - MTS Exam handbook ', '6000.00', 'debit', NULL, 'bill-payment', 4, 'success', '2024-11-28 14:43:15'),
(21, 2, 'FUNAAB-F35-97E-802-5', 'P-C-20241128-G2JSH8VLWE', 'Paid - MTS Exam handbook ', '6000.00', 'debit', NULL, 'bill-payment', 4, 'success', '2024-11-28 14:43:32'),
(22, 2, 'FUNAAB-1EA-117-2B4-7', 'P-C-20241128-VF6B4CGADK', 'Paid - MTS Exam handbook ', '6000.00', 'debit', NULL, 'bill-payment', 4, 'success', '2024-11-28 15:00:01'),
(23, 2, 'CAMPAIGN-FB4-861-35D-3', 'P-C-20241129-ZJ8RPHGNCA', 'Received fund from campaign - Empowering Creativity: Funding Baqee\'s Innovative Textbook on Digital Art Techniques', '200.00', 'credit', NULL, 'received-donation', 6, 'success', '2024-11-29 10:12:03'),
(24, 7, 'CAMPAIGN-47C-C73-32F-8', 'P-C-20241129-D2MGCXK74Y', 'Received fund from campaign - Chima\'s Party', '300.00', 'credit', NULL, 'received-donation', 7, 'success', '2024-11-29 16:05:24'),
(25, 2, 'CAMPAIGN-47C-C73-32F-8', 'P-C-20241129-D2MGCXK74Y', 'Donated funds via gateway to campaign - Chima\'s Party', '300.00', 'donate', NULL, 'donate', 7, 'success', '2024-11-29 16:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `abbreviation` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('Federal','State','Uniformed','Private') NOT NULL,
  `country` varchar(50) DEFAULT 'Nigeria',
  `email` varchar(1000) DEFAULT NULL,
  `password` varchar(1000) DEFAULT NULL,
  `secret_code` varchar(1000) DEFAULT NULL,
  `logo` varchar(1000) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`id`, `abbreviation`, `name`, `type`, `country`, `email`, `password`, `secret_code`, `logo`) VALUES
(5, 'FUNAAB', 'Federal University of Agriculture, Abeokuta', 'Federal', 'Nigeria', 'funaab@funaab.com', 'test', 'test', 'default.png'),
(31, 'UNILAG', 'University of Lagos', 'Federal', 'Nigeria', 'unilag@unilag.com', 'test', 'test', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `university_departments`
--

CREATE TABLE `university_departments` (
  `id` int(11) NOT NULL,
  `university_id` int(11) DEFAULT NULL,
  `university` varchar(1000) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `university_departments`
--

INSERT INTO `university_departments` (`id`, `university_id`, `university`, `faculty_id`, `name`, `timestamp`) VALUES
(1, 5, NULL, 1, 'Mathematics', '2024-11-18 12:12:10'),
(2, 5, NULL, 1, 'Computer Science', '2024-11-18 12:12:20'),
(3, 5, NULL, 1, 'Physics', '2024-11-18 12:12:36'),
(4, 5, NULL, 1, 'Chemistry', '2024-11-18 12:12:46'),
(5, 31, NULL, 3, 'Mechanical Engineering', '2024-11-20 14:48:52'),
(6, 31, NULL, 3, 'Computer Engineering', '2024-11-20 14:48:59'),
(7, 31, NULL, 3, 'Civil Engineering', '2024-11-20 14:49:13'),
(8, 31, NULL, 4, 'Medicine and Surgery', '2024-11-20 14:49:26'),
(9, 31, NULL, 4, 'Dentistry', '2024-11-20 14:49:31'),
(10, 31, NULL, 5, 'Computer Science', '2024-11-20 14:49:42'),
(11, 31, NULL, 5, 'Mathematics', '2024-11-20 14:49:48'),
(12, 31, NULL, 5, 'Physics', '2024-11-20 14:49:53'),
(13, 31, NULL, 5, 'Chemistry', '2024-11-20 14:49:58'),
(14, 5, NULL, 2, 'Mechanical Engineering', '2024-11-29 19:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `university_faculties`
--

CREATE TABLE `university_faculties` (
  `id` int(11) NOT NULL,
  `university_id` int(11) DEFAULT NULL,
  `university` varchar(500) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `university_faculties`
--

INSERT INTO `university_faculties` (`id`, `university_id`, `university`, `name`, `created_at`) VALUES
(1, 5, 'Federal University of Agriculture, Abeokuta', 'College of Physical Sciences', '2024-11-18 12:12:03'),
(2, 5, 'Federal University of Agriculture, Abeokuta', 'College of Engineering', '2024-11-19 21:36:48'),
(3, 31, 'University of Lagos', 'Engineering', '2024-11-20 14:47:39'),
(4, 31, 'University of Lagos', 'Medical Sciences', '2024-11-20 14:47:47'),
(5, 31, 'University of Lagos', 'Sciences', '2024-11-20 14:48:35');

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
(1, 'Adekunle John', 'johnadekunle@gmail.com', '2000.00', 'john', '08000000000', '2007-07-08', 'Nigeria', 'Ogun', 'FUNAAB', 'College of Physical Sciences', 'Mathematics', '20243001', '$2y$10$NNgx4I5JnaAU1hgRayhc4uuXHntca1J3ERnDMx6xAHOY/0Q1MRvmi', '100', NULL, NULL, NULL, '2024-11-17 22:09:07', '2024-11-25 07:00:07', 'male'),
(2, 'Adegbola AbdulBaqee', 'baqee20072007@gmail.com', '2700.00', 'baqx', '09019659410', '2007-07-08', 'Nigeria', 'Ogun', 'FUNAAB', 'Engineering', 'Mathematics', '20243905', '$2y$10$FbF71O7S20aiIhqFC.bVQeAIwKcPYQNLuFxEpu.w8a3nF0MAImKhm', '100', NULL, NULL, NULL, '2024-11-17 22:36:24', '2024-11-29 20:34:59', 'male'),
(3, 'Kate Perry', 'bgoldbaqee@yahoo.com', '0.00', 'perry', '09019659400', '2007-01-01', 'Nigeria', 'Ogun', 'FUNAAB', 'College of Physical Sciences', 'Computer Science', '970770', '$2y$10$aijQr7T1Ca8pLhOYLn.hTOrbU/yEDm8j2TeZvTl0.8H7qdkwpXgGe', '100', NULL, NULL, NULL, '2024-11-18 00:02:45', '2024-11-29 13:11:43', 'male'),
(4, 'Olapade Janet', 'janet@gmail.com', '1900.00', 'janet', '08044661188', '2005-11-19', 'Nigeria', 'Ogun', 'FUNAAB', 'College of Physical Sciences', 'Chemistry', '20225677', '$2y$10$ysBXjicHxYOr/NwHHwfbx.bnXWeWRgYeSxkzZNNM3Cdk3nt/dKcZm', '100', NULL, NULL, NULL, '2024-11-19 03:44:37', '2024-11-19 03:45:13', 'female'),
(5, 'James Daniel', 'james@gmail.com', '800.00', 'james', '08044553355', '2003-11-20', 'Nigeria', 'Ogun', 'UNILAG', 'Sciences', 'Computer Science', '2024268', '$2y$10$nv8di9jOjahvMU84PbvF6.PTOcGxgjF0TGPquCBSdVW3FLELAKuK.', '100', NULL, NULL, NULL, '2024-11-20 00:07:59', '2024-11-20 00:08:15', 'male'),
(6, 'Chiagozie Godswill', 'baqeecodes@gmail.com', '0.00', 'Chiagozie', '08055228833', '2004-11-28', 'Nigeria', 'Ogun', 'FUNAAB', '1', 'Mathematics', '20243456', '$2y$10$v62pFEArdc2i7EKG6ugEZOerC9TskIHboCxZ4CJxYzBV9h1AxJra2', '100', NULL, NULL, NULL, '2024-11-28 06:06:13', '2024-11-28 06:06:37', 'female'),
(7, 'Oluwasetemi Kunle-Ajayi', 'johnajayi008@gmail.com', '300.00', 'Setemi', '09166248240', '2008-10-28', 'Nigeria', 'Ogun', 'UNILAG', '5', 'Computer Science', '737383939493', '$2y$10$nqy1peE4gH3QdQnVyt./kOa722JQ3nTqo8gpR1ez1jfZon5Znp3bW', '100', NULL, NULL, NULL, '2024-11-29 07:48:40', '2024-11-29 07:48:59', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `user_payouts`
--

CREATE TABLE `user_payouts` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `payout_method` varchar(255) NOT NULL,
  `bank_account_name` varchar(255) DEFAULT NULL,
  `bank_account_number` varchar(50) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `merchant_reference` varchar(255) DEFAULT NULL,
  `gateway_reference` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Processed','Failed','Cancelled') DEFAULT 'Pending',
  `remarks` text DEFAULT NULL,
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `processed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_transactions`
--
ALTER TABLE `admin_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

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
-- Indexes for table `reset_links`
--
ALTER TABLE `reset_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`(255));

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
-- Indexes for table `university_departments`
--
ALTER TABLE `university_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `university_faculties`
--
ALTER TABLE `university_faculties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_payouts`
--
ALTER TABLE `user_payouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_transactions`
--
ALTER TABLE `admin_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bill_invoice`
--
ALTER TABLE `bill_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `creators`
--
ALTER TABLE `creators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reset_links`
--
ALTER TABLE `reset_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `university_departments`
--
ALTER TABLE `university_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `university_faculties`
--
ALTER TABLE `university_faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_payouts`
--
ALTER TABLE `user_payouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_transactions`
--
ALTER TABLE `admin_transactions`
  ADD CONSTRAINT `admin_transactions_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `creators` (`id`);

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

--
-- Constraints for table `user_payouts`
--
ALTER TABLE `user_payouts`
  ADD CONSTRAINT `user_payouts_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
