<toggler v-slot="{ isOpen, toggle }">
    <div>
        {{ $button }}

        <div class="fixed inset-0 overflow-hidden md:static md:block z-30" :class="isOpen ? 'pointer-events-auto' : 'pointer-events-none'">
            <div class="absolute inset-0 overflow-hidden md:static">
                <transition
                    enter-active-class="ease-in-out duration-500"
                    enter-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="ease-in-out duration-500"
                    leave-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <div v-show="isOpen" @click="toggle" class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity md:hidden-important"></div>
                </transition>
                <section class="absolute inset-y-0 right-0 pl-10 max-w-full flex pointer-events-auto md:static md:pl-0">
                    <transition
                        enter-active-class="transform transition ease-in-out duration-500 sm:duration-700"
                        enter-class="translate-x-full"
                        enter-to-class="translate-x-0"
                        leave-active-class="transform transition ease-in-out duration-500 sm:duration-700"
                        leave-class="translate-x-0"
                        leave-to-class="translate-x-full"
                    >
                        <div v-show="isOpen" class="w-screen max-w-md md:block-important">
                            <div class="h-full flex flex-col space-y-6 py-6 bg-white shadow-xl overflow-y-scroll md:py-0 md:space-y-0">
                                <header class="px-4 md:hidden">
                                    <div class="flex items-start justify-between space-x-3">
                                        <h2 class="text-lg leading-7 font-medium text-gray-900">
                                            @lang('Filters')
                                        </h2>
                                        <div class="h-7 flex items-center">
                                            <button aria-label="@lang('Close filters')" class="text-gray-400 hover:text-gray-500 transition ease-in-out duration-150" @click="toggle">
                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </header>
                                <div class="relative flex-1 px-4 md:pl-0">
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </transition>
                </section>
            </div>
        </div>
    </div>
</toggler>
