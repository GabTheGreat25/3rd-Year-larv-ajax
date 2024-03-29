<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=xdevice-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Client</title>
    <link rel="stylesheet" href="{{  asset('css/app.css') }}" type="text/css" media="screen" title="no title"
        charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="./style.css" />

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
    <script src="js/client.js"></script>
    <style>
        body {
            overflow-x: hidden;
        }

        .container {
            margin-top: 10rem;
        }
    </style>
    <script src="js/login.js"></script>
    <header class="static m-7">
        <div x-data="{ open: false }"
            class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
            <div class="p-4 flex flex-row items-center justify-between">
                <a href="login"
                    class="text-lg font-semibold tracking-widest text-gray-50 uppercase rounded-lg dark-mode:text-white">RedFrame
                    CAM RENT</a>
                <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
                    <svg fill="currentColor" viewBox="0 50 20 20" class="w-6 h-6">
                        <path x-show="!open" fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                        <path x-show="open" fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>

            </div>
            {{-- <nav :class="{'flex': open, 'hidden': !open}"
                class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row">
                <form class="order-first mb-10 md:mb-0 md:order-last md:pr-8" action="{{ route('user.login') }}"
                    id="loginform" method="POST">
                    {{ csrf_field() }}
                    <input class="mr-2 h-full w-50 py-1 pl-3 pr-10 rounded-full focus:outline-0" type="email"
                        placeholder="E-mail" name="email" id="email">
                    <input class="mr-3 h-full w-50 py-2 pl-3 pr-10 rounded-full focus:outline-0" type="password"
                        placeholder="Password" name="password" id="password">
                    <button
                        class="px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-gray-200 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                        id="loginbtn" type="submit">Log In</button>
                </form>
            </nav> --}}
        </div>
    </header>
</head>


<body class="w-full h-auto bg-repeat bg-cover"
    style="background-image: url('https://wallpapers.com/images/file/fujifilm-x-pro2-camera-e3j9dwe6sxs64c7o.jpg');">
    <div class="grid grid-cols-2 gap-12 mt-14 lg:mt-28">
        <div class="sm:w-3/4 lg:w-2/4 mx-auto">
            <h2 class="text-gray-50 text-3xl md:text-4 lg:text-5xl text-center lg:text-left mb-6">
                RedFrame Camera Rentals
            </h2>
            <p class="text-gray-50 text-lg text-center lg:text-left mb-1">
                Rent our camera for smooth/fast reliable transactions. No
                downpayment needed just fill out the requirements
            </p>

        </div>
        <div class="container mx-auto" style="position: absolute;
    left: 90%;
    top: 43%;
    transform: translate(-50%,-50%);">
            <div class="flex justify-center px-10 my-12">
                <div class="w-full xl:w-3/4 lg:w-11/12 flex">

                    <div class="w-full lg:w-1/2 bg-white p-1 rounded-lg">
                        <h3 class="pt-4 text-2xl text-center">Register As Client</h3>
                        <form class="px-8 pt-2 pb-2 mb-4 bg-white rounded" id="clform" action="#" method="#"
                            enctype="multipart/form-data">
                            <div class="mb-4">
                                <label class="block mb-1 text-sm font-bold text-gray-700" for="email">
                                    Email
                                </label>
                                <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="email" name="email" type="text" placeholder="Enter Your Email" />
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                                    Password
                                </label>
                                <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="password" name="password" type="password" placeholder="******************" />
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="full_name">
                                    Full Name
                                </label>
                                <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="full_name" name="full_name" type="text" placeholder="Enter Your Full Name" />
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="age">
                                    Age
                                </label>
                                <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="age" name="age" type="text" placeholder="Enter Your Age" />
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="valid_id">
                                    Valid ID
                                </label>
                                <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="valid_id" name="valid_id" type="text" placeholder="Enter Your Contact Number" />
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="billing_address">
                                    Billing Address
                                </label>
                                <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="billing_address" name="billing_address" type="text"
                                    placeholder="Enter Your Contact Number" />
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="address">
                                    Address
                                </label>
                                <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="address" name="address" type="text" placeholder="Enter Your Contact Number" />
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="contact_number">
                                    Contact Number
                                </label>
                                <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="contact_number" name="contact_number" type="text"
                                    placeholder="Enter Your Contact Number" />
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="uploads">
                                    Client Image
                                </label>
                                <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="uploads" name="uploads" type="file" />
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: .75rem;">
                                <button id="clientSubmit"
                                    class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                    type="submit">
                                    Sign up
                                </button>
                                <a href="/login" class="btn btn-danger"
                                    style="color: white; background: rgb(226, 49, 49); text-align: center; font-size: 1rem; font-weight: 500; font-style:italic;"
                                    role="button">Go
                                    Back</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>