
@extends('layouts.base')
@section('body')

<body>
        <div class="card-body mx-4">
            <div class="container">
                <p class="text-center font-bold text-white my-6" style="font-size: 30px;">Thank for your purchase</p>
                <hr class="w-48 h-1 mx-auto my-4 bg-gray-50 border-0 rounded md:my-10 dark:bg-gray-50">
                <div class="row">
                    <ul class="list-unstyled">
                        <li class="text-white">{{ Auth::user()->name }}</li>
                        @foreach ($transactions as $transaction)
                        <li class="text-muted mt-1"><span class="text-black">Transaction Number #</span> {{
                            $transaction->transaction_id }}</li>
                        @php
                        $total = 0;
                        @endphp
                    </ul>
                    <hr>
                    <div class="col-xl-10 text-center font-bold text-white my-6">
                        <p>Cost:</p>
                    </div>
                    <div class="col-xl-2">
                        <p class="float-end text-center font-bold text-white my-6">${{ $transaction->costs }}
                        </p>
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-xl-10 text-center font-bold text-white my-6">
                        <p>Camera Model:</p>
                    </div>
                    <div class="col-xl-2 ">
                        <p class="float-end text-center font-bold text-white my-6">{{ $transaction->model }}
                        </p>
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-xl-10">
                        <p class="text-center font-bold text-white my-6">Camera Image</p>
                    </div>
                    <div class="col-xl-2">
                        <p class="float-end"><img src="storage/{{ $transaction->image_path }}" width="100" height="100"
                                style="border-radius: 1rem;">
                        </p>
                    </div>
                    @php
                    $total += $transaction->costs;
                    @endphp
                    <hr style="border: 2px solid white;">
                </div>
                <div class="row text-white">

                    <div class="col-xl-12">
                        <p class="float-end fw-bold text-center font-bold text-white my-6">Total Price: ${{ $total }}
                        </p>
                    </div>
                    <hr style="border: 2px solid white;">
                </div>
                <div class="text-center" style="margin-top: 90px; color:white;">
                    <p>Download As PDF</p>
                    <div
                        style="display: grid; justify-content:center; background-color: rgb(26, 228, 26); margin: 0 33rem; padding: 1.5rem 0; border-radius: .75rem;">
                        {{ link_to_route('camera.downloadPDF', 'Export to PDF') }}
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>
</body>

@endsection