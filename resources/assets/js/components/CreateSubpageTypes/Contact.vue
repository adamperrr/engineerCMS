<template>
    <div>
        <input type="hidden" name="content" :value="JSON.stringify(emailData)">

        <div class="form-group">
            <label for="email">Docelowy adres email:</label>
            <input id="email" type="email" class="form-control" placeholder="Podaj email" v-model="email" required>
        </div>

        <div class="form-group">
            <label for="subject">Temat wiadmości (jeśli nie zostanie podany domyślny temat użytkownicy będą mogli ustawić własny)</label>
            <input id="subject" type="text" class="form-control" placeholder="Temat wiadomości" v-model="subject">
        </div>
    </div>
</template>

<script>
    export default {
        props: ['email_prop', 'appurl'],

        data() {
            return {
                email: 'example2@example.pl',
                subject: ''
            }
        },
        computed: {
            emailData(){
                let result = {};
                result.email = this.email;

                if(this.subject !== '') {
                    result.subject = this.subject;
                }

                return result;
            }
        },
        mounted(){
            this.email = this.email_prop;
        }
    }
</script>
