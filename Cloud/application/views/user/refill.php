        <!-- page content -->
        <div class="right_col" role="main">
          <div class="" style="min-height: 620px;">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-cloud"> </i> REFILL</h3>
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
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tambah Saldo Anda</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-12">
                        <!-- price element -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="pricing">
                            <div class="title">
                              <h1><strong>100 K</strong></h1>
                            </div>
                            <div class="x_content">
                              <div class="pricing_footer">
                                <form role="form" action= "<?php  echo site_url('C_main/refill_100k');?>" method="post">
                                  <input type="submit" name="100k" value="Beli Sekarang!" class="btn btn-success btn-block">
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="pricing">
                            <div class="title">
                              <h1><strong>200 K</strong></h1>
                            </div>
                            <div class="x_content">
                              <div class="pricing_footer">
                                <form role="form" action= "<?php  echo site_url('C_main/refill_200k');?>" method="post">
                                  <input type="submit" name="200k" value="Beli Sekarang!" class="btn btn-success btn-block">
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="pricing">
                            <div class="title">
                              <h1><strong>300 K</strong></h1>
                            </div>
                            <div class="x_content">
                              <div class="pricing_footer">
                                <form role="form" action= "<?php  echo site_url('C_main/refill_300k');?>" method="post">
                                  <input type="submit" name="300k" value="Beli Sekarang!" class="btn btn-success btn-block">
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="pricing">
                            <div class="title">
                              <h1><strong>400 K</strong></h1>
                            </div>
                            <div class="x_content">
                              <div class="pricing_footer">
                                <form role="form" action= "<?php  echo site_url('C_main/refill_400k');?>" method="post">
                                  <input type="submit" name="400k" value="Beli Sekarang!" class="btn btn-success btn-block">
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
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