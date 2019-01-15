@extends('layouts.app')

@section('content')
<div class="container">
    
    <h1>Ajax insert</h1>

    <form id="insert" method="post" class="table table-bordered">
        <p id="return"></p>
        <table class="">
            <tr >
                <td>Name</td>
                <td><input type="text" name="name" id="name"></td>
            </tr>
            
            <tr >
                <td><input  type="submit" name="submit" id="submit"></td>
            </tr>
        </table>
    </form>

    <form id="autosearch" method="post" class="table table-bordered">
        <table class="">
            <tr >
                
                <td><input type="text" name="search" id="search" placeholder="Search"></td>
            </tr>
        </table>
        <div  id="countrylist">
            
        </div>
        <div id="data">
    	
        </div>
    </form>
    
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            
            $("#submit").click(function (event) {
                event.preventDefault();

                var _token = '{{ csrf_token() }}';
                var name = $("#name").val();
                $.post("{{ route('insertPost') }}", {name:name,_token:_token}, function (ret) {
                    $("#return").html(ret);
                    alert('Insert');

                });

            });

            $("#search").keyup(function (event) {
                
                var _token = '{{ csrf_token() }}';
                var search = $("#search").val();

                if(search != ''){
                    $.post("{{ route('autoSearch') }}", {search:search,_token:_token}, function (ret) {
                    
                        $("#countrylist").fadeIn();
                        $("#countrylist").html(ret);
    
                    });
                }
                
                

            });

            $(document).on('click', 'li', function() {
                	
                $('#search').val($(this).text());
                $('#countrylist').fadeOut();

                
            });

            
        });
        
        

    </script>
@endsection
