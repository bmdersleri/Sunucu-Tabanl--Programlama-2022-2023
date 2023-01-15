-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 15 Oca 2023, 11:44:30
-- Sunucu sürümü: 5.7.40
-- PHP Sürümü: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `esraarslan`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baslik` varchar(100) COLLATE utf8_bin NOT NULL,
  `resim` varchar(100) COLLATE utf8_bin NOT NULL,
  `icerik` longtext COLLATE utf8_bin NOT NULL,
  `tarih` datetime NOT NULL,
  `sefurl` varchar(120) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `blog`
--

INSERT INTO `blog` (`id`, `baslik`, `resim`, `icerik`, `tarih`, `sefurl`) VALUES
(1, 'İletişim', 'https://cdn2.iconfinder.com/data/icons/contact-us-set/100/contact_us_office_business_work-25-64.png', '<p><strong>E-mail:</strong> arslanesratr@gmail.com</p>', '2023-01-14 09:40:45', 'iletisim'),
(2, 'İş Deneyimleri', 'https://cdn1.iconfinder.com/data/icons/company-business-people/32/busibess_people-37-64.png', '<p><strong>2022- Devam</strong> Alisan Lojistik Yazilim Muhendisi</p>\r\n<p><strong>2022 </strong>&nbsp;Alisan Lojistik Stajyer</p>', '2023-01-14 09:45:28', 'is-deneyimleri'),
(4, 'Eğitim', 'https://cdn3.iconfinder.com/data/icons/education-1-1/256/School-64.png', '<p>2007 yılında Marasal Fevzi Cakmak İlkokulunda ilkogretim ve ortaogretim egitimimi tamamladıktan sonra Sultanbeyli Anadolu Lisesinde eğitim g&ouml;rmeye devam ettim. 2019 yılında Mehmet Akif Ersoy Universitesi Bilgisayar Muhendisligi Bolumune girmeye hak kazandım. Suan 4. sınıf ogrencisi olarak egitimime devam etmekteyim.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', '2023-01-14 09:50:21', 'egitim'),
(5, '|', 'https://cdn1.iconfinder.com/data/icons/computer-techologies-outline-part-1/128/ic_me_about-64.png', '<p>2000 yılında İstanbul\'da doğdum.</p>', '2023-01-14 09:50:59', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sayfalar`
--

DROP TABLE IF EXISTS `sayfalar`;
CREATE TABLE IF NOT EXISTS `sayfalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sira` int(11) NOT NULL,
  `baslik` varchar(100) COLLATE utf8_bin NOT NULL,
  `icon` varchar(10) COLLATE utf8_bin NOT NULL,
  `icerik` longtext COLLATE utf8_bin NOT NULL,
  `sefurl` varchar(120) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `sayfalar`
--

