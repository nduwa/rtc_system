<?php
include "../includes/auto_load.req.php";
include "../includes/header.php";
include '../includes/menu.php';
#####################################################
$obj  = new Display();
$gps_data  = $obj->displayed_GPS_Farm();

?>
  <!-- =============================================== -->

    <!-- page content -->
    <div class="right_col" role="main">
           <div class="">
            <!-- top tiles -->
            <div class="row tile_count">

             </div>
             <!-- /top tiles -->
             <div class="clearfix"></div>

             <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="x_panel">
                    <div class="x_title">
                      <h2><i class="fa fa-bars"></i> list of distributed farmer trees</h2>
                      
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th>Station Name</th>
                            <th>Farmer Name</th>
                            <th>National ID</th>
                            <th>Farmer ID</th>
                            <th>GPS</th>
                            <th>Collector</th>
                            <th>Date</th>
                            <th>ACTION</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($gps_data as $row) {  
                            ?>
                            <tr>
                                <td><?php echo $row["CW_Name"]; ?></td>
                                <td><?php echo $row["farmer_name"]; ?></td>
                                <td><?php echo $row["national_ID"]; ?></td>
                                <td><?php echo $row["farmer_ID"]; ?></td>
                                <td><?php echo $row["farm_GPS"]; ?></td>
                                <td><?php echo $row["full_name"]; ?></td>
                                <td><?php echo $row["created_at"]; ?></td>
                                <td><a href="../router/action_page.php?remove_gps_data=<?php echo $row["id"]; ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                      </table>
                    </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
         <!-- /page content -->

       
         <?php include '../includes/footer.php'; ?>
