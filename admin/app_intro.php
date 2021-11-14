<?php 
include("header.php");
$status = FALSE;
if ( authorize($_SESSION["access"]["SETTINGS"]["APP INTRO"]["create"]) || 
authorize($_SESSION["access"]["SETTINGS"]["APP INTRO"]["edit"]) || 
authorize($_SESSION["access"]["SETTINGS"]["APP INTRO"]["view"]) || 
authorize($_SESSION["access"]["SETTINGS"]["APP INTRO"]["delete"]) ) {
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
                                        <h5 class="text-dark font-weight-bold my-1 mr-5"><i class="menu-icon flaticon2-protection mr-1"></i> APP INTRO</h5>
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

                                 <div class="col-lg-4 col-sm-12">

                <form autocomplete="off" id="introAppForm" class="">

                 <div class="form-group mb-2">
                    <label>App Intro Icon/Image</label>
                    <div align="center">
                    
                    <div class="image-input image-input-outline" id="kt_image_1">
                     <div class="image-input-wrapper" style="background-image: url(<?php echo $set['installUrl'].'assets/logo/'. $set['logo']; ?>)"></div>

                     <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Upload Image/Video">
                      <i class="fa fa-pen icon-sm text-muted"></i>
                      <input type="file" name="image" accept=".png, .jpg, .jpeg, .mp4"/>
                      <input type="hidden" name="profile_avatar_remove"/>
                     </label>

                     <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Remove Image">
                      <i class="ki ki-bold-close icon-xs text-muted"></i>
                     </span>
                    </div>

                </div>

                </div>
                

                  <div class="form-group mb-2">
                <label>App Intro Header/Title</label>
                <input type="text" name="title" class="form-control">
                </div>

                <div class="form-group mb-2">
                <label>App Intro Details</label>
                <textarea class="summernote" id="editor" name="info"></textarea>
                </div>
                <div class="form-group mb-5">
                <div align="center">
                  <?php if (authorize($_SESSION["access"]["SETTINGS"]["APP INTRO"]["create"])) { ?>
                <button type="submit" class="btn btn-md btn-info insertPackages" id="insertPackages"><i class="fa fa-plus"></i> Add</button>
                <?php } ?>
                </div>
                </div>

                </form>

                </div>

                <div class="col-lg-8 bg-white col-grey pt-3 pb-3">
                <table id="table" style="width: 100%;" class="table table-striped table_view">
                    <thead class="heading">
                      <tr>
                       <th>Header/Title</th>
                        <th>Intro Text</th>
                        <th>Img</th>
                        
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="refresh">
       <?php  
       $app = appIntro();
       foreach($app as $rows){

        if(empty($rows['img'])){
        $myimg  = $set['installUrl'].'assets/img/farm.png';
        }else{
        $myimg = $set['installUrl'].'assets/images/'.$rows['images'];
        }

        ?> 
        <tr class="animated fadeIn">
        <td><?php echo ucwords($rows['title']); ?></td>    
        <td><?php echo ucwords($rows['info']); ?></td>
        <td><img src="<?php echo $myimg;  ?>" width="40" height="40"></td>
              
        <td class="tbtn"> 
          <!--<button id="<?php //echo  $rows['u_rolecode']; ?>" class="btn btn-floating uprivileges btn-small waves-effect waves-light orange z-depth-3"  ><i class="material-icons left">supervisor_account</i></button>-->
           <?php if (authorize($_SESSION["access"]["SETTINGS"]["APP INTRO"]["edit"])) { ?>
          <a href="#" data-toggle="modal" data-target="#planModal" type="button" data-id="<?php echo $rows['id']; ?>" id="<?php echo $rows['id']; ?>" class="btn bg-default btn-icon btn-circle green z-depth-3 btn-small modal-trigger planmodal" type="button" title="Edit"><i class="flaticon-edit col-white"></i></a>
        <?php } ?>
         <?php if (authorize($_SESSION["access"]["SETTINGS"]["APP INTRO"]["delete"])) { ?>
          <button id="<?php echo $rows['id']; ?>" class="btn btn-icon btn-circle delPlan waves-effect waves-light bg-red z-depth-4 btn-small" type="button" title="Delete"><i class="flaticon-delete col-white"></i></button>
      <?php } ?>
        </td>
        </tr>
        <?php
        }
        ?>
       </tbody>
                    
          </table>


                </div>



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



<div class="modal fade" id="planModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
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
        </div>
    </div>
</div>




<?php include("footer.php"); ?>

<script type="text/javascript">

$(document).ready(function(){
 // Insert class
 $('#insertPackages').click(function(event) {
  event.preventDefault();
  //var data = $("#register-form").serialize();
  $.ajax({
    url: "../inc/app/insert_intro.php",
    method: "post",
    data:  new FormData($("#introAppForm")[0]),//new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    async: false,
    success: function(data){
    if(data == "done")
    { 
       
                Swal.fire({
                    text: "Created successfully",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-success"
                    }
                });

        $('#introAppForm')[0].reset();
        setTimeout('window.location.href = "app_intro"; ',1000);
        
        $("#kt_summernote_1").summernote('code', '');
         
    }
    else{

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
  });
});






  
 //Delete User from users' list
 $(document).ready(function(){
    $(".delPlan").click(function() {
     var pid = $(this).attr('id'); // get id of clicked row  
     if(confirm("Are you sure you want to delete this?")){
     $.post("../inc/packages/remove.php", {"member_id": pid, }, 
    function(data) {
        if(data == 1){
             M.toast({html: "Successfully Delected", classes: "alert-success"});
              Swal.fire({
                    text: "Delected successfully",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-success"
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

}else{
        return false;
    }
    });
  });





 $(document).ready(function(){
    $(".planmodal").click(function() {
     
     var pid = $(this).attr('id'); // get id of clicked row
     $('#contents').html(''); // leave this div blank
     $('#planmodal').show();      // load ajax loader on button click
   
     $.ajax({
          url: '../inc/packages/getPlan.php',
          type: 'POST',
          data: 'uid='+pid,
          dataType: 'html'
     })
     .done(function(data){
          console.log(pid); 
          $('#contents').html(data); // load here
          $('#modal-loader').hide(); // hide loader  
           $('#user-modal').show();
     })
     .fail(function(){
          $('contents').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          $('#modal-loader').hide();
     });

    });

});


</script>