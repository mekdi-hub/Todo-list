<script setup>
defineProps({
  placeholder: String,
  modelValue: String,
  type: {
    type: String,
    default: "text",
  },
});
const emit = defineEmits(["update:modelValue"]);
</script>

<template>
  <input
    :type="type"
    :placeholder="placeholder"
    :value="modelValue"
    class="input"
    @input="emit('update:modelValue', $event.target.value)"
  />
</template>
<style scoped>
.input {
  display: flex;
  padding: 10px 20px;
  border-radius: 5px;
  margin: 20px;
}
</style>
