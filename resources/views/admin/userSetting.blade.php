@extends('layouts.appAdmin')
@section('title', 'User Setting')
@section('css')

@endsection

@section('content')

<div class="col-xl-12 col-lg-8">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users"> USER LIST</i></h6>
      <strong id="success_message" class="text-success"></strong>

      <div class="dropdown no-arrow">
        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#AddUserModal"><i
            class="fas fa-plus fa-fw mr-2 text-gray-400"></i>Add New User</button>
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <table id="UserListTable" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th class="text-center">#NO</th>
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Role</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>

      </table>
    </div>
  </div>
</div>
@include('admin.modal.addUser')
@include('admin.modal.editUser')

<!-- Delete Confirmation Modal-->
<div class="modal fade" id="DeleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Select "Delete" below if you are <strong>Sure</strong> to <strong>Delete</strong> this
        <strong id="dtn"></strong> Test. </div>
      <div class="modal-footer" style="display: inline">
        <input type="hidden" id="delete_test_id" value="">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <button onclick="deleteTest($('#delete_test_id').val())" class="btn btn-danger float-right"
          type="button">Delete</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  //  $('#TestListTable').DataTable();
   $('#UserListTable').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      "order": [[ 0, "asc" ]],
      ajax:{
      url: "{{ route('userSetting') }}",
      },
      columns:[
        { 
            data: 'DT_RowIndex', 
            name: 'DT_RowIndex' 
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'email',
            name: 'email'
        },
        {
            data: 'is_role',
            name: 'is_role'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false
        }
      ]
  });

    function addUser() {

      if ($( "#name" ).val() && $( "#email" ).val() && $("#role" ).val() && $( "#password" ).val() && $("#confirm_password" ).val() && IsEmail($("#email").val())==true ) {
        
        $("#nameError,#emailError,#roledError,#passwordError,#confirm_passwordError").text('');
        $("#name,#email,#password,#role,#confirm_password" ).removeClass("errorInputBox");

        if ($("#password").val() != $("#confirm_password").val() ) {
          $("#confirm_password").addClass("errorInputBox");
          $("#confirm_passwordError").text('Password do not match').addClass("ErrorMsg");
        }else if($("#password").val() != null && $("#password").val().length < 8){
          $("#passwordError").html("Password Must be 8 Char").addClass("ErrorMsg");
          $("#password").addClass("errorInputBox");
        }else{

          $("#nameError,#emailError,#roledError,#passwordError,#confirm_passwordError").text('');
          $("#name,#email,#password,#role,#confirm_password" ).removeClass("errorInputBox");

          var myData =  $('#AddUserForm').serialize();

              $.ajax({
                  type: 'POST',
                  url: "{{ route('addUser') }}",
                  data: myData,
                  success: function (response) {
                      console.log(response);
                      if (response.success) {
                        
                        $("#success_message").text(response.success);
                        $('#UserListTable').DataTable().ajax.reload();
                        $('#AddUserModal').modal('hide');
                        $("#AddUserForm").trigger("reset");
                        
                        SuccessMsg();
                      }

                  },error:function(){ 
                      console.log(response);
                  }
              });

        }
              

      } else {

        if ( !$("#name" ).val()) {
            $("#name").addClass("errorInputBox");
            $("#nameError").text('Name Is Required').addClass("ErrorMsg");
        } else {
            $("#name").removeClass("errorInputBox");
            $("#nameError").text('').removeClass("ErrorMsg");
        }
        
        if ( !$("#email" ).val()) {
            $("#email").addClass("errorInputBox");
            $("#emailError").text('Email Is Required').addClass("ErrorMsg");
            
        } else {
          if(IsEmail($("#email").val())==false){
            $("#email").addClass("errorInputBox");
            $("#emailError").text("Email Formate is Wrong").addClass("ErrorMsg");
          }else{
            $("#email").removeClass("errorInputBox");
            $("#emailError").text('').removeClass("ErrorMsg");
          }
        }

        if ( !$("#role" ).val()) {
            $("#role").addClass("errorInputBox");
            $("#roleError").text('Select Role').addClass("ErrorMsg");
        } else {
            $("#role").removeClass("errorInputBox");
            $("#roleError").text('').removeClass("ErrorMsg");
        }
        
        if ( !$("#password" ).val() ) {
            $("#password").addClass("errorInputBox");
            $( "#passwordError").text('Password Is Required').addClass("ErrorMsg");
            
        } else {
            $("#password").removeClass("errorInputBox");
            $( "#passwordError").text('').removeClass("ErrorMsg");
        }

        if ( !$("#confirm_password" ).val() ) {

            $("#confirm_password").addClass("errorInputBox");
            $("#confirm_passwordError").text('Confirm Password Is Required').addClass("ErrorMsg");
            
        } else {
          $("#confirm_password").removeClass("errorInputBox");
          $( "#confirm_passwordError").text('').removeClass("ErrorMsg");
        }
        
      }
        
        
    }

    function editUser(id) {
      $.ajax({
          type: 'GET',
          url: "{{url('editUser')}}"+"/"+id,
          success: function (response) {
              console.log(response);
              if (response) {
                
                $('#edit_user_id').val(response.id);
                $('#ename').val(response.name);
                $('#eemail').val(response.email);
                $("#erole option[value=" + response.is_role + "]").prop('selected', true);
                $('#epassword').val(response.test_price);
                $('#econfirm_password').val(response.test_price);
              }

          },error:function(){ 
              console.log(response);
          }
      });
    }

    function updateUser(params) {
      if ( $( "#etest_code" ).val() != '' ) {
            $("#etest_code").removeClass("errorInputBox");
            $("#etest_codeError").text('').removeClass("ErrorMsg");;
            
      } else {
          $("#etest_code").addClass("errorInputBox");
          $("#etest_codeError").text('Test Name Is Required').addClass("ErrorMsg");
      }
      
      if ( $( "#etest_name" ).val() != '' ) {
          $("#etest_name").removeClass("errorInputBox");
          $("#etest_nameError").text('').removeClass("ErrorMsg");;
          
      } else {
          $("#etest_name").addClass("errorInputBox");
          $("#etest_nameError").text('Test Name Is Required').addClass("ErrorMsg");
      }

      if ( $( "#etest_price" ).val() != '' ) {
          $("#etest_price").removeClass("errorInputBox");
          $("#etest_priceError").text('').removeClass("ErrorMsg");;
          
      } else {
          $("#etest_price").addClass("errorInputBox");
          $("#etest_priceError").text('Test Name Is Required').addClass("ErrorMsg");
      }

      if ( $( "#etest_code" ).val() && $( "#etest_name" ).val() && $( "#etest_price" ).val() ) {
          $( "#etest_codeError","#etest_nameError","#etest_priceError").text('');
          $( "#etest_code","#etest_name","#etest_price").removeClass("errorInputBox");
        
          var myData =  $('#EditTestForm').serialize();
          // alert(data);
          $.ajax({
              type: 'POST',
              url: "{{ route('updateTest') }}",
              data: myData,
              success: function (response) {
                  console.log(response);
                  if (response.success) {
                      
                    $("#success_message").text(response.success);
                    $('#TestListTable').DataTable().ajax.reload();
                    $('#EditTestModal').modal('hide');
                    
                    SuccessMsg();
                  }

              },error:function(){ 
                  console.log(response);
              }
          });
      }
    }

    function deleteModal(TestId,TestName) {
      $("#dtn").text('[ '+TestName+' ]');
      $("#delete_test_id").val(TestId);
    }

    function deleteTest(TestId) {
      // alert(TestId);
      $.ajax({
          type: 'GET',
          url: "{{url('deleteTest')}}"+"/"+TestId,
          success: function (response) {
              console.log(response);
              if (response.success) {
                      
                $("#success_message").text(response.success);
                $('#TestListTable').DataTable().ajax.reload();
                $('#DeleteConfirmationModal').modal('hide');

                SuccessMsg();
              }

          },error:function(){ 
              console.log(response);
          }
      });
    }

    //flash msg
    function SuccessMsg() {
        $("#success_message").fadeTo(3000, 500).slideUp(500, function(){
            $("#success_message").alert('close');
        });
    }

    $("#password").keyup(function(){
            if ( $("#password").val() != null && $("#password").val().length >= 8) {
                $("#passwordError").html("");
                $("#password").addClass("successInputBox");
            }else{
                $("#passwordError").html("Password Must be 8 Char").css("color","red");
                $("#password").addClass("errorInputBox");
          }
    });

    $("#confirm_password").keyup(function(){
            if ($("#password").val() != $("#confirm_password").val()) {
                $("#confirm_passwordError").text("Password do not match").addClass("ErrorMsg");
                $("#confirm_password").addClass("errorInputBox");
            }else{
                $("#confirm_passwordError").text("Password matched").addClass("SuccessMsg");
                $("#confirm_password").addClass("successInputBox");
          }
    });

    function showPassword() {
      var password = document.getElementById("password");
      var confirm_password = document.getElementById("confirm_password");
      if (password.type === "password") {
        password.type = "text";
        confirm_password.type = "text";
      } else {
        password.type = "password";
        confirm_password.type = "password";
      }
    }

    /* email validation start*/
    function IsEmail(email) {
      var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if(!regex.test(email)) {
        return false;
      }else{
        return true;
      }
    }
    /* email validation end*/
    

</script>

@endsection