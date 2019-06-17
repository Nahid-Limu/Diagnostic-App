@extends('layouts.app')
@section('css')
    
@endsection

@section('content')
    @php
        echo $data;
    @endphp
    <button type="button" onclick="window.print();" class="btn btn-danger" id="dis">Print</button>
@endsection

@section('script')
    
    <script>
        

        $(document).ready(function(){
            alert('okk');
            //$('tableData tr').find('td:eq(n),th:eq(n)').remove();
        });

        

    </script>
@endsection