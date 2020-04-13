@extends('layouts.appAdmin')
@section('title', 'Daily Expense')
@section('css')

@endsection

@section('content')

<div class="col-xl-12 col-lg-8">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list"> DAILY EXPENSE LIST</i></h6>
      <strong id="success_message" class="text-success"></strong>

      <div class="dropdown no-arrow">
        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#AddDailyExpenseModal"><i
            class="fas fa-plus fa-fw mr-2 text-gray-400"></i>Add Todays Expense</button>
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <table id="DailyExpenceListTable" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th class="text-center">#NO</th>
            <th class="text-center">Expense Name</th>
            <th class="text-center">Ammount</th>
            <th class="text-center">Create By</th>
            <th class="text-center">Date</th>
            <th class="text-center">Description</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>

      </table>
    </div>
  </div>
</div>
@include('admin.modal.addDailyExpense')
@include('admin.modal.editDailyExpense')

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
        <strong id="dtn"></strong> Expense. </div>
      <div class="modal-footer" style="display: inline">
        <input type="hidden" id="delete_data_id" value="">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <button onclick="deleteData($('#delete_data_id').val())" class="btn btn-danger float-right"
          type="button">Delete</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  //  $('#TestListTable').DataTable();
   $('#DailyExpenceListTable').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      "order": [[ 0, "asc" ]],
      ajax:{
      url: "{{ route('dailyExpense') }}",
      },
      columns:[
        { 
            data: 'DT_RowIndex', 
            name: 'DT_RowIndex' 
        },
        {
            data: 'expence_name',
            name: 'expence_name'
        },
        {
            data: 'ammount',
            name: 'ammount'
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'created_at',
            name: 'created_at'
        },
        {
            data: 'expence_description',
            name: 'expence_description'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false
        }
      ]
  });

    function addDailyExpense() {

      if ($( "#expence_id" ).val() && $( "#ammount" ).val() && $( "#expence_description" ).val() ) {
        
        $("#expence_idError,#ammountError,#expence_descriptionError").text('');
        $("#expence_id,#ammount,#expence_description" ).removeClass("errorInputBox");

        var myData =  $('#AddDailyExpenseForm').serialize();

            $.ajax({
                type: 'POST',
                url: "{{ route('addDailyExpense') }}",
                data: myData,
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                      
                      $("#success_message").text(response.success);
                      $('#DailyExpenceListTable').DataTable().ajax.reload();
                      $('#AddDailyExpenseModal').modal('hide');
                      $("#AddDailyExpenseForm").trigger("reset");
                      
                      SuccessMsg();
                    }

                },error:function(){ 
                    console.log(response);
                }
            });
              

      } else {

        if ( !$("#expence_id" ).val()) {
            $("#expence_id").addClass("errorInputBox");
            $("#expence_idError").text('Select Expence Name').addClass("ErrorMsg");
        } else {
            $("#expence_id").removeClass("errorInputBox");
            $("#expence_idError").text('').removeClass("ErrorMsg");
        }

        if ( !$("#ammount" ).val()) {
            $("#ammount").addClass("errorInputBox");
            $("#ammountError").text('Expence Ammount Is Required').addClass("ErrorMsg");
        } else {
            $("#ammount").removeClass("errorInputBox");
            $("#ammountError").text('').removeClass("ErrorMsg");
        }

        if ( !$("#expence_description" ).val()) {
            $("#expence_description").addClass("errorInputBox");
            $("#expence_descriptionError").text('Expence Description Is Required').addClass("ErrorMsg");
        } else {
            $("#expence_description").removeClass("errorInputBox");
            $("#expence_descriptionError").text('').removeClass("ErrorMsg");
        }
      }
        
        
    }

    function editDailyExpense(id) {
      $.ajax({
          type: 'GET',
          url: "{{url('editDailyExpense')}}"+"/"+id,
          success: function (response) {
              console.log(response);
              if (response) {
                
                $('#edit_id').val(response.id);
                $("#eexpence_id option[value=" + response.expence_id + "]").prop('selected', true);
                $('#eammount').val(response.ammount);
                $('#eexpence_description').val(response.expence_description);
              }

          },error:function(){ 
              console.log(response);
          }
      });
    }

    function updateDailyExpense(params) {

      if ($( "#eexpence_id" ).val() && $( "#eammount" ).val() && $( "#eexpence_description" ).val() ) {
        
        $("#eexpence_idError,#eammountError,#eexpence_descriptionError").text('');
        $("#eexpence_id,#eammount,#eexpence_description" ).removeClass("errorInputBox");

        var myData =  $('#EditDailyExpenseForm').serialize();

            $.ajax({
                type: 'POST',
                url: "{{ route('updateDailyExpense') }}",
                data: myData,
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                      
                      $("#success_message").text(response.success);
                      $('#DailyExpenceListTable').DataTable().ajax.reload();
                      $('#EditDailyExpenseModal').modal('hide');
                      $("#EditDailyExpenseForm").trigger("reset");
                      
                      
                    }else{
                      $("#success_message").text(response.falied);
                      $('#DailyExpenceListTable').DataTable().ajax.reload();
                      $('#EditDailyExpenseModal').modal('hide');
                      $("#EditDailyExpenseForm").trigger("reset");
                    }
                    SuccessMsg();

                },error:function(){ 
                    console.log(response);
                }
            });
              

      } else {

        if ( !$("#eexpence_id" ).val()) {
            $("#eexpence_id").addClass("errorInputBox");
            $("#eexpence_idError").text('Select Expence Name').addClass("ErrorMsg");
        } else {
            $("#eexpence_id").removeClass("errorInputBox");
            $("#eexpence_idError").text('').removeClass("ErrorMsg");
        }

        if ( !$("#eammount" ).val()) {
            $("#eammount").addClass("errorInputBox");
            $("#eammountError").text('Expence Ammount Is Required').addClass("ErrorMsg");
        } else {
            $("#eammount").removeClass("errorInputBox");
            $("#eammountError").text('').removeClass("ErrorMsg");
        }

        if ( !$("#eexpence_description" ).val()) {
            $("#eexpence_description").addClass("errorInputBox");
            $("#eexpence_descriptionError").text('Expence Description Is Required').addClass("ErrorMsg");
        } else {
            $("#eexpence_description").removeClass("errorInputBox");
            $("#eexpence_descriptionError").text('').removeClass("ErrorMsg");
        }
      }
    }

    function deleteModal(id,name) {
      $("#dtn").text('[ '+name+' ]');
      $("#delete_data_id").val(id);
    }

    function deleteData(id) {
      $.ajax({
          type: 'GET',
          url: "{{url('deleteDailyExpense')}}"+"/"+id,
          success: function (response) {
              console.log(response);
              if (response.success) {
                      
                $("#success_message").text(response.success);
                $('#DailyExpenceListTable').DataTable().ajax.reload();
                $('#DeleteConfirmationModal').modal('hide');

              }else{
                $("#success_message").text(response.falied);
                $('#DailyExpenceListTable').DataTable().ajax.reload();
                $('#DeleteConfirmationModal').modal('hide');
              }

              SuccessMsg();

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