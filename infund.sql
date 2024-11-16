-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 04:21 PM
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
(1, 'Computer Networks Manual', 5, 3, 'FUNAAB-1AE-904-09D-5', 'P-C-20241115-IUARWKY34B', '2024-11-20', 16500.00, 'Paid', 'False', '2024-11-15 09:48:07', '2024-11-15 09:50:42'),
(2, 'Programming Fundamentals Handbook', 1, 3, 'FUNAAB-EE2-F5E-315-B', 'P-C-20241115-W5EF6MPDVC', '2024-11-30', 15000.00, 'Paid', 'False', '2024-11-15 10:58:10', '2024-11-15 10:59:15'),
(3, 'Software Engineering Project Guide', 4, 3, 'FUNAAB-3A3-AD7-F25-D', 'P-C-20241115-QB93YXSHIL', '2024-12-01', 20000.00, 'Paid', 'False', '2024-11-15 18:12:08', '2024-11-15 18:12:40');

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
(2, 'Help me go to Rema\'s concert', 'Your support extends beyond attending a concert; it fuels fandom, community, and cultural appreciation. By contributing, you\'ll: 1. Enable a devoted fan to experience pure joy 2. Promote African music and cultural exchange 3. Encourage enthusiasm and dedication 4. Create lifelong memories Every donation counts! Thank you for helping make my Rema concert dream a reality!', 'Rema\'s music resonates deeply with me, providing motivation, comfort, and happiness. His artistry inspires me to pursue my passions, embrace individuality, and celebrate African culture. Attending the concert will be an unforgettable experience, allowing me to connect with fellow fans and witness his electrifying performance live. Your contribution will bring me closer to realizing this dream, fostering unforgettable memories.', 'Rema\'s music resonates deeply with me, providing motivation, comfort, and happiness. His artistry inspires me to pursue my passions, embrace individuality, and celebrate African culture. Attending the concert will be an unforgettable experience, allowing me to connect with fellow fans and witness his electrifying performance live. Your contribution will bring me closer to realizing this dream, fostering unforgettable memories.', 3, 50000.00, 53507.00, '2024-11-11', '2024-12-15', 'completed', '2024-11-11 03:35:46', '2024-11-15 09:46:58', 'campaign_1731296146_67317b9222ddc.png', NULL, NULL, NULL),
(3, 'Help me buy Garri', 'We all love garri,231150511233,231150511233', '\r\nCode Corsair\r\nLorel Ipsum\r\nAdegbola AbdulBaqee\r\nMathematics\r\n3 days left\r\n2 donors\r\n₦6,000.00 raised\r\n₦4,000.00 goal\r\n\r\nShare\r\n\r\nWhatsApp\r\n\r\nTwitter\r\nAbout This Campaign\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sapien est, interdum sed aliquam non, tempus sit amet elit. Aenean non tristique felis. Aliquam efficitur euismod arcu, eget finibus turpis aliquam at. In hac habitasse platea dictumst. Integer semper hendrerit diam, quis dictum erat scelerisque eget. Morbi malesuada sapien at urna dictum, ut varius ligula porta. Proin sodales, leo nec pellentesque finibus, ex tortor hendrerit sem, sit amet pulvinar nibh nunc quis nunc. Curabitur lectus orci, feugiat at ipsum ut, interdum feugiat leo. Quisque et semper augue, eget ullamcorper nisl. Quisque magna diam, congue ac enim et, finibus elementum diam. Phasellus nibh nunc, interdum ut dignissim eget, aliquet sit amet nisl. Sed tincidunt faucibus erat, feugiat sollicitudin lectus tincidunt in. Vivamus ac elit sit amet ante fringilla blandit. Vivamus pretium, massa tincidunt volutpat rhoncus, nunc lectus faucibus sem, eget congue justo neque eu enim. Aenean rutrum egestas suscipit. Duis id congue sapien.', '\r\nCode Corsair\r\nLorel Ipsum\r\nAdegbola AbdulBaqee\r\nMathematics\r\n3 days left\r\n2 donors\r\n₦6,000.00 raised\r\n₦4,000.00 goal\r\n\r\nShare\r\n\r\nWhatsApp\r\n\r\nTwitter\r\nAbout This Campaign\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sapien est, interdum sed aliquam non, tempus sit amet elit. Aenean non tristique felis. Aliquam efficitur euismod arcu, eget finibus turpis aliquam at. In hac habitasse platea dictumst. Integer semper hendrerit diam, quis dictum erat scelerisque eget. Morbi malesuada sapien at urna dictum, ut varius ligula porta. Proin sodales, leo nec pellentesque finibus, ex tortor hendrerit sem, sit amet pulvinar nibh nunc quis nunc. Curabitur lectus orci, feugiat at ipsum ut, interdum feugiat leo. Quisque et semper augue, eget ullamcorper nisl. Quisque magna diam, congue ac enim et, finibus elementum diam. Phasellus nibh nunc, interdum ut dignissim eget, aliquet sit amet nisl. Sed tincidunt faucibus erat, feugiat sollicitudin lectus tincidunt in. Vivamus ac elit sit amet ante fringilla blandit. Vivamus pretium, massa tincidunt volutpat rhoncus, nunc lectus faucibus sem, eget congue justo neque eu enim. Aenean rutrum egestas suscipit. Duis id congue sapien.', 4, 70000.00, 80000.00, '2024-11-15', '2024-11-21', 'completed', '2024-11-15 01:46:10', '2024-11-15 01:53:25', 'campaign_1731635170_6736a7e284b23.jpg', 'campaign_1731635170_6736a7e285774.jpg', 'campaign_1731635170_6736a7e28676f.jpg', NULL);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `creators`
--

