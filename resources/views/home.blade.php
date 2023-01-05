<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./style.css" />
  <title>RedFrame Camera Rentals</title>
  <style>
    body {
      overflow-x: hidden;
    }
  </style>
  <header class="z-5 relative ">
    <div x-data="{ open: false }"
      class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
      <div class="p-4 flex flex-row items-center justify-between">
        <a href="home"
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
        <div @click.away="open = false" class="relative" x-data="{ open: false }">
          <button @click="open = !open"
            class="text-gray-50 flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
            <span>Index</span>
            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}"
              class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
              <path fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
            </svg>
          </button>
          <div x-show="open" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
            <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
              <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="admin-index">Admin Index</a>
              <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="operator-index">Operator Index</a>
              <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="investor-index">Investor Index</a>
              <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="client-index">Client Index</a>
              <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="service-index">Service Index</a>
              <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="camera-index">Camera Index</a>
              <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="accessories-index">Accessories Index</a>
              <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="transaction-index">Transaction Index</a>

            </div>
          </div>
        </div>
        {{-- <a
          class="text-gray-50 px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
          href="{{route('comment.index')}}">Rate</a> --}}
        <a class="text-gray-50 px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
          href="charts">Charts</a>
        <div @click.away="open = false" class="relative" x-data="{ open: false }">
          <button @click="open = !open"
            class="text-gray-50 flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
            <span>Search</span>
            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}"
              class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
              <path fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
            </svg>
          </button>
          <div x-show="open" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
            <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
              <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="searchAccTransaction">Search Accessories Transaction</a>
              <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="searchCamTransaction">Search Camera Transaction</a>
              <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="searchService">Search Service</a>
            </div>
          </div>
        </div>
        <div @click.away="open = false" class="relative" x-data="{ open: false }">
          <button @click="open = !open"
            class="text-gray-50 flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
            <span>Transactions</span>
            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}"
              class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
              <path fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
            </svg>
          </button>
          <div x-show="open" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
            <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
              <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="accessories-transaction">Accessories Transaction</a>
              <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="camera-transaction">Camera Transaction</a>

            </div>
          </div>
        </div>
        <a class=" px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-gray-200 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
          href="{{route('logout')}}">Log Out</a>
    </div>
    </nav>
    </div>
  </header>
</head>

