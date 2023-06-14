<?php
include "../includes/auto_load.req.php";
include "../includes/header.php";
include '../includes/menu.php';
#####################################################
$obj  = new Display();
$module_data  = $obj->displayWeeklyReport();

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
                      <h2><i class="fa fa-bars"></i> List of RTC Stations</h2>
                      
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th>Station Name</th>
                            <th>User ID</th>
                            <th>Field Officer</th>
                            <th>Group Trained</th>
                            <th>Men Attended</th>
                            <th>Women Attended</th>
                            <th>Group Planned to Train</th>
                            <th>Farms Inspected</th>
                            <th>Farms Planned to Inspect</th>
                            <th>Other Activities and Comments</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($module_data as $row) {  
                            ?>
                            <tr>
                                <td><?php echo $row["CW_Name"]; ?></td>
                                <td><?php echo $row["user_code"]; ?></td>
                                <td><?php echo $row["full_name"]; ?></td>
                                <td><?php echo $row["trained_number"]; ?></td>
                                <td><?php echo $row["men_attended"]; ?></td>
                                <td><?php echo $row["women_attended"]; ?></td>
                                <td><?php echo $row["planned_groups"]; ?></td>
                                <td><?php echo $row["farm_inspected"]; ?></td>
                                <td><?php echo $row["planned_inspected"]; ?></td>
                                <td><?php echo $row["comments"]; ?></td>
                                <td><?php echo $row["createdAt"]; ?></td>
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
