<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=xdevice-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="{{  asset('css/app.css') }}" type="text/css" media="screen" title="no title"
    charset="utf-8">
</head>

<body class="font-mono bg-gray-400">
  <div class="container mx-auto" style="position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%,-50%);">
    <div class="flex justify-center px-6 my-12">
      <div class="w-full xl:w-3/4 lg:w-11/12 flex">
        <div class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
          style="background-image: url('https://images.unsplash.com/photo-1516035069371-29a1b244cc32?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80')">
        </div>
        <div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
          <h3 class="pt-4 text-2xl text-center">Create an Account</h3>
          <form class="px-8 pt-6 pb-8 mb-4 bg-white rounded" action="{{ route('user.register') }}" method="POST">
            {{ csrf_field() }}
            <div class="mb-4">
              <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                Name
              </label>
              <input
                class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                id="name" name="name" type="text" placeholder="name" />
            </div>
            <div class="mb-4">
              <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                Email
              </label>
              <input
                class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                id="email" name="email" type="text" placeholder="email" />
            </div>
            <div class="mb-4">
              <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                Password
              </label>
              <input
                class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                id="password" name="password" type="password" placeholder="******************" />
            </div>
            <div class="mb-6 text-center">
              <button
                class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                type="submit">
                Sign up
              </button>
            </div>
            <hr class="mb-6 border-t" />
            <div class="text-center">
              <a class="inline-block text-sm text-red-500 align-baseline hover:text-blue-800"
                href="{{ url('/login') }}">
                Have an Account?
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>