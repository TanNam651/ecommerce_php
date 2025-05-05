<?php
$router->post("/login", "account/logincontroller.php");
$router->get("/register", "account/signupcontroller.php");
$router->post("/reset-password", "account/reset-password/reset-password.php");
$router->post("/confimation-password", "account/confimation-password/confimation-password.php");
$router->post("/verify-email", "account/verify-email.php");
$router->get("/", "products/productcontroller.php");
$router->get("/products","products/detailproductcontroller.php");
$router->get("/cart","products/cartcontroller.php");
$router->get("/checkout", "checkout/checkout-controller.php");
$router->get("/transaction-return", "checkout/transaction-controller.php");
$router->get("/profile","profile/profile-controller.php");
$router->get("/admin","admin/dashboard-controller.php");
$router->get("/admin/product","admin/product-controller.php");
$router->get("/admin/product/create","admin/add-product-controller.php");
$router->get("/admin/user","admin/user-controller.php");
$router->get("/admin/order","admin/order-controller.php");
?>