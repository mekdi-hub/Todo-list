<script setup>
import Navbar from '../components/layout/Navbar.vue'
import Footer from '../components/layout/Footer.vue'
import BaseButton from '../components/ui/BaseButton.vue'
import BaseInput from '../components/ui/BaseInput.vue'
import TaskTable from '../components/task/TaskTable.vue'
const tasks =  [
  
]
</script>
<template>
  <Navbar />

  <main class="tasks-page">

    <div class="tasks-header">
      <h1>My Tasks</h1>

      <BaseButton>
        + New Task
      </BaseButton>
    </div>


    <div class="table-card">
      <TaskTable :tasks="tasks"/>
    </div>

  </main>

  <Footer />
</template>

<style scoped>

.tasks-page{

  max-width:1200px;
  margin:0 auto;
  padding:50px 30px;

  min-height:calc(100vh - 200px);

}


/* Title + Button */

.tasks-header{

  display:flex;
  justify-content:space-between;
  align-items:center;

  margin-bottom:40px;

}


.tasks-header h1{

  color:#064e3b;
  font-size:42px;
  font-weight:800;

}


/* Table wrapper */

.table-card{

  background:white;

  padding:25px;

  border-radius:16px;

  box-shadow:
  0 10px 25px rgba(0,0,0,0.08);

}



/* Mobile */

@media(max-width:768px){

.tasks-page{

padding:30px 15px;

}


.tasks-header{

flex-direction:column;

align-items:flex-start;

gap:20px;

}
.tasks-header h1
{
font-size:32px;
}
}
</style>


