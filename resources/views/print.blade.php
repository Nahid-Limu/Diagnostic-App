@extends('layouts.app')
@section('title', 'Print')
@section('css')
<style type="text/css">
    /* style sheet for "A4" printing */
    @media print and (width: 14.5cm) and (height: 21cm) {
        @page {
            /* margin: 3cm; */
        }
    }

    /* style sheet for "letter" printing */
    /* @media print and (width: 8.5in) and (height: 11in) {
        @page {
            margin: 1in;
        }
    } */

    /* A4 Landscape*/
    /* @page {
        size: A4 landscape;
        margin: 10%;
    } */
</style>
@endsection

@section('content')



<div class="col-md-6 offset-3">
    <div id="invoice">

        <div class="toolbar hidden-print">
            <div class="text-right">
                <button onclick="window.location.href = '{{ route('home') }}' " class="btn btn-primary float-left"><i
                        class="fa fa-home"></i> Home</button>
                <button onclick="printDiv('printableArea')" class="btn btn-info"><i class="fa fa-print"></i>
                    Print</button>
                <button id="exportPDF" value='{{ $lastInvoice->id }}' class="btn btn-info"><i
                        class="fa fa-file-pdf-o"></i> Export as PDF</button>
            </div>
            <hr>
        </div>
        <div class="invoice overflow-auto">
            <div id="printableArea" style="min-width: 600px">
                <header>
                    <div class="row">
                        <div class="col">
                            {{-- <a target="_blank" href="">
                                  <h2>Update DG Center</h2>
                                    <img src="http://lobianijs.com/lobiadmin/version/1.0/ajax/img/logo/lobiadmin-logo-text-64.png" alt="okkk" data-holder-rendered="true" />
                                    <img class="img-profile rounded-circle" src="{{ asset('img/invoiceLogo.png')}}"
                            style="width: 100px; height: 100px;">
                            </a>
                            <div class="col-md-3">
                                <img src="{{ asset('img').'/'."DCMS-Logo.png"}}" alt="opps"
                                    class="img img-responsive img-circle pull-left"
                                    style="width: 100px; height: 100px;" />
                            </div> --}}

                            {{-- <img src="{{ asset('img/invoiceLogo.png')}}" alt="opps" class="img img-responsive
                            img-circle pull-left" style="width: 610px; height: 100px;"/> --}}
                            <img src="{{ asset('img/invoiceLogo.png')}}" alt="opps" class="img img-responsive"
                                style="width: 100%; height: 100%;" />
                        </div>
                        <div class="col company-details">
                            {{-- <h2 class="name">
                                    <a target="_blank" href="https://lobianijs.com">
                                    Update DG Center
                                    </a>
                                </h2> --}}
                            <div><i class="fa fa-address-card" aria-hidden="true"> এম আর কলেজ মোড়, তেঁতুলিয়া রোড, পঞ্চগড়
                                </i> </div>
                            <div><i class="fa fa-phone" aria-hidden="true"></i> +88 01715155619</div>
                            <div><i class="fa fa-envelope-open" aria-hidden="true"></i> updatepanchagarh@gmail.com</div>
                            {{-- <img src="{{ asset('img/invoiceBanar.png')}}" alt="opps" class="img img-responsive
                            img-circle pull-left" style="width: 300px; height: 100px;"/> --}}
                        </div>

                    </div>
                </header>
                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">

                            <div class="font-weight-bold">Bill No: {{ $lastInvoice->invoice_id }} <span
                                    class="pull-right">Date: {{ $lastInvoice->created_at->toDateString() }}</span></div>
                            <div class="font-weight-bold">Patient ID: {{ strtoupper($Clint->id) }} <span
                                    class="pull-right"> Billed By: {{ $User->name}}</span></div>
                            <div class="font-weight-bold">Name: {{ strtoupper($Clint->clint_name) }}</div>
                            <div class="font-weight-bold">
                                <div class="row">
                                    <div class="col-md-4">Age: {{ strtoupper($Clint->clint_age) }}</div>
                                    <div class="col-md-4">Sex: {{ strtoupper($Clint->clint_sex) }}</div>
                                    <div class="col-md-4 pull-right"><span class="pull-right">Contact No:
                                            {{ strtoupper($Clint->clint_tel) }}</span></div>
                                </div>
                            </div>
                            <div class="font-weight-bold">REF DR: {{ strtoupper($lastInvoice->ref_dr) }}</div>

                        </div>
                        {{-- <div class="col invoice-details">
                                
                                <div class="date">Date of Invoice: {{ $lastInvoice->created_at->toDateString() }}
                    </div>

            </div> --}}
        </div>
        <hr>
        {{-- Test list [start]  --}}
        {!! $data !!}
        <p class="pull-right">In Word Taka: {{$netAmountInWord}}</p>
        <hr>
        
        {{-- Test list [end]  --}}
        <hr>
        {{-- <div class="thanks">Thank you!</div> --}}
        <div class="notices">
            {{-- <div>NOTICE:</div> --}}
            <div class="notice"> ৩০ দিনের মধ্যে রিপোর্ট সংগ্রহ করতে হবে।</div>
        </div>
        </main>
        <footer style="background-color: aqua">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"
    integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous">
</script>
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