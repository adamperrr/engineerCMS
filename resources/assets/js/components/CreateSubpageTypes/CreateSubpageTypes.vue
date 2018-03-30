<template>
    <div>
        <div class="form-group">
            <label for="type">Typ podstrony:</label>
            <select class="form-control" id="type" name="type" v-on:change="turnOnCKEditor()" v-model="selectedType" required>
                <option v-for="option in typesOptions" v-bind:value="option.value">
                    {{ option.text }}
                </option>
            </select>
        </div>

        <div v-if="selectedType == 'bibtex'">
            <create_subpage_type_bibtex v-bind:appurl="appurl"></create_subpage_type_bibtex>
        </div>
        <div v-else-if="selectedType == 'menu'">
            <create_subpage_type_menu v-bind:page_id="page_id" v-bind:appurl="appurl"></create_subpage_type_menu>
        </div>
        <div v-else-if="selectedType == 'contact'">
            <create_subpage_type_contact v-bind:email_prop="email" v-bind:appurl="appurl"></create_subpage_type_contact>
        </div>
        <div v-else>
            <create_subpage_type_text v-bind:appurl="appurl"></create_subpage_type_text>
        </div>
    </div>
</template>

<script>
    import create_subpage_type_text from './Text.vue';
    import create_subpage_type_bibtex from './Bibtex.vue';
    import create_subpage_type_menu from './Menu.vue';
    import create_subpage_type_contact from './Contact.vue';

    export default {
        components: {
            create_subpage_type_text,
            create_subpage_type_bibtex,
            create_subpage_type_menu,
            create_subpage_type_contact
        },

        props: ['settings_str', 'page_id'],

        computed: {
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
                typesOptions: [
                    {text: 'Tekstowy', value: 'text'},
                    {text: 'BibTeX', value: 'bibtex'},
                    {text: 'Menu', value: 'menu'},
                    {text: 'Kontakt', value: 'contact'}
                ]
            }
        },

        methods: {
            turnOnCKEditor: function(){
                // I used 'v-on:change' instead 'watch' because 'watch' starts before change in template
                if(this.selectedType == 'text') {
                    $(document).ready(function() {
                        $('#content').ckeditor();
                    });
                }
            }
        }
    }
</script>
