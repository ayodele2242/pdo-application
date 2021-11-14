<?php 
include("header.php");
$status = FALSE;
if ( authorize($_SESSION["access"]["USER"]["ALL USERS"]["create"]) || 
authorize($_SESSION["access"]["USER"]["ALL USERS"]["edit"]) || 
authorize($_SESSION["access"]["USER"]["ALL USERS"]["view"]) || 
authorize($_SESSION["access"]["USER"]["ALL USERS"]["delete"]) ) {
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
										<h5 class="text-dark font-weight-bold my-1 mr-5"><i class="menu-icon fas fa-users"></i> Admin Users</h5>
										<!--end::Page Title-->
										
									</div>
									<!--end::Page Heading-->

								</div>
								<!--end::Info-->
								
							</div>
						</div>
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid refresh">
							<!--begin::Container-->
							<div class="container users-boxs ">

								<!--begin::Row-->
								<div class="row">
									<?php  
									$users = getUsers();
							       $i = 1;
							       foreach($users as $rows){
							        $string = $rows['Name'];
							        if($rows['status'] == '1'){
							        $esta = "checked";
							         }else{
							        $esta = "";
							        }
							        ?> 
									
									<!--end::Col-->
									<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
										<div class="card card-custom gutter-b card-stretch">
											<div class="card-body relative pt-4">

												<!--begin::Toolbar-->
												<div class="d-flex justify-content-end">
													<div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
														<a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<i class="ki ki-bold-more-hor"></i>
														</a>
														<div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
															<!--begin::Navigation-->
															<ul class="navi navi-hover">
																
																<li class="navi-header font-weight-bold py-4">
																	<span class="font-size-lg">Choose Action: </span>
																	<i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="" data-original-title="You can edit or delete this user from here"></i>
																</li>

																
																<li class="navi-separator mb-3 opacity-70"></li>
																<?php if (authorize($_SESSION["access"]["USER"]["ALL USERS"]["edit"])) { 
																?>
																<li class="navi-item">
																	<a href="#" data-toggle="modal" data-target="#userModal" data-id="<?php echo $rows['u_userid']; ?>" id="<?php echo $rows['u_userid']; ?>" data-name="<?php echo ucwords($rows['Name']); ?>" type="button" class="navi-link font-weight-bold usermodal" data-placement="left" title="" data-original-title="Edit user details" data-toggle="tooltip">
																		<span class="navi-text">

																			<span class="label label-xl label-inline label-light-warning"><i class="fas fa-edit icon-md text-muted mr-2 col-orange"></i> Edit info.</span>
																		</span>
																	</a>
																</li>
																<?php 
																}  
																if (authorize($_SESSION["access"]["USER"]["ALL USERS"]["delete"])) { 
																?>

																<li class="navi-item">
																	<a href="#" data-toggle="modal" data-target="#deleteModal" id="<?php echo $rows['u_rolecode']; ?>"  data-name="<?php echo ucwords($rows['Name']); ?>" class="navi-link delUser" data-placement="left" title="" data-original-title="Delete" data-toggle="tooltip">
																		<span class="navi-text">
																			<span class="label label-xl label-inline label-light-danger"><i class="fas fa-trash icon-md text-muted mr-2 col-red"></i> Delete User</span>
																		</span>
																	</a>
																</li>
																<?php
														        }
														        ?>
																
																
															</ul>
															<!--end::Navigation-->
														</div>
													</div>
												</div>
												<!--end::Toolbar-->
												<!--begin::User-->
												<div class="d-flex align-items-center mb-7">
													<!--begin::Pic-->
													<div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
														<div class="symbol symbol-circle symbol-lg-75 d-none">
															<img src="<?php echo $web['installUrl']; ?>assets/logo/<?php echo $web['logo']; ?>" alt="image">
														</div>
														<div class="symbol symbol-lg-75 symbol-circle symbol-success <?php echo $string[0]; ?>">
															<span class="symbol-label font-size-h3 font-weight-boldest"><?php echo initials($rows['Name']);  ?></span>
														</div>
													</div>
													<!--end::Pic-->
													<!--begin::Title-->
													<div class="d-flex flex-column">
														<a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0"><?php echo ucwords($rows['Name']); ?></a>
														<span class="text-muted font-weight-bold"><?php echo $rows['u_username']; ?></span>
													</div>
													<!--end::Title-->
												</div>
												<!--end::User-->
												<div class="mb-7">
														<div class="d-flex justify-content-between align-items-center">
														<span class="text-dark-75 font-weight-bolder mr-2">Email:</span>
														<a href="#" class="text-muted text-hover-primary"><?php echo ucwords($rows['email']); ?></a>
													</div>
													<div class="d-flex justify-content-between align-items-cente my-1">
														<span class="text-dark-75 font-weight-bolder mr-2">Phone:</span>
														<a href="#" class="text-muted text-hover-primary"><?php echo $rows['phone']; ?></a>
													</div>
													 <?php if (authorize($_SESSION["access"]["USER"]["ALL USERS"]["edit"])) { ?>
													<div class="d-flex justify-content-between align-items-center">
														<span class="text-dark-75 font-weight-bolder mr-2">Account Status: </span>
														<span class="text-muted font-weight-bold"> 
															<div class="col-3">
													   <span class="switch switch-sm switch-outline switch-icon switch-success">
													    <label>
													     <input type="checkbox"  <?php echo $esta; ?> class="ustaDetails" name="select" id="<?php echo $rows['u_userid']; ?>" value="<?php echo $rows['u_userid']; ?>"/>
													     <span></span>
													    </label>
													   </span> 
													  </div>

													 </div>

													  <?php $i++; } ?>



												</div>	
												<a href="#" data-toggle="modal" data-target="#msgModal" data-id="<?php echo $rows['u_userid']; ?>" id="<?php echo $rows['u_userid']; ?>" data-name="<?php echo ucwords($rows['Name']); ?>" data-sender="<?php echo $_SESSION['name']; ?>" data-senderId ="<?php echo $_SESSION['uid']; ?>" data-senderUsername="<?php echo $_SESSION['uname']; ?>" type="button" class="btn btn-block btn-sm bg-default font-weight-bolder text-uppercase py-4 msgBtn col-white"><i class="flaticon-speech-bubble-1 col-white mr-1"></i> Send message </a>

											 <div class="iStatus hide processing-<?php echo $rows['u_userid']; ?>" >
											  <div class="spinner spinner-primary spinner-lg mr-15"></div>
										    </div>




											</div>
										</div>		

									</div>

									 <?php
								        }
								      ?>


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

<div class="modal fade" id="userModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
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
            <!--<div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold">Save changes</button>
            </div>-->
        </div>
    </div>
</div>


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


<div class="modal fade" id="msgModal" tabindex="-1" role="dialog" aria-labelledby="msgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title warning-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="msgform" id="msgform">
            <div class="modal-body">

            	
				 <div class="card-body">
				  <div class="form-group">
				   <label>Receiver:</label>
				   <input type="text" name="to" id="to" class="form-control form-control-solid" placeholder="" readonly="" />
				   
				  </div>
				   <div class="form-group row">
				    <label >Start typing...</label>
				    <div class="col-lg-12">
				     <textarea class="summernote" name="message" id="kt_summernote_1"></textarea>
				    </div>
				   </div>
				  

				 </div>
				
				

               
            </div>
            <div class="modal-footer">
            	<input type="hidden" id="reciverId" name="reciverid" value="" />
            	<input type="hidden" id="sendername" name="sendername" value="" />
            	<input type="hidden" id="senderusername" name="senderusername" value="" />

                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm bg-default font-weight-bold sendMe col-white" >Send <i class="flaticon2-send-1 col-white ml-1"></i></button>
            </div>
            </form>
        </div>
    </div>
</div>
	


<?php include("footer.php"); ?>

<script type="text/javascript">



	
//Get user's details and update data
$(document).ready(function(){

    $(".usermodal").click(function() {
     
     var pid = $(this).attr('id'); // get id of clicked row
     var name = $(this).attr('data-name'); 
     $('#contents').html(''); // leave this div blank
     //$('#user-modal').show();      // load ajax loader on button click

      
     $('.title-name').html(name); 

     
   
     $.ajax({
          url: '../inc/user/getUser.php',
          type: 'POST',
          data: 'uid='+pid,
          dataType: 'html'
     })
     .done(function(data){
          //console.log(pid); 
          $('#contents').html(data); // load here
          $('#modal-loader').hide(); // hide loader  
           $('#user-modal').show();
     })
     .fail(function(){
          $('#contents').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          $('#modal-loader').hide();
     });

    });

});

$(document).ready(function(){
        //User's account status update
      $('.ustaDetails').on('click', function() {
          
      var checkStatus = this.checked ? 1 : 0;
      var id = $(this).attr('id');
      $(".processing-"+id).removeClass('hide').addClass('display');
     
    $.post("../inc/user/user_status_updates.php", {"id": id, "sta":checkStatus, }, 
    function(data) {
        if(data == 1){
           
             Swal.fire({
	                text: "User Account Activated",
	                icon: "success",
	                customClass: {
						confirmButton: "btn font-weight-bold btn-light-success"
					}
	            });

             $(".processing-"+id).removeClass('display').addClass('hide');
            //alert(data);
        }else if(data == 0){
              Swal.fire({
	                text: "User Account De-activated",
	                icon: "warning",
	                customClass: {
						confirmButton: "btn font-weight-bold btn-light-warning"
					}
	            });

             $(".processing-"+id).removeClass('display').addClass('hide');
        }else{
           
            $(".processing-"+id).removeClass('display').addClass('hide');
            Swal.fire({
					text: data,
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-danger"
					}
				});
            //alert(data);
        }
        
    });
    });
});



 $(document).ready(function(){
 	
    $(".delUser").click(function() {
     var pid = $(this).attr('id'); 
     var name = $(this).attr('data-name'); 

     $("#adminId").val(pid);

     $(".warning-title").html('<i class="fa fa-exclamation-triangle text-danger"></i> Delete Warning').addClass("text-danger");
     $(".delete-msg").html('<p>You are about to delete <b class="text-info">' +name+ '</b> account informations.<p><p>Please note that every informations(personal info, menus assigned) will all be deleted and there is no redo after deletion.</p>  ');

    });


 $(".msgBtn").click(function() {

  $receiverId = $(this).attr('data-id');
  $receiverName = $(this).attr('data-name');
  $sendername = $(this).attr('data-sender');
  $enderUsername = $(this).attr('data-senderUsername');
 
  $("#to").val($receiverName);
  $("#reciverId").val($receiverId);
  $("#sendername").val($sendername);
  $("#senderusername").val($enderUsername);
 });

 $(".sendMe").click(function() {

$(".sendMe").html('Please wait <div class="spinner spinner-warning ml-15"></div>')

  var msg = $("#kt_summernote_1").val();
  if(msg == ""){
  	 Swal.fire({
					text: "Please enter your message",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-danger"
					}
				});

  	 $(".sendMe").html('Send <i class="flaticon2-send-1 col-white ml-1"></i>');

  }else{
  	//var data = new FormData($('#msgform')[0]);

  	$.ajax({
            method: 'POST',
            url: '../inc/messenge/send.php',
            data: new FormData($('#msgform')[0]),
            contentType: false,
            cache: false,
            processData: false,
           success :  function(data) {
                if(data == 'done'){
                	$(".sendMe").html('Send <i class="flaticon2-send-1 col-white ml-1"></i>');
                //$('#kt_summernote_1').code('');
                $("#kt_summernote_1").summernote('code', '');
                 Swal.fire({
					text: "Message sent",
					icon: "success",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-success"
					}
				});
            }else{
            	$(".sendMe").html('Send <i class="flaticon2-send-1 col-white ml-1"></i>');
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


            }
        });

  }


 });

  });



  //Delete User from users' list
 $(document).ready(function(){
    $(".delAdmin").click(function() {
     var pid = $("#adminId").val();
     $.post("../inc/user/deleteUser.php", {"id": pid, }, 
    function(data) {
        if(data == 1){
             
             Swal.fire({
	                text: "User Account Deleted",
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
