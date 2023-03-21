<script setup>

import { ref, onMounted, reactive } from 'vue'
// import datatable from './components/categories/datatable.vue';
import CardBasic from './components/card-basic.vue';
import useApi from './api';

const { getData, showData, deleteData, storeData, updateData, swalSuccess, swalError, swalTrigger } = useApi();

const title = ref(['Id', 'Type', 'Category', 'Number', 'Action'])
const categories = ref()
const page_types = ref()
const buttonSection = ref()
const isLoading = ref(true);

const category = ref({
    id: null,
    name: null,
    pageTypeId: null,
    number: null
})

onMounted(() => {
    getCategory()
    getTypes()
    isLoading.value = false
})

const getCategory = async () => {
    let response = await getData('/category')
    categories.value = response.data
}

const storeCategory = async () => {
    let response = await storeData('/category', category.value)
    response.message == 'success' ? swalSuccess() : swalError()
    clearCategory()
    getCategory()
}

const showCategory = async (id) => {
    buttonSection.value = true
    let response = await showData('/category', id)
    category.value = response.data

}

const updateCategory = async () => {
    let response = await updateData('category', category.value.id, category.value)
    response.message == 'success' ? swalSuccess('Category Updated!') : swalError('Category Did Not Update!')
    getCategory()
    cancelButton()
}

const deleteCategory = async (id) => {
    let response = await deleteData('/category', id)
    getCategory()
    return response.message == 'success' ? true : false
}

const getTypes = async () => {
    let response = await getData('/get-types')
    page_types.value = response.data
}

const cancelButton = () => {
    clearCategory()
    buttonSection.value = false;
}

const swalDel = (id) => {
    swalTrigger(() => deleteCategory(id))
}

const clearCategory = () => {
    category.value = { id: null, name: null, page_type_id: null, number: null }
}



</script>

<template>
    <div class="row">
        <div v-if="!isLoading">
            <CardBasic>
                <div v-if="isLoading" class="d-flex justify-content-center align-items-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="row gx-5">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" v-model="category.name">
                        </div>
                        <div class="form-group">
                            <label>Number</label>
                            <input type="number" class="form-control" v-model="category.number">
                        </div>
                        <div class="form-group">
                            <label>Page Type</label>
                            <select class="form-select" v-model="category.page_type_id">
                                <option v-for="pagetype in page_types" :value="pagetype.id">{{ pagetype.name }}
                                </option>
                            </select>
                        </div>

                        <button class="btn btn-primary" @click="storeCategory()" v-show="!buttonSection">Add</button>
                        <button class="btn btn-success" @click="updateCategory()" v-show="buttonSection">Save</button>
                        <button class="btn btn-danger mx-2" @click="cancelButton()" v-show="buttonSection">Cancel</button>

                    </div>
                    <div class="col-9">
                        <!-- <datatable :title="title" :data="categories"></datatable> -->

                        <table class="table">
                            <thead>
                                <tr>
                                    <th v-for="item in title" scope="col">{{ item }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="category in categories">
                                    <th scope="row">{{ category.id }}</th>
                                    <td>{{ category.page_type_name }}</td>
                                    <td>{{ category.name }}</td>
                                    <td>{{ category.number }}</td>
                                    <td>
                                        <button type="button" class="btn btn-success" @click="showCategory(category.id)">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" @click="swalDel(category.id)">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </CardBasic>
        </div>
        <div v-else>
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

    </div>
</template>

