<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['upload_payment'])){
   $order_id = $_POST['order_id'];
   $upload_payment = $_FILES['upload_payment']['name'];
   $upload_payment_tmp_name = $_FILES['upload_payment']['tmp_name'];
   $upload_payment_folder = 'upload_payment/'.$upload_payment;

   // Periksa apakah direktori ada, jika tidak, buat direktori
   if (!is_dir('upload_payment')) {
       mkdir('upload_payment', 0777, true); // 0777 adalah izin, true untuk pembuatan direktori rekursif
   }

   if(!empty($upload_payment)){
      // Periksa jika file sudah ada
      if (file_exists($upload_payment_folder)) {
         $message[] = 'File sudah ada, mohon ganti nama file dan coba lagi.';
      } else {
         // Pindahkan file yang diunggah ke folder yang ditentukan
         if (move_uploaded_file($upload_payment_tmp_name, $upload_payment_folder)) {
            // Update database dengan nama file
            $update_upload_payment = $conn->prepare("UPDATE `orders` SET upload_payment = ? WHERE id = ? AND user_id = ?");
            $update_upload_payment->execute([$upload_payment, $order_id, $user_id]);
            $message[] = 'Bukti pembayaran berhasil diunggah!';
         } else {
            $message[] = 'Gagal mengunggah file, mohon coba lagi.';
         }
      }
   } else {
      $message[] = 'Mohon unggah file bukti pembayaran.';
   }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pesanan</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="orders">

   <h1 class="heading">Pesanan</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">Silahkan login untuk melihat pesanan Anda</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p>Ditempatkan pada : <span><?= $fetch_orders['placed_on']; ?></span></p>
      <p>Nama : <span><?= $fetch_orders['name']; ?></span></p>
      <p>Email : <span><?= $fetch_orders['email']; ?></span></p>
      <p>Nomor Handphone : <span><?= $fetch_orders['number']; ?></span></p>
      <p>Alamat : <span><?= $fetch_orders['address']; ?></span></p>
      <p>Metode Pembayaran : <span><?= $fetch_orders['method']; ?></span></p>
      <p>Pesanan Anda : <span><?= $fetch_orders['total_products']; ?></span></p>
      <p>Total Harga : <span>Rp.<?= $fetch_orders['total_price']; ?>/-</span></p>
      <p>Status Pembayaran : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>

      <?php if($fetch_orders['payment_status'] == 'pending'){ ?>
         <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
            <input type="file" name="upload_payment" class="box" required>
            <input type="submit" name="upload_payment" class="btn" value="Unggah Bukti Pembayaran">
         </form>
      <?php } ?>

   </div>
   <?php
      }
      }else{
         echo '<p class="empty">Belum ada pesanan!</p>';
      }
      }
   ?>

   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
