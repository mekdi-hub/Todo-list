<script setup>
import {ref} from 'vue'
import BaseButton from '../ui/BaseButton.vue'
import api from '../../api/axios'
const title = ref('')
const description = ref('')
const due_date=ref('')
const priority=ref('')

const createTask= async()=>{
   const response = await api.post('/tasks',{
    title: title.value,
    description: description.value,
    due_date: due_date.value,
    priority:priority.value
});

    console.log(response.data)
    
    title.value=''
    description.value=''
    due_date.value=''
    priority.value='low'
    emit('task-created')

}

</script>

<template>
<div class=" task-form">
<h2>Create Task</h2>

<input v-model="title" placeholder="Title"/>
<textarea v-model="description" placeholder="Description"></textarea>
<input v-model="due_date" placeholder="Due Date" type="date"/>

<select v-model="priority">
<option value="low">Low</option>
<option value="medium">Medium</option>
<option value="high">High</option>

</select>
<BaseButton @click="createTask"> AddTask </BaseButton>
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