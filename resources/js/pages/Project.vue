<script setup>
import { ref, onMounted, watchEffect, computed } from 'vue'
import CardBasic from '../components/card-basic.vue';
import Accordion from '../components/accordion.vue';
import useApi from '../api';

const { getData } = useApi();
const projects = ref()
const searchText = ref()
const loading = ref(false)
const title = ref([
    'Company Name',
    'Name',
    'Budget',
    'Status',
    'Company Address',
    'Country',
    'Company Phone',
    'Company Email',
    'Detail',
    'Notes',
])

const getProject = async () => {
    loading.value = true
    let response = await getData('/project', 1, null, searchText.value, null, null ) //Temporary Solution
    projects.value = response.data
    loading.value = false
}

onMounted(() => {
    getProject()
})

</script>

<template>
    <CardBasic>
        <CardBasic title="Utils">
            <div class="input-group mb-3">
                <input type="text" class="form-control" v-model="searchText">
                <button class="btn btn-primary px-5" type="button" @click="getProject()">Search</button>
            </div>
        </CardBasic>
        <div class="table-area">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th v-for="item in title" scope="col">
                            {{ item }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="loading">
                        <td colspan="100" class="text-center">
                            <div class="spinner-border m-5" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </td>
                    </tr>
                    <tr v-else v-for="project in projects">
                        <td>{{ project.company_name }}</td>
                        <td>{{ project.name }}</td>
                        <td>{{ project.budget }}$</td>
                        <td>{{ project.status }}</td>
                        <td>{{ project.company_address }}</td>
                        <td>{{ project.company_country }}</td>
                        <td>{{ project.company_phone }}</td>
                        <td>{{ project.company_email }}</td>
                        <td style="max-width: 100px;" class="text-truncate" :title="project.detail">{{ project.detail }}</td>
                        <td style="max-width: 100px;" class="text-truncate" :title="project.notes">{{ project.notes }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </CardBasic>
</template>
