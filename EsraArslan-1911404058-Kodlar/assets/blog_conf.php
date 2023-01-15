<?php if(!defined("include")){ echo '<meta http-equiv="refresh" content="0;URL=../index.php">'; exit(); }

$dbhost = "localhost";
$dbuser = "root"; //Veritabanı Kullanıcı Adı
$dbpass = ""; //Veritabanı Şifresi
$dbdata = "esraarslan"; //Veritabanı Adı

try {
     $db = new PDO("mysql:host=$dbhost;dbname=$dbdata", "$dbuser", "$dbpass", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
} catch ( PDOException $e ){
     print $e->getMessage(); exit();
}

//html kod temizleme
function htmlclean($text){  
    $text = preg_replace("'<script[^>]*>.*?</script>'si", '', $text );  
    $text = preg_replace('/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is', '\2 (\1)',$text );  
    $text = preg_replace( '/<!--.+?-->/', '', $text );  
    $text = preg_replace( '/{.+?}/', '', $text );  
    $text = preg_replace( '/&nbsp;/', ' ', $text );  
    $text = preg_replace( '/&amp;/', ' ', $text );  
    $text = preg_replace( '/&quot;/', ' ', $text );  
    $text = strip_tags($text);  
    $text = htmlspecialchars($text);  
    return $text;  
} 

//metin kısaltma
function kisalt($metin, $uzunluk){
    $metin = substr($metin, 0, $uzunluk)."...";
    $metin_son = strrchr($metin, " ");
    $metin = str_replace($metin_son," ...", $metin);
        
    return $metin;
}

//zaman
function timeConvert ( $zaman ){
	$zaman =  strtotime($zaman);
	$zaman_farki = time() - $zaman;
	$saniye = $zaman_farki;
	$dakika = round($zaman_farki/60);
	$saat = round($zaman_farki/3600);
	$gun = round($zaman_farki/86400);
	$hafta = round($zaman_farki/604800);
	$ay = round($zaman_farki/2419200);
	$yil = round($zaman_farki/29030400);
	if( $saniye < 60 ){
		if ($saniye == 0){
			return "az önce";
		} else {
			return $saniye .' saniye önce';
		}
	} else if ( $dakika < 60 ){
		return $dakika .' dakika önce';
	} else if ( $saat < 24 ){
		return $saat.' saat önce';
	} else if ( $gun < 7 ){
		return $gun .' gün önce';
	} else if ( $hafta < 4 ){
		return $hafta.' hafta önce';
	} else if ( $ay < 12 ){
		return $ay .' ay önce';
	} else {
		return $yil.' yıl önce';
	}
}

//sefurl türkçe karaktere dönüştürülmesi için
function temizle($url){
	$url = trim($url);
	$find = array('<b>', '</b>');
	$url = str_replace ($find, '', $url);
	$url = preg_replace('/<(\/{0,1})img(.*?)(\/{0,1})\>/', 'image', $url);
	$find = array(' ', '&amp;quot;', '&amp;amp;', '&amp;', '\r\n', '\n', '/', '\\', '+', '<', '>');
	$url = str_replace ($find, '-', $url);
	$find = array('.','..', '...');
	$url = str_replace ($find, '', $url);
	$find = array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ë', 'Ê');
	$url = str_replace ($find, 'e', $url);
	$find = array('í', 'ì', 'î', 'ï', 'I', 'Í', 'Ì', 'Î', 'Ï','İ','ı');
	$url = str_replace ($find, 'i', $url);
	$find = array('ó', 'ö', 'Ö', 'ò', 'ô', 'Ó', 'Ò', 'Ô');
	$url = str_replace ($find, 'o', $url);
	$find = array('á', 'ä', 'â', 'à', 'â', 'Ä', 'Â', 'Á', 'À', 'Â');
	$url = str_replace ($find, 'a', $url);
	$find = array('ú', 'ü', 'Ü', 'ù', 'û', 'Ú', 'Ù', 'Û');
	$url = str_replace ($find, 'u', $url);
	$find = array('ç', 'Ç');
	$url = str_replace ($find, 'c', $url);
	$find = array('ş','Ş');
	$url = str_replace ($find, 's', $url);
	$find = array('ğ','Ğ');
	$url = str_replace ($find, 'g', $url);
	$find = array('?');
	$url = str_replace ($find, '', $url);
	$find = array('/[^A-Za-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
	$repl = array('', '-', '');
	$url = preg_replace ($find, $repl, $url);
	$url = str_replace ('--', '-', $url);
	$url = strtolower($url);
	return $url;
}

$print = $db->query("select * from settings")->fetch(PDO::FETCH_ASSOC); ?>