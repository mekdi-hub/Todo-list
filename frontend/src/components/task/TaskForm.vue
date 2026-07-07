<script setup>
import { ref, watch, onMounted } from "vue";
import BaseButton from "../ui/BaseButton.vue";
import BaseInput from "../ui/BaseInput.vue";
import api from "../../api/axios";
const categories = ref([]);
const category_id = ref("");

const getCategories = async () => {
  try {
    const response = await api.get("/categories");
    categories.value = response.data.data;
  } catch (error) {
    console.log(error);
  }
};

onMounted(() => {
  getCategories();
});
const props = defineProps({
  task: {
    type: Object,
    default: null,
  },
});

const title = ref("");
const description = ref("");
const due_date = ref("");
const priority = ref("Low");
const due_time = ref("");
const status = ref("Pending");
const message = ref("");
const emit = defineEmits(["Task-submit"]);

watch(
  () => props.task,
  (newTask) => {
    if (newTask) {
      title.value = newTask.title;
      description.value = newTask.description;
      due_date.value = newTask.due_date;
      due_time.value = newTask.due_time;
      priority.value = newTask.priority;
      status.value = newTask.status;
      category_id.value = newTask.category_id ?? "";
    }
  },
  {
    immediate: true,
  },
);
const submitTask = () => {
  emit("Task-submit", {
    category_id: category_id.value,
    title: title.value,
    description: description.value,
    due_date: due_date.value,
    due_time: due_time.value,
    priority: priority.value,
    status: status.value,
  });
};
</script>

<template>
  <div class="task-form">
    <label>Category</label>

    <select v-model="category_id">
      <option disabled value="">Select Category</option>
      <option
        v-for="category in categories"
        :key="category.id"
        :value="category.id"
      >
        {{ category.name }}
      </option>
    </select>
    <BaseInput v-model="title" placeholder="Title" class="input" />
    <textarea v-model="description" placeholder="Description"></textarea>
    <BaseInput
      v-model="due_date"
      placeholder="Due Date"
      type="date"
      class="input"
    />
    <BaseInput v-model="due_time" placeholder="Due Time" type="time" />
    <label>Priority</label>
    <select v-model="priority">
      <option value="Low">Low</option>
      <option value="Medium">Medium</option>
      <option value="High">High</option>
    </select>
    <BaseButton @click="submitTask">
      {{ task ? "update Task" : "Create Task" }}
    </BaseButton>
    <p class="message">{{ message }}</p>
  </div>
</template>

<style scoped>
.task-form {
}

.task-form h2 {
  color: #064e3b;
  font-size: 28px;
  font-weight: 800;
  margin-bottom: 30px;
  text-align: center;
}
label {
  display: block;
  color: #064e3b;
  font-size: 15px;
  font-weight: 600;
  margin-bottom: 8px;
}

.input,
textarea,
select {
  width: 100%;
  padding: 14px 16px;
  margin-bottom: 20px;
  border: 1px solid #d1d5db;
  border-radius: 12px;
  font-size: 15px;
  color: #334155;
  outline: none;
  transition: 0.3s;
}

textarea {
  min-height: 130px;
  resize: vertical;
}

.input:focus,
textarea:focus,
select:focus {
  border-color: #064e3b;
  box-shadow: 0 0 0 3px rgba(6, 78, 59, 0.12);
}

select {
  background: white;
  cursor: pointer;
}

.task-form button {
  width: 100%;
  margin-top: 10px;
}

.message {
  color: #16a34a;
  font-weight: 600;
  text-align: center;
  margin-top: 15px;
}

@media (max-width: 768px) {
  .task-form {
    padding: 20px;
  }

  .task-form h2 {
    font-size: 24px;
  }
}
</style>
