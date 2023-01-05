@extends('layouts.base')
@section('body')

<style>
    #try {
        padding-top: 6rem;
    }
</style>

<blockquote class="my-4 text-3xl italic font-semibold text-center text-gray-50 dark:text-white">
    <p>"My List of Charts"</p>
</blockquote>
<hr class="w-48 h-1 mx-auto my-4 bg-gray-50 border-0 rounded md:my-10 dark:bg-gray-50">
<div class="container-fluid grid grid-cols-3">
    <div id="try"
        class="one block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <canvas id="operatorChart"></canvas>
    </div>

    <div id="try"
        class="two block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <canvas id="salesChart"></canvas>
    </div>

    <div
        class="three block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <canvas id="accChart"></canvas>
    </div>
</div>

</div>
@endsection