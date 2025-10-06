<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Xgear</title>
  <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/45.0.0/ckeditor5.css" />

  <link rel="icon" href="/public/assets/favicon.webp" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/public/styles/style.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="/views/cart/style.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="/views/checkout/style.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="/views/profile/style.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="/views/admin/style.css?v=<?php echo time(); ?>">
  <script src="https://kit.fontawesome.com/c60326e8ae.js" crossorigin="anonymous"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/45.0.0/ckeditor5.umd.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4/dist/chart.umd.min.js"></script>
  <script src="/scripts/jquery.js" crossorigin="anonymous"></script>
  <script src="/scripts/script.js"> </script>
</head>

<body style="position:relative;">

  <?php
  ob_start();
  session_start();
  $config = require_once "config/config.php";
  include("config/config.php");
  include("views/main/main.php");
  ?>

  <div class="modal-backdrop fade"></div>

<script src="/scripts/script.js"></script>
<script>


</script>
</body>

</html>

