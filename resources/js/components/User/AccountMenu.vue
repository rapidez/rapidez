<template>
    <div>
        <div v-if="this.$root.user" class="group">
            Logged in as: {{ this.$root.user.firstname }}
            <div class="hidden absolute w-40 bg-white border z-10 group-hover:block">
                <a
                    href="#"
                    class="block hover:bg-secondary px-3 py-2"
                    @click.prevent="logout()"
                >
                    Logout
                </a>
            </div>
        </div>
        <div v-else>
            <a href="/login">My account</a>
        </div>
    </div>
</template>

<script>
    import InteractWithUser from './mixins/InteractWithUser'

    export default {
        mixins: [InteractWithUser],
    }
</script>
