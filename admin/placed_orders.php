<?php

include '../components/connect.php'; // Sesuaikan path jika file ini ada di dalam folder admin

session_start();

// Periksa jika admin sudah login
if(!isset($_SESSION['admin_id'])){
   header('location:admin_login.php');
   exit;
}

if(isset($_POST['update_payment'])) {
   $order_id = $_POST['order_id'];
   $new_payment_status = $_POST['payment_status'];
   $update_order = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_order->execute([$new_payment_status, $order_id]);
   header('Location: placed_orders.php');
   exit;
}

// Menghapus pesanan jika ada parameter delete
if(isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('Location: placed_orders.php');
   exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pesanan Admin</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css"> <!-- Sesuaikan path jika file ini ada di dalam folder admin -->

</head>
<body>
   
<?php include '../components/admin_header.php'; ?> <!-- Sesuaikan path jika file ini ada di dalam folder admin -->

<section class="orders">

   <h1 class="heading">Pesanan</h1>

   <div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders`");
      $select_orders->execute();
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
      <p>Bukti Pembayaran: 
   <?php if(!empty($fetch_orders['upload_payment'])){ ?>
      <a href="../upload_payment/<?= $fetch_orders['upload_payment']; ?>" target="_blank">Lihat Bukti</a> <!-- Sesuaikan path -->
   <?php } else { ?>
      <span>Belum diunggah</span>
   <?php } ?>
</p>
      <p>Status Pembayaran : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
      <form action="" method="post">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <select name="payment_status" class="select">
            <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
            <option value="pending">tertunda</option>
            <option value="completed">selesai</option>
            
         </select>
      <div class="flex-btn">
         <input type="submit" value="update" class="option-btn" name="update_payment">
         <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Hapus pesanan ini?');">Hapus</a>
      </div>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">Belum ada pesanan!</p>';
      }
   ?>

   </div>

</section>



<script src="../js/admin_script.js"></script> <!-- Sesuaikan path jika file ini ada di dalam folder admin -->

</body>
</html>
