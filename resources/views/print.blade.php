@extends('layouts.app')
@section('css')
    
@endsection

@section('content')
    @php
        echo $data;
    @endphp
@endsection

@section('script')
    
    <script>
        

        $(document).ready(function(){
            alert('okk');
            //$('tableData tr').find('td:eq(n),th:eq(n)').remove();
        });

        

    </script>
@endsection