-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 Oca 2023, 03:15:23
-- Sunucu sürümü: 10.4.27-MariaDB
-- PHP Sürümü: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `deneme`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hakkimizda`
--

CREATE TABLE `hakkimizda` (
  `aciklama` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `hakkimizda`
--

INSERT INTO `hakkimizda` (`aciklama`) VALUES
('Son günlerde teknoloji kullanımına önem veren firmaların kurumsal bir web sitesine olan ilgisi ve ihtiyacını artırdı. Avcı Yazılım web sitesi, tasarımı, dijital pazarlama hizmeti verilmektedir.\r\n\r\nYazılımın her firmaya olan ihtiyacı vardır. Avcı Yazılım büyük küçük işletlerin stok takiplerinin ve gelir giderlerinin kolayca işlenebileceği yazılımlar geliştirmektedir.\r\n\r\nAvcı yazılım hizmette sınır yok ilkesiyle her alanda hizmet vermeyi faydalı yazılımlar geliştirmeyi vizyon edinmiştir. Avcı yazılım. teklif ve öneriler doğrultusunda yazılım hizmeti vermektedir.\r\n\r\nAvcı yazılım gerekli deneyim ve tecrübeye sahip uzman eğitim kadrosuyla yazılımın gelecekteki temelini atmıştır. Avcı yazılım e-ticaret-web sitesi ve programlama konularında ihtiyaca göre proje geliştirmektedir\r\n\r\nAyrıca Seo çalışması, dijital pazarlama konularında müşterilere hizmet vermektedir.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hizmetlerimiz`
--

CREATE TABLE `hizmetlerimiz` (
  `aciklama` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `hizmetlerimiz`
--

INSERT INTO `hizmetlerimiz` (`aciklama`) VALUES
('<li>Web Sitesiyle firmanızı tanıtır.</li>\r\n<li>E-Ticaret ile ürünlerinizi satışa çıkarır.</li>\r\n<li>Masaüstü programlama ile hizmet sektörüne katkı sağlar.</li>\r\n');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `id` tinyint(4) NOT NULL,
  `kullanici` varchar(50) NOT NULL,
  `sifre` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`id`, `kullanici`, `sifre`) VALUES
(1, 'mahsum', '1234'),
(3, 'mehmet', '1234');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `portfolyo`
--

CREATE TABLE `portfolyo` (
  `id` smallint(6) NOT NULL,
  `baslik` varchar(250) NOT NULL,
  `resim` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `portfolyo`
--

INSERT INTO `portfolyo` (`id`, `baslik`, `resim`) VALUES
(24, '', '../img/3.jpg'),
(25, '', '../img/4.jpg'),
(26, '', '../img/5.jpg'),
(27, '', '../img/6.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `projelerimiz`
--

CREATE TABLE `projelerimiz` (
  `aciklama` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `projelerimiz`
--

INSERT INTO `projelerimiz` (`aciklama`) VALUES
('<li>Mağaza Barkodlu Ürün Satış Programı</li>\r\n<li>Ön Muhasebe Programı</li>\r\n<li>Gelen - Giden Evrak Kayıt Takip ve Belge Arşiv</li>\r\n<li>Müşteri Takip Kasa Stok Ve Veresiye Defteri</li>\r\n<li>Taksitli Satış Müşteri Takip Kasa Stok ve Veresiye Defteri</li>\r\n<li>Hasta Takip Programı</li>\r\n<li>Personel Takip Programı</li>\r\n<li>Gelen - Giden Evrak Kayıt Takip ve Belge Arşiv</li>\r\n<li>Sinema Salonu Uygulaması</li>\r\n<li>Hasta Takip Programı</li>\r\n\r\n\r\n');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `portfolyo`
--
ALTER TABLE `portfolyo`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `portfolyo`
--
ALTER TABLE `portfolyo`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
