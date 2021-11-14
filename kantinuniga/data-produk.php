<?php 
  session_start();
  include 'db.php';
  if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
  }
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
  <body>
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
          <h3>Data Produk</h3>
          <div class="box">
            <p><a href="tambah-produk.php">Tambah Data</a></p>
            <table border="1" cellspacing="0" class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kategori</th>
                  <th>Nama Produk</th>
                  <th>Harga</th>
                  <th>Deskripsi</th>
                  <th>Gambar</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no = 1; 
                  $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
                  if(mysqli_num_rows($produk) > 0){
                  while ($row = mysqli_fetch_array($produk)){
                ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $row['category_name'] ?></td>
                  <td><?php echo $row['product_name'] ?></td>
                  <td>Rp.<?php echo number_format($row['product_price']) ?></td>
                  <td><?php echo $row['product_description'] ?></td>
                  <td><img src="produk/<?php echo $row['product_image'] ?>" width="100px"></td>
                  <td><?php echo ($row['product_status'] == 0)? 'Tidak aktif':'Aktif'; ?></td>
                  <td>
                    <a href="edit-produk.php?id=<?php echo $row['product_id'] ?>">Edit</a> || <a href="proses-hapus.php?idp=<?php echo $row['product_id'] ?>" onclick="return confirm('hapus data?')">Hapus</a>
                  </td>
                </tr>
              <?php }}else{ ?>
                <tr>
                  <td colspan="8">Tidak ada data</td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
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