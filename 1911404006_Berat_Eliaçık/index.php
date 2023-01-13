<?php include('./include/db.php'); 
$query = "SELECT * FROM basic_setup,personal_setup,aboutus_setup";
$runquery = mysqli_query($db,$query);
if(!$db){
    header("location:index-2.html");
}
$data = mysqli_fetch_array($runquery);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- ===== SWIPER CSS ===== -->
        <link rel="stylesheet" href="">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <!-- ===== CSS ===== -->

        <link rel="stylesheet" href="assets/css/styles.css">

        <title><?=$data['title']?></title>
        <meta content="<?=$data['description']?>" name="description">
        <meta content="<?=$data['keyword']?>" name="keywords">
        
         <!-- Favicons -->
        <link href="assets/img/<?=$data['icon']?>" rel="icon">
        <link href="assets/img/<?=$data['icon']?>" rel="apple-touch-icon">
        
   
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
        
        
        
    </head>
<body>
        <!--===== SCROLL TOP =====-->
        <a href="#" class="scrolltop" id="scroll-top">
            <i class='bx bxs-chevron-up scrolltop__icon'></i>
        </a>

        <!--===== HEADER =====-->
        <header class="l-header " id="header">
            <nav class="nav bd-container">
                <a href="#home" class="nav__logo"><?=$data['name']?></a>
                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item"><a href="#home" class="nav__link active-link">Home</a></li>
                        <li class="nav__item"><a href="#about" class="nav__link">About</a></li>
                        <li class="nav__item"><a href="#services" class="nav__link">Services</a></li>
                        <li class="nav__item"><a href="#portfolio" class="nav__link">Portfolio</a></li>
                        <li class="nav__item"><a href="#contact" class="nav__link">Contact</a></li>
                    </ul>
                </div>
                <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-menu'></i>
                </div>
            </nav>
        </header>

        <main class="l-main">
            <!--===== HOME =====-->
            <section class="home" id="home">
                <div class="home__container bd-container bd-grid">
                    <div class="home__data">
                        
                        <h1 class="home__name"><?=$data['name']?></h1>
                        <span class="home__profession"><?=$data['professions']?></span>
                        <a download="" href="assets/pdf/Berat-Eliacik-Cv.pdf" class="button button-light home__button">Download CV</a>
                    </div>
                    <div class="home__social">
                      <!--=====  <a href="#" class="home__social-icon"><i class='bx bxl-linkedin' ></i></a>
                        <a href="#" class="home__social-icon"><i class='bx bxl-github'></i></a>
                        <a href="#" class="home__social-icon"><i class='bx bxl-medium'></i></a>  =====-->
                        
                        
                                    <?php 
                    if($data['linkedin']!=""){
                        ?>
                                <a href="<?=$data['linkedin']?>" class="home__social-icon"><i class="bx bxl-linkedin"></i></a>
                                <?php
                    }
                  if($data['github']!=""){
                        ?>
                                <a href="<?=$data['github']?>" class="home__social-icon"><i class="bx bxl-github"></i></a>
                                <?php
                    } 
                    if($data['skype']!=""){
                        ?>
                                <a href="<?=$data['skype']?>" class="home__social-icon"><i class="bx bxl-medium"></i></a>
                                <?php
                    }
                 
                    ?>
                        
                        
                        
                    </div>
                    <div class="home__img">
                     <!--=====   <img src="assets/img/<?=$data['profilepic']?>" alt=""> =====-->
                    </div>
                    
                    
                    
                    
                    
                    
                </div>
            </section>
            
            <!--===== ABOUT =====-->
            <section class="about section bd-container" id="about">
                <span class="section-subtitle">My History</span>
                <h2 class="section-title">About Me</h2>

                <div class="about__container bd-grid">
                    <div class="about__data bd-grid">
                        <p class="about__description"><span><?=$data['heading']?><br></span><?=$data['shortdesc']?></p>
                    
                        <div>
                            <span class="about__number"><?=$data['dob']?></span>
                            <span class="about__achievement">Years of Experience</span>
                        </div>

                        <div>
                            <span class="about__number"><?=$data['website']?></span>
                            <span class="about__achievement">Project completes</span>
                        </div>
                        
                        

                       
                        
                        <!--=====
                        <div>
                            <span class="about__number">07</span>
                            <span class="about__achievement">Best work awards</span>
                        </div> 
                        =====-->
                        
                    </div>
                    <img src="assets/img/<?=$data['homewallpaper']?>" alt="" class="about__img">
                    
                   
                   
                    
                    
                    
                </div>
                

                
            </section>
            
    
        
            
            
            
            
            <!--===== QUALIFICATION =====-->
            <section class="qualification section bd-container">
                <span class="section-subtitle">Experience and education</span>
                <h2 class="section-title">Qualification</h2>
                
                

                <div class="qualification__container bd-grid">
                    <div class="qualification__content">
                        
                        
                        <h2 class="qualification__title">
                            <i class='bx bx-briefcase-alt qualification__title-icon' ></i>
                            Work Experience
                        </h2>
