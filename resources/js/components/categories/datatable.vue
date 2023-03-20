<script setup>
import { toRef, ref } from 'vue';


const props = defineProps(['title', 'data'])
const title = props.title;
const data = toRef(props, 'data')
const category_id = ref()

const clickUpdate = (id) => {
    category_id.value = id
}




</script>

<template>
    <table class="table">
        <thead>
            <tr>
                <th v-for="item in title" scope="col">{{ item }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="category in data">
                <th scope="row">{{ category.id }}</th>
                <td>{{ category.page_type?.name }}</td>
                <td>{{ category.name }}</td>
                <td>{{ category.number }}</td>
                <td>
                    <button type="button" class="btn btn-success" @click="clickUpdate(category.id)">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</template>
