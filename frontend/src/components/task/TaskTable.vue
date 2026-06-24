<script setup>
defineProps({
  tasks: {
    type: Array,
    default: () => []
  }
})
</script>

<template>
<div class="table-container">
<table>

<thead>

<tr>
<th>ID</th>
<th>Description</th>
<th>Title</th>
<th>Status</th>
<th>Priority</th>
<th>Due Date</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<tr v-for="task in tasks" :key="task.id">
          <td>{{ task.title }}</td>
          <td>{{ task.status }}</td>
          <td>{{ task.priority }}</td>
          <td>{{ task.due_date }}</td>

          <td class="actions">
            <button class="complete-btn">
              Complete
            </button>

            <button class="update-btn">
              Update
            </button>

            <button class="delete-btn">
              Delete
            </button>
          </td>
        </tr>

        <tr v-if="tasks.length === 0">
          <td colspan="5" class="empty">
            No tasks found
          </td>
        </tr>
</tbody>
</table>
</div>
</template>


<style scoped>
.table-container{
  background:white;
  border-radius:12px;
  overflow:hidden;
  box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

table{
  width:100%;
  border-collapse:collapse;
}

thead{
  background:#064e3b;
  color:white;
}

th,
td{
  padding:16px;
  text-align:left;
}

tbody tr{
  border-bottom:1px solid #e5e7eb;
}

tbody tr:hover{
  background:#ecfdf5;
}

.actions{
  display:flex;
  gap:10px;
}

.complete-btn{
  background:#047857;
  color:white;
  border:none;
  padding:8px 12px;
  border-radius:6px;
  cursor:pointer;
}

.update-btn{
  background:#2563eb;
  color:white;
  border:none;
  padding:8px 12px;
  border-radius:6px;
  cursor:pointer;
}

.delete-btn{
  background:#dc2626;
  color:white;
  border:none;
  padding:8px 12px;
  border-radius:6px;
  cursor:pointer;
}

.empty{
  text-align:center;
  color:gray;
}
</style>
