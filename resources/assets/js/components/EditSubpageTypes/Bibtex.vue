<template>
    <div>
        <input type="hidden" name="content" :value="JSON.stringify(getFinalContent())">

        <div class="form-group">
            <div v-if="isBibtexLoadedCorrect">
                <hr>
                <div class="form-group">
                    <label for="bibtexSortMethod">Styl bibliografii:</label>
                    <select class="form-control" id="bibtexSortMethod" v-model="bibtexStyleType">
                        <option value="unsrt">unsrt</option>
                        <option value="plain">plain</option>
                        <option value="abbrv">abbrv</option>
                    </select>
                </div>
            </div>
            <hr>
        </div>
        <div v-if="hasBibtexResponse" id="bibtexResult">
            <div v-if="isBibtexLoadedCorrect">
                <table class="table table-hover">
                    <tr>
                        <td>L.p.</td>
                        <td>Typ pola</td>
                        <td></td>
                    </tr>
                    <tbody v-for="(element, index) in processedBibtexData">
                    <tr>
                        <td>{{ index + 1 }}</td>
                        <td>
                            <input type="text" class="form-control" placeholder="typ" list="possibleFieldTypesList" v-model="element.entrytype.value" v-bind:required="true">
                            <datalist id="possibleFieldTypesList">
                                <option value="article"></option>
                                <option value="book"></option>
                                <option value="booklet"></option>
                                <option value="conference"></option>
                                <option value="inbook"></option>
                                <option value="incollection"></option>
                                <option value="inproceedings"></option>
                                <option value="manual"></option>
                                <option value="mastersthesis"></option>
                                <option value="misc"></option>
                                <option value="phdthesis"></option>
                                <option value="proceedings"></option>
                                <option value="techreport"></option>
                                <option value="unpublished"></option>
                            </datalist>
                        </td>
                        <td>
                            <button type="button" class="form-control" v-on:click.prevent="removeElement(index)">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <table class="table table-hover">
                                <tr v-for="(item, key) in element" v-if="key !== 'entrytype'">
                                    <td class="w-25">{{key}}</td>
                                    <td class="w-50">
                                        <input type="text" class="form-control" v-model="element[key].value"
                                               v-bind:required="element[key].required && element[key].or === undefined ||
                                           element[key].required && element[key].or !== undefined && element[element[key].or].value === ''"
                                        ><!--
                                           v-bind:disabled="element[key].or !== undefined && element[element[key].or].value !== ''"-->
                                    </td>
                                    <td class="w-25">
                                        <button v-if="!element[key].required" type="button" class="form-control" v-on:click.prevent="removeField(index, key)">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="subpage-add-new-field" v-if="showDifferenceTypes(element).length > 0">
                                    <td class="w-25">
                                        <b>Nowe pole</b>
                                    </td>
                                    <td class="w-50" colspan="2">
                                        <div class="input-group">
                                            <select class="form-control" v-model="newAttribute[index]">
                                                <option v-for="type in showDifferenceTypes(element)"
                                                        v-bind:value="type">
                                                    {{ type }}
                                                </option>
                                            </select>
                                            <span class="input-group-btn">
                                            <button type="button" class="btn btn-info" v-on:click="addNewAttribute(index, newAttribute[index])">Dodaj</button>
                                        </span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div v-else>
                <div class="alert alert-danger"><strong>Błąd!</strong> Podczas przetwarzania pliku wystąpił błąd: <strong><i> {{ loadedBibtexData }} </i></strong></div>
            </div>
        </div>
        <br>
    </div>
</template>

<script src="./bibtexScript.js"></script>
