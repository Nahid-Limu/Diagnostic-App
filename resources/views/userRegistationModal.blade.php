
<!-- Modal start -->
<div class="modal fade" id="ClintRegistationModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-bed" aria-hidden="true" style="color: red"></i> Patient Details
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form form action="{{ route('print') }}" id="goToPrintForm">
                    @csrf
                    {{-- hidden inputs [start] --}}
                    <input type="hidden" value="" id="t_data" name="t_data">
                    <input type="hidden" value="" id="InvoiceID" name="InvoiceID">
                    {{-- hidden inputs [end] --}}
                </form> 

                {{-- Search Clint [start] --}}
                <div class="d-flex justify-content-center input-group mb-3">
                    <input type="text" class="form-control" id="clintIdSearch" placeholder="Search Clint Id" >
                    <div class="input-group-append">
                      <button class="form-control btn-success" onclick="clintIdSearchFunction()" >Search</button>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <label class="radio-inline">Search By :</label>
                    <label class="radio-inline">
                        <input type="radio" value="id" name="searchOption" id="radio1" style="margin-left: 10px;" checked> ID
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="phone" name="searchOption" id="radio2" style="margin-left: 10px;"> Phone
                    </label>
                </div>
                {{-- Search Clint [end] --}}

                <form id="ClintRegistationForm">  
                    @csrf
                    {{-- hidden inputs [start] --}}
                    <input type="hidden" value="" id="exist_clint_id" name="exist_clint_id" disabled>
                    <input type="hidden" value="" id="testIds" name="test_ids">
                    <input type="hidden" value="" id="test_price" name="test_price">
                    <input type="hidden" value="" id="discount_amount" name="discount_amount">
                    {{-- hidden inputs [end] --}}
                    
                    <hr>
                    <h5 class="text-center text-success" id="p_status">New Patient</h5>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="clintName">Name</label>
                            <input type="text" class="form-control" id="clintName" name="clint_name" placeholder="Name [EX: Feroz Mahmud] ">
                            <span id="clintNameError"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="age">Age</label>
                            <input type="number" class="form-control" id="age" name="clint_age" placeholder="Age [EX: 28] ">
                            <span id="ageError"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="sex">Sex</label>
                            <select id="sex" name="clint_sex" class="form-control">
                                <option selected>Choose...</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tel">Phone</label>
                            <input type="tel" class="form-control" id="tel" name="clint_tel" max="11"  placeholder="Tel [EX: 01719205019]">
                            <span id="telError"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea type="text" class="form-control" id="address" name="clint_address" placeholder="Address [EX: Islambag, Panchagarh]"></textarea>
                        <span id="addressError"></span>
                    </div>

                    <div class="form-group">
                        <label for="ref_dr">Ref Dr</label>
                        <input type="text" class="form-control" id="ref_dr" name="ref_dr" placeholder="Ref Dr [EX: Baharam Ali]">
                        <span id="ref_drError"></span>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer" style="display: inline">
                <button onclick="ClintRegistation()" type="button" class="btn btn-success float-right">Registation</button>
                <button onclick="dismissModal()" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                {{-- <button onclick="testfun()" type="button" class="btn btn-danger">test</button> --}}
            </div>

        </div>
    </div>
