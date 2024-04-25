<?php
session_start();

$conn = mysqli_connect("localhost","root","","stockbarang");

// Menambah barang baru

if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];

    // soal gambar
    $allowed_extension = array('png', 'jpg', 'webp');
    $nama = $_FILES['file']['name']; // ngambil nama gambar
    $dot = explode('.',$nama);
    $ekstensi = strtolower(end($dot)); // ngambil ekstensinya
    $ukuran = $_FILES['file']['size']; // ngambil size filenya
    $file_tmp = $_FILES['file']['tmp_name']; // ngambil lokasi filenya 

    // penamaan file -> enkripsi
    $image = md5(uniqid($nama,true) . time()).'.'.$ekstensi; // menggabungkan nama file yang dienkripsi dengan ekstensinya

    // validasi udah ada atau belum
    $cek = mysqli_query($conn,"select * from stock where namabarang='$namabarang'");
    $hitung = mysqli_num_rows($cek);

    if($hitung<1){
        // jika belum ada
        
        // proses uploud gambar
        if(in_array($ekstensi, $allowed_extension) === true){
            // validasi ukuran filenya
            if($ukuran < 15000000){
                move_uploaded_file($file_tmp, 'images/'.$image);  //lokasi simpan file gambar

                $addtotable = mysqli_query($conn,"insert into stock (namabarang, harga, deskripsi, stock, image) values('$namabarang','$harga','$deskripsi','$stock','$image')");
                if($addtotable){
                    header('location:index.php');
                } else {
                    echo 'Gagal';
                    header('location:index.php');
                }
            } else {
                // kalo filenya lebih dari 15mb
                echo '
                <script>
                alert("Ukuran terlalu besar");
                window.location.href="index.php";
                </script>
                ';
            }
        } else {
            // kalo filenya tidak png, jpg, webp
            echo '
        <script>
        alert("File harus png, jpg atau webp");
        window.location.href="index.php";
        </script>
        ';
        }

    } else {
        // jika sudah ada
        echo '
        <script>
        alert("Nama barang sudah terdaftar");
        window.location.href="index.php";
        </script>
        ';
    }

    $addtotable = mysqli_query($conn, "insert into stock (namabarang, harga, deskripsi, stock, ) values('$namabarang', '$harga',$deskripsi', '$stock', '$image')");
    if($addtotable){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
};

// Menambah barang masuk

if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

    $addtomasuk = mysqli_query($conn, "insert into masuk (idbarang, keterangan, qty) values('$barangnya', '$penerima', '$qty')");
    $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    if($addtomasuk&&$updatestockmasuk){
        header('location:masuk.php');
    } else {
        echo 'Gagal';
        header('location:masuk.php');
    }
};

// Menambah barang keluar

