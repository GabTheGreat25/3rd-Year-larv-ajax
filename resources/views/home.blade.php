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
</head>

<body class="font-Poppins">
  <header>
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
  </header>

  <section class="relative">
    <div class="container flex flex-col-reverse lg:flex-row items-center gap-12 mt-14 lg:mt-28">
      <div class="flex flex-1 flex-col items-center lg:items-start">
        <h2 class="text-bookmark-blue text-3xl md:text-4 lg:text-5xl text-center lg:text-left mb-6">
          RedFrame Camera Rentals
        </h2>
        <p class="text-bookmark-grey text-lg text-center lg:text-left mb-6">
          Rent our camera for smooth/fast reliable transactions. No
          downpayment needed just fill out the requirements
        </p>
        <div class="flex justify-center flex-wrap gap-6">
          <button type="button" class="btn bg-bookmark-red text-white hover:bg-bookmark-white hover:text-black">
            Book now!
          </button>
          <button type="button" class="btn btn-white hover:bg-bookmark-red hover:text-white">
            Services
          </button>
        </div>
      </div>
      <div class="flex justify-center flex-1 mb-10 md:mb-16 lg:mb-0 z-10">
        <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-full md:h-full" src="./imgs/camera-intro.png" alt="" />
      </div>
    </div>
    <div
      class="hidden md:block overflow-hidden bg-bookmark-red rounded-l-full absolute h-80 w-2/4 top-32 right-0 lg: -bottom-28 lg:-right-36">
    </div>
  </section>

  <section class="bg-bookmark-white py-20 mt-20 lg:mt-60">
    <div class="sm:w-3/4 lg:w-5/12 mx-auto px-2">
      <h1 class="text-3xl text-center text-bookmark-blue">
        Mission / Vision
      </h1>
      <p class="text-center text-bookmark-grey mt-4">
        We provide backup camera's for those in need.
      </p>
    </div>
    <div class="relative mt-20 lg:mt-24">
      <div class="container flex flex-col lg:flex-row items-center justify-center gap-x-24">
        <div class="flex flex-1 justify-center z-10 mb-10 lg:mb-0">
          <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-full md:h-full" src="./imgs/camera-intro.png" alt="" />
        </div>
        <div class="flex flex-1 flex-col items-center lg:items-start">
          <h1 class="text-3xl text-bookmark-blue">
            Inquire / Submit Requirements
          </h1>
          <p class="text-bookmark-grey my-4 text-center lg:text-left sm:w-3/4 lg:w-full">
            Know the availability and current rates of our camera to pick the
            best for you! Kindly view &amp; fill out the form to proceed on
            renting
          </p>
          <button type="button" class="btn bg-bookmark-red text-white hover:bg-bookmark-white hover:text-black">
            <a
              href="https://docs.google.com/forms/d/e/1FAIpQLSe7olaNeEheTItNmwVQOjQxgpYSOpnx7z3eupFf2kQVrN-A0A/viewform">
              Click Me!
            </a>
          </button>
        </div>
      </div>
      <div
        class="hidden lg:block overflow-hidden bg-bookmark-red rounded-r-full absolute h-80 w-2/4 -bottom-24 -left-36">
      </div>
    </div>
    <div class="relative mt-20 lg:mt-52">
      <div class="container flex flex-col lg:flex-row-reverse items-center justify-center gap-x-24">
        <div class="flex flex-1 justify-center z-10 mb-10 lg:mb-0">
          <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-full md:h-full" src="./imgs/camera-intro.png" alt="" />
        </div>
        <div class="flex flex-1 flex-col items-center lg:items-start">
          <h1 class="text-3xl text-bookmark-blue">Fast Delivery</h1>
          <p class="text-bookmark-grey my-4 text-center lg:text-left sm:w-3/4 lg:w-full">
            We offer pickup and delivery Through Lalamove, Joyride, Angkas, &
            Grab couriers. Note that shipping expense are client’s expense
            back and forth.
          </p>
          <button type="button" class="btn bg-bookmark-red hover:bg-bookmark-white hover:text-black">
            More Info
          </button>
        </div>
      </div>
      <div
        class="hidden lg:block overflow-hidden bg-bookmark-red rounded-l-full absolute h-80 w-2/4 -bottom-24 -right-36">
      </div>
    </div>
    <div class="relative mt-20 lg:mt-52">
      <div class="container flex flex-col lg:flex-row items-center justify-center gap-x-24">
        <div class="flex flex-1 justify-center z-10 mb-10 lg:mb-0">
          <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-full md:h-full" src="./imgs/camera-intro.png" alt="" />
        </div>
        <div class="flex flex-1 flex-col items-center lg:items-start">
          <h1 class="text-3xl text-bookmark-blue">Enjoy</h1>
          <p class="text-bookmark-grey my-4 text-center lg:text-left sm:w-3/4 lg:w-full">
            Enjoy and We'd be happy to hear QA and feedback we are happy to
            hear and consider every opinion
          </p>
          <button type="button" class="btn bg-bookmark-red hover:bg-bookmark-white hover:text-black">
            More Info
          </button>
        </div>
      </div>
      <div
        class="hidden lg:block overflow-hidden bg-bookmark-red rounded-r-full absolute h-80 w-2/4 -bottom-24 -left-36">
      </div>
    </div>
  </section>

  <section class="bg-bookmark-white py-20">
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
  </section>
</body>

</html>