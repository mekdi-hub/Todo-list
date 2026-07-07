<script setup>
import api from "../api/axios";
import { useRouter } from "vue-router";
import CategoryForm from "../components/Categories/CategoryForm.vue";
const router = useRouter();
const createCategory = async (formData) => {
  try {
    const response = await api.post("/categories", formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    });
    console.log(response.data);
    router.push("/categories");
  } catch (error) {
    console.log(error);
    console.log(error.response?.data);
  }
};
</script>

<template>
  <main class="create-page">
    <div class="page-header">
      <h1>Create New Category</h1>
      <p>Organize your work and stay productive.</p>
    </div>

    <div class="form-card">
      <categoryForm @category-submit="createCategory" />
    </div>
  </main>
</template>

<style scoped>
.create-page {
  max-width: 900px;
  margin: 0 auto;
  padding: 50px 30px;
  min-height: calc(100vh - 200px);
}

.page-header {
  margin-bottom: 30px;
}

.page-header h1 {
  font-size: 42px;
  font-weight: 800;
  color: #064e3b;
  margin-bottom: 8px;
}

.page-header p {
  color: #6b7280;
  font-size: 16px;
}

@media (max-width: 768px) {
  .create-page {
    padding: 30px 15px;
  }

  .page-header h1 {
    font-size: 32px;
  }

  .form-card {
    padding: 20px;
  }
}
</style>