if(isset($_POST['addbarangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];

    if($stocksekarang >= $qty){
        // kalo stock barangnya cukup
    $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;

    $addtokeluar = mysqli_query($conn, "insert into keluar (idbarang, penerima, qty) values('$barangnya', '$penerima', '$qty')");
    $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    if($addtomasuk&&$updatestockmasuk){
        header('location:keluar.php');
    } else {
        echo 'Gagal';
        header('location:keluar.php');
    }
    } else {
        // kalo stock barangnya ga cukup
        echo '
        <script>
            alert("Stock saat ini tidak mencukupi");
            window.location.href="keluar.php";
        </script>
        ';
    }
}


// update info barang
if(isset($_POST['updatebarang'])){
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];
	
	// soal gambar
    $allowed_extension = array('png', 'jpg', 'webp');
    $nama = $_FILES['file']['name'];
    $dot = explode('.',$nama);
    $ekstensi = strtolower(end($dot));
    $ukuran = $_FILES['file']['tmp_name'];
    $file_tmp = $_FILES['file']['tmp_name'];

    // penamaan file -> enkripsi
    $image = md5(uniqid($nama,true) . time()).'.'.$ekstensi;

    if($ukuran==0){
        // jika tidak ingin upload
        $update = mysqli_query($conn,"update stock set namabarang='$namabarang', harga='$harga', deskripsi='$deskripsi', where idbarang = '$idb'");
        if($update) {
            header('location:index.php');
        } else {
            echo 'Gagal';
            header('location:index.php');
        }
    } else {
        // jika ingin
        move_uploaded_file($file_tmp, 'images/'.$image);
        $update = mysqli_query($conn,"update stock set namabarang='$namabarang', harga='$harga', deskripsi='$deskripsi', image='$image' where idbarang = '$idb'");
        if($update){
            header('location:index.php');
        } else {
            echo 'Gagal';
            header('location:index.php');
        }
    }
}

// menghapus barang dari stock
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb']; // id barang
	
	// $gambar = mysqli_query($conn,"select * from stock where idbarang='$idb'");
	// $get = mysqli_fetch_array($gambar);
	// $img = 'images/'.$get['image'];
	// unlink($img);

    $hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");
    if($hapus){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

// mengubah data barang masuk
if(isset($_POST['updatebarangmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $deskripsi = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $selisih = $qty-$qtyskrg;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");
            if($kurangistocknya&&$updatenya){
                header('location:masuk.php');
                } else {
                    echo 'Gagal';
                    header('location:masuk.php');
            } 
    } else {
        $selisih = $qtyskrg-$qty;
        $kurangin = $stockskrg - $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");
            if($kurangistocknya&&$updatenya){
                header('location:masuk.php');
                } else {
                    echo 'Gagal';
                    header('location:masuk.php');
            }
    }
}

//menghapus barang masuk
if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idm = $_POST['idm'];

    $getdatastock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $selisih = $stok-$qty;

    $update = mysqli_query($conn,"update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn,"delete from masuk where idmasuk='$idm'");

    if($update&&$hapusdata){
        header('location:masuk.php');
    } else {
        header('location:masuk.php');
    }
}

// mengubah data barang keluar
if(isset($_POST['updatebarangkeluar'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idk'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $selisih = $qty-$qtyskrg;
        $kurangin = $stockskrg - $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set qty='$qty', keterangan='$deskripsi' where idkeluar='$idk'");
            if($kurangistocknya&&$updatenya){
                header('location:keluar.php');
                } else {
                    echo 'Gagal';
                    header('location:keluar.php');
            } 
    } else {
        $selisih = $qtyskrg-$qty;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set qty='$qty', keterangan='$deskripsi' where idkeluar='$idk'");
            if($kurangistocknya&&$updatenya){
                header('location:keluar.php');
                } else {
                    echo 'Gagal';
                    header('location:keluar.php');
            }
    }
}

//menghapus barang keluar
if(isset($_POST['hapusbarangkeluar'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idk = $_POST['idkeluar'];

    $getdatastock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $selisih = $stok-$qty;

    $update = mysqli_query($conn,"update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn,"delete from keluar where idkeluar='$idk'");

    if($update&&$hapusdata){
        header('location:keluar.php');
    } else {
        header('location:keluar.php');
    }
}

// menambah admin baru

if(isset($_POST['addadmin'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $queryinsert = mysqli_query($conn, "insert into login (email, password) values ('$email','$password')");

    if($queryinsert){
        // if berhasil
        header('localhost:admin.php');
    } else {
        // kalo ga berhasil
        header('location:admin.php');
    }
}

// edit data admin

if(isset($_POST['updateadmin'])){
    // Mengambil nilai dari form
    $emailbaru = $_POST['emailadmin'];
    $passwordbaru = $_POST['passwordbaru'];
    $idnya = $_POST['id'];

    // Perintah SQL untuk melakukan update
    $queryupdate = mysqli_query($conn, "UPDATE login SET email='$emailbaru', password='$passwordbaru' WHERE iduser='$idnya'");

    // Memeriksa apakah query berhasil dieksekusi
    if($queryupdate){

        header('Location: admin.php');
        exit();
    } else {
        header('Location: admin.php');
    }
}

// hapus data admin

if(isset($_POST['hapusadmin'])){
    $id = $_POST['id'];

    $querydelete = mysqli_query($conn, "delete from login where iduser='$id'");

    if($querydelete){

        header('Location: admin.php');
        exit();
    } else {
        header('Location: admin.php');
    }
}

// if($conn){
//     echo 'berhasil';
// }
?>