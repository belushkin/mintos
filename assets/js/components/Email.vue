<template>
    <span class="invalid-feedback d-block mb-2">
        <span class="d-block">
            <span class="form-error-icon badge badge-danger text-uppercase">Error</span>
        </span>
        <span class="form-error-message">{{message}}</span>
    </span>
</template>
<script>
    export default {
        name: "email",
        props: ['message', 'seen'],
        data () {
            return {
                // message: null
            }
        },
        created: function () {
        }
    }
</script>
<style scoped>
</style>
