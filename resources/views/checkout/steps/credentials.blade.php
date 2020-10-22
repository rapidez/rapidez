<h1 class="font-bold text-4xl mb-5">@lang('Credentials')</h1>

<form class="lg:w-2/3" v-on:submit.prevent="save(['credentials'], 3)">
    <div class="grid grid-cols-12 gap-4 mb-3">
        <div class="col-span-12 sm:col-span-6">
            <label class="text-gray-700 text-sm" for="firstname">@lang('Fistname')</label>
            <input
                type="text"
                class="form-input w-full"
                id="firstname"
                dusk="firstname"
                placeholder="@lang('Firstname')"
                :value="checkout.shipping_address.firstname"
                @input="inputChange('shipping_address', $event)"
            >
        </div>
        <div class="col-span-12 sm:col-span-6">
            <label class="text-gray-700 text-sm" for="firstname">@lang('Lastname')</label>
            <input
                type="text"
                class="form-input w-full"
                id="lastname"
                dusk="lastname"
                placeholder="@lang('Lastname')"
                :value="checkout.shipping_address.lastname"
                @input="inputChange('shipping_address', $event)"
            >
        </div>
        <div class="col-span-6 sm:col-span-3">
            <label class="text-gray-700 text-sm" for="zipcode">@lang('Postcode')</label>
            <input
                type="text"
                class="form-input w-full"
                id="zipcode"
                dusk="zipcode"
                placeholder="@lang('Zipcode')"
                :value="checkout.shipping_address.zipcode"
                @input="inputChange('shipping_address', $event)"
            >
        </div>
        <div class="col-span-6 sm:col-span-3">
            <label class="text-gray-700 text-sm" for="housenumber">@lang('Housenumber')</label>
            <input
                type="text"
                class="form-input w-full"
                id="housenumber"
                dusk="housenumber"
                placeholder="@lang('Nr.')"
                :value="checkout.shipping_address.housenumber"
                @input="inputChange('shipping_address', $event)"
            >
        </div>
        <div class="col-span-12 sm:col-span-6 sm:col-start-1">
            <label class="text-gray-700 text-sm" for="street">@lang('Street')</label>
            <input
                type="text"
                class="form-input w-full"
                id="street"
                dusk="street"
                placeholder="@lang('Street')"
                :value="checkout.shipping_address.street"
                @input="inputChange('shipping_address', $event)"
            >
        </div>
        <div class="col-span-12 sm:col-span-6 sm:col-start-1">
            <label class="text-gray-700 text-sm" for="city">@lang('City')</label>
            <input
                type="text"
                class="form-input w-full"
                id="city"
                dusk="city"
                placeholder="@lang('City')"
                :value="checkout.shipping_address.city"
                @input="inputChange('shipping_address', $event)"
            >
        </div>
        <div class="col-span-12 sm:col-span-6 sm:col-start-1">
            <label class="text-gray-700 text-sm" for="telephone">@lang('Telephone')</label>
            <input
                type="text"
                class="form-input w-full"
                id="telephone"
                dusk="telephone"
                placeholder="@lang('Telephone')"
                :value="checkout.shipping_address.telephone"
                @input="inputChange('shipping_address', $event)"
            >
        </div>
    </div>

    <h1 class="font-bold text-4xl mt-5 mb-3">@lang('Shipping method')</h1>

    <div class="my-2" v-for="method in checkout.shipping_methods">
        <input
            type="radio"
            name="shipping_method"
            :value="method.carrier_code+'_'+method.method_code"
            :id="method.carrier_code+'_'+method.method_code"
            v-model="checkout.shipping_method"
        >
        <label :for="method.carrier_code+'_'+method.method_code">@{{ method.method_title }}</label>
    </div>

    <button
        type="submit"
        class="btn btn-primary mt-3"
        :disabled="$root.loading"
        dusk="continue"
    >
        @lang('Continue')
    </button>
</form>
