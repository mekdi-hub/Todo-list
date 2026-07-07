<script setup>
import { useRouter } from "vue-router";
import BaseButton from "../ui/BaseButton.vue";

defineProps({
  task: Object,
  compact: {
    type: Boolean,
    default: false,
  },
});
const router = useRouter();
const editTask = (id) => {
  router.push(`/tasks/edit/${id}`);
};
</script>

<template>
  <div :class="['task-card', { compact }]">
    <h3>{{ task.title }}</h3>
    <p>{{ task.description }}</p>
    <p>
      Category:
      {{ task.category?.name || "No Category" }}
    </p>
    <p>Due: {{ task.due_date }}</p>
    <p class="status">Status: {{ task.status }}</p>
    <div class="task-actions">
      <BaseButton> Complete </BaseButton>

      <button class="style">Delete</button>

      <button @click="editTask(task.id)" class="style update">Edit</button>
    </div>
  </div>
</template>
<style scoped>
.task-card {
  background: white;
  padding: 16px;
  border-radius: 14px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  margin-bottom: 20px;
  transition: 0.3s ease;
  border-left: 5px solid darkgreen;
}

.task-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.task-card h3 {
  margin: 0 0 12px;
  font-size: 18px;
  font-weight: bold;
  color: darkgreen;
}

.task-card p {
  margin: 8px 0;
  color: #555;
  font-size: 16px;
}

.status {
  display: inline-block;
  background: #fff3cd;
  color: #856404;
  padding: 6px 14px;
  border-radius: 20px;
  font-size: 14px;
  font-weight: bold;
}

.task-actions {
  display: flex;
  gap: 12px;
  margin-top: 20px;
}

.style {
  border: none;
  border-radius: 8px;
  color: white;
  background-color: darkred;
  padding: 10px 18px;
  cursor: pointer;
  font-weight: bold;
  transition: 0.3s ease;
}

.style:hover {
  opacity: 0.8;
  transform: scale(1.05);
}

.update {
  background-color: #006699;
}
.today-section {
  max-width: 900px;
}
.task-card.compact {
  padding: 15px;
  width: 300px;
  border-left: 4px solid darkgreen;
}

.task-card.compact h3 {
  font-size: 18px;
  margin-bottom: 8px;
}

.task-card.compact p {
  font-size: 14px;
  margin: 5px 0;
}

.task-card.compact .task-actions {
  margin-top: 10px;
}

.task-card.compact button {
  padding: 6px 12px;
  font-size: 13px;
}

@media (max-width: 600px) {
  .task-card {
    padding: 18px;
  }

  .task-actions {
    flex-direction: column;
  }

  .style {
    width: 100%;
  }
}
</style>
