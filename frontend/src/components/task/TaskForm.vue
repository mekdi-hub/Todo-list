<script setup>
import {ref} from 'vue'
import BaseButton from '../ui/BaseButton.vue'

const title = ref('')
const description = ref('')

</script>

<template>
<div class=" task-form">
<h2>Create Task</h2>

<input v-model="title" placeholder="Title"/>
<textarea v-model="description" placeholder="Description"></textarea>
<BaseButton> AddTask </BaseButton>
</div>
</template>

<style scoped>
.task-form{

background:white;
padding:20px;
border-radius:10px;
margin-bottom:20px;

}


input,textarea{
width:100%;
padding:10px;
margin-bottom:10px;
}

</style>