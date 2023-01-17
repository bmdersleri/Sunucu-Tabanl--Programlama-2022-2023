<?php include('./include/db.php'); 
$query = "SELECT * FROM basic_setup,personal_setup,aboutus_setup";
$runquery = mysqli_query($db,$query);
if(!$db){
    header("location:database_message.html");
}
$data = mysqli_fetch_array($runquery);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?=$data['title']?></title>
    <meta content="<?=$data['description']?>" name="description">
    <meta content="<?=$data['keyword']?>" name="keywords">

    <!--
    - favicon
  -->
    <link rel="shortcut icon" href="./assets/images/<?=$data['icon']?>" type="icon">

    <!--
    - custom css link
  -->
    <link rel="stylesheet" href="./assets/css/style.css">

    <!--
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>

    <!--
    - #MAIN
  -->

    <main>

        <!--
      - #SIDEBAR
    -->

        <aside class="sidebar" data-sidebar>

            <div class="sidebar-info">

                <figure class="avatar-box">
                    <img src="./assets/images/<?=$data['profilepic']?>" alt="Bera" width="80">
                </figure>

                <div class="info-content">
                    <h1 class="name" title="Bera"><?=$data['name']?></h1>

                    <p class="title"><?=$data['professions']?></p>
                </div>

                <button class="info_more-btn" data-sidebar-btn>
                    <span>Show Contacts</span>

                    <ion-icon name="chevron-down"></ion-icon>
                </button>

            </div>

            <div class="sidebar-info_more">

                <div class="separator"></div>

                <ul class="contacts-list">

                    <li class="contact-item">

                        <div class="icon-box">
                            <ion-icon name="mail-outline"></ion-icon>
                        </div>

                        <div class="contact-info">
                            <p class="contact-title">Email</p>

                            <a href="mailto:mberayildiz@gmail.com" class="contact-link"><?=$data['emailid']?></a>
                        </div>

                    </li>

                    <li class="contact-item">

                        <div class="icon-box">
                            <ion-icon name="phone-portrait-outline"></ion-icon>
                        </div>

                        <div class="contact-info">
                            <p class="contact-title">Phone</p>

                            <a href="tel:+905314561697" class="contact-link"><?=$data['mobile']?></a>
                        </div>

                    </li>

                    <li class="contact-item">

                        <div class="icon-box">
                            <ion-icon name="calendar-outline"></ion-icon>
                        </div>

                        <div class="contact-info">
                            <p class="contact-title">Birthday</p>

                            <time datetime="1997-10-27"><?=$data['dob']?></time>
                        </div>

                    </li>

                    <li class="contact-item">

                        <div class="icon-box">
                            <ion-icon name="location-outline"></ion-icon>
                        </div>

                        <div class="contact-info">
                            <p class="contact-title">Location</p>

                            <address><?=$data['location']?></address>
                        </div>

                    </li>

                </ul>

                <div class="separator"></div>

                <ul class="social-list">

                    <?php 
        if($data['twitter']!=""){
            ?>
                    <li class="social-item">
                        <a href="<?=$data['twitter']?>" target="_blank" class="social-link">
                            <ion-icon name="logo-twitter"></ion-icon>
                        </a>
                    </li>
                    <?php
        }    
        if($data['instagram']!=""){
          ?>
                    <li class="social-item">
                        <a href="<?=$data['instagram']?>" target="_blank" class="social-link">
                            <ion-icon name="logo-instagram"></ion-icon>
                        </a>
                    </li>
                    <?php
      } 
      if($data['github']!=""){
        ?>
                    <li class="social-item">
                        <a href="<?=$data['github']?>" target="_blank" class="social-link">
                            <ion-icon name="logo-github"></ion-icon>
                        </a>
                    </li>
                    <?php
    } 
    if($data['linkedin']!=""){
      ?>
                    <li class="social-item">
                        <a href="<?=$data['linkedin']?>" target="_blank" class="social-link">
                            <ion-icon name="logo-linkedin"></ion-icon>
                        </a>
                    </li>
                    <?php
  }  
        ?>

                </ul>

            </div>

        </aside>





        <!--
      - #main-content
    -->

        <div class="main-content">

            <!--
        - #NAVBAR
      -->

            <nav class="navbar">

                <ul class="navbar-list">

                    <li class="navbar-item">
                        <button class="navbar-link  active" data-nav-link>About</button>
                    </li>

                    <li class="navbar-item">
                        <button class="navbar-link" data-nav-link>Resume</button>
                    </li>

                    <li class="navbar-item">
                        <button class="navbar-link" data-nav-link>Portfolio</button>
                    </li>

                    <li class="navbar-item">
                        <button class="navbar-link" data-nav-link>Contact</button>
                    </li>

                </ul>

            </nav>





            <!--
        - #ABOUT
      -->

            <article class="about  active" data-page="about">

                <header>
                    <h2 class="h2 article-title">About me</h2>
                </header>

                <section class="about-text">
                    <p>
                        <?=$data['shortdesc']?>
                    </p>
                </section>


                <!--
          - service
        -->

                <section class="service">

                    <h3 class="h3 service-title">What i'm doing</h3>

                    <ul class="service-list">

                        <li class="service-item">

                            <div class="service-icon-box">
                                <img src="./assets/images/icon-design.svg
                " alt="design icon" width="40">
                            </div>

                            <div class="service-content-box">
                                <h4 class="h4 service-item-title">Web design</h4>

                                <p class="service-item-text">
                                    The most modern and high-quality design made at a professional level.
                                </p>
                            </div>

                        </li>

                        <li class="service-item">

                            <div class="service-icon-box">
                                <img src="./assets/images/icon-dev.svg" alt="Web development icon" width="40">
                            </div>

                            <div class="service-content-box">
                                <h4 class="h4 service-item-title">Web development</h4>

                                <p class="service-item-text">
                                    High-quality development of sites at the professional level.
                                </p>
                            </div>

                        </li>

                        <li class="service-item">

                            <div class="service-icon-box">
                                <img src="./assets/images/icon-app.svg" alt="mobile app icon" width="40">
                            </div>

                            <div class="service-content-box">
                                <h4 class="h4 service-item-title">Mobile apps</h4>

                                <p class="service-item-text">
                                    Professional development of applications for iOS and Android.
                                </p>
                            </div>

                        </li>

                        <li class="service-item">

                            <div class="service-icon-box">
                                <img src="./assets/images/design_ico.svg" alt="designer icon" width="40">
                            </div>

                            <div class="service-content-box">
                                <h4 class="h4 service-item-title">Design</h4>

                                <p class="service-item-text">
                                    Professional preparation of all designs.
                                </p>
                            </div>

                        </li>

                    </ul>

                </section>




                <!--
          - testimonials modal
        -->

                <div class="modal-container" data-modal-container>

                    <div class="overlay" data-overlay></div>

                    <section class="testimonials-modal">

                        <button class="modal-close-btn" data-modal-close-btn>
                            <ion-icon name="close-outline"></ion-icon>
                        </button>

                    </section>

                </div>

            </article>





            <!--
        - #RESUME
      -->

            <article class="resume" data-page="resume">

                <header>
                    <h2 class="h2 article-title">Resume</h2>
                </header>


                <section class="timeline">

                    <div class="title-wrapper">
                        <div class="icon-box">
                            <ion-icon name="book-outline"></ion-icon>
                        </div>

                        <h3 class="h3">Education</h3>

                    </div>
                    <?php
                    $query4 = "SELECT * FROM resume WHERE category='e'";
