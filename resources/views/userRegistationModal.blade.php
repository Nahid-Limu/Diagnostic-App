
<!-- Modal start -->
<div class="modal fade" id="myModal">
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
                <form form action="{{ route('ClintReg') }}" method="" id="ClintRegistationForm">
                    @csrf
                    {{-- hidden inputs [start] --}}
                    <input type="hidden" value="" id="t_data" name="t_data">
                    <input type="hidden" value="" id="testIds" name="testIds">
                    {{-- hidden inputs [end] --}}
                    
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                    </div>
                    <div class="form-group">
                        <label for="inputState">State</label>
                        <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="clintName">Name</label>
                            <input type="text" class="form-control" id="clintName" name="clintName" placeholder="Name [EX: Feroz Mahmud] ">
                            <span id="clintNameError"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="age">Age</label>
                            <input type="number" class="form-control" id="age" name="age" placeholder="Age [EX: 28] ">
                            <span id="ageError"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="sex">Sex</label>
                            <select id="sex" name="sex" class="form-control">
                                <option selected>Choose...</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tel">Phone</label>
                            <input type="tel" class="form-control" id="tel" name="tel" max="11"  placeholder="Tel [EX: 01719205019]">
                            <span id="telError"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea type="text" class="form-control" id="address" name="address" placeholder="Address [EX: Islambag, Panchagarh]"></textarea>
                        <span id="addressError"></span>
                    </div>
                    
                    {{-- <button type="submit" class="btn btn-primary">Sign in</button> --}}
                   
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button onclick="ClintRegistation()" type="button" class="btn btn-success">Registation</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- Modal end -->
<script>
    function ClintRegistation(params) {
        
        var tel = $( "#tel" ).val();
    
        var numPattern = /[0-9]/g;
        var resultTel = tel.match(numPattern);
        // alert(tel.length);
        if (resultTel != null && tel.length == 11) {
            $("#tel").removeClass("errorInputBox");
            $( "#telError").text('').removeClass("ErrorMsg");;
            
        } else {
            $("#tel").addClass("errorInputBox");
            $( "#telError").text('Tel Format is Worong').addClass("ErrorMsg");
        }

        if ( $( "#clintName" ).val() != '' ) {
            $("#clintName").removeClass("errorInputBox");
            $( "#clintNameError").text('').removeClass("ErrorMsg");;
            
        } else {
            $("#clintName").addClass("errorInputBox");
            $( "#clintNameError").text('Clint Name Is Required').addClass("ErrorMsg");
        }

        if ( $( "#age" ).val() != '' ) {
            $("#age").removeClass("errorInputBox");
            $( "#ageError").text('').removeClass("ErrorMsg");;
            
        } else {
            $("#age").addClass("errorInputBox");
            $( "#ageError").text('Age Is Required').addClass("ErrorMsg");
        }

        if ( $( "#address" ).val() != '' ) {
            $("#address").removeClass("errorInputBox");
            $( "#addressError").text('').removeClass("ErrorMsg");;
            
        } else {
            $("#address").addClass("errorInputBox");
            $( "#addressError").text('Address Is Required').addClass("ErrorMsg");
        }

        if (resultTel != null && tel.length == 11 && $( "#clintName" ).val() && $( "#age" ).val() && $( "#address" ).val() ) {
            alert();
            document.getElementById("ClintRegistationForm").method = "post";
            document.getElementById("ClintRegistationForm").submit();
        }
        
    }
</script>