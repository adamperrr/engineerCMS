<template>
    <div>
        <div class="form-group">
            <label for="content">Zawartość:</label>
            <textarea type="text" id="content" name="content" class="form-control" placeholder="Podaj zawartość">
                {{ content }}
            </textarea>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['subpage', 'appurl'],
        data() {
            return {
                content: ''
            }
        },
        mounted() {
            this.content = this.subpage.content;
        }
    }
</script>