<?php
                    $query4 = "SELECT * FROM resume WHERE category='pe'";
$runquery4= mysqli_query($db,$query4);
while($data4=mysqli_fetch_array($runquery4)){
    ?>
                        <div class="bd-grid">

                            <div class="qualification__data">
                                <h3 class="qualification__area"><?=$data4['title']?></h3>
                                
                                <div class="qualification__box">
                                    <span class="qualification__work">
                                        <i class='bx bx-briefcase-alt qualification__icon' ></i>
                                        <?=$data4['ogname']?>
                                    </span>

                                    <span class="qualification__work">
                                        <i class='bx bx-calendar-alt qualification__icon' ></i>
                                        <?=$data4['year']?>
                                    </span>

                                </div>
                            </div>
                            
  
<!--===== 

                            <div class="qualification__data">
                                <h3 class="qualification__area">Software Development Intern</h3>
                                
                                <div class="qualification__box">
                                    <span class="qualification__work">
                                        <i class='bx bx-briefcase-alt qualification__icon' ></i>
                                        Turkcell Technology
                                    </span>

                                    <span class="qualification__work">
                                        <i class='bx bx-calendar-alt qualification__icon' ></i>
                                        Oct 2022 - Dec 2022
                                    </span>

                                </div>
                            </div>

                            <div class="qualification__data">
                                <h3 class="qualification__area">Software Development Intern</h3>
                                
                                <div class="qualification__box">
                                    <span class="qualification__work">
                                        <i class='bx bx-briefcase-alt qualification__icon' ></i>
                                        NTT DATA Business Solutions
                                    </span>

                                    <span class="qualification__work">
                                        <i class='bx bx-calendar-alt qualification__icon' ></i>
                                        Jul 2022 - Aug 2022
                                    </span>

                                </div>
                            </div>
 =====-->
                            
                        </div>
                                                  <?php
}
                    ?>
                    </div>

                    
                    <div class="qualification__content">
                        <h2 class="qualification__title">
                            <i class='bx bx-book-bookmark qualification__title-icon' ></i>
                            Education
                        </h2>
                        
                        <?php
                    $query4 = "SELECT * FROM resume WHERE category='e'";
