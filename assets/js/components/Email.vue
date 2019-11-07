<template>
    <span class="invalid-feedback d-block">
        <span class="d-block">
            <span class="form-error-icon badge badge-danger text-uppercase">Error</span>
        </span>
        <span class="form-error-message">User with such email {{message}} already exists or email is incorrect.</span>
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
            // console.log('user data from parent component:')
            // console.log(this.neffa) //prints out an empty string
            // this.$emit('neffa', this.neffa)
        }
    }
</script>
<style scoped>
</style>
