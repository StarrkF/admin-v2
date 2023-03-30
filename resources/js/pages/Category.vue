<script setup>

import { ref, onMounted, watchEffect, computed } from 'vue'
import CardBasic from '../components/card-basic.vue';
import Accordion from '../components/accordion.vue';
import useApi from '../api';

const { getData, showData, deleteData, storeData, updateData, swalSuccess, swalError, swalTrigger } = useApi();
const title = ref([
    { row: 'page_type_id', name: 'Type' },
    { row: 'name', name: 'Category' },
    { row: 'number', name: 'Number' },
    { row: 'hidden', name: 'Action' },
])
const category = ref({
    id: null,
    name: null,
    pageTypeId: null,
    number: null,
    selected: true
})
const categories = ref()
const page_types = ref()
const buttonSection = ref()
const isLoading = ref(true);
const byPageType = ref()
const byPagination = ref(10)
const orderBy = ref({ row: 'number', type: 'asc', selected: true })
const search = ref()
const currentPage = ref(1)
const allSelected = ref(false)
const deleteSelectSection = ref(false)
const hiddenColumns = ref([])
let lastPage = ref()

onMounted(() => {
    getCategory()
    getTypes()
    isLoading.value = false
})

watchEffect(() => {
    if (categories.value) {
        allSelected.value = categories.value.every(category => category.selected)
        deleteSelectSection.value = categories.value.some(category => category.selected)
    }
})

const getCategory = async (page) => {
    let response = await getData('/category', page, byPageType.value, search.value, byPagination.value, orderBy.value)
    categories.value = response.data
    currentPage.value = response.meta.current_page
    lastPage.value = response.meta.last_page
}

const storeCategory = async () => {
    let response = await storeData('/category', category.value)
    response.message == 'success' ? swalSuccess() : swalError()
    clearCategory()
    getCategory()
}

const showCategory = async (id) => {
    let response = await showData('/category', id)
    category.value = response.data
    buttonSection.value = true
}

const updateCategory = async () => {
    let response = await updateData('category', category.value.id, category.value)
    response.message == 'success' ? swalSuccess('Category Updated!') : swalError('Category Did Not Update!')
    getCategory()
    cancelButton()
}

const deleteCategory = async (id) => {
    if (Array.isArray(id)) {
        const result = await Promise.all(id.map(index => deleteData('/category', index)))
        const message = result.every(category => category.message == 'success')
        getCategory()
        return message
    } else {
        let response = await deleteData('/category', id)
        getCategory()
        return response.message == 'success' ? true : false
    }

}

const getTypes = async () => {
    let response = await getData('/types')
    page_types.value = response.data
}

const cancelButton = () => {
    clearCategory()
    buttonSection.value = false;
}

const swalDel = (id) => {
    swalTrigger(() => deleteCategory(id))
}

const deleteSelected = () => {
    const selectedCategories = computed(() => {
        return categories.value.filter(category => category.selected)
    })
    const ids = selectedCategories.value.map(category => category.id)
    swalDel(ids)
}

const clearCategory = () => {
    category.value = { id: null, name: null, page_type_id: null, number: null }
}

const selectAll = () => {
    allSelected.value == !allSelected.value
    categories.value.forEach(category => category.selected = allSelected.value)
}

const orderChange = (row, order) => {
    orderBy.value = { row: row, type: order, selected: true }
    getCategory()
}

const toggleColumn = (column) => {
    console.log(hiddenColumns.value)
    if (hiddenColumns.value.includes(column)) {
        hiddenColumns.value = hiddenColumns.value.filter(c => c !== column);
    } else {
        hiddenColumns.value.push(column);
    }
}

</script>

<template>
    <div class="row">
        <CardBasic>
            <div class="row gx-5">
                <CardBasic class="col-3" title="Add Category">
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
                </CardBasic>

                <div class="col-9">
                        <button class="btn btn-danger float-end px-5 mb-2" @click="deleteSelected()"
                            v-show="deleteSelectSection">Delete Selected</button>
                    <Accordion title="Utilities">
                        <CardBasic>
                            <div class="row">
                                <div class="form-group col-2">
                                    <label class="text-black font-bold">Hide/Show</label>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                            Columns
                                        </button>
                                        <div class="dropdown-menu">
                                            <a v-for="item in title" role="button" class="dropdown-item"
                                                :class="{ 'active': !hiddenColumns.includes(item.row) }"
                                                @click="toggleColumn(item.row)">{{ item.name }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-2">
                                    <label class="text-black">Per Page</label>
                                    <select class="form-select" v-model="byPagination" @change="getCategory()">
                                        <option :value="10">10</option>
                                        <option :value="25">25</option>
                                        <option :value="50">50</option>
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label class="text-black">Filter Page Type</label>
                                    <select class="form-select" v-model="byPageType" @change="getCategory()">
                                        <option selected value="">Clear Filter</option>
                                        <option v-for="pagetype in page_types" :value="pagetype.id">{{ pagetype.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label class="text-black">Search Term</label>
                                    <input type="text" class="form-control" v-model="search" @input="getCategory()">
                                </div>
                            </div>
                        </CardBasic>
                    </Accordion>
                    <div class="table-area">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" v-model="allSelected" @change="selectAll"
                                                class="form-check-input form-check-primary form-check-glow">
                                        </div>
                                    </th>
                                    <th v-for="item in title" :key="item.name" scope="col"
                                        v-show="!hiddenColumns.includes(item.row)">
                                        <a @click="orderChange(item.row, 'asc')">
                                            <i class="fa-solid fa-xs orderBy fa-arrow-up" v-show="item.row != 'hidden'"></i>
                                        </a>
                                        <a @click="orderChange(item.row, 'desc')">
                                            <i class="fa-solid fa-xs orderBy fa-arrow-down"
                                                v-show="item.row != 'hidden'"></i>
                                        </a>
                                        {{ item.name }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="category in categories">
                                    <th style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox"
                                                class="form-check-input form-check-primary form-check-glow"
                                                id="checkboxGlow{{ category.id }}" v-model="category.selected">
                                        </div>
                                    </th>
                                    <td v-show="!hiddenColumns.includes('page_type_id')">{{ category.page_type_name }}</td>
                                    <td v-show="!hiddenColumns.includes('name')">{{ category.name }}</td>
                                    <td v-show="!hiddenColumns.includes('number')">{{ category.number }}</td>
                                    <td v-show="!hiddenColumns.includes('hidden')">
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

                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item" :class="{ disabled: currentPage === 1 }">
                                <a role="button" class="page-link" @click="getCategory((currentPage - 1))">Previous</a>
                            </li>
                            <li class="page-item" v-for="page in lastPage" :key="page"
                                :class="{ active: page === currentPage }">
                                <a role="button" class="page-link" @click="getCategory(page)">{{ page }}</a>
                            </li>
                            <li class="page-item" :class="{ disabled: currentPage === lastPage }">
                                <a role="button" class="page-link" @click="getCategory(currentPage + 1)">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </CardBasic>
    </div>
</template>

<style>
.table-area {
    max-height: 75vh;
    overflow: auto;
}

thead {
    background-color: white;
    position: sticky;
    top: 0px;
}

.orderBy {
    color: rgb(196, 196, 196);
}

.orderBy:hover,
.orderBy:active {
    color: rgb(75, 75, 75);
    cursor: pointer;
}

.order-select {
    color: #000;
}
</style>

