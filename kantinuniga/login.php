

<!--USERNAME : admin, PASSWORD : admin-->


<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title>LOGIN | KantinUniga</title>
  </head>
  <body id="bg-login">
      <div class="box-login">
        <h2>LOGIN</h2>
        <form action="" method="POST">
          <input type="text" name="user" placeholder="Username" class="input-control"><br>
          <input type="password" name="pass" placeholder="Password" class="input-control"><br>
          <button type="submit" name="submit" class="btn btn-danger">Login</button>
        </form>
          <?php 
            if (isset($_POST['submit'])) {
              session_start();
              include 'db.php';

              $user = $_POST['user'];
              $pass = $_POST['pass'];

              $cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '".$user."' AND password = '".MD5($pass)."'");
              if(mysqli_num_rows($cek) > 0){
                $d = mysqli_fetch_object($cek);
                $_SESSION['status_login'] = true;
                $_SESSION['a_global'] = $d;
                $_SESSION['id'] = $d->admin_id;
                echo '<script>window.location="dashboard.php"</script>';
              }else{
                echo '<script>alert("username atau password anda salah!")</script>';
              }
            }
          ?>
      </div>
      <ul>
        <h3>UTS PEMROGRAMAN INTERNET</h3>
        <li>Nama  : Jodi Angger Wicaksono</li>
        <li>Nim     : 20510019</li>
        <li>Prodi : Sistem Informasi</li>
      </ul>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>