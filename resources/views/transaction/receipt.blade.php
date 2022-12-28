@extends('layouts.base')
@section('body')
<div style="display: grid; justify-content: end;">
    <a href="/home" class="btn btn-danger"
        style="padding: .7rem 1.5rem; margin: 3rem 6rem 0 3rem; font-size: 2rem; font-weight: 500; font-style:italic;"
        role="button">Go
        Back</a>
</div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1 style="text-align: center; font-weight: 700;">Client Profile {{ Auth::user()->name }}
        </h1>
        <hr>
        <h2 style="text-align: center; font-weight: 700; padding: 1rem 0;">Your Receipt</h2>
        {{-- {{dd($transactions)}} --}}
        @foreach ($transactions as $transaction)
        <div class="panel panel-default">
            <div class="panel-body">
                <h2 style="text-align: center;">Transaction Number #{{ $transaction->transaction_id }}</h2>
                <ul class="list-group">
                    @php
                    $total = 0;
                    @endphp
                    <div>
                        <li class="list-group-item">
                            <span>${{ $transaction->costs }} </span>
                            Camera Model: {{ $transaction->model }}
                            @php
                            $total += $transaction->costs;
                            @endphp
                        </li>
                    </div>
                </ul>
            </div>
            <div class="panel-footer" style="display: grid; justify-content:center;">
                <strong>Total Price: ${{ $total }}</strong>
            </div>
        </div>
        <div
            style="display: grid; justify-content:center; background-color: rgb(26, 228, 26); margin: 0 38rem; padding: 1.5rem 0; btransaction-radius: .75rem;">
            {{ link_to_route('camera.downloadPDF', 'Export to PDF') }}
        </div>
        @endforeach
    </div>
</div>
@endsection