</div>
<!-- Modal end -->
<script>

    function clintIdSearchFunction() {
        var ClintID = $("#clintIdSearch").val();
        var searchOption = $("input[name='searchOption']:checked"). val();
        // alert(searchOption);

        if ($("#clintIdSearch").val() == '') {
            $("#clintIdSearch").addClass("errorInputBox");
        } else {

            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: "{{ route('autocompleteClint') }}",
                data: {searchOption: searchOption,ClintID: ClintID},
                // dataType: 'json',
                success: function (response) {
                    console.log(response);
                    
                    $("#clintIdSearch").val('');
                    if (response != 0) {
                        $("#clintIdSearch").removeClass("errorInputBox");
                        // alert(response.clint_name);
                        
                        $( "#p_status" ).text('Old Patient');

                        $("#exist_clint_id").prop('disabled', false);
                        $( "#exist_clint_id" ).val(response.id);

                        $( "#clintName" ).val(response.clint_name);
                        $( "#age" ).val(response.clint_age) ;
                        $("#sex option[value=" + response.clint_sex + "]").prop('selected', true);
                        $( "#tel" ).val(response.clint_tel);
                        $( "#address" ).val(response.clint_address);
                        $( "#ref_dr" ).val(response.ref_dr)
                    }else{

                        $( "#p_status" ).text('New Patient');
                        document.getElementById("ClintRegistationForm").reset();
                        $("#ref_dr").removeClass("errorInputBox");
                        $( "#ref_drError").text('').removeClass("ErrorMsg");
                    }
                    
                },error:function(){ 
                    console.log(response);
                }
            });

        }

       
    }

    function ClintRegistation(params) {
        
        var tel = $( "#tel" ).val();
        var numPattern = /[0-9]/g;
        var resultTel = tel.match(numPattern);

       
        if (resultTel != null && tel.length == 11) {
            $("#tel").removeClass("errorInputBox");
            $("#telError").text('').removeClass("ErrorMsg");;
        } else {
            $("#tel").addClass("errorInputBox");
            $("#telError").text('Tel Format is Worong').addClass("ErrorMsg");
        }

        if ( $("#clintName" ).val() != '' ) {
            $("#clintName").removeClass("errorInputBox");
            $("#clintNameError").text('').removeClass("ErrorMsg");;
            
        } else {
            $("#clintName").addClass("errorInputBox");
            $("#clintNameError").text('Clint Name Is Required').addClass("ErrorMsg");
        }

        if ( $("#age" ).val() != '' ) {
            $("#age").removeClass("errorInputBox");
            $("#ageError").text('').removeClass("ErrorMsg");;
            
        } else {
            $("#age").addClass("errorInputBox");
            $("#ageError").text('Age Is Required').addClass("ErrorMsg");
        }

        if ( $("#address" ).val() != '' ) {
            $("#address").removeClass("errorInputBox");
            $("#addressError").text('').removeClass("ErrorMsg");;
            
        } else {
            $("#address").addClass("errorInputBox");
            $("#addressError").text('Address Is Required').addClass("ErrorMsg");
        }

        if ( $("#ref_dr" ).val() != '' ) {
            $("#ref_dr").removeClass("errorInputBox");
            $("#ref_drError").text('').removeClass("ErrorMsg");
            
        } else {
            $("#ref_dr").addClass("errorInputBox");
            $("#ref_drError").text('Ref Dr Name Is Required').addClass("ErrorMsg");
        }
        
        if (resultTel != null && tel.length == 11 && $( "#clintName" ).val() && $( "#age" ).val() && $( "#address" ).val() && $( "#ref_dr" ).val() ) {
            
            var _token = '{{ csrf_token() }}';
            var myData =  $('#ClintRegistationForm').serialize();
            // alert(data);
            $.ajax({
                type: 'POST', //THIS NEEDS TO BE GET
                url: "{{ route('ClintReg') }}",
                // data: {_token: _token, clintName: clintName,age: age,sex: sex,address: address,ref_dr: ref_dr},
                // data: {_token: _token, myData: myData},
                data: myData,
                // dataType: 'json',
                success: function (response) {
                    console.log(response.InvoiceID);
                    if (response.InvoiceID) {
                        document.getElementById("ClintRegistationForm").reset();
                        document.getElementById("InvoiceID").value = response.InvoiceID;
                        document.getElementById("goToPrintForm").method = "post";
                        document.getElementById("goToPrintForm").submit();
                    }
                    
                    
                    // $("#ClintRegistationForm").trigger("reset");
                    
                },error:function(){ 
                    console.log(response);
                }
            });
        }   
    }

    function dismissModal() {

        $("#tel,#clintName,#age,#address,#ref_dr").removeClass("errorInputBox");
        $("#telError,#clintNameError,#ageError,#addressError,#ref_drError").text('').removeClass("ErrorMsg");

        $("#clintIdSearch").val('');

        $( "#p_status" ).text('New Patient');

        $("#exist_clint_id").prop('disabled', true);
        $("#exist_clint_id" ).val('');
        
        document.getElementById("ClintRegistationForm").reset()
    }

    function testfun() {
        alert();
    }
</script>