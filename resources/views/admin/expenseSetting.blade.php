@extends('layouts.appAdmin')
@section('title', 'Expense Setting')
@section('css')

@endsection

@section('content')

<div class="col-xl-12 col-lg-8">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list"> EXPENSE LIST</i></h6>
      <strong id="success_message" class="text-success"></strong>

      <div class="dropdown no-arrow">
        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#AddExpenseModal"><i
            class="fas fa-plus fa-fw mr-2 text-gray-400"></i>Add New Expense Catagory</button>
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <table id="ExpenceListTable" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th class="text-center">#NO</th>
            <th class="text-center">Expence Name</th>
            <th class="text-center">Remarke</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>

      </table>
    </div>
  </div>
</div>
@include('admin.modal.addExpense')
@include('admin.modal.editExpense')

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
   $('#ExpenceListTable').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      "order": [[ 0, "asc" ]],
      ajax:{
      url: "{{ route('expenseSetting') }}",
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
            data: 'remarke',
            name: 'remarke'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false
        }
      ]
  });

    function addExpense() {

      if ($( "#expence_name" ).val() ) {
        
        $("#expence_nameError").text('');
        $("#expence_name" ).removeClass("errorInputBox");

        var myData =  $('#AddExpenseForm').serialize();

            $.ajax({
                type: 'POST',
                url: "{{ route('addExpense') }}",
                data: myData,
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                      
                      $("#success_message").text(response.success);
                      $('#ExpenceListTable').DataTable().ajax.reload();
                      $('#AddExpenseModal').modal('hide');
                      $("#AddExpenseForm").trigger("reset");
                      
                      SuccessMsg();
                    }

                },error:function(){ 
                    console.log(response);
                }
            });
              

      } else {

        if ( !$("#expence_name" ).val()) {
            $("#expence_name").addClass("errorInputBox");
            $("#expence_nameError").text('Expence Name Is Required').addClass("ErrorMsg");
        } else {
            $("#expence_name").removeClass("errorInputBox");
            $("#expence_nameError").text('').removeClass("ErrorMsg");
        }
      }
        
        
    }

    function editExpense(id) {
      $.ajax({
          type: 'GET',
          url: "{{url('editExpense')}}"+"/"+id,
          success: function (response) {
              console.log(response);
              if (response) {
                
                $('#edit_expense_id').val(response.id);
                $('#eexpence_name').val(response.expence_name);
                $('#eremarke').val(response.remarke);
              }

          },error:function(){ 
              console.log(response);
          }
      });
    }

    function updateExpense(params) {

      if ($( "#eexpence_name" ).val() ) {
        
        $("#eexpence_nameError").text('');
        $("#eexpence_name" ).removeClass("errorInputBox");

        var myData =  $('#EditExpenseForm').serialize();

            $.ajax({
                type: 'POST',
                url: "{{ route('updateExpense') }}",
                data: myData,
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                      
                      $("#success_message").text(response.success);
                      $('#ExpenceListTable').DataTable().ajax.reload();
                      $('#EditExpenseModal').modal('hide');
                      $("#EditExpenseForm").trigger("reset");
                      
                      SuccessMsg();
                    }

                },error:function(){ 
                    console.log(response);
                }
            });
              

      } else {

        if ( !$("#eexpence_name" ).val()) {
            $("#eexpence_name").addClass("errorInputBox");
            $("#eexpence_nameError").text('Expence Name Is Required').addClass("ErrorMsg");
        } else {
            $("#eexpence_name").removeClass("errorInputBox");
            $("#eexpence_nameError").text('').removeClass("ErrorMsg");
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
          url: "{{url('deleteExpense')}}"+"/"+id,
          success: function (response) {
              console.log(response);
              if (response.success) {
                      
                $("#success_message").text(response.success);
                $('#ExpenceListTable').DataTable().ajax.reload();
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