INSERT INTO `sayfalar` (`id`, `sira`, `baslik`, `icon`, `icerik`, `sefurl`) VALUES
(1, 2, 'İletişim', 'phone', '<p><strong><img src=\"https://cdn4.iconfinder.com/data/icons/multimedia-75/512/multimedia-01-64.png\" alt=\"phone, telephone, cell, call, communication, multimedia \" width=\"32\" height=\"32\" />Telefon Numarası: </strong>0542&nbsp; 671 80 13</p>\r\n<p>&nbsp;</p>\r\n<p><strong><img src=\"https://cdn4.iconfinder.com/data/icons/quality-control-check-mark-glyph/72/GALYPH-17-64.png\" alt=\"device approval, free phones, government phone, job phone, official phone, phone approval \" width=\"33\" height=\"33\" />&nbsp;İş Telefonu:</strong> 0532 312 07 58</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://cdn1.iconfinder.com/data/icons/neutro-essential/32/email-64.png\" alt=\"email, letter, mail, envelope, message, send \" width=\"27\" height=\"27\" /> <strong>E-mail:</strong> <a href=\"mailto:arslanesratr@gmail.com\">arslanesratr@gmail.com</a></p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://cdn2.iconfinder.com/data/icons/font-awesome/1792/fax-64.png\" alt=\"fax \" width=\"31\" height=\"31\" /> <strong>Fax:&nbsp;</strong>0212 325 02 01</p>\r\n<p>&nbsp;</p>', 'iletisim'),
(2, 1, 'Teknolojiler', 'file', '<p style=\"text-align: left;\"><strong><img src=\"https://cdn3.iconfinder.com/data/icons/programming-languages-4/222/c-64.png\" alt=\"c, c sharp, c#, csharp, langague, prog, programming, extension, file \" width=\"52\" height=\"52\" />&nbsp; &nbsp; C#&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img src=\"https://cdn0.iconfinder.com/data/icons/font-awesome-brands-vol-2/512/node-js-64.png\" alt=\"node, js \" width=\"55\" height=\"55\" />&nbsp; &nbsp; JacaScript&nbsp; &nbsp; &nbsp;</strong></p>\r\n<p><strong> <img src=\"https://cdn4.iconfinder.com/data/icons/logos-brands-5/24/php-64.png\" alt=\"php \" width=\"53\" height=\"53\" />&nbsp; &nbsp; Php&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img src=\"https://cdn2.iconfinder.com/data/icons/programming-5/24/MySQL-Database-64.png\" alt=\"database, mysql, coding, development, language \" width=\"53\" height=\"53\" />&nbsp; &nbsp; MySQL&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</strong></p>\r\n<p><img style=\"color: #626262; font-weight: bold;\" src=\"https://cdn4.iconfinder.com/data/icons/logos-brands-5/24/flutter-64.png\" alt=\"flutter \" width=\"45\" height=\"45\" /><strong>&nbsp; &nbsp;Flutter&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <img src=\"https://cdn4.iconfinder.com/data/icons/logos-brands-5/24/mongodb-512.png\" alt=\"Mongodb icon - Free download on Iconfinder\" width=\"43\" height=\"43\" />&nbsp; &nbsp; MongoDB</strong></p>\r\n<p><strong><img src=\"https://cdn1.iconfinder.com/data/icons/ionicons-fill-vol-2/512/logo-vue-64.png\" alt=\"logo, vue \" width=\"50\" height=\"50\" /> Vue.js&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <img src=\"https://cdn4.iconfinder.com/data/icons/logos-brands-5/24/postgresql-64.png\" alt=\"postgresql \" width=\"45\" height=\"45\" />&nbsp; &nbsp;PostegroSQL</strong></p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong> &nbsp;</strong></p>\r\n<p><strong>&nbsp;&nbsp;&nbsp;</strong></p>\r\n<p><strong>&nbsp;&nbsp;</strong></p>', 'teknolojiler');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `siteadi_title` varchar(200) COLLATE utf8_bin NOT NULL,
  `siteadi_sidebar` varchar(100) COLLATE utf8_bin NOT NULL,
  `siteadi_head` varchar(100) COLLATE utf8_bin NOT NULL,
  `siteadi_intro` text COLLATE utf8_bin NOT NULL,
  `keywords` varchar(200) COLLATE utf8_bin NOT NULL,
  `description` varchar(200) COLLATE utf8_bin NOT NULL,
  `analytics` text COLLATE utf8_bin NOT NULL,
  `color` int(11) NOT NULL,
  `about` text COLLATE utf8_bin NOT NULL,
  `facebook` varchar(100) COLLATE utf8_bin NOT NULL,
  `twitter` varchar(100) COLLATE utf8_bin NOT NULL,
  `instagram` varchar(100) COLLATE utf8_bin NOT NULL,
  `youtube` varchar(100) COLLATE utf8_bin NOT NULL,
  `linkedin` varchar(100) COLLATE utf8_bin NOT NULL,
  `pinterest` varchar(100) COLLATE utf8_bin NOT NULL,
  `github` varchar(100) COLLATE utf8_bin NOT NULL,
  `stackoverflow` varchar(100) COLLATE utf8_bin NOT NULL,
  `codepen` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`siteadi_title`, `siteadi_sidebar`, `siteadi_head`, `siteadi_intro`, `keywords`, `description`, `analytics`, `color`, `about`, `facebook`, `twitter`, `instagram`, `youtube`, `linkedin`, `pinterest`, `github`, `stackoverflow`, `codepen`) VALUES
('Esra Arslan', 'Esra Arslan', 'HAKKIMDA', '', '#', '#', '', 5, 'Bilgisayar Mühendisi', '#', '', 'https://www.instagram.com/_eesrarslan/', '', 'https://www.linkedin.com/in/esra-arslan-350b48223/', '', 'https://github.com/esra-arslan', '', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yonetim`
--

DROP TABLE IF EXISTS `yonetim`;
CREATE TABLE IF NOT EXISTS `yonetim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_bin NOT NULL,
  `password` varchar(32) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `yonetim`
--

INSERT INTO `yonetim` (`id`, `username`, `password`) VALUES
(1, 'esraarslan', 'e10adc3949ba59abbe56e057f20f883e');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