$runquery4= mysqli_query($db,$query4);
while($data4=mysqli_fetch_array($runquery4)){
    ?>
                    <ol class="timeline-list">

                        <li class="timeline-item">

                            <h4 class="h4 timeline-item-title"><?=$data4['title']?></h4>

                            <span><?=$data4['year']?></span>

                            <p class="h4 timeline-item-title"><?=$data4['ogname']?></p>

                        </li>


                    </ol>
                    <?php
}
                    ?>
                </section>

                <section class="timeline">

                    <div class="title-wrapper">
                        <div class="icon-box">
                            <ion-icon name="book-outline"></ion-icon>
                        </div>

                        <h3 class="h3">Experience</h3>
                        
                    </div>
                    <?php
                    $query4 = "SELECT * FROM resume WHERE category='pe'";
$runquery4= mysqli_query($db,$query4);
while($data4=mysqli_fetch_array($runquery4)){
    ?>

                    <ol class="timeline-list">

                        <li class="timeline-item">

                            <h4 class="h4 timeline-item-title"><?=$data4['title']?></h4>

                            <span><?=$data4['year']?></span>

                            <p class="h4 timeline-item-title"><?=$data4['ogname']?></p>

                        </li>

                    </ol>

                    <?php
}
                    ?>
                </section>

                <section class="skill">

                    <h3 class="h3 skills-title">My skills</h3>


                    <ul class="skills-list content-card">

                        <li class="skills-item">

                            <?php
                    $query3 = "SELECT * FROM skills";
