@extends('layouts.app')
@section('title', 'Print')
@section('css')
    
@endsection

@section('content')
   

    
    <div class="col-md-6 offset-3">
        <div id="invoice">

            <div class="toolbar hidden-print">
                <div class="text-right">
                    <button onclick="window.location.href = '{{ route('home') }}' " class="btn btn-primary float-left"><i class="fa fa-home"></i> Home</button>
                    <button onclick="printDiv('printableArea')" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
                    <button id="exportPDF" value='{{ $lastInvoice->id }}' class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
                </div>
                <hr>
            </div>
            <div class="invoice overflow-auto">
                <div id="printableArea" style="min-width: 600px">
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
    
   <div id="editor"></div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            // alert('okk');
            $('table#tableData th.testaction ').remove();
            $('table#tableData td.testaction ').remove();
        });


        //print Div//
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

            window.location.href = "{{ route('home') }}";
        }

        

    </script>
    <script>
		// here we will write our custom code for printing our div
		$(function(){
			var doc = new jsPDF();
            var specialElementHandlers = {
                '#editor': function (element, renderer) {
                    return true;
                }
            };

            $('#exportPDF').click(function () {
                doc.fromHTML($('#printableArea').html(), 15, 15, {
                    'width': 170,
                        'elementHandlers': specialElementHandlers
                });
                doc.save('INVOICE-'+this.value+'.pdf');
            });
		});
	</script>
@endsection