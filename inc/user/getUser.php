
<?php
   
 require_once '../admins.php';

	
 
 if (isset($_REQUEST['uid'])) {
   
 $id = intval($_REQUEST['uid']);
 $getAdmin = getAdmin($id);
 $u = $getAdmin['u_rolecode'];


 ?>
   
 <div class="row">
 
<div class="col-md-12 col-lg-12 mb-3">
<form id="fine">
 <table class="table table_view">
 <tr>
 <td colspan="10"><div align="center"><h5> <?php echo $getAdmin['Name']; ?></h5></div></td>
 </tr>	
 
 <tr>
 <th>Email ID</th>
 <td><input type="email" name="email" class="form-control" value="<?php echo $getAdmin['email']; ?>" ></td>
 </tr>
 <tr>
 <th>Phone Number</th>
 <td><input type="text" name="phone" class="form-control" value="<?php echo $getAdmin['phone']; ?>" ></td>
 </tr>
 <tr>
<td colspan="10"><div align="center"><button type="button" id="updateIt" class="btn btn-default btn-sm">Update</button> </div></td>
 </tr>	
 </table>
<input type="hidden" name="id" value="<?php echo $getAdmin['u_userid']; ?>">
</form>

</div>
  <div class="col-lg-4 col-sm-12 mb-3 refresh">
<table id="tableData" class="table table_view">
 	 <tr>
<td colspan="10"><div align="center"><h5>Assigned Menus</h5></div></td>
 </tr>
 <?php 


$rights = getAdminRights($u);
 if(!$rights){
 	echo ' <tr><td colspan="10">
 	 <div align="center" class="card-content red-text">
                  <p>No menu Privilege assigned to this user</p>
                </div>
 	</td></tr>';
 }else{

  foreach($rights as $row2){ ?>
<tr>
 <td><?php echo $row2['rr_modulecode']; ?></td>
 <td> <button id="<?php echo $row2['id'];  ?>" class="btn btn-delete btn-icon btn-circle bg-red z-depth-4 btn-floating waves-effect waves-light red z-depth-2 btn-small" type="button" title="Delete"><i class="flaticon-delete col-white"></i></button></td>
</tr>

<?php } } ?>
 </table>
  </div>	

   <div class="col-lg-8 col-sm-12 mb-3 form-fields refresh">
       <div align="center" class="card-content red-text">
                  <h5>Assign More Menu(s)</h5>
       </div>
<form id="mPrivilege">
<?php
$allprivileges = getAllAdminRights($u);
if(!$allprivileges){
	echo '<div align="center" class="card-content red-text">
                  <p class="col-red">All Privileges have been assigned to this user</p>
                </div>';
}else{

?>


<table role="table" class="table table_view rowfy" id="user_table"> 
                                         <tbody role="rowgroup">
                                        <tr id="template" role="row"> 
                                         
                                          <td role="cell">
                                            <select name="module[]" class="browser-default mselect select module">
                                             <option value="" class="validate" selected>Select User Menu Module</option>  
                                          <?php 
                                          

                                           foreach($allprivileges as $row){       
   										      	echo '
										        <option value="'.$row["mod_modulecode"].'"> '.$row["mod_modulecode"].'</option>
										      	';
										        
											}	
                                           ?>
                                          </select>
                                        </td>
                                      <td role="cell">
                                      <select name="create[]" class="browser-default mselect select create">
                                      <option value="" class="validate"  selected>Create</option>
                                      <option>No</option>
                                      <option>Yes</option>
                                      </select>
                                      </td>
                                      <td role="cell">
                                      <select name="edit[]" class="browser-default mselect select edit">
                                      <option value="" class="validate"  selected>Edit</option>
                                     <option>No</option>
                                      <option>Yes</option>
                                      </select>
                                      </td>
                                      <td role="cell">
                                       <select name="delete[]" class="browser-default mselect select delete">
                                      <option value=""   selected>Delete</option>
                                      <option>No</option>
                                      <option >Yes</option>
                                      </select>
                                      </td>
                                      <td role="cell">
                                       <select name="view[]" class="browser-default mselect select view">
                                      <option value=""   selected>View</option>
                                      <option>No</option>
                                      <option >Yes</option>
                                      </select>

                                      </td>
                                     
                                     </tr>
                                   </tbody>
                                        </table>  
										<input type="hidden" name="ucode" value="<?php echo $u; ?>">
                                        <div class="row" style="margin-top: 15px; margin-bottom: 15px;">

										                     <div class="col m4 s4 mb-3 mb">
                                           <button id="add-line" class="btn btn-floating addme btn-icon btn-circle bg-default z-depth-4 waves-effect waves-light green" type="button" ><i class="flaticon-plus col-white"></i></button>

                                         </div>
                                   
                                          <div class="col m4 s4 mb-3 mb">
                                            <button class="waves-effect waves dark btn btn-primary" id="submitUser"
                                                type="submit">
                                               Submit
                                               
                                            </button> 
                                    
                                           </div>
                                        </div>	
                                    <?php } ?>

</form>
 </div>

 </div>	



<?php } ?>


