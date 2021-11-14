<?php 
include("header.php");
$status = FALSE;
if ( authorize($_SESSION["access"]["INVESTORS"]["ALL INVESTORS"]["create"]) || 
authorize($_SESSION["access"]["INVESTORS"]["ALL INVESTORS"]["edit"]) || 
authorize($_SESSION["access"]["INVESTORS"]["ALL INVESTORS"]["view"]) || 
authorize($_SESSION["access"]["INVESTORS"]["ALL INVESTORS"]["delete"]) ) {
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
										<h5 class="text-dark font-weight-bold my-1 mr-5"><i class="menu-icon flaticon2-group mr-1"></i> Investors</h5>
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
								<table id="table" class="table table_view">
       <thead class="heading">
         <th></th>
      
       <th>Name</th>
       <th>Email</th>
       <th>Phone</th>
       <th>DoB</th>
       <th>Gender</th>
       <th>Account Name</th>
       <th>Account Number</th>
       <th>Bank</th>
       <th>Next of Kin's Name</th>
       <th>Next of Kin's Phone</th>
       <th>Next of Kin's Address</th>
       
 
       </thead>
       <tbody class="refresh">
       <?php  
       $investors = getInvestors();
       foreach($investors as $rows){
        
        if($rows['status'] == '1'){
        $esta = "checked";
         }else{
        $esta = "";
        }
        $bcode = $rows['bank_code']
        ?> 
        <tr class="animated fadeIn">
             <td class="tbtns d-flex">
           <?php if (authorize($_SESSION["access"]["INVESTORS"]["ALL INVESTORS"]["edit"])) { ?>

              <span class="switch switch-sm switch-outline switch-icon switch-success">
                <label>
                 <input type="checkbox"  <?php echo $esta; ?> class="invDetails" name="select" id="<?php echo $rows['id']; ?>" value="<?php echo $rows['id']; ?>"/>
                 <span></span>
                </label>
               </span> 


               <a href="member-details?user=<?php echo $rows['email']; ?>" class="btn btn-icon btn-sm btn-circle btn-info mr-2 ml-1" data-placement="left" title="" data-original-title="<?php echo ucwords($rows['name']); ?> Info" data-toggle="tooltip">
            <i class="flaticon2-search-1 col-white"></i>
        </a>
          <?php 
               
           } 



          if (authorize($_SESSION["access"]["INVESTORS"]["ALL INVESTORS"]["delete"])) { ?>
            <a href="#" type="button" data-toggle="modal" data-target="#deleteModal" id="<?php echo $rows['id']; ?>"  data-name="<?php echo ucwords($rows['name']); ?>" class="btn btn-icon btn-sm btn-circle btn-danger delUser" data-placement="left" title="" data-original-title="Delete" data-toggle="tooltip">
            <i class="flaticon2-rubbish-bin-delete-button col-white"></i>
        </a>
      <?php } ?>
        </td>
        <td><?php echo ucwords($rows['name']); ?></td>
        <td><?php echo ucwords($rows['email']); ?></td>
         <td><?php echo $rows['phone']; ?></td>
        <td><?php echo $rows['dob']; ?></td>
        <td><?php echo $rows['gender']; ?></td>
        <td><?php echo $rows['account_name']; ?></td>
         <td><?php echo $rows['account_number']; ?></td>
          <td><?php echo getBankName($bcode); ?></td>
          <td><?php echo $rows['kin_name']; ?></td>
          <td><?php echo $rows['kin_phone']; ?></td>
          <td><?php echo $rows['kin_address']; ?></td>
       

      
        
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


<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title warning-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body delete-msg">
               
            </div>
            <div class="modal-footer">
            	<input type="hidden" id="adminId" value="" />
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger del-btn font-weight-bold delAdmin" >Yes, delete</button>
            </div>
        </div>
    </div>
</div>



<?php include("footer.php"); ?>


<script>
 //Delete User from users' list
 $(document).ready(function(){

 	    $(".delUser").click(function() {
     var pid = $(this).attr('id'); 
     var name = $(this).attr('data-name'); 

     $("#adminId").val(pid);

     $(".warning-title").html('<i class="flaticon2-warning text-danger"></i> Delete Warning').addClass("text-danger");
     $(".delete-msg").html('<p>You are about to delete <b class="text-info">' +name+ '\'s</b> account informations.<p><p>Please note that every informations about this user will all be deleted and there is no redo after deletion.</p>  ');

    });


    $(".delUsers").click(function() {
     var pid = $(this).attr('id'); // get id of clicked row  
     var name = $(this).attr('data-name');

     
     if (confirm("Are you sure you want to delete for "+name+"? There is no undo.")) {
     $.post("../inc/user/deleteInvestor.php", {"id": pid, }, 
    function(data) {
        if(data == 1){
             M.toast({html: "Investor Account Delected"});
             location.reload();
            // $(".refresh").load(location.href + ".refresh");
            //alert(data);
        }else{
            M.toast({html: data});
            //alert(data);
        }
        
    });
    }

    });
  });

   //Delete User from users' list
 $(document).ready(function(){
    $(".delAdmin").click(function() {
     var pid = $("#adminId").val();
     $.post("../inc/user/deleteInvestor.php", {"id": pid, }, 
    function(data) {
        if(data == 1){
             
             Swal.fire({
	                text: "Investor Account Delected",
	                icon: "success",
	                customClass: {
						confirmButton: "btn font-weight-bold btn-light-success"
					}
	            });

             location.reload();
             
             $('#deleteModal').modal('toggle');
            
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
               Swal.fire({
                    text: "User Account Activated",
                    icon: "success",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-success"
                    }
                });
        }else if(data == 0){
            Swal.fire({
                    text: "User Account De-activated",
                    icon: "warning",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-warning"
                    }
                });
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
    });

});
</script>