<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";

import api from "../api/axios";
import TaskForm from "../components/task/TaskForm.vue";

const route = useRoute();
const router = useRouter();

const task = ref("");

const getTask = async () => {
  try {
    const response = await api.get(`/tasks/${route.params.id}`);
    task.value = response.data;
  } catch (error) {
    console.log(error);
  }
};
const updateTask = async (data) => {
  try {
    await api.put(`/tasks/${route.params.id}`, data);
    router.push("/tasks");
  } catch (error) {
    console.log(error);
  }
};
onMounted(() => {
  getTask();
});
</script>

<template>
  <main class="edit-task-page">
    <section class="edit-task-header">
      <h1>Edit Task</h1>
      <p>Update your task information</p>
    </section>
    <div class="form-card">
      <TaskForm v-if="task" :task="task" @task-submit="updateTask" />
    </div>
  </main>
</template>
<style scoped>
.edit-task-page {
  max-width: 900px;
  margin: 0 auto;
  padding: 50px 30px;
  min-height: calc(100vh - 200px);
}

.edit-task-header {
  margin-bottom: 30px;
}

.edit-task-header h1 {
  color: #064e3b;
  font-size: 42px;
  font-weight: 800;
  margin-bottom: 10px;
}

.edit-task-header p {
  color: #64748b;
  font-size: 18px;
}

.form-card {
  background: white;
  padding: 35px;
  border-radius: 20px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
}
@media (max-width: 768px) {
  .edit-task-page {
    padding: 30px 15px;
  }
  .edit-task-header h1 {
    font-size: 32px;
  }
  .form-card {
    padding: 20px;
  }
}
</style>
