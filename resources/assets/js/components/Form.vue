<template>
    <div class="form">
        <form action="store" method="POST" id="lead" @submit.prevent="submit" ref="form">
            <pre v-if="lead">{{ lead.name }}</pre>
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
    import qs from 'qs';
    export default {
        data() {
            return {
                name: null,
                email: null,
                status: 'subscribed',
                lead: null,
            }
        },

        methods: {
            submit() {
                this.$validator.validateAll().then(result => {
                    if (result) {
                        axios.post('/store', qs.stringify(this.$data))
                        .then( response => {
                            this.lead = response.data;
                            console.log('success lead craeted');
                        }).catch(error => {
                            console.log(error);
                        });
                    }
                });
            },

            subscribe() {
                let data = new FormData();
                data.append('email', this.email);
                data.append('name', this.name);
                data.append('status', this.status);

                axios({
                    method :'post',
                    url : 'http://mailchimp.dev/subscribe',
                    data   : data
                })
                .then(function (response) {
                    console.log(response.data);
                })
                .catch(function (error) {
                    console.log(error.data);
                });
            }
        },

    }
</script>

