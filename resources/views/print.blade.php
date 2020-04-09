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
                                <a target="_blank" href="">
                                  <h2>Update DG Center</h2>
                                    {{-- <img src="http://lobianijs.com/lobiadmin/version/1.0/ajax/img/logo/lobiadmin-logo-text-64.png" alt="okkk" data-holder-rendered="true" /> --}}
                                    </a>
                            </div>
                            <div class="col company-details">
                                {{-- <h2 class="name">
                                    <a target="_blank" href="https://lobianijs.com">
                                    Update DG Center
                                    </a>
                                </h2> --}}
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
                                {{-- <h5 class="to font-weight-bold">Name: {{ strtoupper($Clint->clint_name) }}</h5> --}}
                                <div class="font-weight-bold">Patient ID: {{ strtoupper($Clint->id) }}</div>
                                <div class="font-weight-bold">Name: {{ strtoupper($Clint->clint_name) }}</div>
                                <div class="font-weight-bold">Age: {{ strtoupper($Clint->clint_age) }}</div>
                                <div class="font-weight-bold">Sex: {{ strtoupper($Clint->clint_sex) }}</div>
                                <div class="address font-weight-bold">Address: {{ strtoupper($Clint->clint_address) }}</div>
                                {{-- <div class="email"><a href="mailto:john@example.com">john@example.com</a></div> --}}
                            </div>
                            <div class="col invoice-details">
                                <h1 class="invoice-id">INVOICE - {{ $lastInvoice->id }}</h1>
                                <div class="date">Date of Invoice: {{ $lastInvoice->created_at->toDateString() }}</div>
                                <div class="date">Due Date: 30/10/2018</div>
                                <div class="font-weight-bold">REF DR: {{ strtoupper($lastInvoice->ref_dr) }}</div>
                            </div>
                        </div>
                        <hr>
                        {{-- Test list [start]  --}}
                          {!! $data !!}
                        {{-- Test list [end]  --}}
                        <hr>
                        <div class="thanks">Thank you!</div>
                        <div class="notices">
                            <div>NOTICE:</div>
                            {{-- <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div> --}}
                        </div>
                    </main>
                    <footer>
                        Software By: Nahid Limu
                    </footer>
                </div>
                <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                <div></div>
            </div>
        </div>
    </div>
    
    {{-- <button type="button" onclick="window.print();" class="btn btn-danger" id="dis">Print</button> --}}
    {{-- <button type="button" onclick="printFunction();" class="btn btn-danger" id="dis">OKAY <i class="fa fa-check" aria-hidden="true"></i></button> --}}

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