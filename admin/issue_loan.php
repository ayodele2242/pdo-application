<?php 
include("header.php");
$status = FALSE;
if ( authorize($_SESSION["access"]["LOAN PRODUCTS"]["ISSUE LOAN"]["create"]) || 
authorize($_SESSION["access"]["LOAN PRODUCTS"]["ISSUE LOAN"]["edit"]) || 
authorize($_SESSION["access"]["LOAN PRODUCTS"]["ISSUE LOAN"]["view"]) || 
authorize($_SESSION["access"]["LOAN PRODUCTS"]["ISSUE LOAN"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}
$ltype = loanTypes();
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
										<h5 class="text-dark font-weight-bold my-1 mr-5">Issue Loan</h5>
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

				<form autocomplete="off" id="packagesForm">

                <div class="form-group mb-2">
                    <label>Loan Type</label>
               <select name="loan_id" id="loantype"  class="form-control">
                <option value=""> </option>
             <?php
              foreach($ltype as $income){ 
             ?>
             <option value="<?php echo $income['id']; ?>"><?php echo ucwords($income['name']); ?></option>
            <?php
           }
             ?>
             </select>
                </div>

                 <div class="form-group mb-2">
                    <label>Loan Amount</label>
                <input type="text" name="amount"  id="amount" class="form-control thousand digit" placeholder="">
                <input type="hidden" name="duration"  id="duration">
                </div>

                <div class="form-group stas mb-2" >
                  <label>Interest Rate(%)</label>  
                <input type="text" name="interest_rate" id="interest" class="form-control" placeholder="">
                </div>

             

                <div class="form-group  mb-2" >
                  <label>Borrower's E-mail Address</label>  
                <input type="email" name="email" id="iemail" class="form-control" placeholder="">
                </div>

                 <div class="form-group  mb-2" >
                  <label>Loan Status</label>  
               <select name="status" class="form-control">
               	 <option value=""></option>
                 <option value="active">Approve</option>
                 <option value="pending">Pending</option>
               </select>
                </div>


                <div class="form-group mb-2 ">
                <label>Payment Frequency</label>
                <select name="frequency" id="frequency" class="form-control">
                      <option value=""></option>
                      <option value="Monthly">Monthly</option>
                      <option value="2 Weeks">2 Weeks</option>
                      <option value="Weekly">Weekly</option>
                    </select>
                </div>

               
                <div class="form-group mb-5 mt-5">
                <div align="center">
                  <?php if (authorize($_SESSION["access"]["LOAN PRODUCTS"]["ISSUE LOAN"]["create"])) { ?>
                <button class="btn btn-md btn-info insertPackages" id="insertPackages"><i class="fa fa-plus"></i> Preview</button>

                 <button class="btn btn-md btn-success finish" id="finish"><i class="fa fa-plus"></i> Grant Loan</button>
                <?php } ?>
                </div>
                </div>

                </form>
								<div id="details"></div>
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
$(document).ready(function(){
  $("#finish").hide();
 // Insert class
 $('.insertPackages').click(function(event) {
 event.preventDefault();
 
 var loan = $("#loantype").val();
 var amt = $("#amount").val();
 var interest = $("#interest").val();
 var frequency = $("#frequency").val();
 var email = $("#iemail").val();
 if(loan == "" || amt=="" || interest =="" || frequency == "" || email == ""){
 	            Swal.fire({
					text: "Check for empty value(s)",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-danger"
					}
				});
   
 }else{
        
  //var data = $("#register-form").serialize();
  $.ajax({
    url: "../inc/loans/insertBorrowLoan.php",
    method: "post",
    data:  $("#packagesForm").serialize(),//new FormData(this),
    
    success: function(data){
  
     $("#details").html(data);
      $("#finish").show();
    }
  });//ajax ends

}
  });
});



$(document).ready(function(){
 
 // Insert class
 $('#finish').click(function(event) {
 event.preventDefault();
 
 var loan = $("#loantype").val();
 var amt = $("#amount").val();
 var interest = $("#interest").val();
 var frequency = $("#frequency").val();
 var email = $("#iemail").val();
 if(loan == "" || amt=="" || interest =="" || frequency == "" || email == ""){
   Swal.fire({
					text: "Check for empty value(s)",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-danger"
					}
				});
 }else{
        
  //var data = $("#register-form").serialize();
  $.ajax({
    url: "../inc/loans/processLoan.php",
    method: "post",
    data:  $("#packagesForm").serialize(),//new FormData(this),
    
    success: function(data){

      if(data == "done"){
         $("#finish").hide();
         $("#details").html('<div class="alert alert-success">Loan has been disbursed</div>');
         $("#packagesForm")[0].reset()


      }else{
        $("#details").html('<div class="alert alert-danger">'+data+'</div>');
      }
  
     
      
    }
  });//ajax ends

}
  });
});




$(document).ready(function(){  
  // code to get all records from table via select box
  $("#loantype").change(function() {    
    var id = $(this).find(":selected").val();
    var dataString = 'id='+ id;    
    $.ajax({
      url: '../inc/loans/getloanAjax.php',
      dataType: "json",
      data: dataString,  
      cache: false,
      success: function(employeeData) {
         if(employeeData) {    
          $("#amount").val(employeeData.amount);
          $("#interest").val(employeeData.interest);
          $("#duration").val(employeeData.duration);
            
        } else {
          $("#no_records").show();
        }     
      } 
    });
  }) 
});


</script>