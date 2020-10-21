<user class="my-1 mr-3" v-cloak>
    <div v-if="$root.user" class="group" slot-scope="{ logout }">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
        @{{ $root.user.firstname }}
        <div class="hidden absolute w-40 bg-white border z-10 group-hover:block">
            <a
                href="#"
                class="block hover:bg-secondary px-3 py-2"
                @click.prevent="logout()"
            >
                @lang('Logout')
            </a>
        </div>
    </div>
    <div v-else>
        <a href="/login">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
        </a>
    </div>
</user>
