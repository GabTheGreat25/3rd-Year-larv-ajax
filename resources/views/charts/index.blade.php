@extends('layouts.base')
@section('body')
<body class="w-40 h-40 bg-cover" style="background-image: url('https://wallpapers.com/images/file/canon-dslr-zoom-photography-lenses-evtrr0i1swpetu82.jpg');">
 
<style>
    .container-fluid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
    }
</style>
<form action="" class="grid grid-cols-2 gap-12 mt-14 lg:mt-28">
<div class="container-fluid">
    <div class="f">
        <canvas id="operatorChart"></canvas>
    </div>

    <div class="s">
        <canvas id="salesChart"></canvas>
    </div>

    <div class="t">
        <canvas id="accChart"></canvas>
    </div>
</div>
</form>
</div>
</body>
@endsection