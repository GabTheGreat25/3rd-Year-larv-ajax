<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camera Receipt</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/sl-1.4.0/datatables.min.css" />

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/sl-1.4.0/datatables.min.js">
    </script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"
        integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
        integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<style>
    body {
        background: rgb(171, 171, 171);
        padding-bottom: 1rem;
    }
</style>

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
                        <p>Camera Model:</p>
                    </div>
                    <div class="col-xl-2">
                        <p class="float-end">{{ $transaction->model }}
                        </p>
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-xl-10">
                        <p>Camera Image</p>
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
                        {{ link_to_route('camera.downloadPDF', 'Export to PDF') }}
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>
</body>

</html>