$runquery4= mysqli_query($db,$query4);
while($data4=mysqli_fetch_array($runquery4)){
    ?>

                        <div class="bd-grid">
                            <div class="qualification__data">
                                <h3 class="qualification__area"><?=$data4['title']?></h3>
                                
                                <div class="qualification__box">
                                    <span class="qualification__work">
                                        <i class='bx bx-book-alt qualification__icon' ></i>
                                         <?=$data4['ogname']?>
                                    </span>

                                    <span class="qualification__work">
                                        <i class='bx bx-calendar-alt qualification__icon' ></i>
                                        <?=$data4['year']?>
                                    </span>

                                </div>
                            </div>
                            

<!--=====
                            <div class="qualification__data">
                                <h3 class="qualification__area">Computer Engineering</h3>
                                
                                <div class="qualification__box">
                                    <span class="qualification__work">
                                        <i class='bx bx-book-alt qualification__icon' ></i>
                                        Mehmet Akif Ersoy University
                                    </span>

                                    <span class="qualification__work">
                                        <i class='bx bx-calendar-alt qualification__icon' ></i>
                                        Sep 2019 - Jun 2023
                                    </span>

                                </div>
                            </div>  =====-->

                        </div>
                                                     <?php
}
                    ?>
                    </div>
                </div>

            <!--===== SERVICES =====-->
            <section class="services section bd-container" id="services">
                <span class="section-subtitle">What i offer?</span>
                <h2 class="section-title">Services</h2>

                <div class="services__container bd-grid">
                    <div class="services__data">
                        <i class='bx bx-palette services__icon' ></i>
                        <h3 class="services__title">Ui/Ux Design</h3>
                        <p class="services__description">Service that I offer and work, with years of experience in the work area.</p>
                        <a href="#" class="button">Know More</a>
                    </div>

                    <div class="services__data">
                        <i class='bx bx-laptop services__icon' ></i>
                        <h3 class="services__title">Web Development</h3>
                        <p class="services__description">Service that I offer and work, with years of experience in the work area.</p>
                        <a href="#" class="button">Know More</a>
                    </div>

                    <div class="services__data">
                        <i class='bx bx-pen services__icon' ></i>
                        <h3 class="services__title">Graphic Design</h3>
                        <p class="services__description">Service that I offer and work, with years of experience in the work area.</p>
                        <a href="#" class="button">Know More</a>
                    </div>

                  <!--=====  <div class="services__data">
                        <i class='bx bx-palette services__icon' ></i>
                        <h3 class="services__title">Ui/Ux Design</h3>
                        <p class="services__description">Service that I offer and work, with years of experience in the work area.</p>
                        <a href="#" class="button">Know More</a>
                    </div> =====-->
                </div>
            </section>

            <!--===== PROJECT IN MIND =====-->
            <section class="project section bd-container">
                <div class="project__container bd-grid">
                    <div class="project__data">
                        <i class='bx bx-chat project__icon' ></i>

                        <div>
                            <h2 class="project__title">Project in mind</h2>
                            <p class="project__description">Hire me to carry out the following projects.</p>
                        </div>

                        <div>
                            <a href="#contact" class="button button-white">Hire me</a>
                        </div>
                    </div>
                </div>
            </section>

            <!--===== PORTFOLIO =====-->
            <section class="portfolio section bd-container" id="portfolio">
                <span class="section-subtitle">My recent works</span>
                <h2 class="section-title">Portfolio</h2>

                <div class="portfolio__nav">
                    <span class="portfolio__item active-portfolio" data-filter="all">All</span>
                    <span class="portfolio__item" data-filter=".web">Web</span>
                    <span class="portfolio__item" data-filter=".ux">Ui/Ux</span>
                    <span class="portfolio__item" data-filter=".app">App</span>
                </div>

                <div class="portfolio__container bd-grid">
                    
                    <?php
                    $query5 = "SELECT * FROM portfolio";
