<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
  <?php require_once("application/views/templates/scripts.php"); ?>
</head>
<body>
  <?php require_once("application/views/templates/header.php"); ?>
  <div id="container">
    <div id="body">
      <div class="container">
        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
          <form action="<?=base_url('login/login')?>" method="post" style="width: 23rem;" class="container">
            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>
  
            <div class="form-floating mb-4">
              <input type="email" id="form-email" name="form-email"
                class="form-control <?= $this->session->flashdata('invalid_login') ? 'is-invalid' : '' ?>" placeholder="me@email.com" />
              <label class="form-label" for="form-email">Email address</label>
            </div>
            
            <div class="form-floating mb-4">
              <input type="password" id="form-password" name="form-password"
                class="form-control <?= $this->session->flashdata('invalid_login') ? 'is-invalid' : '' ?>" placeholder="password" />
              <label class="form-label" for="form-password">Password</label>
              
              <div class="invalid-feedback">
                Invalid email or password.
              </div>
            </div>
            
            <div class="pt-1 mb-4 container position-relative">
              <a href="<?= base_url("blog") ?>" class="link-primary position-absolute top-50 start-50 translate-middle">Enter as guest</a>
            </div>

            <div class="pt-1 mb-4 container">
              <button class="btn btn-info btn-lg btn-block container" type="submit">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <p class="footer"></p>
  </div>

</body>
</html>
