@extends('layouts.base')
@section('body')
<style>
    .container-fluid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 1rem;
        padding-top: 1rem;
    }

    .one,
    .two {
        padding-top: 10rem;
        background: rgba(171, 171, 171, 0.507);
        border-radius: .75rem;
    }

    .three {
        background: rgba(171, 171, 171, 0.507);
        border-radius: .75rem;
    }

    h1 {
        text-align: center;
    }
</style>
<div style="display: grid; justify-content: end;">
    <a href="/home" class="btn btn-danger"
        style="padding: .7rem 1.5rem; margin: 3rem 6rem 0 3rem; font-size: 2rem; font-weight: 500; font-style:italic;"
        role="button">Go
        Back</a>
</div>
<h1>CHARTS</h1>
<div class="container-fluid">
    <div class="one">
        <canvas id="operatorChart"></canvas>
    </div>

    <div class="two">
        <canvas id="salesChart"></canvas>
    </div>

    <div class="three">
        <canvas id="accChart"></canvas>
    </div>
</div>

</div>
@endsection