<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>mengapa memilih kami?</h3>
         <p>Kami mengutamakan kenyamanan dan kemudahan bagi pelanggan dalam berbelanja online. Dengan antarmuka yang intuitif dan proses transaksi yang cepat, kami memastikan pengalaman berbelanja Anda selalu menyenangkan.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">
   
   <h1 class="heading">ulasan klien</h1>

   <div class="swiper reviews-slider">

   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <img src="images/pic-1.png" alt="">
         <p>Saya sangat puas berbelanja di sini! Proses pemesanan sangat mudah dan cepat. Produk yang saya terima sesuai dengan deskripsi dan kualitasnya sangat baik. Layanan pelanggan juga sangat responsif ketika saya memiliki pertanyaan. Pengirimannya cepat dan tepat waktu. Pasti akan berbelanja lagi!Produk Berkualitas dan Terpercaya.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-2.png" alt="">
         <p>Belanja online di platform ini benar-benar menyenangkan. Banyak pilihan produk dengan harga yang kompetitif. Saya juga mendapatkan diskon besar-besaran pada acara promosi. Paket saya sampai dalam kondisi baik dan tepat waktu. Sangat direkomendasikan!.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Taylor lina</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-3.png" alt="">
         <p>Saya sangat terkesan dengan layanan pelanggan mereka. Ada sedikit masalah dengan pesanan saya, tetapi tim dukungan pelanggan sangat cepat dalam merespons dan menyelesaikan masalah tersebut. Produk yang saya beli berkualitas tinggi dan sesuai harapan. Terima kasih!.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>kevin amberano</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-4.png" alt="">
         <p>Ini adalah pengalaman belanja online terbaik yang pernah saya alami. Situs webnya mudah digunakan dan transaksi sangat aman. Produk yang ditawarkan sangat beragam dan selalu ada penawaran menarik. Saya suka fitur pelacakan pengiriman yang membuat saya tenang menunggu pesanan saya.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Kenny kolasa</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-5.png" alt="">
         <p>Saya sering berbelanja di sini karena selalu puas dengan kualitas produknya. Harga yang ditawarkan sangat kompetitif, dan mereka sering mengadakan promo menarik. Pengirimannya juga cepat dan aman. Sungguh layanan e-commerce yang luar biasa!.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Leonardo kokas</h3>
      </div>


   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>