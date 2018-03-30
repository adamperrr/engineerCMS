<template>
    <div>
        <form v-on:submit.prevent="sendEmail">

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Imię i nazwisko" v-model="fromName" required>
            </div>

            <div class="form-group">
                <input type="email" class="form-control" placeholder="Twój adres email" v-model="fromEmail" required>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Temat wiadomości" v-model="subject" v-bind:disabled="!isSubjectEnabled" required>
            </div>

            <div class="form-group">
                <textarea type="text" class="form-control" placeholder="Treść wiadomości" v-model="message" required></textarea>
            </div>

            <div v-if="!isEmailSent" class="form-group">
                <input type="submit" class="btn btn-primary" value="Wyślij">
            </div>
            <div v-else>
                <div class="alert alert-info">Wiadomość e-mail została wysłana.</div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['subpage', 'token', 'appurl'],

        data() {
            return {
                fromName: '',
                fromEmail: '',
                subject: '',
                message: '',

                toEmail: '',
                isSubjectEnabled: true,
                isEmailSent: false,
            }
        },
        methods: {
            fetchSubpage() {
                this.$http.post(this.appURL + '/subpage/contact/get_subpage_by_id', this.getSubpageRequest)
                    .then(response => response.json())
                    .then(result => {
                        let contactData = JSON.parse(result.data.content);
                        this.toEmail = contactData.email;
                        this.subject = contactData.subject;
                        this.isSubjectEnabled = contactData.subject == null ||contactData.subject === '';
                    },
                    error => {
                        console.dir(error);
                    });
            },
            sendEmail() {
                this.$http.post(this.appURL + '/subpage/contact/send_email', this.sendEmailRequest)
                    .then(response => response.json())
                    .then(result => {
                        this.isEmailSent = true;
                    });
            },
        },
        computed: {
            getSubpageRequest(){
                return {
                    _token: this.token,
                    subpageId: this.subpage
                }
            },
            sendEmailRequest(){
                return {
                    _token: this.token,
                    emailData: {
                        fromName: this.fromName,
                        fromEmail: this.fromEmail,
                        subject: this.subject,
                        message: this.message,
                        toEmail: this.toEmail,
                    }
                }
            },
            appURL() {
                return this.appurl;
            }
        },
        mounted(){
            this.fetchSubpage();
        }
    }
</script>
