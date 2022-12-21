@extends('layouts.base')
@section('body')
<style>
    .container-fluid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
    }
</style>

<div class="container-fluid">
    <div class="f">
        <canvas id="operatorChart"></canvas>
    </div>

    <div class="s">
        <canvas id="salesChart"></canvas>
    </div>

    <div class="t">
        <canvas id="itemsChart"></canvas>
    </div>
</div>

</div>
@endsection