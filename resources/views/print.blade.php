@extends('layouts.app')
@section('title', 'Print')
@section('css')
    
@endsection

@section('content')
   

    
    <div class="col-md-6 offset-3">
        <div id="invoice">

            <div class="toolbar hidden-print">
                <div class="text-right">
                    <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
                    <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
                </div>
                <hr>
            </div>
            <div class="invoice overflow-auto">
                <div style="min-width: 600px">
                    <header>
                        <div class="row">
                            <div class="col">
                                <a target="_blank" href="https://lobianijs.com">
                                    <img src="http://lobianijs.com/lobiadmin/version/1.0/ajax/img/logo/lobiadmin-logo-text-64.png" data-holder-rendered="true" />
                                    </a>
                            </div>
                            <div class="col company-details">
                                <h2 class="name">
                                    <a target="_blank" href="https://lobianijs.com">
                                    Update DG Center
                                    </a>
                                </h2>
                                <div><i class="fa fa-address-card" aria-hidden="true"></i> MR College Road, Panchagarh</div>
                                <div><i class="fa fa-phone" aria-hidden="true"></i> 01719205019</div>
                                <div><i class="fa fa-envelope-open" aria-hidden="true"></i> udgc@example.com</div>
                            </div>
                        </div>
                    </header>
                    <main>
                        <div class="row contacts">
                            <div class="col invoice-to">
                                <div class="text-gray-light">INVOICE TO:</div>
                                <h2 class="to">John Doe</h2>
                                <div class="address">796 Silver Harbour, TX 79273, US</div>
                                <div class="email"><a href="mailto:john@example.com">john@example.com</a></div>
                            </div>
                            <div class="col invoice-details">
                                <h1 class="invoice-id">INVOICE 3-2-1</h1>
                                <div class="date">Date of Invoice: 01/10/2018</div>
                                <div class="date">Due Date: 30/10/2018</div>
                            </div>
                        </div>
                        <hr>
                        {!! $data !!}
                        <hr>
                        <div class="thanks">Thank you!</div>
                        <div class="notices">
                            <div>NOTICE:</div>
                            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                        </div>
                    </main>
                    <footer>
                        Invoice was created on a computer and is valid without the signature and seal.
                    </footer>
                </div>
                <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                <div></div>
            </div>
        </div>
    </div>
    {{$testIds}}
    {{-- <button type="button" onclick="window.print();" class="btn btn-danger" id="dis">Print</button> --}}
    <button type="button" onclick="printFunction();" class="btn btn-danger" id="dis">OKAY <i class="fa fa-check" aria-hidden="true"></i></button>

    <!-- Modal start -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-bed" aria-hidden="true" style="color: red"></i> Patient Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        
            <!-- Modal body -->
            <div class="modal-body">
                <form>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputAddress">Address</label>
                      <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                    </div>
                    <div class="form-group">
                      <label for="inputAddress2">Address 2</label>
                      <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputCity">City</label>
                        <input type="text" class="form-control" id="inputCity">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputState">State</label>
                        <select id="inputState" class="form-control">
                          <option selected>Choose...</option>
                          <option>...</option>
                        </select>
                      </div>
                      <div class="form-group col-md-2">
                        <label for="inputZip">Zip</label>
                        <input type="text" class="form-control" id="inputZip">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                          Check me out
                        </label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                  </form>
            </div>
        
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        
            </div>
        </div>
    </div>
    <!-- Modal end -->
@endsection

@section('script')
    
    <script>
        $(document).ready(function(){
            // alert('okk');
            $('table#tableData th.testaction ').remove();
            $('table#tableData td.testaction ').remove();
        });

        function printFunction(params) {
            $("#myModal").modal();
        }

    </script>
@endsection