<script setup>
const props = defineProps(['title'])
</script>

<template>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#accordion1" aria-expanded="false" aria-controls="flush-collapseOne">
                    {{ title ?? 'Filters' }}
                </button>
            </h2>
            <div id="accordion1" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#accordionFlushExample">
                <slot></slot>
            </div>
        </div>
    </div>
</template>
