
<!-- Modal start -->
<div class="modal fade" id="EditTestModal">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true" style="color: red"></i> Edit Test</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form id="EditTestForm">  
                    @csrf
                    <input type="hidden" id="edit_test_id" name="id">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="form-control" for="etest_code">Test Code</label>
                        </div>
                        <div class="form-group col-md-9">
                            <input type="number" class="form-control" id="etest_code" name="test_code" placeholder="Test Code [EX: 112] ">
                            <span id="etest_nameError"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="form-control" for="etest_name">Test Name</label>
                        </div>
                        <div class="form-group col-md-9">
                            <input type="text" class="form-control" id="etest_name" name="test_name" placeholder="Test Name [EX: ECG] ">
                            <span id="etest_nameError"></span>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="form-control" for="etest_price">Test Price</label>
                        </div>
                        <div class="form-group col-md-9">
                            <input type="number" class="form-control" id="etest_price" name="test_price" placeholder="Test Price [EX: 500] ">
                            <span id="etest_priceError"></span>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal footer  class="modal-footer"-->
            <div class="modal-footer" style="display: inline">
                <button onclick="updateTest()" type="button" class="btn btn-success float-right">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                {{-- <button onclick="testfun()" type="button" class="btn btn-danger">test</button> --}}
            </div>

        </div>
    </div>
</div>
<!-- Modal end -->
<script>

</script>