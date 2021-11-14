<?php 
include("header.php");
$status = FALSE;
if ( authorize($_SESSION["access"]["INVESTORS"]["FAILED TRANSACTIONS"]["create"]) || 
authorize($_SESSION["access"]["INVESTORS"]["FAILED TRANSACTIONS"]["edit"]) || 
authorize($_SESSION["access"]["INVESTORS"]["FAILED TRANSACTIONS"]["view"]) || 
authorize($_SESSION["access"]["INVESTORS"]["FAILED TRANSACTIONS"]["delete"]) ) {
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
										<h5 class="text-dark font-weight-bold my-1 mr-5">Failed Transactions</h5>
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
        <th></th>
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
       <th>Daily Growth</th>
       </thead>
       <tbody class="refresh">
       <?php  
       $invest = failedInvestments();
       foreach($invest as $rows){
        
        
        ?> 
        <tr class="animated fadeIn">
          <!--<td class="text-center">
            <label>
              <input type="checkbox" class="name" name="user_email" value="<?php //echo $rows['email']; ?>"/>
               <span></span>
            </label>
          </td>-->
          <td>
            <?php
            if($rows['status'] == 'payment_failed' OR $rows['status'] == 'active' AND $rows['trasaction_status'] !='successful' ){
            ?>
            <button id="<?php echo $rows['id']; ?>" class="btn btn-icon btn-circle btn-danger btn-floating delUser waves-effect waves-light red z-depth-4 btn-small" type="button" title="Delete"><i class="flaticon2-rubbish-bin-delete-button col-white"></i></button>

             <a href="#" data-toggle="modal" data-target="#userModal" data-id="<?php echo $rows['id']; ?>" id="<?php echo $rows['id']; ?>" class="btn btn-icon btn-circle btn-info btn-floating waves-effect waves-light orange z-depth-3 btn-small modal-trigger usermodal" type="button" title="Edit"><i class="flaticon2-edit col-white"></i></a>
       
            <?php }else{ ?>
             <button id="<?php echo $rows['id']; ?>" class="btn btn-icon btn-circle btn-danger btn-floating waves-effect waves-light grey lighten-3 z-depth-2 btn-small" type="button" title="Delete"><i class="flaticon2-rubbish-bin-delete-button col-white"></i></button>
            
           <?php } ?>
            
        </td>
      

          
          <?php 
          if($rows['status'] == 'active' && $rows['transId'] != ''){  ?>
          <td class="bg-green green lighten-5 green-text">
            <span >Active</span>
         </td>    
          <?php }else if($rows['status'] === 'waiting_withdrawal'){ ?>
          <td class="bg-oranger yellow lighten-2 col-orange">
            <span >Awaiting Payment</span>
            </td>
          <?php }else if($rows['status'] == 'inactive' && $rows['payment_status'] == 'paid' ){ ?>
          <td class="green darken-4 white-text">
            <span >Paid Out</span>
            </td>
          <?php
            }else{
              ?>
              <td class="">
              	<span class="label label-danger label-pill label-inline mr-2">Payment failed</span>
             
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




<div class="modal fade" id="userModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title title-name" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" id="contents">
             <div id="modal-loader" style="display: none; text-align: center;">
	           <div class="spinner spinner-primary spinner-lg mr-15"></div>
           </div>

            </div>
        
        </div>
    </div>
</div>


<?php include("footer.php"); ?>


<script>



//Get user's details and update data
$(document).ready(function(){
    $(".usermodal").click(function() {
     
     var pid = $(this).attr('id'); // get id of clicked row
     $('#contents').html(''); // leave this div blank
     //$('#user-modal').show();      // load ajax loader on button click
   
     $.ajax({
          url: '../inc/user/getFailedTransactions.php',
          type: 'POST',
          data: 'uid='+pid,
          dataType: 'html'
     })
     .done(function(data){
          console.log(pid); 
          $('#contents').html(data); // load here
          //$('#modal-loader').hide(); // hide loader  
           //$('#user-modal').show();
     })
     .fail(function(){
          $('contents').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          $('#modal-loader').hide();
     });

    });

});





 //Delete User from users' list
 $(document).ready(function(){
    $(".delUser").click(function() {
     var pid = $(this).attr('id'); // get id of clicked row  
     var name = $(this).attr('data-name');

     
     if (confirm("Are you sure you want to delete? There is no undo.")) {
     $.post("../inc/user/deleteInvestment.php", {"id": pid, }, 
    function(data) {
        if(data == 1){
             Swal.fire({
	                text: "Investment Delected",
	                icon: "success",
	                customClass: {
						confirmButton: "btn font-weight-bold btn-light-success"
					}
	            });
             location.reload();
            
        }else{
            Swal.fire({
					text: data,
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-danger"
					}
				});
        }
        
    });
    }

    });
  });
</script>

<script type="text/javascript">
  
$(document).ready(function(){
   //User's account status update
      $('.invDetails').on('click', function() {
       
      var checkStatus = this.checked ? 1 : 0;
      var id = $(this).attr('id');
     
    $.post("../inc/members/investor_status_updates.php", {"id": id, "sta":checkStatus, }, 
    function(data) {
        if(data == 1){
           // $('#email_status').prop( "checked", true );
             M.toast({html: "User Account Activated", classes: 'alert-success'});
            //alert(data);
        }else if(data == 0){
            //$('#email_status').prop( "checked", false );
             M.toast({html: "User Account Deactivated", classes: 'alert-warning'});
        }else{
            M.toast({html: data, classes: 'alert-danger'});
            //alert(data);
        }
        
    });
    });

});









</script>