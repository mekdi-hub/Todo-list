<script setup>
import Navbar from '../components/layout/Navbar.vue'
import Footer from '../components/layout/Footer.vue'
import TaskForm from '../components/task/TaskForm.vue'
import api from '../api/axios'
import DashboardLayout from '../components/layout/DashboardLayout.vue'

import { useRouter } from 'vue-router'
const router = useRouter()

const createTask = async(data)=>{
    try{

        await api.post('/tasks', data)
        router.push('/tasks')
        
    }
    catch(error){
        console.log(error)
    }
}
</script>

<template>


  <main class="create-page">

    <div class="page-header">
      <h1>Create New Task</h1>
      <p>Organize your work and stay productive.</p>
    </div>

    <div class="form-card">
      <TaskForm @task-submit="createTask"/>
    </div>

  </main>

</template>

<style scoped>

.create-page{
  max-width:900px;
  margin:0 auto;
  padding:50px 30px;
  min-height:calc(100vh - 200px);
}

.page-header{
  margin-bottom:30px;
}

.page-header h1{
  font-size:42px;
  font-weight:800;
  color:#064e3b;
  margin-bottom:8px;
}

.page-header p{
  color:#6b7280;
  font-size:16px;
}

.form-card{
  background:white;
  border-radius:20px;
  padding:35px;
  box-shadow:0 10px 25px rgba(0,0,0,.08);
}

@media(max-width:768px){

  .create-page{
    padding:30px 15px;
  }

  .page-header h1{
    font-size:32px;
  }

  .form-card{
    padding:20px;
  }

}
</style>