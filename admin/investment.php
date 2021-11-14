<?php 
include("header.php");
$status = FALSE;
if ( authorize($_SESSION["access"]["INVESTORS"]["ALL INVESTMENT"]["create"]) || 
authorize($_SESSION["access"]["INVESTORS"]["ALL INVESTMENT"]["edit"]) || 
authorize($_SESSION["access"]["INVESTORS"]["ALL INVESTMENT"]["view"]) || 
authorize($_SESSION["access"]["INVESTORS"]["ALL INVESTMENT"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You do not have the permission to access this page");
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
										<h5 class="text-dark font-weight-bold my-1 mr-5">Active Investment</h5>
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
								 <table id="tableTrigger" class="table table_view ">
       <thead class="heading">
        
        <th>Status</th>
       <th>Name</th>
       <th>Email</th>
       <th>Phone</th>
       <th>Plan</th>
       <th>Duration</th>
       <th>Amt Invested</th>
       <th>Interest Rate</th>
       <th>Expected Amt</th>
       <th>Expected Int</th>
       <th>Payment Trans #ID</th>
       <th>Daily Growth On Total Investment</th>
        <th>Daily Growth Interest Rate</th>
       <th>Date Invested</th>
       <th>Mature Date</th>
       <!--<th>Mature in Day(s)</th>-->
       </thead>
       <tbody class="refresh">
       <?php  
       $invest = getInvestments();
       foreach($invest as $rows){
           
           $sdate = $rows['created_date'];
           $dt = new DateTime($sdate);
           $start_date = $dt->format('Y-m-d');
           
           $end_date = $rows['exp_date'];
           $dateDiff = dateDifference($start_date, $end_date); 
        
        
        ?> 
        <tr class="animated fadeIn">
          
          <!--<td>
            <?php
            if($rows['status'] == 'payment_failed' OR $rows['status'] == 'active' AND $rows['trasaction_status'] !='successful' ){
            ?>
            <button id="<?php echo $rows['id']; ?>" class="btn btn-floating delUser waves-effect waves-light red z-depth-4 btn-small" type="button" title="Delete"><i class="material-icons left">delete</i></button>
            
            <?php }else{ ?>
             <button id="<?php echo $rows['id']; ?>" class="btn btn-floating waves-effect waves-light grey lighten-3 z-depth-2 btn-small" type="button" title="Delete"><i class="material-icons left">delete</i></button>
            
           <?php } ?>
            
        </td>-->
      

          
          <?php 
          if($rows['status'] == 'active' && $rows['transId'] != ''){  ?>
          <td class="">
            <span class="label label-dot label-success mr-1"></span> <span class="label label-success label-pill label-inline mr-2">Active</span>
         </td>    
          <?php }else if($rows['status'] === 'waiting_withdrawal'){ ?>
          <td class="">
          	<span class="label label-warning label-pill label-inline mr-2">Awaiting Payment</span>
            </td>
          <?php }else if($rows['status'] == 'paidout' && $rows['payment_status'] == 'paid' ){ ?>
          <td class="">
          	<span class="label label-dark label-pill label-inline mr-2"><i class="flaticon2-check-mark col-white mr-2"> Paid Out</span>
            
            </td>
          <?php
            }else{
              ?>
              <td class="red darken-1 white-text">
             <span  >Payment failed</span>
              </td>
              <?php
            }
          ?>
       



        <td><?php echo ucwords($rows['name']); ?></td>
        <td><?php echo $rows['email']; ?></td>
        <td><?php echo $rows['phone']; ?></td>
         <td><?php echo ucwords($rows['plan']); ?></td>
        <td><?php echo $rows['duration']; ?></td>
        <td><?php echo number_format($rows['amount_invested'],2); ?></td>
        <td><?php echo $rows['interest']; ?></td>
        <td><?php echo number_format($rows['Amt_to_get'],2); ?></td>
        <td><?php echo number_format($rows['totInterest']); ?></td>
        <td><?php echo $rows['transId']; ?></td>
        <td><?php echo $rows['daily_growth']; ?></td>
        <td><?php echo round($rows['totInterest']/$dateDiff); ?></td>
        <td><?php echo $rows['created_date']; ?></td>
        <td><?php echo $rows['exp_date']; ?></td>
        <!--<td><?php //echo get_timeago($rows['exp_date']); ?></td>-->
        </tr>
        <?php
        }
        ?>
       </tbody>


     </table>  
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