<script type="text/javascript">

//Get user's details and update data
$(document).ready(function(){
    $(".pmodal").click(function() {

     var pid = $(this).attr('id'); // get id of clicked row
     $('#content').show(); // leave this div blank
     $('#modal-loader').show();      // load ajax loader on button click

     $.ajax({
          url: '../incs/user/getUser.php',
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
          $('contents').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          $('#modal-loader').hide();
     });

    });

});


//Update store setting table
$(document).ready(function() {
    $("#updateIt").click(function() {
        // using serialize function of jQuery to get all values of form
        var serializedData = $("#fine").serialize();
        //var loader='<img src="../assets/img/loading.gif" width="40" height="40"/>';
        //alert(serializedData);
         
       $.ajax({

            type : 'POST',
            url  : '../admin/script/updateUser.php',
            data : serializedData,
            success :  function(data)
            {
                if(data == 1)
                {

                	 
                Swal.fire({
                    text: "Updated successfully",
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
            }
        });
        return false;

 
    });
});


//Delete User from users' list
 $(document).ready(function(){
    $(".btn-delete").click(function() {
     var pid = $(this).attr('id'); // get id of clicked row  
     //confirm("Are you sure you want to delete "+pid+"? There is no undo."); 
     $.post("../admin/script/deleteMenu.php", {"id": pid, }, 
    function(data) {
        if(data == 1){
        	 $(".refresh").load(location.href + ".refresh");
             
             Swal.fire({
                    text: "Menu Privilege Delected",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-success"
                    }
                });
             $("#tableData").load();
             
            //alert(data);
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



$(document).ready(function() {
    var template = $('#template'),
        id = 0;
    
    $("#add-line").click(function() {
        if(!template.is(':visible'))
        {
            template.show();
            return;
        }
        var row = template.clone().append('<td><button class="btn btn-small btn btn-floating btn-icon btn-circle bg-red '
      + ($(this).is(":last-child") ?
        'rowfy-addrow remove red">-' :
        'rowfy-deleterow remove waves-effect waves-light red">-') 
      +'</button></td>');
        //template.find(".mselect").val();
        row.attr('id', 'row_' + (++id));
        template.after(row);

        //$(this).removeClass('rowfy-addrow btn-success').addClass('rowfy-deleterow btn-danger').text('-');
    });
    
    $('.form-fields').on('click', '.remove', function(){
        var row = $(this).closest('tr');
        if(row.attr('id') == 'template')
        {
            row.hide();
        }
        else
        {
            row.remove();
        }
    });
});
 



$(document).ready(function() {
    $("#submitUser").click(function() {

    	var sender = $("#mPrivilege").serialize();
    	//console.log(sender);

    

     var error = '';

    $('.module').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select module to add to user/'s privileges </p>";
    return false;
   }
   count = count + 1;
  });

  $('.create').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select permission on create </p>";
    return false;
   }
   count = count + 1;
  });  

  $('.delete').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select permission on delete</p>";
    return false;
   }
   count = count + 1;
  });  
  
  $('.view').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select permission on view </p>";
    return false;
   }
   count = count + 1;
  });  

  $('.edit').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select permission on edit</p>";
    return false;
   }
   count = count + 1;
  });  

  if(error == '')
  {
       $.ajax({
            type : 'POST',
            url  : '../admin/script/updatePrivilege.php',
            data : sender,
            success :  function(data)
            {
                if(data.trim()=="i")
                {
                  
                  Swal.fire({
                    text: "Insertion was Successful!!",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-success"
                    }
                });
                	 setTimeout('window.location.href = "all_users"; ',1000);
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
        return false;

} else
  {

    Swal.fire({
                    text: error,
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
 </script>


