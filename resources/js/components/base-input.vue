<script setup>
const props = defineProps({
    modelValue: {
        type: String,
        default: ""
    },
    label: {
        type: String,
        default: ""
    },
    error: {
        type: Boolean,
        value: false
    }
})
// const label = props.label
// const modelValue = props.modelValue
// const hasError = props.error


</script>

<template>
    <div class="col-sm-6">
        <label v-if="label" class="font-bold">{{ label }}</label>
        <div class="form-group">
            <input class="form-control"
            type="text"
             :placeholder="label"
             :value="modelValue"
             @input="$emit('update:modelValue', $event.target.value)"
             v-bind="$attrs"
             :class="{'is-invalid':error}"
             >
            <small v-if="error" class="text-danger">Invalid Input</small>
        </div>
    </div>
</template>
