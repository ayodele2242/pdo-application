<?php 
include("header.php");
$uemail = $_GET['user'];
$profile = getUserProfile($uemail);
$amtInv = getAmtInvested($uemail);

if(!empty($profile['img'])){
$img  = $set['installUrl'].'assets/images/'.$profile['img'];
}else{
$img  = $set['installUrl'].'assets/logo/'.$set['logo'];
}

$sell = getDailyGrowth($uemail);
$chart_data="";
foreach($sell as $row){
   $productname[]  = $row['plan'];
   $rate[] = $row['daily_growth'];
}



$result = mysqli_query($mysqli,"SELECT sum(amount_invested) as capital, sum(Amt_to_get) as returns from plans WHERE transId !='' and email='$uemail'");
$count = mysqli_num_rows($result);
$response = array();
while($row = mysqli_fetch_array($result))
{
$response = array(
array("y" => $row["capital"], "legendText" => "Total Capital", "label" => "Total Capital"),
array("y" => $row["returns"], "legendText" => "Total Returns", "label" => "Total Returns")
);

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
										<h5 class="text-dark font-weight-bold my-1 mr-5"><i class="flaticon-user mr-2 text-info font-weight-bold"></i><?php echo $profile['name']; ?>'s Details</h5>
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
								
								<!--begin::Profile 4-->
								<div class="d-flex flex-row">
									<!--begin::Aside-->
									<div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
										<!--begin::Card-->
										<div class="card card-custom gutter-b">
											<!--begin::Body-->
											<div class="card-body pt-4">

												<!--begin::User-->
												<div class="d-flex align-items-center">
													<div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
														<div class="symbol-label" style="background-image:url('<?php echo $img; ?>')"></div>
														<i class="symbol-badge bg-success"></i>
													</div>
													<div>
														<a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?php echo $profile['name']; ?></a>
														<div class="text-muted text-info"> <?php echo $profile['phone']; ?></div>
														<div class="mt-2">
															<a href="#" class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">Chat</a>
															
														</div>
													</div>
												</div>
												<!--end::User-->
												<!--begin::Contact-->
												<div class="pt-8 pb-6">
													<div class="d-flex align-items-center justify-content-between mb-2">
														<span class="font-weight-bold mr-2">Email:</span>
														<a href="#" class="text-muted text-hover-primary"><?php echo $profile['email']; ?></a>
													</div>
													<div class="d-flex align-items-center justify-content-between mb-2">
														<span class="font-weight-bold mr-2">Phone:</span>
														<span class="text-muted"><?php echo $profile['phone']; ?></span>
													</div>
													<div class="d-flex align-items-center justify-content-between">
														<span class="font-weight-bold mr-2">Mode of Registration:</span>
														<span class="text-muted"><?php if($profile['platform'] == "From App"){ echo '<span class="label label-danger label-pill label-inline mr-2">App</span>'; }else{ '<span class="label label-info label-pill label-inline mr-2">'.ucwords($profile['platform']).'</span>'; } ?></span>
													</div>
												</div>
												<!--end::Contact-->
												
											</div>
											<!--end::Body-->
										</div>
										<!--end::Card-->
									
									</div>
									<!--end::Aside-->
									<!--begin::Content-->
									<div class="flex-row-fluid ml-lg-8">
										<!--begin::Row-->
										<div class="row">

											<div class="col-lg-6">
												<!--begin::Mixed Widget 5-->
												<div class="card card-custom bg-radial-gradient-primary card-stretch gutter-b">
													<!--begin::Header-->
													<div class="card-header border-0 py-5">
														<h3 class="card-title font-weight-bolder text-white">Investment Progress</h3>
														<div class="card-toolbar">


														</div>
													</div>
													<!--end::Header-->
													<!--begin::Body-->
													<div class="card-body d-flex flex-column p-0">
														<!--begin::Chart-->
														<div id="chartContainer" style="height: 200px"></div>
														<!--end::Chart-->
														<!--begin::Stats-->
														<div class="card-spacer bg-white card-rounded flex-grow-1">
															<!--begin::Row-->

															<div class="row m-0">
																<div class="col px-8 py-6 mr-8">
																	<div class="font-size-sm text-muted font-weight-bold">Total Amt. Invested</div>
																	<div class="font-size-h4 font-weight-bolder col-grey"><?php echo $left_currency. number_format($amtInv['totInvested']) .$right_currency; ?></div>
																</div>
																<div class="col px-8 py-6">
																	<div class="font-size-sm text-muted font-weight-bold">Total Expected Amt.</div>
																	<div class="font-size-h4 font-weight-bolder col-grey"><?php echo $left_currency. number_format($amtInv['totAmtToGet']) .$right_currency; ?></div>
																</div>
															</div>
															<!--end::Row-->
														
														</div>
														<!--end::Stats-->
													</div>
													<!--end::Body-->
												</div>
												<!--end::Mixed Widget 5-->
											</div>


											<div class="col-lg-6">
												<!--begin::List Widget 10-->
												<div class="card card-custom card-stretch gutter-b">
													<!--begin::Header-->
													<div class="card-header border-0">
														<h3 class="card-title font-weight-bolder text-dark">Savings/Loans Details</h3>
														<div class="card-toolbar">
															
														</div>
													</div>
													<!--end::Header-->
													<!--begin::Body-->
													<div class="card-body pt-0">
														
														<!--begin: Item-->
														<div class="">
															<!--begin::Content-->
															
															<!--end::Content-->
														</div>
														<!--end: Item-->
													</div>
													<!--end: Card Body-->
												</div>
												<!--end: Card-->
												<!--end: List Widget 10-->
											</div>
										</div>
										<!--end::Row-->
										<!--begin::Advance Table Widget 8-->
										<div class="card card-custom gutter-b">
											<!--begin::Header-->
											<div class="card-header border-0 py-5">
												<h3 class="card-title align-items-start flex-column">
													<span class="card-label font-weight-bolder text-dark">Plans Info.</span>
													</h3>
											
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="card-body pt-0 pb-3">
												<?php $invest = getUserInvestments($uemail); ?>
												<!--begin::Table-->
												<div class="table-responsive">

													<table class="table table_view table-vertical-center table-borderless">
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
															

														</thead>
														<tbody>
															<?php  
														       
														       foreach($invest as $rows){
														           
														           $sdate = $rows['created_date'];
														           $dt = new DateTime($sdate);
														           $start_date = $dt->format('Y-m-d');
														           
														           $end_date = $rows['exp_date'];
														           $dateDiff = dateDifference($start_date, $end_date); 
														        
														        
														        ?> 
														        <tr>
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
											              <td class="">
											             <span   class="label label-danger label-pill label-inline">Payment failed</span>
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
												<!--end::Table-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Advance Table Widget 8-->
									</div>
									<!--end::Content-->
								</div>
								<!--end::Profile 4-->


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

<script type="text/javascript">
$(function () {
    var chart = new CanvasJS.Chart("chartContainer", {
        theme: "light2",
        zoomEnabled: true,
        animationEnabled: true,
        title: {
            text: "Capital Invested and Returns"
        },
        data: [
        {
            type: "line",
            dataPoints: <?php echo json_encode($response, JSON_NUMERIC_CHECK); ?>
        }
        ]
    });
    chart.render();
});
</script>


<script type="text/javascript">
    $(function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            title: {
                text: "Total Capital/Returns Chart"
            },
            animationEnabled: true,
            legend: {
                verticalAlign: "center",
                horizontalAlign: "left",
                fontSize: 15,
                fontFamily: "Helvetica"
            },
            theme: "light1",
            data: [
            {
                type: "pie",
                indexLabelFontFamily: "Garamond",
                indexLabelFontSize: 20,
                indexLabel: " {label} ₦{y}",
                startAngle: -1,
                showInLegend: true,
                toolTipContent: "{legendText} ₦{y}",
                dataPoints: <?php echo json_encode($response); ?>
            }
            ]
        });
        chart.render();
    });
</script>