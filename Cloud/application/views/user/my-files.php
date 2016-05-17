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
                      
                      <?php 
                      
                      foreach ($files['Message'] as $key => $value) {
                        
                        foreach ($value as $anotherkey => $val  ) {
                          $a = $anotherkey;
                         }
                      }
                      ?>
                      
                      <?php for ($x=0;$x<=$a;$x++){ ?>
                        <tbody>
                     
                        <tr>
                          <td><?php echo $x+1; ?></td>
                          <td>
                            <a href="<?php echo base_url('assets'); ?>/gentelella/production/images/img.jpg"><?php print_r($files['Message']['filename'][$x]); ?></a>
                          </td>
                          <td>
                            <a href="<?php echo site_url('C_main/view/'.$files['Message']['object_name'][$x]); ?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                            <!-- <a href="http://localhost:8888/files/<?php echo $files['Message']['object_name'][$x]; ?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a> -->
                            <a href="<?php echo site_url('C_main/set_flag_share/'.$files['Message']['object_name'][$x]); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Share </a>
                            <a href="<?php echo site_url('C_main/delete/'.$files['Message']['object_name'][$x]); ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                          </td>
                        </tr>
                        <tr>
                      </tbody>
                      <?php }
                      ?>
                      

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