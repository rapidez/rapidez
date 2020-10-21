<h1 class="font-bold text-4xl mb-5">Credentials</h1>

<form class="w-2/3" v-on:submit.prevent="save(['credentials'], 3)">
    <div class="grid grid-cols-12 col-gap-4 mb-3">
        <label class="col-span-12 text-gray-700 text-sm" for="firstname">Name</label>
        <div class="col-span-6">
            <input
                type="text"
                class="form-input w-full"
                id="firstname"
                dusk="firstname"
                placeholder="Firstname"
                :value="checkout.shipping_address.firstname"
                @input="inputChange('shipping_address', $event)"
            >
        </div>
        <div class="col-span-4">
            <input
                type="text"
                class="form-input w-full"
                id="lastname"
                dusk="lastname"
                placeholder="Lastname"
                :value="checkout.shipping_address.lastname"
                @input="inputChange('shipping_address', $event)"
            >
        </div>
    </div>

    <div class="grid grid-cols-12 col-gap-4 mb-3">
        <div class="col-span-3">
            <label class="text-gray-700 text-sm" for="zipcode">Postcode</label>
            <input
                type="text"
                class="form-input w-full"
                id="zipcode"
                dusk="zipcode"
                placeholder="Zipcode"
                :value="checkout.shipping_address.zipcode"
                @input="inputChange('shipping_address', $event)"
            >
        </div>
        <div class="col-span-3">
            <label class="text-gray-700 text-sm" for="housenumber">Housenumber</label>
            <input
                type="text"
                class="form-input w-full"
                id="housenumber"
                dusk="housenumber"
                placeholder="Nr."
                :value="checkout.shipping_address.housenumber"
                @input="inputChange('shipping_address', $event)"
            >
        </div>
    </div>

    <div class="grid grid-cols-12 col-gap-4 mb-3">
        <div class="col-span-6">
            <label class="text-gray-700 text-sm" for="street">Street</label>
            <input
                type="text"
                class="form-input w-full"
                id="street"
                dusk="street"
                placeholder="Street"
                :value="checkout.shipping_address.street"
                @input="inputChange('shipping_address', $event)"
            >
        </div>
    </div>

    <div class="grid grid-cols-12 col-gap-4 mb-3">
        <div class="col-span-6">
            <label class="text-gray-700 text-sm" for="city">City</label>
            <input
                type="text"
                class="form-input w-full"
                id="city"
                dusk="city"
                placeholder="City"
                :value="checkout.shipping_address.city"
                @input="inputChange('shipping_address', $event)"
            >
        </div>
    </div>

    <div class="grid grid-cols-12 col-gap-4 mb-3">
        <div class="col-span-6">
            <label class="text-gray-700 text-sm" for="telephone">Telephone</label>
            <input
                type="text"
                class="form-input w-full"
                id="telephone"
                dusk="telephone"
                placeholder="Telephone"
                :value="checkout.shipping_address.telephone"
                @input="inputChange('shipping_address', $event)"
            >
        </div>
    </div>

    <h1 class="font-bold text-4xl mt-5 mb-3">Shipping method</h1>

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
        Continue
    </button>
</form>
