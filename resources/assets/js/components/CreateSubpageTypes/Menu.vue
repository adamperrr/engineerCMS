<template>
    <div>
        <input type="hidden" name="content" :value="JSON.stringify(links)">

        <table class="table table-hover">
            <tr>
                <td colspan="2">Przemieść</td>
                <td>Nazwa</td>
                <td>Link</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="5">
                    <button type="button" class="form-control" v-on:click.prevent="addTop()">
                        <span class="glyphicon glyphicon-plus"></span>
                        Dodaj link
                    </button>
                </td>
            </tr>
            <tr v-for="(link, index) in links">
                <td>
                    <button type="button" class="form-control" v-on:click.prevent="moveUp(index)">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </button>
                </td>
                <td>
                    <button type="button" class="form-control" v-on:click.prevent="moveDown(index)">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </button>
                </td>
                <td><input type="text" class="form-control" placeholder="nazwa" v-model="link.name"></td>
                <td><input type="text" class="form-control" placeholder="url" v-model="link.url"></td>
                <td>
                    <button type="button" class="form-control" v-on:click.prevent="removeLink(index)">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <button type="button" class="form-control" v-on:click.prevent="addBottom()">
                        <span class="glyphicon glyphicon-plus"></span>
                        Dodaj link
                    </button>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                links: []
            }
        },
        props: ['page_id', 'appurl'],
        computed: {
            dataForRequest(){
                return {
                    params: {
                        pageId: this.page_id
                    }
                }
            }
        },
        methods: {
            fetchSubpages() {
                this.$http.get(this.appurl + '/admin/subpage/get_subpages_by_page_id', this.dataForRequest)
                    .then(response => response.json())
                    .then(result => {
                        let subpages = result.data;
                        for(let i = 0; i < subpages.length; i++)
                        {
                            this.links.push({ name: subpages[i].title, url: '#subpage' + subpages[i].id });
                        }
                    });
            },
            removeLink(index) {
                this.links.splice(index, 1);
            },
            moveUp(index) {
                if(index != 0)
                {
                    let x = index;
                    let y = index-1;

                    var origin = this.links[x];
                    this.links[x] = this.links[y];
                    Vue.set(this.links, y, origin);
                }
            },
            moveDown(index) {
                if(index != this.links.length-1)
                {
                    let x = index;
                    let y = index+1;

                    var origin = this.links[x];
                    this.links[x] = this.links[y];
                    Vue.set(this.links, y, origin);
                }
            },
            addTop() {
                this.links.unshift({ name: '', url: '' });
            },
            addBottom() {
                this.links.push({ name: '', url: '' });
            },
        },
        mounted() {
            this.fetchSubpages();
        }
    }
</script>
