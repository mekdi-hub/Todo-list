<script setup>
import api from "../../api/axios";
import { useRouter } from "vue-router";
import { useToast } from "vue-toastification";
import Swal from "sweetalert2";
const toast = useToast();
const router = useRouter();
const props = defineProps({
  category: {
    type: Object,
  },
});
const emit = defineEmits(["category-deleted"]);

const deleteCategory = async () => {
  const result = await Swal.fire({
    title: "Delete Category?",
    text: "This action cannot be undone.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#dc2626",
    cancelButtonColor: "#6b7280",
    confirmButtonText: "Delete",
    cancelButtonText: "Cancel",
  });

  if (!result.isConfirmed) return;
  try {
    await api.delete(`/categories/${props.category.id}`);
    toast.success("Category deleted successfully!");
    emit("category-deleted");
  } catch (error) {
    console.log(error);
    toast.error("Failed to delete category.");
  }
};

const editCategory = () => {
  router.push(`/categories/edit/${props.category.id}`);
  
};
</script>
<template>
  <div class="category-card">
    <img
      v-if="category.image"
      :src="`http://127.0.0.1:8000/storage/${category.image}`"
      class="category-image"
    />
    <div v-else class="no-image">No Image</div>
    <div class="category-content">
      <h2>
        {{ category.name }}
      </h2>

      <p>
        {{ category.description }}
      </p>

      <div class="actions">
        <button @click="deleteCategory" class="delete-btn">Delete</button>
        <button @click="editCategory" class="edit-btn">Edit</button>
      </div>
    </div>
  </div>
</template>
<style scoped>
.category-card {
  background: white;
  border-radius: 18px;
  overflow: hidden;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
  transition: 0.3s;
}
.category-card:hover {
  transform: translateY(-5px);
}
.category-image {
  width: 100%;
  height: 180px;
  object-fit: cover;
}
.no-image {
  height: 180px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #e5e7eb;
  color: #6b7280;
}
.category-content {
  padding: 20px;
}
.category-content h2 {
  color: #064e3b;
  font-size: 22px;
  font-weight: 700;
  margin-bottom: 10px;
}
.category-content p {
  color: #6b7280;
  line-height: 1.5;
}
.actions {
  display: flex;
  gap: 10px;
  margin-top: 20px;
}
.actions button {
  padding: 8px 15px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
}
.delete-btn {
  background: #dc2626;
  color: white;
}

.edit-btn {
  background: #064e3b;
  color: white;
}
</style>
