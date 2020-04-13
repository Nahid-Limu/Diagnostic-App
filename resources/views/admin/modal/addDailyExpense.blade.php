
<!-- Modal start -->
<div class="modal fade" id="AddDailyExpenseModal">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInLeft">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus" aria-hidden="true" style="color: red"></i> Todays Expense</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form id="AddDailyExpenseForm">  
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label class="form-control" for="expence_id">Expense Name</label>
                        </div>
                        <div class="form-group col-md-7">
                            <select name="expence_id" id="expence_id" class="form-control">
                                <option value="">Select Expense Name</option>
                                @foreach ($Expenses as $Expense)
                                    <option value="{{$Expense->id}}">{{$Expense->expence_name}}</option>
                                @endforeach
                            </select>
                            <span id="expence_idError"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label class="form-control" for="ammount">Expense Ammount</label>
                        </div>
                        <div class="form-group col-md-7">
                            <input type="number" class="form-control" id="ammount" name="ammount" placeholder="Expense Ammount [EX: 200] ">
                            <span id="ammountError"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label class="form-control" for="expence_description">Expence Description</label>
                        </div>
                        <div class="form-group col-md-7">
                            <textarea type="text" class="form-control" id="expence_description" name="expence_description" placeholder="Expence Description [EX: Guest Tea Bill] "></textarea>
                            <span id="expence_descriptionError"></span>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal footer  class="modal-footer"-->
            <div class="modal-footer" style="display: inline">
                <button onclick="addDailyExpense()" type="button" class="btn btn-success float-right">Add</button>
                <button onclick="onCloseModal('AddDailyExpenseForm')" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                {{-- <button onclick="testfun()" type="button" class="btn btn-danger">test</button> --}}
            </div>

        </div>
    </div>
</div>
<!-- Modal end -->
<script>

</script>