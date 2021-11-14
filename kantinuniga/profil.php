<?php 
  session_start();
  include 'db.php';
  if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
  }

  $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."'");
  $d = mysqli_fetch_object($query);

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
            <h3>Profil</h3>
            <div class="box">
              <form action="" method="POST">
                <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_name?>" required>
                <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username?>" required>
                <input type="text" name="hp" placeholder="No Hp" class="input-control" value="<?php echo $d->admin_telp?>" required>
                <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email?>" required>
                <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->admin_address?>" required>
                <button type="submit" name="submit" value="Ubah Profil" class="btn btn-danger">Ubah Profil</button>
              </form>
              
              <?php 
                if(isset($_POST['submit'])){

                  $nama   = $_POST['nama'];
                  $user   = $_POST['user'];
                  $hp     = $_POST['hp'];
                  $email  = $_POST['email'];
                  $alamat = $_POST['alamat'];

                  $update = mysqli_query($conn, "UPDATE tb_admin SET
                                    admin_name = '".$nama."',
                                    username = '".$user."',
                                    admin_telp = '".$hp."',
                                    admin_email = '".$email."',
                                    admin_address = '".$alamat."'
                                    WHERE admin_id = '".$d->admin_id."' ");
                  
                  if ($update){
                    echo '<script>alert("Ubah data berhasil")</script>';
                    echo '<script>window.location="profil.php"</script>';
                  }else{
                    echo 'gagal' .mysqli_error($conn);
                  }
               } 
              ?>
            </div>

            <h3>Ubah Password</h3>
            <div class="box">
              <form action="" method="POST">
                <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
                <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="input-control" required>
                <button type="submit" name="ubah_password" value="Ubah Profil" class="btn btn-danger">Ubah Profil</button>
              </form>
              
              <?php 
                if(isset($_POST['ubah_password'])){

                  $pass1   = $_POST['pass1'];
                  $pass2   = $_POST['pass2'];

                  if($pass2 != $pass1){
                    echo '<script>alert("Password tidak sesuai")</script>';
                  }else {
                    $u_pass = mysqli_query($conn, "UPDATE tb_admin SET
                                    password = '".MD5($pass1)."'
                                    WHERE admin_id = '".$d->admin_id."' ");
                    if ($u_pass) {
                      echo '<script>alert("Ubah data berhasil")</script>';
                      echo '<script>window.location="profil.php"</script>';
                    }else {
                      echo 'gagal' .mysqli_error($conn);
                    }
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