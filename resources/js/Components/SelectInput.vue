<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue','options', 'placeholder']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <select
        class="focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        :value="modelValue"
        @change="$emit('update', $event.target.value)"
        ref="input">
        <option value="0" disabled>{{ placeholder }}</option>
        <option v-for="op in options" :key="op.i" :value="op.id">
        {{ op.name }}
        </option>
    </select>
</template>
