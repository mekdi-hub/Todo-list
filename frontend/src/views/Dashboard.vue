<script setup>
import { ref,onMounted} from 'vue'
import Navbar from '../components/layout/Navbar.vue'
import TaskChart from '../components/Dashboard/TaskChart.vue'
import api from '../api/axios'
import TaskCard from '../components/task/TaskCard.vue'
import TaskForm from '../components/task/TaskForm.vue'
const user = JSON.parse(localStorage.getItem('user'))
const data =ref ('')
const tasks = ref([
    {
        id:1,
        title:"Learn Vue",
        description:"Learn components and API",
        status:"pending"
    }
])
const dashboard = async() => {
 try{
  const response = await api.get('/dashboard')
  data.value = response.data
  
 }
 catch(error)
 {
  console.error(error.response.data)
 }

 }
onMounted(()=>{

  dashboard()
  })
</script>

<template>
<Navbar/>
  <div class ="dashboard">
  <h1> Dashboard </h1>
  <p>Welcome Back, {{ user.name }} 👋</p>
 
  <div class="cards" v-if="data">

<div class="card">
<h3>Total Tasks</h3>
<p>{{ data.total_tasks }}</p>
</div>


<div class="card">
<h3>Completed</h3>
<p>{{ data.completed_tasks }}</p>
</div>


<div class="card">
<h3>Pending</h3>
<p>{{ data.pending_tasks }}</p>
</div>


<div class="card">
<h3>High Priority</h3>
<p>{{ data.high_priority_tasks }}</p>
</div>


<div class="card">
<h3>Categories</h3>
<p>{{ data.total_categories }}</p>
</div>

  </div>
  </div>

  <div class="dashboards" v-if="data">
  <TaskChart :data="data"/>
  </div>
<TaskForm/>


<div v-for="task in tasks" :key="task.id">

<TaskCard :task="task"/>

</div>


</template>

<style scoped>
p{
color:darkgray;
font-size: 20px;

}
h1{
  color:darkgreen;
  font-size: 36px;
  font-weight:bold;
}
.dashboard{
padding :40px;
}
.cards
{
display: grid;
grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
gap: 20px;
margin-top: 20px;
}
.card{
box-shadow: 0 2px 4px rgba(0,0,0,0.1);
background-color: white;
padding: 20px;
border-radius: 8px;
text-align: center;

}
.card h3{
margin: 0 0 10px 0;
font-weight:bold;
color: darkgreen;

}
.card p{
margin: 0;
font-size: 24px;
font-weight: bold;
color: darkgreen;

}
@media (max-width: 768px) {
  .hero-section {
    padding: 1rem 1.5rem 1.5rem;
  }
  
  .hero-image img {
    max-width: 16rem;
  }
  
  .hero-title {
    font-size: 1.875rem;
    margin-bottom: 0.75rem;
  }
  
  .hero-description {
    font-size: 0.9375rem;
    margin-bottom: 1.25rem;
  }
  
  .button-group {
    margin-bottom: 1.5rem;
  }
}
</style>
