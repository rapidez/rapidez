<login v-slot="{ email, password, go, loginInputChange, emailAvailable }">
    <div class="flex justify-center">
        <form class="p-8 border rounded" v-on:submit.prevent="go()">
            <h1 class="font-bold text-4xl text-center mb-5">@lang('Checkout')</h1>
            <input
                class="form-input w-full"
                id="email"
                type="email"
                dusk="email"
                placeholder="@lang('Email')"
                :value="email"
                @input="loginInputChange"
            >
            <input
                v-if="!emailAvailable"
                class="form-input w-full mt-3"
                id="password"
                type="password"
                dusk="password"
                placeholder="@lang('Password')"
                :value="password"
                @input="loginInputChange"
            >
            <button
                type="submit"
                class="btn btn-primary w-full mt-5"
                :disabled="$root.loading"
                dusk="continue"
            >
                @lang('Continue')
            </button>
        </form>
    </div>
</login>
