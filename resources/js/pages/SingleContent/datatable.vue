<script setup>

import { ref } from 'vue';
import useApi from '../../api';
import CardBasic from '../../components/card-basic.vue';

const { getData, showData, deleteData, storeData, updateData, swalSuccess, swalError, swalTrigger } = useApi();

const posts = ref()

const getPosts = async (page = 1) => {
    let response = await getData('/post', page, byPageType.value, search.value, byPagination.value, orderBy.value)
    posts.value = response.data
    // currentPage.value = response.meta.current_page
    // lastPage.value = response.meta.last_page
}

</script>

<template>
<CardBasic>



</CardBasic>
</template>
