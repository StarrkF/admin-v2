<script setup>

import { ref, onMounted, reactive } from 'vue'
// import datatable from './components/categories/datatable.vue';
import useApi from './api';

const { getData, showData, deleteData } = useApi();

const title = ref(['Id', 'Type', 'Category', 'Number', 'Action'])
const categories = ref()
const page_types = ref()
const categorySection = ref()

const category = ref({
    id: null, name: null, page_type_id: null, number: null
})

onMounted(() => {
    getCategory()
    getTypes()

})

console.log()

const getCategory = async () => {
    let response = await getData('/category')
    categories.value = response.data
}

const showCategory = async (id) => {
    categorySection.value = true
    let response = await showData('/category', id)
    category.value.id = response.data.id
    category.value.name = response.data.name
    category.value.page_type_id = response.data.page_type_id
    category.value.number = response.data.number
}

const deleteCategory = async (id) => {
    await deleteData('/category', id)
    getCategory()
}

const getTypes = async () => {
    let response = await getData('/get-types')
    page_types.value = response.data
}

const hideUpdateSection = () => {
    categorySection.value = false
    console.log(categorySection.value)
}

const swalDel = (id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
                'The Category Category has been deleted.',
                'success'
            )
            deleteCategory(id)
        }

    })
}

</script>

<template>
    <div class="mb-3" v-show="categorySection">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label>Category</label>
                    <input type="text" class="form-control" v-model="category.name">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Number</label>
                    <input type="number" class="form-control" v-model="category.number">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Page Type</label>
                    <select class="form-select" v-model="category.page_type_id">
                        <option v-for="pagetype in page_types" :value="pagetype.id">{{ pagetype.name }}</option>
                    </select>
                </div>
            </div>
        </div>

        <button class="btn btn-success">Save</button>
        <button class="btn btn-danger mx-2" @click="hideUpdateSection()">Cancel</button>

    </div>



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
                <td>{{ category.page_type?.name }}</td>
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
</template>

