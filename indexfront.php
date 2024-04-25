<?php
require 'function.php';
require 'cek.php';     

$queryproduk = mysqli_query ($conn, "select idbarang, namabarang, harga, deskripsi, stock, image from stock limit 19");
$querybest2 = mysqli_query ($conn, "SELECT keluar.idkeluar, keluar.qty, stock.namabarang, stock.image FROM keluar INNER JOIN stock ON keluar.idbarang=stock.idbarang order by qty DESC limit 3;");
                               
 ?>

<!DOCTYPE html>
<html lang="en">
<head>

     <title>Oppo Store</title>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/style.css">

</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

     <!-- PRE LOADER -->
     <section class="preloader">
          <div class="spinner">
               <span class="spinner-rotate"></span>
          </div>
     </section>


     <!-- MENU -->
     <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="#" class="navbar-brand">Oppo Store Website</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <li class="active"><a href="index.php">Home</a></li>
                         <li><a href="index.php">Tetang Oppo</a></li>
                         <li><a href=".php">Produk</a></li>
                         <li><a href="produk.php">Produk Best Seller</a></li>
                         <li><a href="produk.php">Rating</a></li>
                         <li><a href="kontak.php">Kontak</a></li>
                    </ul>
               </div>

          </div>
     </section>

     <!-- HOME -->
     <section id="home">
          <div class="row">
                <div class="owl-carousel owl-theme home-slider">
                    
					
					<div class="item item-first">
					<img src="images/cover.jpg" alt="Gambar 1">

                    </div>
               </div>
          </div>
     </section>

     <section>
               <div class="container">
                    <div class="row">
                         <div class="col-md-12 col-sm-12">
                              <div class="text-center">
                                   <h2>Tentang Oppo</h2>

                                   <br>

                                   <p class="lead">Oppo didirikan pada tahun 2001 oleh Tony Chen. Oppo adalah salah satu brand besar di industri smartphone dan masuk
                                        dalam deretan 10 besar brand smartphone paling berpengaruh saat ini. Oppo telah tersohor dan mempunyai
                                        banyak penggemar dari berbagai kelompok masyarakat</p>
                                        <p class="lead">
                                        <br> 
                                   OPPO mengidentifikasi dengan sejumlah besar rekan kami. Kami berharap dapat memberdayakan mereka dan
                                   mengangkat masyarakat dengan inovasi dan teknologi, serta membuat perbedaan dan menemukan inspirasi ke depan.</p>
                              </div>
                         </div>
                    </div>
               </div>
          </section>

     <main>

    

											
          <section>
               <div class="container">
                    <div class="row">
                         <div class="col-md-12 col-sm-12">
                              <div class="section-title text-center">
                                   <h2>Produk Tersedia</h2>
                              </div>
                         </div>
						
						<?php while($data = mysqli_fetch_array($queryproduk)){?>
						
                         <div class="col-md-4 col-sm-6">
                              <div class="team-thumb">
                                   <div class="team-image">
                                        <img src="images/<?php echo $data['image']; ?>" class="img-responsive" alt="">
                                   </div>
                                   <div class="team-info">
                                        <h3><?php echo $data['namabarang']; ?></h3>

                                        <p class="lead"><small>Mulai Dari</small> <strong>Rp.<?php echo $data['harga']; ?></strong></p>
                                   </div>
                                   <div class="team-thumb-actions">
                                        <a href="produk_detail.php?nama=<?php echo $data['namabarang']; ?>" class="section-btn btn btn-primary btn-block">Spesifikasi</a>
                                   </div>
                              </div>
                         </div>
						<?php }?>

                         

                    </div>
               </div>
          </section>

         

          <section>
               <div class="container">
                    <div class="row">
                         <div class="col-md-12 col-sm-12">
                              <div class="section-title text-center">
                                   <h2>Produk Best Seller<small>Bulan Maret-April</small></h2>
                              </div>
                         </div>
						<?php while($data = mysqli_fetch_array($querybest2)){?>
                         <div class="col-md-4 col-sm-4">
                              <div class="courses-thumb courses-thumb-secondary">
                                   <div class="courses-top">
                                        <div class="courses-image">
                                             <img src="images/<?php echo $data['image']; ?>" class="img-responsive" alt="">
                                        </div>
                                        <div class="courses-date">
                                             <span title="Date"><i class="fa fa-calendar"></i> 2023</span>
                                        </div>
                                   </div>

                                   <div class="courses-detail">
                                        <h3><a href="blog-post-details.html"><?php echo $data['namabarang']; ?></a></h3>
                                   </div>

                                   <div class="courses-info">
                                        <a href="produk_detail.php?nama=<?php echo $data['namabarang']; ?>" class="section-btn btn btn-primary btn-block">Baca Lebih Banyak</a>
                                   </div>
                              </div>
                         </div>
						 
						 <?php }?>

                        

                        
                    </div>
               </div>
          </section>
          <section id="testimonial">
               <div class="container">
                    <div class="row">

                         <div class="col-md-12 col-sm-12">
                              <div class="section-title text-center">
                                   <h2>Pelanggan Yang Puas Dengan Pelayanan Kami</h2>
                              </div>

                              <div class="owl-carousel owl-theme owl-client">
                                   <div class="col-md-4 col-sm-4">
                                        <div class="item">
                                             <div class="tst-image">
                                                  <img src="images/tst-image-1-200x216.jpg" class="img-responsive" alt="">
                                             </div>
                                             <div class="tst-author">
                                                  <h4>Bagas</h4>
                                                  <span>Pembeli</span>
                                             </div>
                                             <p>Pelayanan bagus, ramah, proses cepat, dan ga ribet. Udah berkali-kali
                                                  beli HP di Cello's Shop selalu mantap
                                             </p>
                                             <div class="tst-rating">
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                             </div>
                                        </div>
                                   </div>

                                   <div class="col-md-4 col-sm-4">
                                        <div class="item">
                                             <div class="tst-image">
                                                  <img src="images/tst-image-2-200x216.jpg" class="img-responsive" alt="">
                                             </div>
                                             <div class="tst-author">
                                                  <h4>Indah</h4>
                                                  <span>Pembeli</span>
                                             </div>
                                             <p>Mantap banget! kualitasnya selalu memuaskan</p>
                                             <div class="tst-rating">
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                             </div>
                                        </div>
                                   </div>

                                   <div class="col-md-4 col-sm-4">
                                        <div class="item">
                                             <div class="tst-image">
                                                  <img src="images/tst-image-3-200x216.jpg" class="img-responsive" alt="">
                                             </div>
                                             <div class="tst-author">
                                                  <h4>Olla</h4>
                                                  <span>Pembeli</span>
                                             </div>
                                             <p>Puas banget belanja disini, puas sama barangnya</p>
                                             <div class="tst-rating">
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                             </div>
                                        </div>
                                   </div>

                                   <div class="col-md-4 col-sm-4">
                                        <div class="item">
                                             <div class="tst-image">
                                                  <img src="images/tst-image-4-200x216.jpg" class="img-responsive" alt="">
                                             </div>
                                             <div class="tst-author">
                                                  <h4>Ikmal</h4>
                                                  <span>Pembeli</span>
                                             </div>
                                             <p>Selalu memuaskan, mantap!</p>
                                             <div class="tst-rating">
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                             </div>
                                        </div>
                                   </div>

                              </div>
                        </div>
                    </div>
               </div>
          </section> 
     </main>

     <!-- CONTACT -->
     <section id="contact">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-12">
                         <form id="contact-form" role="form" action="" method="post">
                              <div class="section-title">
                                   <h2>Hubungi Kami <small>Kami senang membantu anda!</small></h2>
                              </div>

                              <div class="col-md-12 col-sm-12">
                                   <input type="text" class="form-control" placeholder="Masukan Nama" name="name" required>
                    
                                   <input type="email" class="form-control" placeholder="Masukan Email" name="email" required>

                                   <textarea class="form-control" rows="6" placeholder="Pesan" name="message" required></textarea>
                              </div>

                              <div class="col-md-4 col-sm-12">
                                   <input type="submit" class="form-control" name="send message" value="Kirim">
                              </div>

                         </form>
                    </div>

                    <!-- <div class="col-md-6 col-sm-12">
                         <div class="contact-image">
                              <img src="images/contact-1-600x400.jpg" class="img-responsive" alt="Smiling Two Girls">
                         </div>
                    </div> -->

               </div>
          </div>
     </section>       

     <!-- FOOTER -->
     <footer id="footer">
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-6">
                         <div class="footer-info">
                              <div class="section-title">
                                   <h2>Alamat</h2>
                              </div>
                              <address>
                                   <p>Jl. Daeyuhkolot No. 421</p>
                              </address>

                              <ul class="social-icon">
                                   <li><a href="#" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                                   <li><a href="#" class="fa fa-twitter"></a></li>
                                   <li><a href="#" class="fa fa-instagram"></a></li>
                              </ul>

                              <div class="copyright-text"> 
                                   <p>Copyright &copy; 2004-2024 OPPO. Seluruh hak cipta.</p>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <div class="footer-info">
                              <div class="section-title">
                                   <h2>Info Kontak</h2>
                              </div>
                              <address>
                                   <p>081281022589</p>
                                   <p><a href="mailto:cello's@gmail.com">oppo@gmail.com</a></p>
                              </address>

                              <!-- <div class="footer_menu">
                                   <h2>Quick Links</h2>
                                   <ul>
                                        <li><a href="index.html">Home</a></li>
                                        <li><a href="about-us.html">About Us</a></li>
                                        <li><a href="terms.html">Terms & Conditions</a></li>
                                        <li><a href="contact.html">Contact Us</a></li>
                                   </ul>
                              </div>
                         </div>
                    </div> -->

                    <!-- <div class="col-md-4 col-sm-12">
                         <div class="footer-info newsletter-form">
                              <div class="section-title">
                                   <h2>Newsletter Signup</h2>
                              </div>
                              <div>
                                   <div class="form-group">
                                        <form action="#" method="get">
                                             <input type="email" class="form-control" placeholder="Enter your email" name="email" id="email" required>
                                             <input type="submit" class="form-control" name="submit" id="form-submit" value="Send me">
                                        </form>
                                        <span><sup>*</sup> Please note - we do not spam your email.</span>
                                   </div>
                              </div>
                         </div>
                    </div>
                     -->
               </div>
          </div>
     </footer>

     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>

</body>
</html>