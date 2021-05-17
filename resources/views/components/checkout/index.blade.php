@extends('layouts.default')
@section('content')
    <!--====== Section 1 ======-->
    <div class="u-s-p-y-60">

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="breadcrumb">
                    <div class="breadcrumb__wrap">
                        <ul class="breadcrumb__list">
                            <li class="has-separator">

                                <a href="{{ route('products.index') }}">Home</a>
                            </li>
                            <li class="is-marked">

                                <a href="{{ route('checkout.index') }}">Checkout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section 1 ======-->


    <!--====== Section 2 ======-->
    <div class="u-s-p-b-60">

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 2 ======-->


    <!--====== Section 3 ======-->
    <div class="u-s-p-b-60">

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="checkout-f">
                    <div class="row">
                        <h1 class="checkout-f__h1">ORDER SUMMARY</h1>

                        <!--====== Order Summary ======-->
                        <div class="o-summary">
                            <div class="o-summary__section u-s-m-b-30">
                                <div class="o-summary__item-wrap gl-scroll">
                                    @foreach ($cartProducts as $cartProduct)
                                        <div class="o-card">
                                            <div class="o-card__flex">
                                                <div class="o-card__img-wrap">
                                                    <img class="u-img-fluid"
                                                        src="{{ $cartProduct['product']->images[0]->url }}" alt="">
                                                </div>
                                                <div class="o-card__info-wrap">
                                                    <span class="o-card__name">
                                                        <a
                                                            href="product-detail.html">{{ $cartProduct['product']->name }}</a></span>
                                                    <span class="o-card__quantity">{{ $cartProduct['amount'] }}</span>
                                                    <span
                                                        class="o-card__price">${{ number_format($cartProduct['product']->price * $cartProduct['amount']) }}</span>
                                                </div>
                                            </div>
                                            <a class="o-card__del far fa-trash-alt"></a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="o-summary__section u-s-m-b-30">
                                <div class="o-summary__box">
                                    <table class="o-summary__table">
                                        <tbody>
                                            <tr>
                                                <td>SUBTOTAL</td>
                                                <td>${{ number_format($subtotal) }}</td>
                                            </tr>
                                            <tr>
                                                <td>TAX</td>
                                                <td>${{ number_format($tax) }}</td>
                                            </tr>
                                            <tr>
                                                <td>DISCOUNT</td>
                                                <td>${{ number_format($discount) }}</td>
                                            </tr>
                                            <tr>
                                                <td>GRAND TOTAL</td>
                                                <td>${{ number_format($grandTotal) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="o-summary__section u-s-m-b-30">
                                <div class="o-summary__box">
                                    <h1 class="checkout-f__h1">PAYMENT INFORMATION</h1>
                                    <form class="checkout-f__payment" action="{{ route('checkout.store') }}"
                                        method="POST">
                                        @csrf
                                        <div class="u-s-m-b-10">
                                            <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="grandTotal" value="{{ $grandTotal }}">
                                            <!--====== Radio Box ======-->
                                            <div class="radio-box">
                                                <input type="radio" id="payment" name="payment" value="crypto">
                                                <div class="radio-box__state radio-box__state--primary">
                                                    <label class="radio-box__label"
                                                        for="direct-bank-transfer">Cryptocurrency</label>
                                                </div>
                                            </div>
                                            <!--====== End - Radio Box ======-->
                                            <span class="gl-text u-s-m-t-6">Cryptocurrencies or crypto assets are a type of
                                                digital currency that uses a strong encryption medium and has a
                                                decentralized control. This makes transactions much safer than centralized
                                                currencies.</span>
                                        </div>
                                        <div class="u-s-m-b-10">
                                            <!--====== Radio Box ======-->
                                            <div class="radio-box">
                                                <input type="radio" id="payment" name="payment" value="cc">
                                                <div class="radio-box__state radio-box__state--primary">
                                                    <label class="radio-box__label" for="pay-with-card">Pay With Credit /
                                                        Debit Card</label>
                                                </div>
                                            </div>
                                            <!--====== End - Radio Box ======-->
                                            <span class="gl-text u-s-m-t-6">International Credit Cards must be eligible for
                                                use within the United States.</span>
                                        </div>
                                        <div class="u-s-m-b-10">
                                            <!--====== Radio Box ======-->
                                            <div class="radio-box">
                                                <input type="radio" id="payment" name="payment" value="paypal">
                                                <div class="radio-box__state radio-box__state--primary">
                                                    <label class="radio-box__label" for="pay-pal">Pay Pal</label>
                                                </div>
                                            </div>
                                            <!--====== End - Radio Box ======-->
                                            <span class="gl-text u-s-m-t-6">When you click "Place Order" below we'll take
                                                you to Paypal's site to set up your billing information.</span>
                                        </div>
                                        <div class="u-s-m-b-15">
                                            <!--====== Check Box ======-->
                                            <div class="check-box">
                                                <input type="checkbox" id="term-and-condition">
                                                <div class="check-box__state check-box__state--primary">
                                                    <label class="check-box__label" for="term-and-condition">I consent to
                                                        the</label>
                                                </div>
                                            </div>
                                            <!--====== End - Check Box ======-->
                                            <a class="gl-link">Terms of Service.</a>
                                        </div>
                                        <div>
                                            <button class="btn btn--e-brand-b-2" type="submit">PLACE ORDER</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--====== End - Order Summary ======-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 3 ======-->
@endsection
