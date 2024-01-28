<?php
     ob_start();
     session_start();
     include_once 'dbconnect.php';

     if ( isset($_SESSION['user'])!="" ) {
      header("Location: home.php");
      exit;
     }
     
     $error = false;
     
     if( isset($_POST['btn-login']) ) { 
      
      $email = trim($_POST['email']);
      $email = strip_tags($email);
      $email = htmlspecialchars($email);
      
      $pass = trim($_POST['pass']);
      $pass = strip_tags($pass);
      $pass = htmlspecialchars($pass);
      
      if(empty($email)){
       $error = true;
       $emailError = "Please enter your email address.";
      } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
       $error = true;
       $emailError = "Please enter a valid email address.";
      }
      
      if(empty($pass)){
       $error = true;
       $passError = "Please enter your password.";
      }
      
      if (!$error) {
       
       $password = hash('sha256', $pass);
      
       $res=mysqli_query($conn,"SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");
       $row=mysqli_fetch_array($res);
       $count = mysqli_num_rows($res);
       
       if( $count == 1 && $row['userPass']==$password ) {
        $_SESSION['user'] = $row['userId'];
        header("Location: home.php");
       } else {
        $errMSG = "Incorrect Credentials, Please try again...";
       }
        
      }
      
     }
    ?>

 

    <!DOCTYPE html>
    <html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Cyber Analog Oturum Aç</title>
	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
 <!--Main CSS Files-->
  <link href="css/styles.css" rel="stylesheet" />
 <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
<!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    </head>
    <body>
		
		<header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center justify-content-lg-between">
<a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="index.html">Anasayfa</a></li>
          <li><a class="nav-link scrollto" href="index.html#services">Hizmetlerimiz</a></li>
          <li><a class="nav-link scrollto" href="index.html#about">Hakkımızda</a></li>
		   <li><a class="nav-link scrollto" href="index.html#testimonials">Ekibimiz</a></li>
          <!--<li><a class="nav-link scrollto " href="#support">Destekçilerimiz</a></li>-->
		  <li><a class="nav-link scrollto" href="index.html#contact">İletişim</a></li>
          <li class="dropdown"><a href="#"><span>Ürünlerimiz</span> <i class="bi bi-chevron-double-down"></i></a>
            <ul>
              <li><a href="hizmet-talebi.html">Ücretsiz SSL Sertifikası</a></li>
              <li class="dropdown"><a href="#"><span>Grafik Tasarım</span> <i class="bi bi-chevron-double-right"></i></a>
                <ul>
                 <li><a href="https://form.jotform.com/221037491341953">Logo Tasarımı</a></li>
                  <li><a href="https://form.jotform.com/221046001299952">Broşür/Kartvizit/Katalog</a></li>
                  <li><a href="https://form.jotform.com/221045934190956">İllustrasyon/Afiş/Sosyal Medya</a></li>
                </ul>
              </li>
              <li><a href="https://form.jotform.com/221045976820962">Web Geliştirme & Tasarım Hizmeti</a></li>
              <li><a href="hizmet-talebi.html">Web Güvenliği & Teknik Destek</a></li>
              <li><a href="hizmet-talebi.html">Web Sitesi SEO Ayarları</a></li>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <a href="signup.php" class="get-started-btn scrollto">Üye Ol | Oturum Aç</a>
    </div>
  </header><!-- End Header -->

   <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Cyber Analog</h2>
          <ol>
            <li><a href="index.html">Anasayfa</a></li>
            <li>Oturum Açma | Üyelik</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
<div class="row">
	<div class="col-lg-6 order-1 order-lg-2">
            <img src="assets/img/login.jpg" class="img-fluid" alt="">
          </div>
	<div class="col-lg-6">
     <div id="login-form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
             <div class="form-group">
                 <h2 class="">Oturum Aç</h2>
                </div>
            
             <div class="form-group">
                 <hr />
                </div>
                
                <?php
       if ( isset($errMSG) ) {
        
        ?>
        <div class="form-group">
                 <div class="alert alert-danger">
        <span class="glyphicon glyphicon-info-sign">Cyber Analog Kullanıcı Girişi</span> <?php echo $errMSG; ?>
                    </div>
                 </div>
                    <?php
       }
       ?>
                
                <div class="form-group">
                 <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                 <input type="email" name="email" class="form-control" placeholder="Email Adresiniz" maxlength="40" />
                    </div>
                    <span class="text-danger"><?php echo $emailError; ?></span>
                </div>
                <br>
                <div class="form-group">
                 <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                 <input type="password" name="pass" class="form-control" placeholder="Şifreniz" maxlength="15" />
                    </div>
                    <span class="text-danger"><?php echo $passError; ?></span>
                </div>
                
                <div class="form-group">
                 <hr />
                </div>
                
                <div class="form-group">
                 <button type="submit" class="btn btn-block btn-primary" name="btn-login">Oturum Aç</button>
                </div>
                
                <div class="form-group">
                 <hr />
                </div>
                
                <div class="form-group">
                 <a href="signup.php">Bir kullanıcı hesabınız yok mu? O zaman üye olun!</a>
                </div>
       <br>
        </form>
        </div> 
		 </div>
</div>
    </div>
		</section></main>
	<!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-left">
                        Copyright &copy; Cyber Analog Project
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                    </div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="https://www.instagram.com/cyberanalog/"><i class="bx bxl-instagram"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="https://www.linkedin.com/company/cyber-analog"><i class="bx bxl-linkedin"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="https://www.behance.net/kirkestormy"><i class="bx bxl-behance"></i></a>
						<a class="btn btn-dark btn-social mx-2" href="https://yasemintugbaalgin.myportfolio.com/"><i class="bx bxl-adobe"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-right">
                        <a class="mr-3" href="privacy.html">Gizlilik Politikası |</a>
                        <a href="conditions.html">Kullanım Şartları</a>
                    </div>
                </div>
            </div>
        </footer>
		<!-- partial -->
  <script  src="js/scripts.js"></script>

 <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
    </body>
    </html>
    <?php ob_end_flush(); ?>