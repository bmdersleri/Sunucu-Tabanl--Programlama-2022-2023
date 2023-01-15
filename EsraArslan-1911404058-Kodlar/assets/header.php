<?php if(!defined("include")){ echo '<meta http-equiv="refresh" content="0;URL=../index.php">'; exit(); } $p = basename($_SERVER['REQUEST_URI']); ?>
    <header class="header text-center">	    
	    <h1 class="blog-name pt-lg-4 mb-0"><a href="index.php"><?php echo $print['siteadi_sidebar']; ?></a></h1>
	    <nav class="navbar navbar-expand-lg navbar-dark" >
           
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>

			<div id="navigation" class="collapse navbar-collapse flex-column" >
				<div class="profile-section pt-3 pt-lg-0">
				    <img class="profile-image mb-3 rounded-circle mx-auto" src="assets/images/profil.jpg" alt="<?php echo $print['siteadi_title']; ?>">			
					
					<div class="bio pb-3"><?php echo $print['about']; ?></div>
					<ul class="social-list list-inline py-3 mx-auto">
<?php if($print['facebook']==""){ }else{ ?><li class="list-inline-item pb-3"><a title="Facebook" href="<?php echo $print['facebook']; ?>" target="_blank"><i class="fab fa-facebook fa-fw"></i></a></li><?php } ?>
<?php if($print['twitter']==""){ }else{ ?><li class="list-inline-item pb-3"><a title="Twitter" href="<?php echo $print['twitter']; ?>" target="_blank"><i class="fab fa-twitter fa-fw"></i></a></li><?php } ?>
<?php if($print['instagram']==""){ }else{ ?><li class="list-inline-item pb-3"><a title="Instagram" href="<?php echo $print['instagram']; ?>" target="_blank"><i class="fab fa-instagram fa-fw"></i></a></li><?php } ?>
<?php if($print['youtube']==""){ }else{ ?><li class="list-inline-item pb-3"><a title="Youtube" href="<?php echo $print['youtube']; ?>" target="_blank"><i class="fab fa-youtube fa-fw"></i></a></li><?php } ?>
<?php if($print['linkedin']==""){ }else{ ?><li class="list-inline-item pb-3"><a title="Linkedin" href="<?php echo $print['linkedin']; ?>" target="_blank"><i class="fab fa-linkedin-in fa-fw"></i></a></li><?php } ?>
<?php if($print['pinterest']==""){ }else{ ?><li class="list-inline-item pb-3"><a title="Pinterest" href="<?php echo $print['pinterest']; ?>" target="_blank"><i class="fab fa-pinterest fa-fw"></i></a></li><?php } ?>
<?php if($print['github']==""){ }else{ ?><li class="list-inline-item pb-3"><a title="Github" href="<?php echo $print['github']; ?>" target="_blank"><i class="fab fa-github-alt fa-fw"></i></a></li><?php } ?>
<?php if($print['stackoverflow']==""){ }else{ ?><li class="list-inline-item pb-3"><a title="Stackoverflow" href="<?php echo $print['stackoverflow']; ?>" target="_blank"><i class="fab fa-stack-overflow fa-fw"></i></a></li><?php } ?>
<?php if($print['codepen']==""){ }else{ ?><li class="list-inline-item pb-3"><a title="Codepen" href="<?php echo $print['codepen']; ?>" target="_blank"><i class="fab fa-codepen fa-fw"></i></a></li><?php } ?>
			        </ul>
			        <hr> 
				</div>
				
				<ul class="navbar-nav flex-column text-left">
					<li class="nav-item<?php if($p==""||$p=="index.php"){ echo ' active'; } ?>">
					    <a class="nav-link" href="index.php"><i class="fas fa-home fa-fw mr-2"></i> Anasayfa</a>
					</li>
		<?php foreach($db->query("select * from sayfalar order by sira asc") as $aaa){ ?>
					<li class="nav-item<?php if($p=="sayfa.php?url=".@$url.""){ echo ' active'; } ?>">
					    <a class="nav-link" href="sayfa.php?url=<?php echo $aaa['sefurl']; ?>"><i class="fas fa-<?php echo $aaa['icon']; ?> fa-fw mr-2"></i><?php echo $aaa['baslik']; ?></a>
					</li>
		<?php } ?>
				</ul>
			</div>
		</nav>
    </header>