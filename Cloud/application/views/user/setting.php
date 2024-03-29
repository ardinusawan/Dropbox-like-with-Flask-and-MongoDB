        <!-- page content -->
        <div class="right_col" role="main">
          <div class="" style="min-height: 620px;">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-cloud"></i> SETTINGS</h3>
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
                <div class="row top_tiles">
                  <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-database"></i>
                      </div>
                      <div class="count"><?php $MB = $setting['size']; echo $MB; ?><span> MB</span></div>

                      <h3>Data Usage</h3>
                      <p>Banyaknya space yang telah Anda digunakan</p>
                    </div>
                  </div>
                  <div class="animated flipInY col-lg-5 col-md-5 col-sm-4 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-dollar"></i>
                      </div>
                      <div class="count"><span>Rp </span><?php echo $setting['money_user']; ?><span>,00</span></div>
                      <h3>User's Saldo</h3>
                      <p>Jumlah uang yang Anda miliki</p>
                    </div>
                  </div>
                  <div class="animated flipInY col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="tile-stats">
                      <div class="count"><?php echo $setting['limit_user']/1000000; ?><span> MB</span></div>
                      <h3>Data Limit</h3>
                      <p>Batasan Data</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tambah Data Limit</h2>
                    <div class="clearfix"></div>
                  </div>
            
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-12">
                        <!-- price element -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="pricing">
                            <div class="title">
                              <h1><strong>1 MB</strong></h1>
                              <h2>Rp 10.000,00</h2>
                            </div>
                            <div class="x_content">
                              <div class="pricing_footer">
                              <form role="form" action= "<?php  echo site_url('C_main/add_limit10k');?>" method="post">
                              <input type="submit" name="1 MB = 10K" value="Beli Sekarang!" class="btn btn-success btn-block">
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                    
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="pricing">
                            <div class="title">
                              <h1><strong>5 MB</strong></h1>
                              <h2>Rp 50.000,00</h2>
                            </div>
                            <div class="x_content">
                              <div class="pricing_footer">
                              <form role="form" action= "<?php  echo site_url('C_main/add_limit50k');?>" method="post">
                              <input type="submit" name="5 MB = 50K" value="Beli Sekarang!" class="btn btn-success btn-block">
                                
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="pricing">
                            <div class="title">
                              <h1><strong>10 MB</strong></h1>
                              <h2>Rp 100.000,00</h2>
                            </div>
                            <div class="x_content">
                              <div class="pricing_footer">
                              <form role="form" action= "<?php  echo site_url('C_main/add_limit100k');?>" method="post">
                              <input type="submit" name="10 MB = 100K" value="Beli Sekarang!" class="btn btn-success btn-block">
                                
                                </form>
                                
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="pricing">
                            <div class="title">
                              <h1><strong>15 MB</strong></h1>
                              <h2>Rp 150.000,00</h2>
                            </div>
                            <div class="x_content">
                              <div class="pricing_footer">
                                <form role="form" action= "<?php  echo site_url('C_main/add_limit150k');?>" method="post">
                              <input type="submit" name="15 MB = 150K" value="Beli Sekarang!" class="btn btn-success btn-block">
                                
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        </form>
                        <!-- price element -->
                      </div>
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