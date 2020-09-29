@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="container mx-auto">
        <checkout v-cloak v-slot="{ checkout, cart, loading, inputChange, save }">
            <div>
                <div v-if="checkout.step == 1">
                    @include('checkout.steps.login')
                </div>

                <div v-if="[2, 3].includes(checkout.step)" class="flex -mx-2">
                    <div class="w-4/5 px-2">
                        <div v-if="checkout.step == 2">
                            @include('checkout.steps.credentials')
                        </div>

                        <div v-if="checkout.step == 3">
                            @include('checkout.steps.payment')
                        </div>
                    </div>
                    <div class="w-1/5 px-2">
                        @include('checkout.partials.sidebar')
                    </div>
                </div>

                <div v-if="checkout.step == 4">
                    @include('checkout.steps.success')
                </div>
            </div>
        </checkout>
    </div>
@endsection
