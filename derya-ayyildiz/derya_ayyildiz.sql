-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 15, 2023 at 12:34 PM
-- Server version: 8.0.29
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `derya_ayyildiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `article_id` int NOT NULL AUTO_INCREMENT,
  `article_title` varchar(255) NOT NULL,
  `article_content` text NOT NULL,
  `article_image` varchar(255) NOT NULL,
  `article_created_time` datetime NOT NULL,
  `id_categorie` int NOT NULL,
  `id_author` int NOT NULL,
  PRIMARY KEY (`article_id`),
  KEY `article_category` (`id_categorie`),
  KEY `article_author` (`id_author`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `article_title`, `article_content`, `article_image`, `article_created_time`, `id_categorie`, `id_author`) VALUES
(53, 'Angular Hakkında', '<h2>Angular Nedir ve Neden Kullanmalıyım?</h2>\r\n\r\n<p>Normalde &ccedil;ok fazla konuşmayı değil &ouml;rneklerle konuları a&ccedil;ıklamayı tercih ederim. Bu serinin ilk makalesi olduğu i&ccedil;in hem giriş niteliğinde olması ve kafanızda Angular i&ccedil;in genel bir şablon oluşturması adına biraz fazla konuştum diyelim ?</p>\r\n\r\n<p>Peki iyi hoş da neden&nbsp;<strong>Angular</strong>&nbsp;kullanmalıyım diye soruyor olabilirsiniz. Biraz bu konudan bahsedelim. &Ccedil;&uuml;nk&uuml;;</p>\r\n\r\n<h3>Neden 1 &ndash; Angular&rsquo;ın SPA (Single Page Application) desteği</h3>\r\n\r\n<p>Single Page Application (SPA), her yeni sayfanın i&ccedil;eriğinin yeni HTML sayfaları y&uuml;klemek yerine JavaScript&rsquo;in mevcut sayfadaki sadece değişen sayfaya ait DOM &ouml;ğelerini değiştirerek dinamik olarak oluşturduğu web sitesi tasarım yaklaşımıdır.</p>\r\n\r\n<p>SPA yaklaşımında tasarlanmayan bir web uygulamasında, index.html sayfası &uuml;zerinden yeni bir sayfaya bağlanıldığında (y&ouml;nlendirildiğinde), bu sayfa sunucu tarafından HTML olarak oluşturulur ve browser &uuml;zerinde g&ouml;r&uuml;nt&uuml;lenir. Bu beyaz ekran oluşumu ve gecikmelere neden olan standart web uygulamalarının en b&uuml;y&uuml;k problemidir. &Ccedil;&uuml;nk&uuml; direkt son kullanıcıyı etkiler.</p>\r\n\r\n<p>Bir SPA uygulaması AJAX requestleri ve ya websocketler ile sunucudan dinamik olarak i&ccedil;erikler alacaktır. Bu, browser&rsquo;ın arka planda sunucuya ek i&ccedil;erik veya tamamen yeni sayfalar getirmesini talep ederken, mevcut sayfayı a&ccedil;ık tutmasını sağlar. Bu sayede &ccedil;ok daha hızlı etkileşimler ve sadece ilgili par&ccedil;aların g&uuml;ncellenmesi sağlandığı i&ccedil;in &ccedil;ok daha hızlı g&uuml;ncellemeler olacaktır.</p>\r\n\r\n<p>Sayfa g&uuml;ncellenmiyorsa url&rsquo;ler değişmeyecek diye d&uuml;ş&uuml;nebilirsiniz. Bunun &ouml;n&uuml;ne ge&ccedil;mek i&ccedil;in HTML5 History API sayfayı yeniden y&uuml;klemeden sayfanın URL&rsquo;sini değiştirmemize izin verir ve bu sayede farklı g&ouml;r&uuml;n&uuml;mler i&ccedil;in ayrı URL&rsquo;ler oluşturabiliriz.</p>\r\n\r\n<h3>Neden 2 &ndash; Two-way data binding (&Ccedil;ift y&ouml;nl&uuml; Data İletişimi)</h3>\r\n\r\n<p><strong>Angular 2</strong>&nbsp;ve &uuml;zeri s&uuml;r&uuml;mlerinde ngModel Directive&rsquo;lerini kullanarak otomatik olarak View ve Controller katmanları arasında veri bağlantısını sağlarız. Bu sayede aynı değişken &uuml;zerindeki herhangi bir değişiklik Angular two-way data binding sayesinde b&uuml;t&uuml;n sayfa &uuml;zerindeki ilgili alanların değişmesini tetikler.</p>\r\n\r\n<p>Jquery ile bunu yapmak istediğimizde selector&rsquo;ler ile sayfa &uuml;zerindeki değiştirmek istediğimiz alanları tek tek bulup, value&rsquo;larını set ederek ya da gerekli methodları &ccedil;ağırıyorduk. Fakat bu Angular ile ger&ccedil;ekten &ccedil;ok kolay ve &ccedil;ok pratik.</p>\r\n', 'angular-nedir.png', '2023-01-13 21:07:20', 29, 11),
(54, 'Flutter Başlangıç', '<p>2020 yılı i&ccedil;erisinde mobil uygulama geliştirebilmenin &ouml;nemi &ouml;nceki yıllara g&ouml;re &ccedil;ok daha b&uuml;y&uuml;k. Mobil uygulama geliştirme dediğimizde aklımıza iki pop&uuml;ler platform olan IOS ve Android işletim sistemleri geliyor.&nbsp;</p>\r\n\r\n<p>Neyseki mobil uygulama geliştirmesi yapmak isteyenler i&ccedil;in bir&ccedil;ok programlama aracı mevcuttur. Bu yazımızda Google&rsquo;nin 2017 yılında duyurmuş olduğu ve d&uuml;nya &uuml;zerinde ciddi şekilde kullanılan Flutter teknolojisini sizlere anlatacağız.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>Flutter Nedir?</strong></h2>\r\n\r\n<p>Flutter &ccedil;apraz bir platformdur, aynı altyapıyı kullanarak hem IOS hemde Android tabanlı uygulamalar geliştirebilirsiniz.</p>\r\n\r\n<p>Android ortamında yazılım geliştirme yapmak istiyorsanız&nbsp;<a href=\"https://www.argenova.com.tr/en-iyi-10-android-gelistirme-ortami\" target=\"_blank\">En İyi 10 Android Geliştirme Ortamı</a>&nbsp;isimli yazımızı inceleyebilirsiniz.</p>\r\n\r\n<p>Flutter iki ana par&ccedil;adan meydana geliyor;</p>\r\n\r\n<ul>\r\n	<li><strong>SDK (Yazılım Geliştirme Kiti) :</strong>&nbsp;Uygulamalarınızı daha kolay geliştirebilmeniz i&ccedil;in bir &ccedil;ok aracı hizmetinize sunar. SDK yazdığınız kodu hem IOS hemde Android i&ccedil;in derleyebilmenizi sağlar</li>\r\n	<li><strong>Framework (Bir &ccedil;ok UI ve k&uuml;t&uuml;phaneler) :</strong>&nbsp;Yazılım geliştirirken kullanılan bir &ccedil;ok UI bileşeni (buttonlar, text inputlar v.b.) hizmetinize sunar. Bu bileşenleri projelerinize g&ouml;re &ouml;zelleştirebilirsiniz.</li>\r\n</ul>\r\n\r\n<p>Flutter ile yazılım geliştirmesi yapabilmek i&ccedil;in&nbsp;<strong>Dart</strong>&nbsp;adında bir programlama dili kullanılır. Dil Google tarafından Ekim 2011&#39;de oluşturulmuş, her ge&ccedil;en yıl kendini geliştirerek yoluna devam etmiştir.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Flutter hakkında daha detaylı bilgi almak i&ccedil;in,<br />\r\n<a href=\"https://flutter.dev/\" target=\"_blank\">Flutter.dev.</a></p>\r\n\r\n<h2><strong>Dart Programlama Dili</strong></h2>\r\n\r\n<p>Dart, &ouml;n u&ccedil; (frontend) geliştirmeye odaklanır ve mobil ve web uygulamaları oluşturmak i&ccedil;in kullanabilirsiniz. Hot Reload &ouml;zelliği sayesinde kod &uuml;zerinde yaptığınız değişikliği hızlıca uygulama &uuml;zerinde g&ouml;rebilirsiniz. Buda yazılım geliştirme s&uuml;recini hızlandırır.&nbsp;</p>\r\n\r\n<p>Değişkenlerin veri t&uuml;rlerini a&ccedil;ık&ccedil;a belirtmeleri gerekmez. Ancak, bir fonksiyon oluşturduğunuzda parametrelerin veri t&uuml;rlerinin belirtilmiş olması gerekir. Her uygulamanın bir main () işlevi vardır ve hi&ccedil;bir şey d&ouml;nd&uuml;rmediğini belirtmek i&ccedil;in void anahtar s&ouml;zc&uuml;ğ&uuml;ne sahiptir.</p>\r\n\r\n<p>Biraz programlama bilginiz var ise, Dart yazılı bir nesne programlama dilidir. Dart&#39;ın s&ouml;zdizimini JavaScript&rsquo;e benzer.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', '60bb4a2e143f632da3e56aea_Flutter app development (2).png', '2023-01-13 21:17:54', 32, 11),
(55, 'React-Native', '<p>React Native, Facebook tarafından geliştirilen cross platform (&ccedil;apraz platform) mobil uygulama geliştirme framework&rsquo;&uuml;d&uuml;r. Yani hem iOS hem de Android işletim sistemleri i&ccedil;in uygulama geliştirmesine izin verir. B&ouml;ylece tek bir platform &uuml;zerinden uygulama geliştirilebilir ve t&uuml;m kullanıcılara tek uygulama ile erişilebilir.&nbsp;</p>\r\n\r\n<h2>React Native&rsquo;in Avantajları Nelerdir?</h2>\r\n\r\n<p>React Native&rsquo;in &ccedil;ok fazla artısı bulunur. Ancak bunlar arasında bazı noktalar &ouml;ne &ccedil;ıkar:</p>\r\n\r\n<h3>Tasarım S&uuml;recinde Zaman Maliyetini D&uuml;ş&uuml;r&uuml;r</h3>\r\n\r\n<p>Tek bir dil &uuml;zerinden mobil tarafta en pop&uuml;ler iki işletim sistemi olan iOS ve Android i&ccedil;in uygulama geliştirilebilir. Bu sayede geliştirme ve tasarım s&uuml;re&ccedil;leri kısalır. Zaman kısaldık&ccedil;a da maliyetler &ouml;nemli &ouml;l&ccedil;&uuml;de d&uuml;şer.&nbsp;</p>\r\n\r\n<h3>Topluluk Desteği ile Kolay &Ccedil;&ouml;z&uuml;mler Sunar</h3>\r\n\r\n<p>React Native, Facebook tarafından tanıtıldığı g&uuml;nden bu yana &ccedil;ok beğenildi ve bir&ccedil;ok geliştiricinin tercih ettiği bir framework oldu. Bu nedenle de olduk&ccedil;a geniş bir geliştirici topluluğuna ulaştı. &Ccedil;ok sayıda k&uuml;t&uuml;phane ve geliştirici tarafından hataların giderildiği paketler geliştirildi. Kısacası React Native ile yapılan uygulamalarda karşılaşılan hatalar kısa s&uuml;re i&ccedil;erisinde k&uuml;t&uuml;phaneler aracılığı ile giderilebilir. Ayrıca o g&uuml;ne kadar karşılaşılmamış bir sorunla karşılaşıldığında da geliştiriciler tarafından kolayca &ccedil;&ouml;z&uuml;mler &uuml;retilebilir.&nbsp;</p>\r\n\r\n<h3>İşletim Sistemlerinin &Ouml;zellikleriyle Uyumludur</h3>\r\n\r\n<p>React Native hem iOS hem de Android işletim sisteminin &ouml;zellikleriyle uyumludur. Geliştirilen uygulamalar, hızla iki işletim sistemine de sunulabilir. Ayrıca hız olarak sorun yaşanmadığı gibi olduk&ccedil;a stabil &ccedil;alışırlar. B&ouml;ylece kullanıcı deneyimi ile ilgili sorunların b&uuml;y&uuml;k bir kısmının &ouml;n&uuml;ne ge&ccedil;ilir.</p>\r\n\r\n<h2>React Native&rsquo;in Dezavantajları Nelerdir?</h2>\r\n\r\n<p>React Native&rsquo;in en b&uuml;y&uuml;k dezavantajı 3. parti paketlere &ccedil;ok fazla bağımlı olmasıdır. Geliştiriciler tarafından hazırlanan paketler, farklı paketlerle uyumlu olmayabilir. B&ouml;yle bir durumda da uygulama d&uuml;zg&uuml;n &ccedil;alışmaz ve m&uuml;dahale edilmesi gerekebilir. Diğer bir dezavantajı ise geliştirme ortamının native SDK&rsquo;lara veya bazı alternatiflere kıyasla yeterince geliştirici dostu olmamasıdır.</p>\r\n\r\n<h2>React Native ve React JS Farkı Nedir?</h2>\r\n\r\n<p>İnternette sık sık &ldquo;React Native vs React JS&rdquo; karşılaştırmaları yapıldığı g&ouml;r&uuml;l&uuml;r. Karşılaştırmanın esası ise kullanım alanlarıdır. React JS, web uygulamaları geliştirilebilen bir JavaScript k&uuml;t&uuml;phanesidir. React Native ise JavaScript kullanarak mobil uygulamalar geliştirilmesini sağlar.&nbsp;</p>\r\n\r\n<h2>React Native ile Geliştirilen Pop&uuml;ler Uygulamalar Nelerdir?</h2>\r\n\r\n<p>Bir&ccedil;ok insanın aklına gelen &ldquo;React Native ile neler yapılabilir?&rdquo; sorusunu cevaplamak pek m&uuml;mk&uuml;n değil. &Ccedil;&uuml;nk&uuml; neredeyse her şey yapılabilir. Bu nedenle de yapılabileceklerin sınırı, geliştiricilerin istek ve hayal g&uuml;c&uuml;ne bağlıdır. Ancak React Native ile geliştirilen uygulamalar arasında bazıları &ouml;ne &ccedil;ıkar. Bunlar kısaca ş&ouml;yle sıralanır:&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Tesla</li>\r\n	<li>Airbnb</li>\r\n	<li>Pinterest&nbsp;</li>\r\n	<li>Skype</li>\r\n</ul>\r\n\r\n<p>Listeden de g&ouml;rebileceğiniz gibi React Native ile geliştirilen uygulamalar, birbirlerinden olduk&ccedil;a farklı &ouml;zelliklere sahiptir. Ayrıca yine birbirlerinden olduk&ccedil;a farklı sekt&ouml;rlerde hizmet verirler. Ancak tamamı olduk&ccedil;a stabil ve kullanıcı dostudur. Bu sayede de milyonlarca insan tarafından her g&uuml;n kullanılırlar.</p>\r\n', '1_C3kxjCrJy-aWSMpe2chfaA.png', '2023-01-13 21:20:23', 30, 11),
(56, 'TypeScript Nedir?', '<h1>TypeScript Nedir?</h1>\r\n\r\n<p>Typescript, JavaScript ile daha hızlı ve anlaşılır kod geliştirmemizi sağlayan bir ortamdır.</p>\r\n\r\n<h1>TypeScript Nedir?</h1>\r\n\r\n<p>Typescript, JavaScript ile daha hızlı ve anlaşılır kod geliştirmemizi sağlayan bir ortamdır.27 Kasım 2020</p>\r\n\r\n<p>Typescript, JavaScript ile daha hızlı ve anlaşılır kod geliştirmemizi sağlayan bir ortamdır. Herhangi bir tarayıcıda, herhangi bir JavaScript motorunda &ccedil;alışan temiz, basit Javascript kodudur..</p>\r\n\r\n<p><br />\r\nTypescript i&ccedil;erisinde tipleri barındırır ve tipler JavaScript geliştirme aşamasında kontroll&uuml;, kolay ve hızlı şekilde, yeniden d&uuml;zenlenebilir uygulama geliştirme imkanı sağlar. Tipler isteğe bağlıdır ancak bileşenler arasındaki arabirimleri (interface) tanımlamamıza ve davranışları hakkında bilgi edinmemize olanak sağlar.</p>\r\n\r\n<h2><br />\r\nTypeScript &Ouml;zellikleri</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>JavaScript, TypeScript&rsquo;tir: TS&rsquo;de yazılan kodlar derlenirken JS dilindeki karşılığına d&ouml;n&uuml;şt&uuml;r&uuml;l&uuml;r, &ccedil;ıktı olarak JS kodu verir ve JS kodu &ccedil;alıştırılır.&nbsp;</li>\r\n	<li>JS i&ccedil;in ge&ccedil;erli olan t&uuml;m &ouml;zellikler TS i&ccedil;inde ge&ccedil;erlidir.</li>\r\n	<li>TS kodu yazabilmek i&ccedil;in JS bilmeniz işin &ccedil;ok b&uuml;y&uuml;k bir oranına hakim olmanızı sağlayacaktır.&nbsp;</li>\r\n	<li>TypeScript, JavaScript&rsquo;in genişletilmiş bir versiyonudur.</li>\r\n	<li>Ancak TS kodu derlenip &ccedil;alıştırılmadığı s&uuml;rece JS kodu değildir.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>T&uuml;m JS k&uuml;t&uuml;phanelerini kullanabilir: T&uuml;m JS k&uuml;t&uuml;phaneleri TS &uuml;zerinde de kullanılabilir.&nbsp;<br />\r\nTS olarak yazılan b&uuml;t&uuml;n kodların JS &ccedil;ıktısı, b&uuml;t&uuml;n JS frameworklerini, ara&ccedil;larını ve k&uuml;t&uuml;phanelerini kullanabilir.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Taşınabilirlik:</strong>&nbsp;TypeScript platform-serbest bir dildir ve farklı tarayıcılarda, cihazlarda, işletim sistemlerinde &ccedil;alışabilir.&nbsp;JavaScript&rsquo;in &ccedil;alıştığı herhangi bir ortamda &ccedil;alışabilir.&nbsp;Muadillerinden(CoffeScript,Dart vb) farklı olarak, Yazılan kodlar JS koduna d&ouml;n&uuml;şt&uuml;r&uuml;ld&uuml;ğ&uuml; ve işlemler JS kodu &uuml;zerinden y&uuml;r&uuml;t&uuml;ld&uuml;ğ&uuml; i&ccedil;in&nbsp;TypeScript&rsquo;in y&uuml;r&uuml;t&uuml;lmesi i&ccedil;in &ouml;zel bir sanal makineye veya &ouml;zel bir &ccedil;alışma-y&uuml;r&uuml;tme ortamına ihtiyacı yoktur.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Neden TypeScript Tercih Edilmelidir?</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>TypeScript, JS kitaplıklarını ve API Belgelerini destekler</li>\r\n	<li>Javascript&rsquo;in bir &uuml;st k&uuml;mesidir</li>\r\n	<li>İsteğe bağlı olarak yazılan kodlama dili TypeScript Kodu d&uuml;z JavaScript Koduna d&ouml;n&uuml;şt&uuml;r&uuml;lebilir</li>\r\n	<li>Daha iyi kod yapılandırması ve nesneye y&ouml;nelik programlama teknikleri i&ccedil;erir.</li>\r\n	<li>Daha iyi geliştirme s&uuml;resi aracı desteği sağlar.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>TypeScript Bileşenleri Nelerdir?</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>TypeScript&rsquo;in &uuml;&ccedil; temel bileşeni vardır.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Dil:&nbsp;</strong>Kendi s&ouml;zdizimi, anahtar kelimeleri ve tip tanımlamaları vardır.</p>\r\n\r\n<p><strong>Derleyici:</strong>&nbsp;TS&rsquo;de yazılan kodu JS&rsquo;deki karşılığına d&ouml;n&uuml;şt&uuml;r&uuml;r.</p>\r\n\r\n<p><strong>TLS(TypeScript Dil Servisi):&nbsp;</strong>Edit&ouml;rlerde kullanılması i&ccedil;in ifade tamamlama, kod bi&ccedil;imlendirme, renklendirme vb. gibi tipik d&uuml;zenleyici &nbsp;işlemlerini destekler.</p>\r\n', '0_L8YVvBMqjAXdjO_F.png', '2023-01-13 21:22:32', 33, 11),
(59, 'Component Yapısı 2', '<h1>Angular Component Nedir?</h1>\r\n\r\n<p>Bu yazımda ise projelerimizde bol bol kullanacağımız component yapısından, component-template ilişkisinden, component decorator&rsquo;dan bahsedeceğim. Ayrıca, Angular CLI ile komutlar ile component oluşturmayı g&ouml;stereceğim.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Angular, component-based devlopment yaklaşımını ile kod geliştirmenizi sağlayan bir framework&rsquo;d&uuml;r. Son kullanıcının etkileşime ge&ccedil;eceği .html uzantılı dosyalar aslında &lsquo;n&rsquo; sayıda component&rsquo;in templatelerinin birleşiminden meydana gelir. Bu y&uuml;zden Angular&rsquo;da geliştirmenin b&uuml;y&uuml;k bir kısmı Component&rsquo;ler &uuml;zerinde yapılır. Bu mantıktan yola &ccedil;ıkarak zaten geliştireceğimiz SPA(Single Page Application) uygulamasının da run olacağı bir root component olması gerektiği ortaya kendiliğinden &ccedil;ıkıyor.</p>\r\n\r\n<p>Angular CLI ile oluşturduğumuz bir projenin src&gt;app dizini altındaki&nbsp;<strong>app.component</strong>&nbsp;varsayılan olarak Angular tarafından oluşturulan root component&rsquo;idir ve main.ts dosyasında referansı vardır.</p>\r\n', '1011c6f3ffcdfa8c2f3f57a78d35fe1f.jpg', '2023-01-13 21:57:59', 29, 11),
(61, 'deneme blog', '<p>denemeblogdenemeblogdenemeblogdenemeblogdenemeblogdenemeblogdenemeblog</p>\r\n', '1_C3kxjCrJy-aWSMpe2chfaA.png', '2023-01-15 10:40:08', 32, 11);

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE IF NOT EXISTS `author` (
  `author_id` int NOT NULL AUTO_INCREMENT,
  `author_fullname` varchar(100) NOT NULL,
  `author_desc` varchar(255) NOT NULL DEFAULT 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil voluptatibus in ullam eum corrupti reiciendis.',
  `author_email` varchar(100) NOT NULL,
  `author_twitter` varchar(100) NOT NULL DEFAULT 'loujaybee',
  `author_github` varchar(100) NOT NULL DEFAULT 'loujaybee',
  `author_link` varchar(100) NOT NULL DEFAULT 'loujaybee',
  `author_avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `author_fullname`, `author_desc`, `author_email`, `author_twitter`, `author_github`, `author_link`, `author_avatar`) VALUES
