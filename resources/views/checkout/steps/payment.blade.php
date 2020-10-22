<h1 class="font-bold text-4xl mb-5">@lang('Payment method')</h1>
<form class="w-2/3" v-on:submit.prevent="save(['payment_method'], 4)">
    <div class="my-2" v-for="(method, index) in checkout.payment_methods">
        <input
            type="radio"
            name="payment_method"
            :value="method.code"
            :id="method.code"
            :dusk="'method-'+index"
            v-model="checkout.payment_method"
        >
        <label :for="method.code">@{{ method.title }}</label>
    </div>

    <button
        type="submit"
        class="btn btn-primary"
        :disabled="$root.loading"
        dusk="continue"
    >
        @lang('Continue')
    </button>
</form>
