<?php if(!defined("include")){ echo '<meta http-equiv="refresh" content="0;URL=../index.php">'; exit(); } $p = basename($_SERVER['REQUEST_URI']); ?>
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li<?php if($p=="home.php"){ echo ' class="active"'; } ?>><a href="home.php"><i class="icon-dashboard"></i><span>Anasayfa</span> </a> </li>
        <li<?php if($p=="blogs.php"||$p=="blogekle.php"||$p=="blogedit.php?id=".@$id.""){ echo ' class="active"'; } ?>><a href="blogs.php"><i class="icon-list"></i><span>Blog Yazıları</span> </a> </li>
        <li<?php if($p=="pages.php"||$p=="pageadd.php"||$p=="pagedit.php?id=".@$id.""){ echo ' class="active"'; } ?>><a href="pages.php"><i class="icon-file"></i><span>Sayfalar</span> </a> </li>
        <li<?php if($p=="ayarlar.php"){ echo ' class="active"'; } ?>><a href="ayarlar.php"><i class="icon-cog"></i><span>Ayarlar</span> </a> </li>
        <li<?php if($p=="yonetim.php?id=".$_SESSION['furtherup'].""){ echo ' class="active"'; } ?>><a href="yonetim.php?id=<?php echo $_SESSION['furtherup']; ?>"><i class="icon-user"></i><span>Yönetim</span> </a> </li>
      </ul>
    </div>
  </div>
</div>