$runquery5= mysqli_query($db,$query5);
while($data5=mysqli_fetch_array($runquery5)){
    ?>
                    
                    <div class="portfolio__content mix <?=$data5['projectlink']?>">
                        <a href="#"><img src="assets/img/<?=$data5['projectpic']?>" alt="" class="portfolio__img"></a>
                        <div class="portfolio__data">
                            <span class="portfolio__subtitle"><?=$data5['projectname']?></span>
                            <a href="#"><h2 class="portfolio__title">New portfolio of work done for a client.</h2></a>
                           <!--===== <a href="#" class="button button-link">View Details</a> =====-->
                        </div>
                    </div>
                    
                    <?php
}
                    ?>

                  <!--=====  <div class="portfolio__content mix web">
                        <a href="#"><img src="assets/img/work2.jpg" alt="" class="portfolio__img"></a>
                        <div class="portfolio__data">
                            <span class="portfolio__subtitle">Web Development</span>
                            <a href="#"><h2 class="portfolio__title">New portfolio of work done for a client.</h2></a>
                            <a href="#" class="button button-link">View Details</a>
                        </div>
                    </div>

                    <div class="portfolio__content mix ux">
                        <a href="#"><img src="assets/img/work3.jpg" alt="" class="portfolio__img"></a>
                        <div class="portfolio__data">
                            <span class="portfolio__subtitle">Ux Design</span>
                            <a href="#"><h2 class="portfolio__title">New portfolio of work done for a client.</h2></a>
                            <a href="#" class="button button-link">View Details</a>
                        </div>
                    </div>

                    <div class="portfolio__content mix ux">
                        <a href="#"><img src="assets/img/work4.jpg" alt="" class="portfolio__img"></a>
                        <div class="portfolio__data">
                            <span class="portfolio__subtitle">Ux Design</span>
                            <a href="#"><h2 class="portfolio__title">New portfolio of work done for a client.</h2></a>
                            <a href="#" class="button button-link">View Details</a>
                        </div>
                    </div>

                    <div class="portfolio__content mix app">
                        <a href="#"><img src="assets/img/work5.jpg" alt="" class="portfolio__img"></a>
                        <div class="portfolio__data">
                            <span class="portfolio__subtitle">Mobile App</span>
                            <a href="#"><h2 class="portfolio__title">New portfolio of work done for a client.</h2></a>
                            <a href="#" class="button button-link">View Details</a>
                        </div>
                    </div>

                    <div class="portfolio__content mix app">
                        <a href="#"><img src="assets/img/work6.jpg" alt="" class="portfolio__img"></a>
                        <div class="portfolio__data">
                            <span class="portfolio__subtitle">Mobile App</span>
                            <a href="#"><h2 class="portfolio__title">New portfolio of work done for a client.</h2></a>
                            <a href="#" class="button button-link">View Details</a>
                        </div> =====-->
                    </div>
                </div>
            </section>

            <!--===== TESTIMONIAL =====-->
            

            <!--===== CONTACTME =====-->
            
            <section class="contact section bd-container" id="contact">
                <span class="section-subtitle">For projects</span>
                <h2 class="section-title">Contact Me</h2>

                <div class="contact__container bd-grid">
                    <div class="contact__content bd-grid">
                        
                        <div class="contact__box">
                            <i class='bx bxs-home contact__icon' ></i>
                            <h3 class="contact__title">Location</h3>
                            <span class="contact__description"><?=$data['location']?></span>
                        </div>

                        <div class="contact__box">
                            <i class='bx bxs-phone contact__icon' ></i>
                            <h3 class="contact__title">Phone</h3>
                            <span class="contact__description"><?=$data['mobile']?></span>
                        </div>

                        <div class="contact__box">
                            <i class='bx bxs-envelope contact__icon' ></i>
                            <h3 class="contact__title">Gmail</h3>
                            <span class="contact__description"><?=$data['emailid']?></span>
                        </div>

                    <!--=====    <div class="contact__box">
                            <i class='bx bxs-chat contact__icon' ></i>
                            <h3 class="contact__title">Chat</h3>
                            <div>
                                <a href="#" class="contact__social"><i class='bx bxl-whatsapp-square' ></i></a>
                                <a href="#" class="contact__social"><i class='bx bxl-telegram' ></i></a>
                                <a href="#" class="contact__social"><i class='bx bxl-messenger' ></i></a>
                            </div>
                        </div> =====-->
                    </div>
                   <form action="https://formsubmit.co/eabe950ccb22ab669953cb03775fdbd1" class="contact__form" method="POST">
                        <div class="contact__inputs">
                            <input type="text" name="name" required placeholder="Name" class="contact__input">
                            <input type="email" name="email" required placeholder="Email" class="contact__input">
                        </div>

                        <div class="contact__inputs">
                            <input type="text" name="project" required placeholder="Project" class="contact__input">
                            <input type="number" name="number" required placeholder="Phone Number" class="contact__input">
                        </div>

                        <textarea name="Message" id="" cols="" rows="7" required placeholder="Message" class="contact__input"></textarea>
                       
                        <input type="submit" value="Send Message" class="button contact__button">
                       <input type="hidden" name="_template" value="table">
                       <input type="hidden" name="_next" value="https://www.berateliacik.com">
                    </form> 
                    
                   
                </div>
                
                
                
                
                
            </section>

        </main>

        <!--===== FOOTER =======-->
        <footer class="footer">
            <div class="footer__container bd-container">
                <h1 class="footer__title">Berat Eliaçık</h1>
                <p class="footer__description">I am Berat Eliaçık and this is my personal website, consult me here.</p>
                
                <div class="footer__social">
                    <?php 
                    if($data['linkedin']!=""){
                        ?>
                                <a href="<?=$data['linkedin']?>" class="footer__link"><i class="bx bxl-linkedin"></i></a>
                                <?php
                    }
                  if($data['github']!=""){
                        ?>
                                <a href="<?=$data['github']?>" class="footer__link"><i class="bx bxl-github"></i></a>
                                <?php
                    } 
                    if($data['skype']!=""){
                        ?>
                                <a href="<?=$data['skype']?>" class="footer__link"><i class="bx bxl-medium"></i></a>
                                <?php
                    }
                 
                    ?>
        
                </div>
                <p class="footer__copy">&#169; 2022 Berat Eliaçık. All right reserved.</p>
            </div>
        </footer>
       

    
   
    
    
        <!--===== MIXITUP FILTER =====-->
        <script src="assets/js/mixitup.min.js"></script>

        <!-- ===== SWIPER JS ===== -->
        <script src=""></script>

        <!-- ===== GSAP =====-->
        <script src="assets/js/gsap.min.js"></script>

        <!--===== MAIN JS =====-->
        <script src="assets/js/main.js"></script>
    </body>
</html>