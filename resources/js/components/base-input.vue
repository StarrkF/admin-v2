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

</script>

<template>
    <label v-if="label" class="font-bold">{{ label }}</label>
      <input class="form-control"
      type="text"
       :placeholder="label"
       :value="modelValue"
       @input="$emit('update:modelValue', $event.target.value)"
       v-bind="$attrs"
       :class="{'is-invalid':error}"
       >
      <small v-if="error" class="text-danger">Invalid Input</small>
</template>
