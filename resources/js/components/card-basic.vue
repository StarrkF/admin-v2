<script setup>
const props = defineProps(['title'])
</script>

<template>
    <div class="card">
        <div class="card-header" v-show="title">
            <h5 class="">{{ title }}</h5>
        </div>
        <div class="card-content">
            <div class="card-body">
                <slot></slot>
            </div>
        </div>
    </div>
</template>


