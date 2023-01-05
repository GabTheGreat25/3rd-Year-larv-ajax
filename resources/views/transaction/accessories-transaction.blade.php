@extends('layouts.acc-transaction')

@section('body')
<div class="grid grid-cols-3">
    <p class="text-center text-gray-50 text-4xl font-bold">Shopping Cart</p>
    <br>
    <div id="cart-container" style="margin-left: 14rem;">
        <div id="cart">
            <i class="fa fa-shopping-cart fa-2x openCloseCart" style="color: white;" aria-hidden="true"></i>
            <button id="emptyCart" class="mx-2 btn btn-white font-bold">Empty Cart</button>
        </div>
        <span id="itemCount"></span>
    </div>

</div>

<div id="shoppingCart">
    <div id="cartItemsContainer">
        <h2>Items in your cart</h2>
        <i class="fa fa-times-circle-o fa-3x openCloseCart" aria-hidden="true"></i>
        <div id="cartItems">
        </div>
        <button
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
            id="checkout">Checkout</button>
        <span id="cartTotal"></span>
    </div>
</div>
<hr class="my-8 h-px bg-gray-50 border-2 mx-28">
<div class="container grid grid-cols-2" id="accessories">
</div>
@endsection