<?php 
  session_start();
  include 'db.php';
  if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
  }

  $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
  $p = mysqli_fetch_object($produk); 
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title>KantinUniga</title>
  </head>
  <body id="bg-profil">
      <header>
        <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <div class="container">
          <a class="navbar-brand" href="dashboard.php">
          <img src="logo-uniga.png" alt="" width="40" height="40" class="d-inline-block align-text-top">
          Kantin Uniga Malang
          </a>
          <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="data-kategori.php">Data Kategori</a></li>
            <li><a href="data-produk.php">Data Produk</a></li>
            <li><a href="keluar.php">Keluar</a></li>
          </ul>
        </div>
        </nav>
      </header>
        <div class="section">
          <div class="container">
            <h3>Edit Data Produk</h3>
            <div class="box">
              <form action="" method="POST" enctype="multipart/form-data">
                <select class="input-control" name="kategori" required>
                  <option value="">--pilih--</option>
                  <?php 
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                    while($r = mysqli_fetch_array($kategori)){
                  ?>
                  <option value="<?php echo $r['category_id'] ?>"<?php echo ($r['category_id'] == $p->category_id)? 'selected':''; ?>><?php echo $r['category_name'] ?></option>
                  <?php } ?>
                </select>

                <input type="text" name="nama" class="input-control" placeholder="Nama Produk" value="<?php echo $p->product_name ?>" required>
                <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p->product_price ?>" required>
                
                <img src="produk/<?php echo $p->product_image ?>" width="150px">
                <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                <input type="file" name="gambar" class="input-control">
                <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"><?php echo $p->product_description ?></textarea>
                <select class="input-control" name="status">
                  <option value="">--pilih--</option>
                  <option value="1" <?php echo ($p->product_status == 1)? 'selected':''; ?>>Aktif</option>
                  <option value="0" <?php echo ($p->product_status == 0)? 'selected':''; ?>>Tidak Aktif</option>
                </select>
                <button type="submit" name="submit" value="Ubah Profil" class="btn btn-danger">Submit</button>
              </form>
              <?php 
                if(isset($_POST['submit'])){

                  $kategori   = $_POST['kategori'];
                  $nama       = $_POST['nama'];
                  $harga      = $_POST['harga'];
                  $deskripsi  = $_POST['deskripsi'];
                  $status     = $_POST['status'];
                  $foto     = $_POST['foto'];

                  $filename = $_FILES['gambar']['name'];
                  $tmp_name = $_FILES['gambar']['tmp_name'];

                  

                  if($filename != ''){
                    $type1 = explode('.', $filename);
                    $type2 = $type1[1];

                    $newname = 'produk'.time().'.'.$type2;

                    $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                    if(!in_array($type2, $tipe_diizinkan)){

                    echo '<script>alert("Format file tidak diizinkan")</script>';
                  }else{
                    unlink('./produk/'.$foto);
                    move_uploaded_file($tmp_name, './produk/'.$newname);
                    $namagambar = $newname;
                  }
                  
                  }else{
                    $namagambar = $foto;  
                  }

                  $update = mysqli_query($conn, "UPDATE tb_product SET 
                                          category_id = '".$kategori."',
                                          product_name = '".$nama."',
                                          product_price = '".$harga."',
                                          product_description = '".$deskripsi."', 
                                          product_image = '".$namagambar."', 
                                          product_status = '".$status."'
                                          WHERE product_id = '".$p->product_id."' ");
                  if($update){
                      echo '<script>alert("ubah data berhasil")</script>';
                      echo '<script>window.location="data-produk.php"</script>';
                    } else{
                      echo 'gagal' .mysqli_error($conn);
                    }

                }
              ?>
            </div>
          </div>
        </div>

        <!--footer -->
        <footer>
          <div class="container">
            <small>Copyright &copy: 2020 | Jodi Angger Wicaksono</small>
          </div>
        </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>