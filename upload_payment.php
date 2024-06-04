<?php
include 'components/connect.php';
session_start();

// Periksa jika user sudah login
if (!isset($_SESSION['user_id'])) {
    header('location:user_login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$message = []; // Inisialisasi array untuk menyimpan pesan

if (isset($_POST['upload_payment'])) {
    // Periksa apakah ada file yang diunggah
    if (isset($_FILES['upload_payment'])) {
        $upload_payment = $_FILES['upload_payment'];

        // Periksa apakah ada kesalahan dalam proses unggah file
        if ($upload_payment['error'] === UPLOAD_ERR_OK) {
            $upload_payment_name = $upload_payment['name'];
            $upload_payment_tmp_name = $upload_payment['tmp_name'];
            $upload_payment_folder = 'upload_payment/' . $upload_payment_name;

            // Pindahkan file yang diunggah ke folder yang ditentukan
            if (move_uploaded_file($upload_payment_tmp_name, $upload_payment_folder)) {
                // Update database dengan nama file
                $update_upload_payment = $conn->prepare("UPDATE `orders` SET upload_payment = ? WHERE user_id = ? ORDER BY id DESC LIMIT 1");
                $update_upload_payment->execute([$upload_payment_name, $user_id]);
                $message[] = 'Bukti pembayaran berhasil diunggah!';
            } else {
                $message[] = 'Gagal mengunggah file, mohon coba lagi.';
            }
        } else {
            $message[] = 'Error saat mengunggah file, mohon coba lagi.';
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
   <title>Unggah Bukti Pembayaran</title>

   <!-- link cdn font awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- link file css custom -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="checkout-orders">

   <form action="" method="POST" enctype="multipart/form-data">

      <h3>Unggah Bukti Pembayaran</h3>

      <div class="inputBox">
         <span>Bukti Pembayaran:</span>
         <input type="file" name="upload_payment" class="box" required>
      </div>

      <input type="submit" name="upload_payment" class="btn" value="Unggah Bukti">

   </form>

   
</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
