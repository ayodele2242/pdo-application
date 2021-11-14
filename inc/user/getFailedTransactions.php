<?php
 error_reporting(0);
 require_once '../admins.php';

	
 
 if (isset($_REQUEST['uid'])) {
    $id = intval($_REQUEST['uid']);

    $query = "SELECT * FROM plans WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->rowCount();
   
    $row = $stmt->fetch(PDO::FETCH_ASSOC);


 


 ?>
   
 <div class="row">
 
<div class="col-lg-12 s12 mb-3">
<form id="fine">
 <table class="table table-striped">
 <tr>
 <td colspan="10"><div align="center"><h5> <?php echo $row['email']; ?></h5></div></td>
 </tr>	
 
 <tr>
 <td>Amount Invested</td>
 <td><?php echo number_format($row['amount_invested'],2); ?> </td>
</tr>
<tr>
 <td>Duration</td>
 <td><?php echo $row['duration']; ?> month(s)</td>
 </tr>
 
 
 <tr>
 <td>Enter Transaction #ID</td>
 <td><input type="text" name="transid" class="form-control" value="" ></td>
 </tr>
  <td>Payment Status</td>
 <td><select class="mselect select form-control" name="status">
     <option value="successful">Successful</option>
 </select></td>
 </tr>
 
 <tr>
<td colspan="4"><div align="center"><button type="button" id="updateIt" class="btn bg-default btn-sm col-white">Update</button> </div></td>
 </tr>	
 
 </table>
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
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


//Update store setting table
$(document).ready(function() {
    $("#updateIt").click(function() {
        // using serialize function of jQuery to get all values of form
        var serializedData = $("#fine").serialize();
        
         
       $.ajax({

            type : 'POST',
            url  : '../admin/script/updatePayment.php',
            data : serializedData,
            success :  function(data)
            {
                if(data == 1)
                {
                    Swal.fire({
                    text: "Update was Successful",
                    icon: "success",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-success"
                    }
                });

                	 setTimeout('window.location.href = "failed_transactions"; ',1000);
                	
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
             M.toast({html: "Menu Privilege Delected"});
             $("#tableData").load();
             
            //alert(data);
        }else{
            M.toast({html: data});
            //alert(data);
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
        var row = template.clone().append('<td><button class="btn btn-small btn btn-floating '
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
                if(data=="i")
                {
                  
                	 M.toast({html: '<i class="material-icons">done</i> Insertion was Successful!!', classes: 'alert-success'});
                   setTimeout('window.location.href = "all_users"; ',1000);
                }
                else{

                	M.toast({
                		html: data, classes: 'alert-danger'

                		});


                }
            }
        });
        return false;

} else
  {

  	 M.toast({
  	 	html: error,
  		type: "warning",
  	 });

    
  }
 
    });
}); 
 </script>


