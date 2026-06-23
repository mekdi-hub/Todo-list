<script setup>
import BaseButton from '../ui/BaseButton.vue'
defineProps({
task:Object
})
</script>

<template>
<div class ="task-card">

    <h3>{{task.title}}</h3>
    <p>{{task.description}}</p>
    <p>Due: {{task.dueDate}}</p>
    <p>Status: {{task.status}}</p>
</div>
<BaseButton>
Complete
</Basebutton>

<button class="style">
Delete
</button>

<button class="style update">
Update
</button>
</template>
<style scoped>
.task-card{

background:white;
padding:20px;
border-radius:10px;
box-shadow:0 3px 10px rgba(0,0,0,0.1);
margin-bottom:15px;

}

.style{
border-radius:4px;
color:white;
background-color:darkred;
margin-right:10px;
padding:10px 20px;
cursor:pointer;
}
.style:hover{
background-color:transparent;
color:black;
transition:0.3s;

}
.update{
background-color:#006699;
}
</style>