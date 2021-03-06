<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SARANG SHARING! | DAFTAR</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets'); ?>/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets'); ?>/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets'); ?>/gentelella/production/css/custom.css" rel="stylesheet">
  </head>

   <body style="background:#F7F7F7;">
    <div class="">
      <a class="hiddenanchor" id="toregister"></a>
      <a class="hiddenanchor" id="tologin"></a>

      <div id="wrapper">
        <div id="login" class=" form">
          <section class="login_content">
            <form role="form" action="<?php  echo site_url('C_register/daftar_post');?>" method="post">
              <h1>Pendaftaran</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="username_post" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password_post" required="" />
              </div>
              <div style="float: right; ">
                <!-- <a class="btn btn-default submit">Log in</a> -->
                <input type="submit" value="Daftar" ></input> 
              </div>
              <div class="clearfix"></div>
              <div id="separat" class="separator">
                <p class="change_link">Sudah memiliki akun?
                  <a href="<?php echo site_url('C_login'); ?>" class="to_register"> Log In </a>
                </p>
                <div class="clearfix"></div>
                <br />
                <div>
                  <h1> Sarang Sharing <i class="fa fa-share-alt" style="font-size: 26px;"></i></h1>
                  <h2><?php echo $data['register']; ?></h2>
                  <p>©2016 All Rights Reserved. | Cloud Computing Final Project</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>