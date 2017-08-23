<template>
    <div class="form">
        <form action="store" method="POST" id="lead" @submit.prevent="submit" ref="form">
            <label>
                Name
                <input v-validate="'required'" type="text" name="name" v-model="name">
                <span class="form-error" v-show="errors.has('name')">{{ errors.first('name') }}</span>
            </label>

            <label>
                Email
                <input v-validate="'required|email'" type="email" name="email" v-model="email">

                <span v-show="errors.has('email')" class="form-error">{{ errors.first('email') }}</span>
            </label>

           <button class="button" type="submit">Enviar</button>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        data() {
            return {
                name: null,
                email: null,
                status: 'subscribed'
            }
        },

        methods: {
            submit() {
                this.$validator.validateAll().then(result => {
                    if (result) {
                        this.$refs.form.submit();
                    }
                });
            }
        },

        subscribe() {
            axios({
                method :'post',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                url : 'http://mailchimp.dev/store',
                data   : `name=${this.name}&email=${this.email}&status=${this.status}`,
            })
            .then(function (response) {
                alert('success');
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    }
</script>

