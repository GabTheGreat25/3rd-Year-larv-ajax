@extends('layouts.base')
@section('body')

<body>
    <div>
        <div style="display: grid; justify-content: end;">
            <a href="/home" class="btn btn-danger"
                style="padding: .7rem 1.5rem; margin: 3rem 6rem 0 3rem; font-size: 2rem; font-weight: 500; font-style:italic;"
                role="button">Go
                Back</a>
        </div>
        <div class="card-body mx-4">
            <div class="container">
                <p class="text-center" style="font-size: 30px;">Thank for your purchase</p>
                <div class="row">
                    <ul class="list-unstyled">
                        <li class="text-black">{{ Auth::user()->name }}</li>
                        @foreach ($transactions as $transaction)
                        <li class="text-muted mt-1"><span class="text-black">Transaction Number #</span> {{
                            $transaction->transaction_id }}</li>
                        @php
                        $total = 0;
                        @endphp
                    </ul>
                    <hr>
                    <div class="col-xl-10">
                        <p>Cost:</p>
                    </div>
                    <div class="col-xl-2">
                        <p class="float-end">${{ $transaction->costs }}
                        </p>
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-xl-10">
                        <p>Accessories Model:</p>
                    </div>
                    <div class="col-xl-2">
                        <p class="float-end">{{ $transaction->description }}
                        </p>
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-xl-10">
                        <p>Accessories Image</p>
                    </div>
                    <div class="col-xl-2">
                        <p class="float-end"><img src="storage/{{ $transaction->image_path }}" width="100" height="100"
                                style="border-radius: 1rem;">
                        </p>
                    </div>
                    @php
                    $total += $transaction->costs;
                    @endphp
                    <hr style="border: 2px solid black;">
                </div>
                <div class="row text-black">

                    <div class="col-xl-12">
                        <p class="float-end fw-bold">Total Price: ${{ $total }}
                        </p>
                    </div>
                    <hr style="border: 2px solid black;">
                </div>
                <div class="text-center" style="margin-top: 90px; color:white;">
                    <p>Download As PDF</p>
                    <div
                        style="display: grid; justify-content:center; background-color: rgb(26, 228, 26); margin: 0 33rem; padding: 1.5rem 0; border-radius: .75rem;">
                        {{ link_to_route('accessories.downloadPDF', 'Export to PDF') }}
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>
@endsection