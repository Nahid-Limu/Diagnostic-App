
<!-- Modal start -->
<div class="modal fade" id="EditExpenseModal">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInLeft">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true" style="color: red"></i> Edit Expense</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form id="EditExpenseForm">  
                    @csrf
                    <input type="hidden" id="edit_expense_id" name="id">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="form-control" for="eexpence_name">Expense Name</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" id="eexpence_name" name="expence_name" placeholder="Name [EX: Snacks] ">
                            <span id="eexpence_nameError"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="form-control" for="eremarke">Remarke</label>
                        </div>
                        <div class="form-group col-md-8">
                            <textarea type="text" class="form-control" id="eremarke" name="remarke" placeholder="Remarke [EX: Guest Tea Bill] "></textarea>
                            <span id="eexpence_nameError"></span>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal footer  class="modal-footer"-->
            <div class="modal-footer" style="display: inline">
                <button onclick="updateExpense()" type="button" class="btn btn-success float-right">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                {{-- <button onclick="testfun()" type="button" class="btn btn-danger">test</button> --}}
            </div>

        </div>
    </div>
</div>
<!-- Modal end -->
<script>

</script>