(11, 'Derya Ayyıldız', 'Full Stack Development', 'ayyildizderya34@gmail.com', 'deryaayyildiiz', 'deryaayyildiz', '', 'XROT6190.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `category_color` varchar(10) NOT NULL DEFAULT '333333',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_image`, `category_color`) VALUES
(29, 'Angular', 'angular-logo.png', '#e10e0e'),
(30, 'React-Native', 'react.png', '#0f88e1'),
(32, 'Flutter', '1_5-aoK8IBmXve5whBQM90GA.png', '#38a847'),
(33, 'TypeScript', '0G4bie6b_400x400.jpg', '#5c6204'),
(34, 'Phyton', 'indir.png', '#e1740e');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `comment_username` varchar(100) NOT NULL,
  `comment_avatar` varchar(255) NOT NULL DEFAULT 'def_face.jpg',
  `comment_content` text NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT '2020-02-14 10:28:00',
  `comment_likes` int NOT NULL DEFAULT '0',
  `id_article` int NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `comment_article` (`id_article`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_username`, `comment_avatar`, `comment_content`, `comment_date`, `comment_likes`, `id_article`) VALUES
(27, '272253667', 'def_face.jpg', 'Çok yararlı bir blog olmuş', '2023-01-13 21:47:50', 0, 53),
(28, '1939975407', 'def_face.jpg', 'dsdfsdfsdfsf', '2023-01-15 10:43:31', 0, 55);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `created_at`) VALUES
(1, 'admin@admin.com', 'admin', '$2y$10$ss5ZCOfLJprUwB5CyMKZ4.eRWKbtRxgG19g0sm/INzDOQuMIbawrm', '2020-08-08 11:46:05'),
(3, 'test@test.com', 'test', '$2y$10$7gy27M9yBNjzQkY.Aklo3.JVMkKZia9MAqmXH8zdKuSQwkz5UeOtm', '2020-08-08 12:38:59');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_author` FOREIGN KEY (`id_author`) REFERENCES `author` (`author_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_category` FOREIGN KEY (`id_categorie`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_article` FOREIGN KEY (`id_article`) REFERENCES `article` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
