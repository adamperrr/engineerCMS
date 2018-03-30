<template>
    <div>
        <div v-if="selectedType == 'bibtex'">
            <edit_subpage_type_bibtex v-bind:subpage="subpage" v-bind:appurl="appurl"></edit_subpage_type_bibtex>
        </div>
        <div v-else-if="selectedType == 'menu'">
            <edit_subpage_type_menu v-bind:subpage="subpage" v-bind:appurl="appurl"></edit_subpage_type_menu>
        </div>
        <div v-else-if="selectedType == 'contact'">
            <edit_subpage_type_contact v-bind:subpage="subpage" v-bind:email_prop="email" v-bind:appurl="appurl"></edit_subpage_type_contact>
        </div>
        <div v-else>
            <edit_subpage_type_text v-bind:subpage="subpage" v-bind:appurl="appurl"></edit_subpage_type_text>
        </div>
    </div>
</template>

<script>
    import edit_subpage_type_text from './Text.vue';
    import edit_subpage_type_bibtex from './Bibtex.vue';
    import edit_subpage_type_menu from './Menu.vue';
    import edit_subpage_type_contact from './Contact.vue';

    export default {
        components: {
            edit_subpage_type_text,
            edit_subpage_type_bibtex,
            edit_subpage_type_menu,
            edit_subpage_type_contact
        },

        props: [ 'subpage_str','settings_str'],

        computed: {
            subpage() {
                return JSON.parse(this.subpage_str);
            },
            settings() {
                return JSON.parse(this.settings_str);
            },
            email() {
                return JSON.parse(this.settings_str).mainEmail.value;
            },
            appurl() {
                return JSON.parse(this.settings_str).APP_URL.value;
            }
        },

        data() {
            return {
                selectedType: 'text',
            }
        },

        methods: {
            turnOnCKEditor: function(){
                if(this.selectedType == 'text') {
                    $(document).ready(function() {
                        $('#content').ckeditor();
                    });
                }
            }
        },

        mounted() {
            this.selectedType = this.subpage.type;
        }
    }
</script>
