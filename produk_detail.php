<?php
require 'function.php';
require 'cek.php';

$nama = htmlspecialchars($_GET['nama']);
$querydetail = mysqli_query($conn, "select * from stock where namabarang='$nama'");
$produk = mysqli_fetch_array($querydetail);


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
                         <li><a href="produk.php">Produk</a></li>
                         <li><a href="produk.php">Produk Best Seller</a></li>
						 <li><a href="produk.php">Rating</a></li>
                         <li><a href="index.php">Kontak</a></li>
                    </ul>
               </div>

          </div>
     </section>

     <!-- HOME -->
     

     

     <main>

     

											
          <section>
               <div class="container">
                    <div class="row">
                         <div class="col-md-12 col-sm-12" >
                              <div class="section-title text-center">
                                   <h2>Detail Produk</h2>
                              </div>
                         </div>

                         <div class="col-md-6 col-sm-6 ">
                              <div class="team-thumb">
                                   <div class="team-image-center">
                                        <img src="images/<?php echo $produk['image']; ?>" class="img-responsive" alt="">
                                   </div>
                                   
                                   
                              </div>
                         </div> 
						 
						 <div class="col-md-6 col-sm-6 ">
                              <div class="team-thumb">
                                  
                                   <div class="team-info">
                                        <h3><?php echo $produk['namabarang']; ?></h3>
										<h3><?php echo $produk['deskripsi']; ?></h3>
										

                                        <p class="lead"><small>Mulai Dari</small> <strong>Rp.<?php echo $produk['harga']; ?></strong></p>
                                   </div>
                                   
                              </div>
                         </div>

                         


                    </div>
               </div>
          </section>

         

          
          
     </main>

         

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