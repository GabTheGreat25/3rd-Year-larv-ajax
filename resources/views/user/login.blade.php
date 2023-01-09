<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=xdevice-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link rel="stylesheet" href="{{  asset('css/app.css') }}" type="text/css" media="screen" title="no title"
    charset="utf-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="./style.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"
    integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
    integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="js/login.js"></script>

  <style>
    body {
      overflow-x: hidden;
    }
  </style>

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
      <nav :class="{'flex': open, 'hidden': !open}"
        class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row">
        <form class="order-first mb-10 md:mb-0 md:order-last md:pr-8" action="{{ route('user.login') }}" id="loginform"
          method="POST">
          {{ csrf_field() }}
          <input class="mr-2 h-full w-50 py-1 pl-3 pr-10 rounded-full focus:outline-0" type="email" placeholder="E-mail"
            name="email" id="email">
          <input class="mr-3 h-full w-50 py-2 pl-3 pr-10 rounded-full focus:outline-0" type="password"
            placeholder="Password" name="password" id="password">
          <button
            class="px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-gray-200 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
            id="loginbtn" type="submit">Log In</button>
        </form>
      </nav>
    </div>
  </header>
</head>

<body class="w-full h-auto bg-no-repeat bg-cover"
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

      <div
        class="px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-gray-200 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
        style="width: fit-content;">
        <a href="{{ route('facebookRedirect') }}">FB LOGIN</a>
      </div>

    </div>
    <div class="container mx-auto" style="position: absolute;
    left: 90%;
    top: 50%;
    transform: translate(-50%,-50%);
    ">
      <div class="flex justify-center px-6 my-12">
        <div class="w-full xl:w-3/4 lg:w-11/12 flex">
          <div class="w-full lg:w-1/2 bg-white p-5 rounded-lg">
            <h3 class="pt-4 text-2xl text-center">Don't have an account?</h3>
            <form>
              <p class="pt-2 text-center">Register an account here!</p>
              <hr class="mb-6 border-t" />
              <div class="text-center"
                style="display: grid; grid-template-columns: 1fr 1fr; grid-template rows: 1fr 1fr; gap:.75rem;">
                <a class="inline-block text-sm text-red-500 align-baseline hover:text-blue-800"
                  style="border: 1px solid red; padding: .5rem .25rem; border-radius: .5rem;"
                  href="{{ url('/admin-register') }}">
                  Register as Admin!
                </a>
                <a class="inline-block text-sm text-red-500 align-baseline hover:text-blue-800" \
                  style="border: 1px solid red; padding: .5rem .25rem; border-radius: .5rem;"
                  href="{{ url('/investor-register') }}">
                  Register as Investor!
                </a>
                <a class="inline-block text-sm text-red-500 align-baseline hover:text-blue-800" \
                  style="border: 1px solid red; padding: .5rem .25rem; border-radius: .5rem;"
                  href="{{ url('/operator-register') }}">
                  Register as Operator!
                </a>
                <a class="inline-block text-sm text-red-500 align-baseline hover:text-blue-800" \
                  style="border: 1px solid red; padding: .5rem .25rem; border-radius: .5rem;"
                  href="{{ url('/client-register') }}">
                  Register as Client!
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>




    </div>
  </div>
</body>

</html>