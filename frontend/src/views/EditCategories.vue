<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import api from "../api/axios";
import CategoryForm from "../components/Categories/CategoryForm.vue";

const route = useRoute();
const router = useRouter();

const category = ref(null);
const getCategory = async () => {
  try {
    const response = await api.get(`/categories/${route.params.id}`);
    console.log(response.data);
    category.value = response.data.data;
  } catch (error) {
    console.log(error);
  }
};
const updateCategory = async (formData) => {
  try {
    await api.post(`/categories/${route.params.id}`, formData, {
      headers: { "Content-Type": "multipart/form-data" },
      params: { _method: "PUT" },
    });
    router.push("/categories");
  } catch (error) {
    console.log(error.response);
  }
};
onMounted(() => {
  getCategory();
});
</script>
<template>
  <main class="edit-page">
    <section class="edit-header">
      <h1>Edit Category</h1>
      <p>Update your category information</p>
    </section>
    <div class="form-card">
      <CategoryForm
        v-if="category"
        :category="category"
        @category-submit="updateCategory"
      />
    </div>
  </main>
</template>

<style scoped>
.edit-page {
  max-width: 900px;
  margin: 0 auto;
  padding: 50px 30px;
  min-height: calc(100vh - 200px);
}
.edit-header {
  margin-bottom: 30px;
}
.edit-header h1 {
  color: #064e3b;
  font-size: 42px;
  font-weight: 800;
  margin-bottom: 10px;
}
.edit-header p {
  color: #64748b;
  font-size: 18px;
}

@media (max-width: 768px) {
  .edit-page {
    padding: 30px 15px;
  }
  .edit-header h1 {
    font-size: 32px;
  }
  .form-card {
    padding: 20px;
  }
}
</style>
