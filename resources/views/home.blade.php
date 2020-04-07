@extends('layouts.app')
@section('title', 'Home')
@section('css')
    <style>
            .searchbar{
            margin-bottom: auto;
            margin-top: auto;
            height: 60px;
            background-color: #353b48;
            border-radius: 30px;
            padding: 10px;
            }
        
            .search_input{
            color: white;
            border: 0;
            outline: 0;
            background: none;
            width: 0;
            caret-color:transparent;
            line-height: 40px;
            transition: width 0.4s linear;
            color:white; 
            font-size: 20px;
            font: bold;
            }
        
            .searchbar:hover > .search_input{
            padding: 0 10px;
            width: 450px;
            caret-color:red;
            transition: width 0.4s linear;
            }
        
            .searchbar:hover > .search_icon{
            background: white;
            color: #e74c3c;
            text-decoration: none;
            }
        
            .search_icon{
            height: 40px;
            width: 40px;
            float: right;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            color:white;
            }

            ul {
            list-style-type: none;
            margin-left: 80px;
            width: 530px;
            position: absolute;
            text-align: center;
            background: aqua;
            font-size: 20px;
            font-style: bold;
            border-radius: 25px;
            }
            li:hover{
                background: ;
                border: 3px solid black;
                margin-left: 80px;
                border-radius: 0px 50px 50px 0px;
                animation: shake 0.5s;
                animation-iteration-count: infinite;
                color: black;
            }
            @keyframes shake {
                0% { transform: translate(1px, 1px) rotate(0deg); }
                10% { transform: translate(-1px, -2px) rotate(-1deg); }
                20% { transform: translate(-3px, 0px) rotate(1deg); }
                30% { transform: translate(3px, 2px) rotate(0deg); }
                40% { transform: translate(1px, -1px) rotate(1deg); }
                50% { transform: translate(-1px, 2px) rotate(-1deg); }
                60% { transform: translate(-3px, 1px) rotate(0deg); }
                70% { transform: translate(3px, 1px) rotate(-1deg); }
                80% { transform: translate(-1px, -1px) rotate(1deg); }
                90% { transform: translate(1px, 2px) rotate(0deg); }
                100% { transform: translate(1px, -2px) rotate(-1deg); }
              }

            img {
                border-radius: 50%;
                border: 3px solid black;
                background-color: white;
            }

            #nav{
                background-image: url("img/final-banner.jpg");
                
                background-repeat: no-repeat;
                background-size:cover;
            }

            .ErrorMsg{
                color: red;
            }

            .errorInputBox {
                border: 1px solid red !important;
            }
            
    </style>
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

                <div  id="testlist" style="margin: auto;
                position: absolute;">
        
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
            <tbody style="background:steelblue; text-align: center; font-style: bold;">
                <tr >
                    <td></td>
                    <td><b> Total</b></td>
                    <td><b>:</b></td>
                    <td ><b id="result" ><b></b></td>
                    <td></td>
                </tr>
            </tbody> 
        </table>
        <div style=" display: flex; justify-content: center;">
            {{-- <form action="{{ route('print') }}" method="POST">
                @csrf
                <button disabled="disabled" class="btn btn-primary" type="submit" id="con" onclick="gotoprint()"><i class="fas fa-sign-out-alt"></i> Confirm</button>
            
                <input  type="hidden" value="" id="t_data" name="t_data">
                <input  type="hidden" value="" id="testIds" name="testIds">
            </form> --}}
            <button disabled="disabled" class="btn btn-primary" type="submit" id="con" onclick="userRegModal()"><i class="fas fa-sign-out-alt"></i> Confirm</button>
            
            <button disabled="disabled" type="button" class="btn btn-danger" id="dis">Discart</button>
        </div>
    </div>
    
    
    
   
    {{-- <footer class="row">
        @include('includes.footer')
    </footer> --}}
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
            // autosearch
            $("#search").keyup(function (event) {
                
                var _token = '{{ csrf_token() }}';
                var search = $("#search").val();

                if(search != ''){
                    $.post("{{ route('autoSearch') }}", {search:search,_token:_token}, function (ret) {
                    
                        $("#testlist").fadeIn();
                        $("#testlist").html(ret);
    
                    });
                }
                
                

            });
            

            $(document).on('click', 'li', function() {
                
                $('#search').val($(this).text());
                $('#testlist').fadeOut();

                var _token = '{{ csrf_token() }}';
                var data = $('#search').val();

                // search data for table
                if(data != ''){
                    
                    var i = $('tr').length;
                    var arr = [];
                        $.post("{{ route('getTable') }}", {data:data,_token:_token,i:i}, function (ret) {
                        console.log(ret.id);                        
                            $("#testTable").append(ret.output);
                            
                            $('.price').each(function() {
                                $(calculateSum);
                            });

                            
                            // var t = $('#tableData').prop('outerHTML');
                            // alert(t);
                            //$("#d").html(t);
                            
                            // $("#t_data").val(t);
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
                
                // count table row
                var tr = $('table tr').length;
                if(tr >= 2){
                    $('#con').prop('disabled', false);
                    $('#dis').prop('disabled', false);
                }else{
                    $('#con').prop('disabled', true);
                    $('#dis').prop('disabled', true);
                }

            });

            
        });

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
                $('#result').text(sum);
        };

        function removeRow(rowId) {
            alert(rowId+' delete me');
            $('#'+rowId).remove();

            $('.price').each(function() {
                $(calculateSum);
            });

            var t = $('#tableData').prop('outerHTML');
            // alert(t);
            //$("#d").html(t);
            $("#t_data").val(t);


            // count table row
            var tr = $('table tr').length;
            if(tr >= 3){
                $('#con').prop('disabled', false);
                $('#dis').prop('disabled', false);
            }else{
                $('#con').prop('disabled', true);
                $('#dis').prop('disabled', true);
            }
        }

        function userRegModal() {
            $("#myModal").modal();
            
            var t = $('#tableData').prop('outerHTML');
            $("#t_data").val(t);
        }

    </script>
    <script>
        $(document).ready(function(){
            $('#dis').click(function(){ 
                alert('okk');
                $("#tableData").find("tr:gt(0)").remove();
              });
        });
    </script>
    <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
@endsection