<body class="w-full h-auto bg-no-repeat bg-cover"
  style="background-image: url('https://wallpapers.com/images/file/canon-dslr-zoom-photography-lenses-evtrr0i1swpetu82.jpg');">

  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <div class="w-full text-gray-700 bg-transparent dark-mode:text-gray-200 dark-mode:bg-gray-800">


  </div>
  {{-- <header>
    <nav class="container flex items-center py-4 mt-4 sm:mt-12">
      <div class="py-1">
        <img src="./imgs/logo-main-dark-transparent.png" alt="" />
      </div>
      <ul class="hidden sm:flex flex-1 justify-end items-center text-bookmark-blue uppercase text-xs">
        <a href="admin-index">
          <li class="cursor-pointer">Admin Index</li>
        </a>
        <a href="operator-index">
          <li class="cursor-pointer">Operator Index</li>
        </a>
        <a href="investor-index">
          <li class="cursor-pointer">Investor Index</li>
        </a>
        <a href="client-index">
          <li class="cursor-pointer">Client Index</li>
        </a>
        <a href="service-index">
          <li class="cursor-pointer">Service Index</li>
        </a>
        <a href="camera-index">
          <li class="cursor-pointer">Camera Index</li>
        </a>
        <a href="accessories-index">
          <li class="cursor-pointer">Accessories Index</li>
        </a>
        <a href="transaction-index">
          <li class="cursor-pointer">Transaction Index</li>
        </a>
        <a href="camera-transaction">
          <li class="cursor-pointer">Camera Transaction</li>
        </a>
        <a href="accessories-transaction">
          <li class="cursor-pointer">Accessories Transaction</li>
        </a>
        <a href="searchService">
          <li class="cursor-pointer">Search Service</li>
        </a>
        <a href="searchCamTransaction">
          <li class="cursor-pointer">Search Camera Transaction</li>
        </a>
        <a href="searchAccTransaction">
          <li class="cursor-pointer">Search Accessories Transaction</li>
        </a>
        <a href="charts">
          <li class="cursor-pointer">Charts</li>
        </a>
        <a href="{{route('comment.index')}}">
          <li class="cursor-pointer">Rate Our Operator</li>
        </a>
        <a href="{{route('logout')}}">
          <li class="cursor-pointer">Logout</li>
        </a>
      </ul>
      <div class="flex sm:hidden flex-1 justify-end">
        <i class="text-2xl fas fa-bars"></i>
      </div>
    </nav>
  </header> --}}
  <section class="z-0">
    <div class="flex flex-col gap-12 mt-14 lg:mt-28">
      <div class="sm:w-3/4 lg:w-2/4 mx-auto">
        <h2 class="text-gray-50 text-3xl md:text-4 lg:text-5xl text-center lg:text-center mb-6">
          RedFrame Camera Rentals
        </h2>
        <p class="text-gray-50 text-lg text-center lg:text-center mb-1">
          Rent our camera for smooth/fast reliable transactions. No
          downpayment needed just fill out the requirements
        </p>
        <br>
        <div class="grid place-items-center">
          <a href="{{route('comment.index')}}"
            class="bg-transparent text center text-gray-50  font-semibold py-2 px-4 border border-white border-transparent rounded">
            Rate our Services!
          </a>
        </div>
      </div>

    </div>
  </section>
  {{-- <button
    class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded">
    Button
  </button>
  <section class="relative">
    <div class="container">
      <div class="sm:w-3/4 lg:w-5/12 mx-auto px-2">
        <h1 class="text-3xl text-center text-gray-50">
          Frequently Asked Questions
        </h1>
        <p class="text-center text-gray-50 mt-4">
          Here are some of our FAQs. If you have any other questions you’d
          like answered please feel free to email us.
        </p>
      </div>
      <div class="flex flex-col sm:w-3/4 lg:w-5/12 mt-12 mx-auto">
        <div class="flex items-center border-b py-4">
          <span class="text-gray-50 flex-1">How to Rent?</span>
          <i class=text-gray-50 fas fa-chevron-down"></i>
        </div>
        <div class="flex items-center border-b py-4">
          <span class="text-gray-50 flex-1">What are the requirements?</span>
          <i class=text-gray-50 fas fa-chevron-down"></i>
        </div>
        <div class="flex items-center border-b py-4">
          <span class="text-gray-50 flex-1">What is your location?</span>
          <i class=text-gray-50 fas fa-chevron-down"></i>
        </div>
        <div class="flex items-center border-b py-4">
          <span class="text-gray-50 flex-1">Do you offer COD / Pickup?</span>
          <i class=text-gray-50 fas fa-chevron-down"></i>
        </div>
        <button type="button"
          class="mt-12 flex self-center btn bg-bookmark-red text-white hover:bg-bookmark-white hover:text-black">
          More Info
        </button>
      </div>
    </div>
  </section> --}}





  {{-- <section class="bg-bookmark-white py-20">
    <div class="container">
      <div class="sm:w-3/4 lg:w-5/12 mx-auto px-2">
        <h1 class="text-3xl text-center text-bookmark-blue">
          Frequently Asked Questions
        </h1>
        <p class="text-center text-bookmark-grey mt-4">
          Here are some of our FAQs. If you have any other questions you’d
          like answered please feel free to email us.
        </p>
      </div>
      <div class="flex flex-col sm:w-3/4 lg:w-5/12 mt-12 mx-auto">
        <div class="flex items-center border-b py-4">
          <span class="flex-1">How to Rent?</span>
          <i class="text-bookmark-purple fas fa-chevron-down"></i>
        </div>
        <div class="flex items-center border-b py-4">
          <span class="flex-1">What are the requirements?</span>
          <i class="text-bookmark-purple fas fa-chevron-down"></i>
        </div>
        <div class="flex items-center border-b py-4">
          <span class="flex-1">What is your location?</span>
          <i class="text-bookmark-purple fas fa-chevron-down"></i>
        </div>
        <div class="flex items-center border-b py-4">
          <span class="flex-1">Do you offer COD / Pickup?</span>
          <i class="text-bookmark-purple fas fa-chevron-down"></i>
        </div>
        <button type="button"
          class="mt-12 flex self-center btn bg-bookmark-red text-white hover:bg-bookmark-white hover:text-black">
          More Info
        </button>
      </div>
    </div>
  </section>

  <section class="bg-bookmark-grey text-white py-20">
    <div class="container">
      <div class="sm:w-3/4 lg:w-2/4 mx-auto">
        <p class="font-light uppercase text-center mb-8">
          We are thrilled to announce that after successful pilot testing of
          our delivery option. We are now officially accepting reservations
          for pick-up and return delivery for new and repeat clients. 🛵🚚🤩
        </p>
        <h1 class="text-3xl text-center">
          Book now & enjoy!
        </h1>
        <div class="flex flex-col sm:flex-row gap-6 mt-8">
          <input type="text" placeholder="Enter your email address"
            class="focus:outline-none flex-1 px-2 py-3 rounded-md text-black" />
          <button type="button" class="btn bg-bookmark-red hover:bg-bookmark-white hover:text-black">
            Contact Us
          </button>
        </div>
      </div>
    </div>
  </section> --}}
</body>

</html>