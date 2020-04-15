@extends('layouts.appAdmin')
@section('title', 'Report')
@section('css')

@endsection

@section('content')

<div class="col-xl-12 col-lg-8">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <form action="{{route('report')}}" method="get">
      @csrf
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-file-csv"> GENERATE REPORT</i></h6>
      <strong id="success_message" class="text-success"></strong>
    
      <div class="dropdown no-arrow">
        <label for="from_datepicker" >From :</label>
      </div>
      <div class="dropdown no-arrow">
        <input type="text" onchange="EnableToDate()" id="from_datepicker" name="from" class="form-control" autocomplete="off">
      </div>

      <div class="dropdown no-arrow">
        <label for="to_datepicker" >To :</label>
      </div>
      <div class="dropdown no-arrow">
        <input type="text" id="to_datepicker" name="to" class="form-control" autocomplete="off" disabled >
      </div>
      <div class="dropdown no-arrow">
        <button type="submit" class="btn btn-sm btn-info"><i class="fas fa-eye fa-fw mr-2 text-gray-400"></i>Generate</button>
      </div>
    </div>
    </form>
    <!-- Card Body -->
    <div class="card-body">
      @isset($Reports)
        <table id="ExpenceListTable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th class="text-center">#NO</th>
              <th class="text-center">Test Name</th>
              <th class="text-center">Test Code</th>
              <th class="text-center">Test Price</th>
              <th class="text-center">Quantity</th>
              <th class="text-center">Total</th>
            </tr>
          </thead>
            
                <tbody>
                  @foreach ($Reports as $Report)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $Report->test_name }}</td>
                        <td>{{ $Report->test_code }}</td>
                        <td>{{ $Report->test_price }}</td>
                        <td>{{ $Report->testquentity }}</td>
                        <td>{{ $Report->TotalPrice }}</td>
                      </tr>
                  @endforeach
                </tbody>
                <form action="{{route('report')}}" method="get">
                  @csrf
                  <input type="hidden" name="btnExport" value="csv">
                  <input type="hidden" name="exp_from" value="{{ $dates['from'] }}">
                  <input type="hidden" name="exp_to" value="{{ $dates['to'] }}">
                  <button class="btn btn-sm btn-info float-left" type="submit"><i class="fas fa-file-csv"> Export Report</i></button>
                </form>
                <br>
            
        </table>
      @endisset
        <hr>
      @isset($Discounts)
      <table id="ExpenceListTable" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th class="text-center">#NO</th>
            <th class="text-center">Invoice Id</th>
            <th class="text-center">Discount Amount</th>
          </tr>
        </thead>
          
              <tbody>
                @foreach ($Discounts as $Discounts)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $Discounts->invoice_id }}</td>
                      <td>{{ $Discounts->discount_amount }}</td>
                    </tr>
                @endforeach
              </tbody>
              {{-- <form action="{{route('report')}}" method="get">
                @csrf
                <input type="hidden" name="btnExport" value="csv">
                <input type="hidden" name="exp_from" value="{{ $dates['from'] }}">
                <input type="hidden" name="exp_to" value="{{ $dates['to'] }}">
                <button class="btn btn-sm btn-info float-left" type="submit"><i class="fas fa-file-csv"> Export Report</i></button>
              </form> --}}
              <br>
          
      </table>
      @endisset
      
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#from_datepicker,#to_datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );

function EnableToDate() {
  if ($("#from_datepicker" ).val()) {
      $("#to_datepicker" ).prop('disabled', false);
  }
}
  
</script>

@endsection