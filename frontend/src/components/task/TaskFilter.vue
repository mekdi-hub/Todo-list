<script setup>
import { ref, watch } from "vue";

const emit = defineEmits(["filter-change"]);

const search = ref("");
const status = ref("");
const priority = ref("");
const sort = ref("");

watch(
  [search, status, priority, sort],

  () => {
    emit("filter-change", {
      search: search.value,

      status: status.value,

      priority: priority.value,

      sort: sort.value,
    });
  },
);
</script>

<template>
  <div class="filter-box">
    <input v-model="search" type="text" placeholder="Search tasks..." />

    <select v-model="status">
      <option value="">All Status</option>

      <option value="Completed">Completed</option>

      <option value="Pending">Pending</option>
    </select>

    <select v-model="priority">
      <option value="">All Priority</option>

      <option value="High">High</option>

      <option value="Medium">Medium</option>

      <option value="Low">Low</option>
    </select>

    <select v-model="sort">
      <option value="">Sort By</option>

      <option value="latest">Latest</option>

      <option value="oldest">Oldest</option>

      <option value="priority">Priority</option>
    </select>
  </div>
</template>

<style scoped>
.filter-box {
  display: flex;

  gap: 15px;

  background: white;

  padding: 20px;

  border-radius: 18px;

  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);

  margin-bottom: 30px;
}

input,
select {
  padding: 12px 16px;

  border-radius: 10px;

  border: 1px solid #d1d5db;

  font-size: 15px;

  outline: none;
}

input {
  flex: 1;
}

input:focus,
select:focus {
  border-color: #064e3b;
}

@media (max-width: 768px) {
  .filter-box {
    flex-direction: column;
  }
}
</style>
