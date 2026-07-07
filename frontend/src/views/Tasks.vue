<script setup>
import BaseButton from "../components/ui/BaseButton.vue";
import BaseInput from "../components/ui/BaseInput.vue";
import TaskTable from "../components/task/TaskTable.vue";
import TaskFilter from "../components/task/TaskFilter.vue";
import { useRouter } from "vue-router";
import { ref, onMounted } from "vue";
import api from "../api/axios";
const router = useRouter();
const tasks = ref([]);
const goToCreateTask = () => {
  router.push("/tasks/create");
};

const getTasks = async () => {
  try {
    const response = await api.get("/tasks");

    tasks.value = response.data.data;
  } catch (error) {
    console.log(error);
  }
};
onMounted(() => {
  getTasks();
});

const filterTasks = async (filters) => {
  console.log(filters);
  try {
    const response = await api.get("/tasks", {
      params: filters,
    });
    console.log(response.data);
    tasks.value = response.data.data;
  } catch (error) {
    console.log(error);
  }
};
</script>
<template>
  <main class="tasks-page">
    <div class="tasks-header">
      <h1>My Tasks</h1>

      <BaseButton @click="goToCreateTask"> + New Task </BaseButton>
    </div>

    <TaskFilter @filter-change="filterTasks" />

    <div class="table-card">
      <TaskTable
        :tasks="tasks"
        @task-updated="getTasks"
        @task-deleted="getTasks"
      />
    </div>
  </main>
</template>
<style scoped>
.tasks-page {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 30px;
  min-height: calc(100vh - 200px);
}
.tasks-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 40px;
}
.tasks-header h1 {
  color: #064e3b;
  font-size: 42px;
  font-weight: 800;
}

.table-card {
  background: white;
  padding: 25px;
  border-radius: 16px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
}

@media (max-width: 768px) {
  .tasks-page {
    padding: 30px 15px;
  }
  .tasks-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 20px;
  }
  .tasks-header h1 {
    font-size: 32px;
  }
}
</style>
