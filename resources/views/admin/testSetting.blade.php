@extends('layouts.appAdmin')
@section('title', 'Test Setting')
@section('css')
    
@endsection

@section('content')

<div class="col-xl-12 col-lg-8">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list"> TESTS LIST</i></h6>
      <strong id="success_message" class="text-success"></strong>
      
      <div class="dropdown no-arrow">
        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#AddTestModal"><i class="fas fa-plus fa-fw mr-2 text-gray-400"></i>Add New Test</button>
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <table id="TestListTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-center">#NO</th>
                <th class="text-center">Test Code</th>
                <th class="text-center">Test Name</th>
                <th class="text-center">Price</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>

    </table>
    </div>
  </div>
</div>
@include('admin.modal.addTest')
@include('admin.modal.editTest')

<!-- Delete Confirmation Modal-->
<div class="modal fade" id="DeleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Select "Delete" below if you are <strong>Sure</strong> to <strong>Delete</strong> this <strong id="dtn"></strong> Test. </div>
      <div class="modal-footer" style="display: inline">
        <input type="hidden" id="delete_test_id" value="">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <button onclick="deleteTest($('#delete_test_id').val())" class="btn btn-danger float-right" type="button">Delete</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  //  $('#TestListTable').DataTable();
   $('#TestListTable').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      "order": [[ 0, "asc" ]],
      ajax:{
      url: "{{ route('testSetting') }}",
      },
      columns:[
        { 
            data: 'DT_RowIndex', 
            name: 'DT_RowIndex' 
        },
        {
            data: 'test_code',
            name: 'test_code'
        },
        {
            data: 'test_name',
            name: 'test_name'
        },
        {
            data: 'test_price',
            name: 'test_price'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false
        }
      ]
  });

    function addTest() {
        if ( $( "#test_code" ).val() != '' ) {
            $("#test_code").removeClass("errorInputBox");
            $( "#test_codeError").text('').removeClass("ErrorMsg");;
            
        } else {
            $("#test_code").addClass("errorInputBox");
            $( "#test_codeError").text('Test Name Is Required').addClass("ErrorMsg");
        }
        
        if ( $( "#test_name" ).val() != '' ) {
            $("#test_name").removeClass("errorInputBox");
            $( "#test_nameError").text('').removeClass("ErrorMsg");;
            
        } else {
            $("#test_name").addClass("errorInputBox");
            $( "#test_nameError").text('Test Name Is Required').addClass("ErrorMsg");
        }

        if ( $( "#test_price" ).val() != '' ) {
            $("#test_price").removeClass("errorInputBox");
            $( "#test_priceError").text('').removeClass("ErrorMsg");;
            
        } else {
            $("#test_price").addClass("errorInputBox");
            $( "#test_priceError").text('Test Name Is Required').addClass("ErrorMsg");
        }

        if ( $( "#test_code" ).val() && $( "#test_name" ).val() && $( "#test_price" ).val() ) {
            $( "#test_codeError","#test_nameError","#test_priceError").text('');
            $( "#test_code","#test_name","#test_price").removeClass("errorInputBox");
          
            var myData =  $('#AddTestForm').serialize();
            // alert(data);
            $.ajax({
                type: 'POST', //THIS NEEDS TO BE GET
                url: "{{ route('addTest') }}",
                // data: {_token: _token, clintName: clintName,age: age,sex: sex,address: address,ref_dr: ref_dr},
                // data: {_token: _token, myData: myData},
                data: myData,
                // dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                      
                      $("#success_message").text(response.success);
                      $('#TestListTable').DataTable().ajax.reload();
                      $('#AddTestModal').modal('hide');
                      $("#AddTestForm").trigger("reset");
                      
                      SuccessMsg();
                    }

                },error:function(){ 
                    console.log(response);
                }
            });
        }
    }

    function editTest(TestId) {
      $.ajax({
          type: 'GET',
          url: "{{url('editTest')}}"+"/"+TestId,
          success: function (response) {
              console.log(response);
              if (response) {
                
                $('#edit_test_id').val(response.id);
                $('#etest_code').val(response.test_code);
                $('#etest_name').val(response.test_name);
                $('#etest_price').val(response.test_price);
              }

          },error:function(){ 
              console.log(response);
          }
      });
    }

    function updateTest(params) {
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
    

</script>

@endsection