INSERT INTO `creators` (`id`, `fullname`, `email`, `role`, `department`, `university`, `university_id`, `password`, `created_at`) VALUES
(1, 'Dr. John Smith', 'john.smith@uni.edu', 'lecturer', 'Computer Science', 'UNI', 0, NULL, '2024-01-01 09:00:00'),
(2, 'Prof. Sarah Johnson', 'sarah.j@uni.edu', 'admin', 'Computer Science', 'FUNAAB', 0, NULL, '2024-01-01 09:00:00'),
(3, 'Mr. James Wilson', 'james.w@uni.edu', 'headofclass', 'Computer Science', 'UNI', 0, NULL, '2024-01-01 09:00:00');

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
(1, 2, 'Adegbola Abdulbaqee', 2000.00, 'baqee20072007@gmail.com', '2024-11-15 09:46:58');

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
(1, 3, 'FUNAAB-1AE-904-09D-5', 'P-C-20241115-IUARWKY34B', 5, 3, 16500.00, 16500.00, 'Paid', '2024-11-15 09:50:42', '2024-11-15 09:50:42', '2024-11-15 09:50:42'),
(2, 3, 'FUNAAB-EE2-F5E-315-B', 'P-C-20241115-W5EF6MPDVC', 1, 3, 15000.00, 15000.00, 'Paid', '2024-11-15 10:59:15', '2024-11-15 10:59:15', '2024-11-15 10:59:15'),
(3, 3, 'FUNAAB-3A3-AD7-F25-D', 'P-C-20241115-QB93YXSHIL', 4, 3, 20000.00, 20000.00, 'Paid', '2024-11-15 18:12:40', '2024-11-15 18:12:40', '2024-11-15 18:12:40');

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
(22, 4, 'FUNAAB-23D-416-3CA-B', 'P-C-20241115-RB5UDSJG3L', 'Paid - Data Structures Manual', 12000.00, 'debit', NULL, 'bill-payment', 2, 'success', '2024-11-15 01:19:54'),
(23, 3, 'CAMPAIGN-BDC-471-A76-E', 'P-C-20241115-7SGDQVC534', 'Received fund from campaign - Help me go to Rema\'s concert', 5000.00, 'credit', NULL, 'received-donation', 2, 'success', '2024-11-15 01:37:00'),
(24, 4, 'CAMPAIGN-BDC-471-A76-E', 'P-C-20241115-7SGDQVC534', 'Donated funds via gateway to campaign - Help me go to Rema\'s concert', 5000.00, 'donate', NULL, 'donate', 2, 'success', '2024-11-15 01:37:00'),
(25, 4, 'CAMPAIGN-206-35C-FBF-B', 'P-C-20241115-6O1YFUVTBM', 'Received fund from campaign - Help me buy Garri', 80000.00, 'credit', NULL, 'received-donation', 3, 'success', '2024-11-15 01:53:25'),
(26, 3, 'CAMPAIGN-206-35C-FBF-B', 'P-C-20241115-6O1YFUVTBM', 'Donated funds via gateway to campaign - Help me buy Garri', 80000.00, 'donate', NULL, 'donate', 3, 'success', '2024-11-15 01:53:25'),
(27, 3, 'CAMPAIGN-FAC-2EA-EBD-6', 'P-C-20241115-UVHLAZP07G', 'Received fund from campaign - Help me go to Rema\'s concert', 2000.00, 'credit', NULL, 'received-donation', 2, 'success', '2024-11-15 09:46:58'),
(28, 3, 'CAMPAIGN-FAC-2EA-EBD-6', 'P-C-20241115-UVHLAZP07G', 'Donated funds via gateway to campaign - Help me go to Rema\'s concert', 2000.00, 'donate', NULL, 'donate', 2, 'success', '2024-11-15 09:46:58'),
(29, 3, 'FUNAAB-1AE-904-09D-5', 'P-C-20241115-IUARWKY34B', 'Paid - Computer Networks Manual', 16500.00, 'debit', NULL, 'bill-payment', 5, 'success', '2024-11-15 09:50:42'),
(30, 3, 'FUNAAB-EE2-F5E-315-B', 'P-C-20241115-W5EF6MPDVC', 'Paid - Programming Fundamentals Handbook', 15000.00, 'debit', NULL, 'bill-payment', 1, 'success', '2024-11-15 10:59:15'),
(31, 3, 'FUNAAB-3A3-AD7-F25-D', 'P-C-20241115-QB93YXSHIL', 'Paid - Software Engineering Project Guide', 20000.00, 'debit', NULL, 'bill-payment', 4, 'success', '2024-11-15 18:12:40');

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
(1, 'ATBU', 'Abubakar Tafawa Balewa University, Bauchi', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(2, 'ABU', 'Ahmadu Bello University, Zaria', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(3, 'AE-FUNAI', 'Alex Ekwueme Federal University Ndufu Alike Ikwo', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(4, 'BUK', 'Bayero University, Kano', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(5, 'FUNAAB', 'Federal University of Agriculture, Abeokuta', 'Federal', 'Nigeria', 'funaab@gmail.com', 'test', 'test', 'default.png'),
(6, 'FUBK', 'Federal University Birnin Kebbi', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(7, 'FUD', 'Federal University Dutse', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(8, 'FUDMA', 'Federal University Dutsin Ma', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(9, 'FUG', 'Federal University Gashua', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(10, 'FUGUS', 'Federal University Gusau', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(11, 'FUHSO', 'Federal University of Health Sciences, Otukpo', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(12, 'FUHSA', 'Federal University of Health Sciences, Azare', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(13, 'FUK', 'Federal University Kashere', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(14, 'FUL', 'Federal University Lafia', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(15, 'FULOKOJA', 'Federal University Lokoja', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(16, 'FUMA', 'Federal University of Agriculture, Makurdi', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(17, 'FUPRE', 'Federal University of Petroleum Resources, Effurun', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(18, 'FUTA', 'Federal University of Technology, Akure', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(19, 'FUTMINNA', 'Federal University of Technology, Minna', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(20, 'FUTY', 'Federal University of Technology, Yola', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(21, 'FUO', 'Federal University Otuoke', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(22, 'FUWUKARI', 'Federal University Wukari', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(23, 'IBBUL', 'Ibrahim Badamasi Babangida University, Lapai', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(24, 'JABU', 'Joseph Ayo Babalola University, Ikeji-Arakeji', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(25, 'KWASU', 'Kwara State University, Malete', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(26, 'MOUA', 'Michael Okpara University of Agriculture, Umudike', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(27, 'NAUB', 'Nigerian Army University Biu', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(28, 'NSUK', 'Nasarawa State University, Keffi', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(29, 'OAU', 'Obafemi Awolowo University, Ile-Ife', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(30, 'UNIJOS', 'University of Jos', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(31, 'UNILAG', 'University of Lagos', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(32, 'UNILORIN', 'University of Ilorin', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(33, 'UNIMAID', 'University of Maiduguri', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(34, 'UNIPORT', 'University of Port Harcourt', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(35, 'UNN', 'University of Nigeria, Nsukka', 'Federal', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(36, 'ABSU', 'Abia State University, Uturu', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(37, 'ADSU', 'Adamawa State University, Mubi', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(38, 'AAUA', 'Adekunle Ajasin University, Akungba-Akoko', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(39, 'AKSU', 'Akwa Ibom State University, Uyo', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(40, 'ADUSTECH', 'Aliko Dangote University of Science and Technology, Wudil', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(41, 'AAU', 'Ambrose Alli University, Ekpoma', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(42, 'ANSU', 'Anambra State University, Uli', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(43, 'BAUCHISTAT', 'Bauchi State University, Gadau', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(44, 'BSU', 'Benue State University, Makurdi', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(45, 'YUMSUK', 'Yusuf Maitama Sule University, Kano', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(46, 'COOU', 'Chukwuemeka Odumegwu Ojukwu University, Uli', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(47, 'CRUTECH', 'Cross River University of Technology, Calabar', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(48, 'DSU', 'Delta State University, Abraka', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(49, 'EBSU', 'Ebonyi State University, Abakaliki', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(50, 'EUI', 'Edo University, Iyamho', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(51, 'ESUT', 'Enugu State University of Science and Technology, Enugu', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(52, 'GOMSU', 'Gombe State University, Gombe', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(53, 'GSU', 'Gombe State University of Science and Technology', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(54, 'IAUE', 'Ignatius Ajuru University of Education, Port Harcourt', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(55, 'IKUN', 'Ibrahim Gbadamosi Babangida University, Lapai', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(56, 'IMSU', 'Imo State University, Owerri', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(57, 'KASU', 'Kaduna State University, Kaduna', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(58, 'KSUSTA', 'Kebbi State University of Science and Technology, Aliero', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(59, 'KSUST', 'Kogi State University, Anyigba', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(60, 'LAUTECH', 'Ladoke Akintola University of Technology, Ogbomoso', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(61, 'LASU', 'Lagos State University, Ojo', 'State', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(62, 'AFIT', 'Nigeria Airforce University, Kaduna', 'Uniformed', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(63, 'NMU', 'Nigeria Maritime University, Warri', 'Uniformed', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(64, 'POLAC', 'Nigeria Police Academy Wudil, Kano', 'Uniformed', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(65, 'NUAB', 'Nigerian Army University Biu, Borno', 'Uniformed', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(66, 'NDA', 'Nigerian Defence Academy, Kaduna', 'Uniformed', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(67, 'AC', 'Achievers University, Owo', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(68, 'AUE', 'Adeleke University, Ede', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(69, 'ABUAD', 'Afe Babalola University, Ado-Ekiti', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(70, 'AUST', 'African University of Science and Technology, Abuja', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(71, 'APU', 'Ahman Pategi University, Pategi', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(72, 'ACU', 'Ajayi Crowther University, Oyo', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(73, 'ALHIKMAH', 'Al-Hikmah University, Ilorin', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(74, 'AUN', 'American University of Nigeria, Yola', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(75, 'AB', 'Augustine University, Ilara', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(76, 'BabcockU', 'Babcock University, Ilishan Remo', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(77, 'BU', 'Baze University, Abuja', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(78, 'BCU', 'Bells University of Technology, Ota', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(79, 'BNU', 'Benson Idahosa University, Benin City', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(80, 'BUI', 'Bingham University, Karu', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(81, 'BUK', 'Bowen University, Iwo', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(82, 'CU', 'Covenant University, Ota', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(83, 'CBU', 'Chrisland University, Abeokuta', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(84, 'GOU', 'Godfrey Okoye University, Enugu', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(85, 'GU', 'Gregory University, Uturu', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(86, 'HEGT', 'Hallmark University, Ijebu-Itele', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(87, 'KCU', 'Kwararafa University, Wukari', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(88, 'LSU', 'Landmark University, Omu-Aran', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(89, 'LU', 'Lead City University, Ibadan', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png'),
(90, 'MCU', 'McPherson University, Seriki Sotayo', 'Private', 'Nigeria', NULL, NULL, NULL, 'default.png');

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
(2, 5, NULL, 10, 'lol', '2024-11-16 08:33:45'),
(4, 5, NULL, 8, 'Computer Science', '2024-11-16 12:02:55');

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
(5, 5, 'Federal University of Agriculture, Abeokuta', 'COLAMRUD', '2024-11-16 07:24:30'),
(6, 5, 'Federal University of Agriculture, Abeokuta', 'COLPHEC', '2024-11-16 07:24:35'),
(7, 5, 'Federal University of Agriculture, Abeokuta', 'COLPHYS', '2024-11-16 07:24:39'),
(8, 5, 'Federal University of Agriculture, Abeokuta', 'College of Physics', '2024-11-16 07:38:13'),
(9, 5, 'Federal University of Agriculture, Abeokuta', 'f3', '2024-11-16 07:41:33'),
(10, 5, 'Federal University of Agriculture, Abeokuta', 'College of Physicss', '2024-11-16 08:33:32');

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
(3, 'Adegbola AbdulBaqee', 'baqee20072007@gmail.com', 37200.00, 'baqx', '09019659410', '2007-07-08', 'Nigeria', 'Ogun', 'FUNAAB', 'Engineering', 'Mathematics', 'baqx', '$2y$10$ZezJMEaMs5VWm7iIZ5VlbOV3YENFQY7w7p7AxTqIan1OCUEIP/1nq', '100', NULL, NULL, NULL, '2024-11-10 07:28:45', '2024-11-16 15:57:44', 'male'),
(4, 'Code Corsair ', 'baqeecodes@gmail.com', 80000.00, 'iambaqx', '09019659420', '2007-11-10', 'Nigeria', 'Ogun', 'BabcockU', 'Engineering', 'Computer Science', '20243900', '$2y$10$9dGg1v6.UVAwtH2Ixm1ajOCCQlgf9Mzi4WsRWVCeaAtZBuH5lyB1G', '100', NULL, NULL, NULL, '2024-11-10 13:25:38', '2024-11-15 11:53:21', 'male'),
(5, 'Adeknle Gold', 'bgoldbaqee@yahoo.com', 0.00, 'baqxes', '09119659410', '2007-07-08', 'Nigeria', 'Ogun', 'FUNAAB', 'Engineering', 'Computer Science', '20143905', '$2y$10$5lcYZVBH5yrggt7H70HB5e3b689YL30FZhN97Ts39NihiT799RSQ6', '100', NULL, NULL, NULL, '2024-11-11 06:04:05', '2024-11-11 08:58:53', 'male');

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
-- Dumping data for table `user_payouts`
--

INSERT INTO `user_payouts` (`id`, `uid`, `amount`, `payout_method`, `bank_account_name`, `bank_account_number`, `bank_name`, `merchant_reference`, `gateway_reference`, `status`, `remarks`, `requested_at`, `processed_at`) VALUES
(1, 3, 2000.00, 'bank_transfer', 'Adegbola Abdulbaqee', '9019659410', 'ACCESS BANK', 'WD_1731668703_3', NULL, 'Pending', NULL, '2024-11-15 11:05:03', NULL);

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
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bill_invoice`
--
ALTER TABLE `bill_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `creators`
--
ALTER TABLE `creators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `university_departments`
--
ALTER TABLE `university_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `university_faculties`
--
ALTER TABLE `university_faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_payouts`
--
ALTER TABLE `user_payouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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

--
-- Constraints for table `user_payouts`
--
ALTER TABLE `user_payouts`
  ADD CONSTRAINT `user_payouts_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
