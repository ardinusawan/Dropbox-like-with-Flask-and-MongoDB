<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SARANG SHARING | DASHBOARD</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets'); ?>/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets'); ?>/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets'); ?>/gentelella/production/css/custom.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-share-alt"></i> <span>Sarang Sharing</span></a>
            </div>
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="<?php echo base_url('assets'); ?>/gentelella/production/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome!</span>
                <h2>Wicak</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>-</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home </a></li>
                  <li class="current-page"><a href=""><i class="fa fa-folder"></i> My Files </a></li>
                  <li><a><i class="fa fa-upload"></i> Upload Files </a></li>
                  <li><a><i class="fa fa-share-alt"></i> Sharing Files </a></li>
                  <li><a><i class="fa fa-refresh"></i> Refill </a></li>
                  <li><a><i class="fa fa-cog"></i> Settings </a></li>                  
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url('assets'); ?>/gentelella/production/images/img.jpg" alt="">Wicak 
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li>
                      <a href="C_login/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="" style="min-height: 620px;">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-cloud"></i></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Go!</button>
                          </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>My Files</h2>
                    <div class="clearfix"></div>
                    <div class="x_content">
                      <br />
                      <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 70%">File name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>#</td>
                          <td>
                            <a href="<?php echo base_url('assets'); ?>/gentelella/production/images/img.jpg">Fileapa.jpg</a>
                          </td>
                          <td>
                            <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                            <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Share </a>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                          </td>
                        </tr>
                        <tr>
                          <td>#</td>
                          <td>
                            <a href="<?php echo base_url('assets'); ?>/gentelella/production/images/img.jpg">Fileapa.jpg</a>
                          </td>
                          <td>
                            <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                            <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Share </a>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Shared Files</h2>
                    <div class="clearfix"></div>
                    <div class="x_content">
                      <br />
                      <table class="table table-hover">
                      <thead>
                        <tr>
                          <th style="width: 70%">File name</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <a href="<?php echo base_url('assets'); ?>/gentelella/production/images/img.jpg">Fileapa.jpg</a>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <a href="<?php echo base_url('assets'); ?>/gentelella/production/images/img.jpg">Fileapa.jpg</a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Komputasi Awan 2016 <a href="">Sarang Sharing</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/vendors/nprogress/nprogress.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('assets'); ?>/gentelella/production/js/custom.js"></script>
  </body>
</html>