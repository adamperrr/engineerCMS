var bibtexMethods = require('../bibtexMethods');
var processBibtex = require('../processBibtex');

export default {
    props: ['subpage', 'appurl'],
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
    mounted(){
        this.hasBibtexResponse = true;
        this.isBibtexLoadedCorrect = true;
        let content = JSON.parse(this.subpage.content);
        this.bibtexStyleType = content.style;
        this.processedBibtexData = content.json;
    }

};