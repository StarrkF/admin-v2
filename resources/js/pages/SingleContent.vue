<script setup>

import { ref } from 'vue';
import BaseInput from '../components/base-input.vue';
import CardBasic from '../components/card-basic.vue';

const title = ref();

</script>

<template>

<CardBasic>

    <BaseInput label="Input Component 1"  v-model="title"></BaseInput>

</CardBasic>

</template>

