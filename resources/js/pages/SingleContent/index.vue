<script setup>
import { reactive, ref } from 'vue';
import useApi from '../../api';
import BaseInput from '../../components/base-input.vue';
import CardBasic from '../../components/card-basic.vue';
import SwitchButton from '../../components/switch-button.vue'

const { getData, showData, deleteData, storeData, updateData, swalSuccess, swalError, swalTrigger } = useApi()

const title = ref();
const hasError = ref(false)
const post = ref({
    id: null,
    title: null,
    description: null,
    key: null,
    number: null,
    content: null,
    status: null,
    image: null,
    summary: null,
})

const getCategory = async (page) => {
    let response = await getData('/category', page, byPageType.value, search.value, byPagination.value, orderBy.value)
    post.value = response.data
}

// console.log(Object.values(post.value).some(value => value === null));

// console.log(Object.keys(post.value))

</script>

<template>
    <CardBasic>

        <div class="row">
            <div class="col-md-1">
                <SwitchButton label="Status" />
            </div>

            <div class="col-md-5">
                <BaseInput label="Number" type="number" :error="hasError" v-model="post.number" />
            </div>

            <div class="col-md-6">
                <BaseInput label="Title" :error="hasError" v-model="post.title" />
            </div>

            <div class="col-md-6">
                <BaseInput label="Description" :error="hasError" v-model="post.description" />
            </div>

            <div class="col-md-6">
                <BaseInput label="Key" :error="hasError" v-model="post.key" />
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>Summary</label>
                    <textarea v-model="post.summary" maxlength="255" class="form-control" placeholder="Content"
                        rows="3"></textarea>
                    <small>{{ post.summary?.length ?? 0 }}/255</small>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>Content</label>
                    <QuillEditor toolbar="full" style="height: 500px;" />
                </div>
            </div>
        </div>
    </CardBasic>
</template>

<style>
.col-md-6 {
    margin-bottom: 30px;
}

.ck-content {
    min-height: 500px;
}
</style>

