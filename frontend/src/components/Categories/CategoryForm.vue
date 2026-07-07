<script setup>
import { ref, watch } from "vue";
import BaseButton from "../ui/BaseButton.vue";
import BaseInput from "../ui/BaseInput.vue";

const props = defineProps({
  category: {
    type: Object,
    default: null,
  },
});
const emit = defineEmits(["category-submit"]);
const name = ref("");
const description = ref("");
const image = ref("");
watch(
  () => props.category,
  (newCategory) => {
    if (newCategory) {
      name.value = newCategory.name;
      description.value = newCategory.description;
    }
  },
  {
    immediate: true,
  },
);
const handleImage = (event) => {
  image.value = event.target.files[0];
};
const submitCategory = () => {
  const formData = new FormData();
  formData.append("name", name.value);
  formData.append("description", description.value);
  if (image.value) {
    formData.append("image", image.value);
  }
  emit("category-submit", formData);
};
</script>

<template>
  <div class="category-form">
    <BaseInput v-model="name" placeholder="Category Name" />
    <input type="file" accept="image/*" @change="handleImage" />

    <textarea v-model="description" placeholder="Description"></textarea>
    <BaseButton @click="submitCategory"
      >{{ category ? "Update" : "Create" }}
    </BaseButton>
  </div>
</template>

<style scoped>
.category-form {
  background: white;
  padding: 35px;
  border-radius: 20px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
}

/* Title */

.category-form h2 {
  color: #064e3b;

  font-size: 28px;

  font-weight: 800;

  margin-bottom: 30px;

  text-align: center;
}

/* Input */

.input,
textarea {
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

.input:focus,
textarea:focus {
  border-color: #064e3b;

  box-shadow: 0 0 0 3px rgba(6, 78, 59, 0.12);
}

/* Description */

textarea {
  min-height: 140px;

  resize: vertical;
}

/* File input */

input[type="file"] {
  width: 100%;

  padding: 12px;

  margin-bottom: 20px;

  border: 1px dashed #9ca3af;

  border-radius: 12px;

  cursor: pointer;

  background: #f8fafc;
}

input[type="file"]:hover {
  border-color: #064e3b;
}

/* Button */

.category-form button {
  width: 100%;

  margin-top: 10px;
}

@media (max-width: 768px) {
  .category-form {
    padding: 20px;
  }

  .category-form h2 {
    font-size: 24px;
  }
}
</style>
