<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { useRouter } from "vue-router";
import api from "../../api/axios";
import { useToast } from "vue-toastification";
import Swal from "sweetalert2";
import { EllipsisVertical } from "lucide-vue-next";
const openMenu = ref(null);
const handleClickOutside = () => {
  openMenu.value = null;
};
onMounted(() => {
  document.addEventListener("click", handleClickOutside);
});

onBeforeUnmount(() => {
  document.removeEventListener("click", handleClickOutside);
});
const toast = useToast();
const router = useRouter();
const toggleMenu = (taskId) => {
  openMenu.value = openMenu.value === taskId ? null : taskId;
};
const props = defineProps({
  tasks: {
    type: Array,
    required: true,
  },
});
const emit = defineEmits(["task-deleted", "task-updated"]);
const editTask = (id) => {
  router.push(`/tasks/edit/${id}`);
};
const deleteTask = async (id) => {
  const result = await Swal.fire({
    title: "Delete Task?",
    text: "This action cannot be undone.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#dc2626",
    cancelButtonColor: "#6b7280",
    confirmButtonText: "Delete",
    cancelButtonText: "Cancel",
  });
  if (!result.isConfirmed) {
    return;
  }
  try {
    await api.delete(`/tasks/${id}`);
    toast.success("Task deleted successfully!");
    emit("task-deleted");
  } catch (error) {
    toast.error("Failed to delete task.");
    console.log(error);
  }
};

const updateStatus = async (id) => {
  try {
    await api.patch(`/tasks/${id}/update-status`);
    toast.success("Task status updated successfully!");
    emit("task-updated");
  } catch (error) {
    toast.error("Failed to update task status.");
    console.log(error);
  }
};
</script>

<template>
  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Description</th>
          <th>Category</th>
          <th>Status</th>
          <th>Priority</th>
          <th>Due Date</th>
          <th>Due Time</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="task in tasks" :key="task.id">
          <td>{{ task.id }}</td>
          <td>{{ task.title }}</td>
          <td>{{ task.description }}</td>
          <td>
            {{ task.category ? task.category.name : "No Category" }}
          </td>
          <td>{{ task.status }}</td>

          <td>{{ task.priority }}</td>
          <td>{{ task.due_date }}</td>

          <td>{{ task.due_time }}</td>
          <td class="actions">
            <button class="menu-button" @click.stop="toggleMenu(task.id)">
              <EllipsisVertical :size="18" />
            </button>

            <div v-if="openMenu === task.id" @click.stop class="dropdown">
              <button
                v-if="task.status === 'Pending'"
                @click="updateStatus(task.id)"
              >
                <Check :size="16" />
                Complete
              </button>

              <button v-else @click="updateStatus(task.id)">
                <RotateCcw :size="16" />
                Undo
              </button>

              <button @click="editTask(task.id)">Edit</button>

              <button @click="deleteTask(task.id)">Delete</button>
            </div>
          </td>
        </tr>

        <tr v-if="tasks.length === 0">
          <td colspan="5" class="empty">No tasks found</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<style scoped>
.table-container {
  background: white;
  border-radius: 12px;
  overflow-x: auto;
  overflow-y: visible;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

table {
  width: 100%;
  min-width: 1000px;
  border-collapse: collapse;
}

thead {
  background: #064e3b;
  color: white;
}

th,
td {
  padding: 16px;
  text-align: left;
}

tbody tr {
  border-bottom: 1px solid #e5e7eb;
  position: relative;
}

tbody tr:hover {
  background: #ecfdf5;
}

.actions {
  position: relative;
}

.menu-button {
  border: none;
  background: none;
  cursor: pointer;
  padding: 8px;
  border-radius: 8px;
}

.menu-button:hover {
  background: #f3f4f6;
}

.dropdown {
  position: absolute;
  right: 0;
  top: 40px;
  width: 160px;
  background: white;
  border-radius: 10px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
  border: 1px solid #e5e7eb;
  z-index: 9999;
}

.dropdown button {
  width: 100%;
  padding: 12px 16px;
  border: none;
  background: none;
  text-align: left;
  cursor: pointer;
}
.dropdown.up {
  top: auto;
  bottom: 40px;
}
.dropdown button:hover {
  background: #f8fafc;
}
.empty {
  text-align: center;
  color: gray;
}
</style>