$runquery3= mysqli_query($db,$query3);
while($data3=mysqli_fetch_array($runquery3)){
    ?>

                            <div class="title-wrapper">
                                <h5 class="h5"><?=$data3['skill']?> </h5>
                                <data value="<?=$data3['score']?>"><?=$data3['score']?>%</data>
                            </div>

                            <div class="skill-progress-bg">
                                <div class="skill-progress-fill" style="width: <?=$data3['score']?>%;"></div>
                            </div>
                            <?php
}
                    ?>
                        </li>
                        
                    </ul>

                </section>

            </article>





            <!--
        - #PORTFOLIO
      -->

            <article class="portfolio" data-page="portfolio">

                <header>
                    <h2 class="h2 article-title">Portfolio</h2>
                </header>

                <section class="projects">



                    <div class="filter-select-box">

                        <button class="filter-select" data-select>

                            <div class="select-value" data-selecct-value>Select category</div>

                            <div class="select-icon">
                                <ion-icon name="chevron-down"></ion-icon>
                            </div>

                        </button>


                    </div>

                    <ul class="project-list">
                        <?php
                    $query5 = "SELECT * FROM portfolio";
$runquery5= mysqli_query($db,$query5);
while($data5=mysqli_fetch_array($runquery5)){
    ?>

                        <li class="project-item  active">
                            <a href="<?=$data5['projectlink']?>">

                                <figure class="project-img">

                                    <img src="./assets/images/<?=$data5['projectpic']?>" alt="img-fluid" loading="lazy">
                                </figure>

                                <h3 class="project-title"><?=$data5['projectname']?></h3>

                                <p class="project-category"><?=$data5['projectcategory']?></p>

                            </a>
                        </li>
                        <?php
}
                    ?>
                    </ul>

                </section>

            </article>




            <!--
        - #CONTACT
      -->

            <article class="contact" data-page="contact">

                <header>
                    <h2 class="h2 article-title">Contact</h2>
                </header>

                <section class="contact-form">

                    <h3 class="h3 form-title">Contact Form</h3>

                    <form action="include/message.php" method="post" role="form" class="form" data-form>

                        <div class="input-wrapper">
                            <input type="name" name="name" class="form-input" placeholder="Full name" required
                                data-form-input>

                            <input type="email" name="email" class="form-input" placeholder="Email address" required
                                data-form-input>

                            <input type="subject" name="subject" class="form-input" placeholder="Subject" required
                                data-form-input>
                        </div>

                        <textarea name="message" class="form-input" placeholder="Your Message" required
                            data-form-input></textarea>

                        <button class="form-btn" type="submit" disabled data-form-btn>
                            <ion-icon name="paper-plane"></ion-icon>
                            <span>Send Message</span>
                        </button>

                    </form>

                </section>

            </article>

        </div>

    </main>


    <!--
    - custom js link
  -->
    <script src="./assets/js/script.js"></script>

    <!--
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>