<?php
error_reporting(0);
session_start();
if ($_SESSION['status'] == "login") {
   header("location:admin.php");
}
?>

<!DOCTYPE html>
<html>

<head>
   <title>TEST</title>
   <link rel="stylesheet" type="text/css" href="style/login.css">
   <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>
   <div class="wrapper">
      <div class="left">
         <div class="left-inner">
         </div>

         <div class="sign-up-form active">
            <h1>Sign up to Your Project.</h1>

            <div class="seperator">
               <span>please sign-up here</span>
            </div>

            <form action="./db_conn/simpan_regisrasi.php" method="POST">

               <?php
               include './db_conn/koneksi.php';
               // mengambil data user dengan kode paling besar
               $querykode = mysqli_query($koneksi, "SELECT max(id_user) as idterbesar FROM user");
               $data = mysqli_fetch_array($querykode);
               $id_user = $data['idterbesar'];
               // mengambil angka dari kode user terbesar, menggunakan fungsi substr
               // dan diubah ke integer dengan (int)
               $urutan = (int) substr($id_user, 3, 3);
               // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
               $urutan++;
               // membentuk kode user baru
               // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
               // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
               // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG
               $huruf = "USR";
               $id_user = $huruf . sprintf("%03s", $urutan);

               ?>

               <div class="form-group">
                  <label for="">Id User</label>
                  <input type="input" name="id_user" value="<?php echo $id_user ?>" readonly>
               </div>
               <div class="grid-container">
                  <div class="form-group">
                     <label for="">Name</label>
                     <input type="input" placeholder="example ee" name="nama_user" id="name">
                  </div>
                  <div class="form-group">
                     <label for="">Username</label>
                     <input type="input" placeholder="exampleee" name="username">
                  </div>
               </div>
               <div class="grid-container">
                  <div class="form-group">
                     <label for="">Jenis Kelamin</label>
                     <select class="form-select" name="jenis_kelamin">
                        <option selected>Select you gender...</option>
                        <option value="Laki - laki">Laki - laki</option>
                        <option value="Perempuan">Perempuan</option>
                     </select>
                  </div>
                  <br>
                  <div class="form-group">
                     <label for="">No Handphone</label>
                     <input type="number" placeholder="089918312234" name="no_hp">
                  </div>
               </div>
               <div class="form-group">
                  <label for="">Password</label>
                  <input type="password" placeholder="*******" name="password">

               </div>
               <div class="form-group">
                  <button id="submit">SIGN UP</button>
               </div>
               <div class="create-aacount">
                  Already registered? <a href="./" class="text-underline sign-in-form-btn"> Sign In</a>
               </div>
            </form>
         </div>
      </div>
      <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
      <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_jcikwtux.json" background="transparent" style="width: 700px; height: 700px; position:absolute; top:20%; right:-5px" loop autoplay></lottie-player>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="position: absolute; top:-10px; right:-10px; z-index:-1; width: 3000px; max-width:110%">
         <path fill="#21CECC" fill-opacity="2" d="M0,32L48,42.7C96,53,192,75,288,85.3C384,96,480,96,576,122.7C672,149,768,203,864,197.3C960,192,1056,128,1152,138.7C1248,149,1344,235,1392,277.3L1440,320L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
      </svg>
   </div>

</body>

</html>