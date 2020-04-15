@extends('layouts.appAdmin')
@section('title', 'Expense History')
@section('css')

@endsection

@section('content')

<div class="col-xl-12 col-lg-8">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <form action="{{route('expenseHistory')}}" method="get">
      @csrf
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-history"> EXPENSE HISTORY</i></h6>
      <strong id="success_message" class="text-success"></strong>
    
      <div class="dropdown no-arrow">
        <label for="from_datepicker" >From :</label>
      </div>
      <div class="dropdown no-arrow">
        <input type="text" onchange="EnableToDate()" id="from_datepicker" name="from_datepicker" class="form-control" autocomplete="off">
      </div>

      <div class="dropdown no-arrow">
        <label for="to_datepicker" >To :</label>
      </div>
      <div class="dropdown no-arrow">
        <input type="text" id="to_datepicker" name="to_datepicker" class="form-control" autocomplete="off" disabled >
      </div>
      <div class="dropdown no-arrow">
        <button type="submit" class="btn btn-sm btn-info"><i class="fas fa-eye fa-fw mr-2 text-gray-400"></i>Show</button>
      </div>
    </div>
    </form>
    <!-- Card Body -->
    <div class="card-body">
      <table id="ExpenceListTable" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th class="text-center">#NO</th>
            <th class="text-center">Created Date</th>
            <th class="text-center">Created By</th>
            <th class="text-center">Expence Name</th>
            <th class="text-center">Amount</th>
            <th class="text-center">Description</th>
          </tr>
        </thead>
          @isset($historys)
              <tbody>
                @foreach ($historys as $history)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ date('Y-m-d', strtotime($history->created_at)) }}</td>
                      <td>{{ $history->name }}</td>
                      <td>{{ $history->expence_name }}</td>
                      <td>{{ $history->ammount }}</td>
                      <td>{{ $history->expence_description }}</td>
                    </tr>
                @endforeach
              </tbody>
          @endisset
      </table>
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