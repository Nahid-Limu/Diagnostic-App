
<!-- Modal start -->
<div class="modal fade" id="AddTestModal">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInLeft">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus" aria-hidden="true" style="color: red"></i> New Test</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form id="AddTestForm">  
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="form-control" for="test_code">Test Code</label>
                        </div>
                        <div class="form-group col-md-9">
                            <input type="number" class="form-control" id="test_code" name="test_code" placeholder="Test Code [EX: 112] ">
                            <span id="test_nameError"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="form-control" for="test_name">Test Name</label>
                        </div>
                        <div class="form-group col-md-9">
                            <input type="text" class="form-control" id="test_name" name="test_name" placeholder="Test Name [EX: ECG] ">
                            <span id="test_nameError"></span>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="form-control" for="test_price">Test Price</label>
                        </div>
                        <div class="form-group col-md-9">
                            <input type="number" class="form-control" id="test_price" name="test_price" placeholder="Test Price [EX: 500] ">
                            <span id="test_priceError"></span>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal footer  class="modal-footer"-->
            <div class="modal-footer" style="display: inline">
                <button onclick="addTest()" type="button" class="btn btn-success float-right">Add</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                {{-- <button onclick="testfun()" type="button" class="btn btn-danger">test</button> --}}
            </div>

        </div>
    </div>
</div>
<!-- Modal end -->
<script>

</script>