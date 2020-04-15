@extends('layouts.app')
@section('title', 'Home')
@section('css')
    
@endsection
@section('content')
<div class="container">
    
    @include('includes.nav')
    <div class="row" >
        <div class="col-md-2"></div>

        <div class="col-md-8">
            <div class="container h-100">
                <form id="autosearch" method="post" class="table ">
                    <div class="d-flex justify-content-center h-100">
                        <div class="searchbar">
                        <input class="search_input" type="text" name="search" id="search" placeholder="Search Test Here....">
                        <a href="#" class="search_icon"><i class="fa fa-search-plus"></i></a>
                        </div>
                    </div>
                </form>
                <div  id="testlist" style="margin: auto; position: absolute;">
                </div>
            </div>
        </div>

        <div class="col-md-2"></div>
    </div>

    <div class="table-responsive table-hover" style="overflow: auto; height: 300px;">
        <table class="table" id="tableData">
            <thead style="background: aqua; text-align: center; font-style: bold;">
            <tr>
                <th>No</th>
                <th>Test Name</th>
                <th>Test Code</th>
                <th>Test Price</th>
                <th class="testaction">Action</th>
                
            </tr>
            </thead>

            <tbody  id="testTable" style="text-align: center; font-style: bold;">         
            </tbody>

            <tbody id="rseTbody" style="background:steelblue; text-align: center; font-style: bold;">
                <tr >
                    <td>&nbsp</td>
                    <td><b> Total</b></td>
                    <td><b>:</b></td>
                    <td ><b id="result" ><b></b></td>
                    <td class ="testaction"><input type="number" onkeyup="calculateSum()" id="discount" name="discount" value="" disabled="disabled"> </td>
                </tr>
            </tbody> 
        </table>
        <div style=" display: flex; justify-content: center;">
            <button disabled="disabled" class="btn btn-primary" type="submit" id="con" onclick="userRegModal()"><i class="fas fa-sign-out-alt"></i> Confirm</button>
            <button disabled="disabled" type="button" class="btn btn-danger" id="dis" style="margin-left: 10px;">Discard</button>
        </div>
    </div>

    @include('includes.footer')
    
</div>
    {{-- userRegistationModal [start] --}}
        @include('userRegistationModal')
    {{-- userRegistationModal [end] --}}
{{-- Rockstar --}}
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            
            //--Test autosearch [start]--//
            $("#search").keyup(function (event) {
                
                var _token = '{{ csrf_token() }}';
                var search = $("#search").val();
                var SearchedTestIds = $("#testIds").val();
                // alert(SearchedTestIds);
                if(search != ''){
                    $.post("{{ route('autoSearch') }}", {SearchedTestIds:SearchedTestIds,search:search,_token:_token}, function (ret) {
                    
                        $("#testlist").fadeIn();
                        $("#testlist").html(ret);
    
                    });
                }
            });
            //--Test autosearch [end]--//
            

            //--on click test get test details [start]--//
            $(document).on('click', 'li', function() {
                // alert(this.id);
                // $('#search').val($(this).text());
                $('#search').val(this.id);
                $('#testlist').fadeOut();

                var _token = '{{ csrf_token() }}';
                var data = $('#search').val();

                // search data for table
                if(data != ''){

                    var i = $('tr').length;
                    $.post("{{ route('getTable') }}", {data:data,_token:_token,i:i}, function (ret) {
                        console.log(ret.output);                        
                        $("#testTable").append(ret.output);
                        
                        calculateSum();
                        
                        var number = ret.tid;
                        $("#testIds").val(function() {
                            if (this.value == '') {
                                return number;
                            } else {
                                return this.value +',' + number;
                            }
                        });

                    });
                }

                $('#search').val('');
                // count table row //
                var tr = $('table tr').length;
                if(tr >= 2){
                    $('#con').prop('disabled', false);
                    $('#dis').prop('disabled', false);
                    $('#discount').prop('disabled', false);
                }else{
                    $('#con').prop('disabled', true);
                    $('#dis').prop('disabled', true);
                    $('#discount').prop('disabled', true);
                }
            });
            //--on click test get test details [end]--//
        });

        function removeRow(rowId) {
            // alert(rowId+' delete me');
            $('#'+rowId).remove();

            calculateSum();

            var t = $('#tableData').prop('outerHTML');
            // alert(t);
            //$("#d").html(t);
            $("#t_data").val(t);


            // count table row
            var tr = $('table tr').length;
            if(tr >= 3){
                $('#con').prop('disabled', false);
                $('#dis').prop('disabled', false);
                $('#discount').prop('disabled', false);
            }else{
                $('#con').prop('disabled', true);
                $('#dis').prop('disabled', true);
                $('#discount').prop('disabled', true);
            }
        }

        // Price Calculation Function start
        function calculateSum() {

            var sum = 0;
            // iterate through each td based on class and add the values
            $(".price").each(function() {

                var value = $(this).text();
                // add only if the value is number
                if(!isNaN(value) && value.length != 0) {
                    sum += parseFloat(value);
                }
            });    
            $('#result').text( ( sum - $('#discount').val() )+' TK');
            $('#test_price').val(sum);

        }
        // Price Calculation Function end

        function userRegModal() {
            // alert();
            $("#ClintRegistationModal").modal();
            
            var t = $('#tableData').prop('outerHTML');
            $("#t_data").val(t);
            $("#discount_amount").val( $('#discount').val() );
            
        }

    </script>
    <script>
        $(document).ready(function(){
            ///dicurt button action
            $('#dis').click(function(){ 

                $('#result').text('');
                $('#test_price').val('');
                $("#testTable").empty();
                $('#discount').val('');
                $('#con').prop('disabled', true);
                $('#dis').prop('disabled', true);
                $('#discount').prop('disabled', true);
                // $("#tableData").find("tr:gt(0)").remove();
            });
        });
    </script>
    
@endsection
