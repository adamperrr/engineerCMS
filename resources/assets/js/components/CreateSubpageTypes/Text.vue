<template>
    <div>
        <div class="form-group">
            <label for="content">Zawartość:</label>
            <textarea type="text" id="content" name="content" class="form-control" placeholder="Podaj zawartość"></textarea>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['appurl'],
        data() {
            return {

            }
        }
    }
</script>
