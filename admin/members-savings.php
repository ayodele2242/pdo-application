<?php 
include("header.php");
$status = FALSE;
if ( authorize($_SESSION["access"]["SAVINGS"]["MEMBERS SAVINGS"]["create"]) || 
authorize($_SESSION["access"]["SAVINGS"]["MEMBERS SAVINGS"]["edit"]) || 
authorize($_SESSION["access"]["SAVINGS"]["MEMBERS SAVINGS"]["view"]) || 
authorize($_SESSION["access"]["SAVINGS"]["MEMBERS SAVINGS"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}
?>


        <!--begin::Main-->

        <!--begin::Header Mobile-->
        <?php 
        include("mobile_header.php");
        ?>
        <!--end::Header Mobile-->

        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="d-flex flex-row flex-column-fluid page">

                <!--begin::Aside-->
               <?php 
                include("left_menu.php");
                ?>
                <!--end::Aside-->

                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                    <!--begin::Header-->
                    <?php include("bottom_header.php"); ?>
                    <!--end::Header-->






                    <!--begin::Content-->
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Subheader-->
                        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
                            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center flex-wrap mr-1">
                                    <!--begin::Page Heading-->
                                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                                        <!--begin::Page Title-->
                                        <h5 class="text-dark font-weight-bold my-1 mr-5">Members Savings</h5>
                                        <!--end::Page Title-->
                                        
                                    </div>
                                    <!--end::Page Heading-->
                                </div>
                                <!--end::Info-->
                                
                            </div>
                        </div>
                        <!--end::Subheader-->
                        <!--begin::Entry-->
                        <div class="d-flex flex-column-fluid">
                            <!--begin::Container-->
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">

                                        <table id="tableTrigger" class="table table_view ">
                                           <thead>
                                            
                                           
                                           <th>Name</th>
                                           <th>Email</th>
                                           <th>Phone</th>
                                           <th>Saving Name</th>
                                           <th>Total Amount Saved</th>
                                           
                                          
                                     
                                           </thead>
                                           <tbody class="refresh">
                                           <?php  
                                           $invest = getMemberSavings();
                                           foreach($invest as $rows){
                                            
                                            
                                            ?> 
                                            <tr class="animated fadeIn">
                                            <td><?php echo ucwords($rows['last_name'].' '.$rows['first_name']); ?></td>
                                            <td><?php echo $rows['email']; ?></td>
                                            <td><?php echo $rows['phone']; ?></td>
                                             <td><?php echo ucwords($rows['category']); ?></td>
                                            <td><?php echo number_format($rows['amount_saved'],2); ?></td>        
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                           </tbody>


                                         </table>       


                                </div>
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Entry-->
                    </div>
                    <!--end::Content-->
                    
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <!--end::Main-->


<?php include("footer.php"); ?>