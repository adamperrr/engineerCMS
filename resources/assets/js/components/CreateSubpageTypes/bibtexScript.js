var bibtexMethods = require('../bibtexMethods');
var processBibtex = require('../processBibtex');

export default {
    props: ['appurl'],

    data() {
        return {
            selectedFileId: 0,
            filesOptions: [],

            hasBibtexResponse: false,
            isBibtexLoadedCorrect:false,
            loadedBibtexData: [],
            processedBibtexData: [],
            bibtexStyleType: 'plain',

            newAttribute: []
        }
    },
    computed: {
        dataForBibtexFileRequest(){
            return {
                params: {
                    bibtexId: this.selectedFileId
                }
            }
        },
        resultStrings(){
            // generowanie wedle wybranego stylu
            return JSON.stringify(this.processedBibtexData);
        }
    },
    watch: {
        selectedFileId: function (val) {
            this.fetchFileById();
        }
    },
    methods: {
        fetchFilesOptions() {
            this.$http.get(this.appurl + '/admin/subpage/get_bibtex_files_list')
                .then(response => response.json())
                .then(result => this.filesOptions = result.data);
        },
        fetchFileById() {
            this.$http.get(this.appurl + '/admin/subpage/get_bibtex_content_from_file', this.dataForBibtexFileRequest)
                .then(response => response.json())
                .then(result => {
                    this.hasBibtexResponse = true;
                    this.isBibtexLoadedCorrect = (result.status === 'success');
                    this.loadedBibtexData = result.data;
                    this.processBibtexData(result.data);
                });
        },
        processBibtexData(bibtexElements) {
            this.processedBibtexData = processBibtex.process(bibtexElements);
        },
        removeElement(index) {
            this.processedBibtexData.splice(index, 1);
        },
        removeField(index, key) {
            Vue.delete(this.processedBibtexData[index], key);
        },
        chooseStyle() {
            this.loadedBibtexData = bibtexMethods.chooseStyle(this.loadedBibtexData, this.bibtexStyleType);
        },
        showDifferenceTypes(element) {
            return bibtexMethods.showDifferenceTypes(element);
        },
        addNewAttribute(elementIndex, attributeType) {
            Vue.set(this.processedBibtexData[elementIndex], attributeType, '');
        },
        getFinalContent() {
            return {
                style: this.bibtexStyleType,
                json: this.processedBibtexData,
                // strings: this.resultStrings
            };
        }
    },
    created(){
        this.fetchFilesOptions();
    }

};