<?php
require 'function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Oppo Store</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            .zoomable{
                width: 100px;
            }
			.zoomable:hover{
				transform: scale(2.0);
				transition: 0.3s ease;
			};
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Oppo Store Admin</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stock Barang
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Keluar
                            </a>
                            <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Kelola Admin
                            </a>
                            <a class="nav-link" href="logout.php">
                                Logout
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Stock Barang</h1>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            Tambah Barang
                            </button>
                            <div class="card-body">

                            <?php
                                $ambildatastock = mysqli_query($conn, "select * from stock where stock < 1");
                                
                                while($fetch=mysqli_fetch_array($ambildatastock)){
                                    $barang = $fetch['namabarang'];
                                


                            ?>

                            <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Perhatian!</strong> Stock Barang <?=$barang;?> Telah Habis
                        </div>

                        <?php
                            }
                        ?>

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Gambar</th>
                                                <th>Nama Barang</th>
                                                <th>Harga</th>
                                                <th>Deskripsi</th>
                                                <th>Stock</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ambilsemuadatastock = mysqli_query($conn, "select * from stock");
                                            $i = 1;
                                            while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                                $namabarang = $data['namabarang'];
                                                $harga = $data['harga'];
                                                $deskripsi = $data['deskripsi'];
                                                $stock = $data['stock'];
                                                $idb = $data['idbarang'];

                                                // cek ada gambar atau tidak
                                                $gambar = $data['image']; // ambil gambar
                                                if($gambar==null){
                                                    // jika tidak ada gambar
                                                    $img = 'No Photo';
                                                } else {
                                                    // jika ada gambar
                                                    $img = '<img src="images/'.$gambar.'" class="zoomable">';
                                                }
                                            
                                            ?>
                                            
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$img;?></td>
                                                <td><?=$namabarang;?></td>
                                                <td><?=$harga;?></td>
                                                <td><?=$deskripsi;?></td>
                                                <td><?=$stock;?></td>
                                                <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idb;?>">
                                                    Edit
                                                </button>
                                                <input type="hidden" name="idbarangyangmaudihapus" value="<?=$idb;?>">
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idb;?>">
                                                    Delete
                                                </button>
                                            </td>
                                            </tr>

                                    <!-- edit modal -->

                                    <div class="modal fade" id="edit<?=$idb;?>">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
      
                                         <div class="modal-header">
                                         <h4 class="modal-title">Edit Barang</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <form method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                        <input type="text" name="namabarang" value="<?=$namabarang;?>" class="form-control" required>
                                        <br>
                                        <input type="text" name="harga" value="<?=$harga;?>" class="form-control" required>
                                        <br>
                                        <input type="text" name="deskripsi" value="<?=$deskripsi;?>" class="form-contorl" required> <br>
                                        <br>
                                        <input type="number" name="stock" class="form-control" placeholder="Stock" required>
                                        <br>
										<input type="file" name="file" class="form-control">
										<br>
                                        <input type="hidden" name="idb" value="<?=$idb;?>">
                                        <button type="submit" class="btn btn-primary" name="updatebarang">Edit</button>
                                        </div>
                                        </form>
                                        
                                    </div>
                                    </div>
                                </div>

                                <!-- modal delete -->

                                <div class="modal fade" id="delete<?=$idb;?>">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
      
                                         <div class="modal-header">
                                         <h4 class="modal-title">Delete Barang</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <form method="post">
                                        <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus <?=$namabarang;?>?
                                        <input type="hidden" name="idb" value="<?=$idb;?>">
                                        <br>
                                        <br>
                                        <button type="submit" class="btn btn-danger" name="hapusbarang">Hapus</button>
                                        </div>
                                        </form>
                                        
                                    </div>
                                    </div>
                                </div>
                                            <?php
                                            };

                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>

  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <form method="post" enctype="multipart/form-data">
            <div class="modal-body">
          <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
          <br>
          <input type="text" name="harga" class="form-control" placeholder="Harga" required>
          <br>
          <input type="text" name="deskripsi" placeholder="Deskripsi Barang" class="form-contorl" required> <br>
          <br>
          <input type="number" name="stock" class="form-control" placeholder="Stock" required>
          <br>
          <input type="file" name="file" class="form-control">
          <br>
          <button type="submit" class="btn btn-primary" name="addnewbarang">Tambah</button>
        </div>
        </form>
        
      </div>
    </div>
  </div>
</html>