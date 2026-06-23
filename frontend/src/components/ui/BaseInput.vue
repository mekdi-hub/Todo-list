<script setup>

defineProps({
  placeholder: String,
   modelValue: String,
   type:String
})
const emit = defineEmits([
  'update:modelValue'
])
</script>

<template>

<input :placeholder="placeholder" :value="modelValue" class="input" @input="emit('update:modelValue',$event.target.value)">

</template>
<style scoped>

.input{
display:flex;
padding:10px 20px;
border-radius:5px;
margin:20px;

}


</style>
