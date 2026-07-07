<script setup>

import BaseButton from '../components/ui/BaseButton.vue'
import BaseInput from '../components/ui/BaseInput.vue'
import CategoryCard from '../components/Categories/CategoryCard.vue'
import CategoryForm from '../components/Categories/CategoryForm.vue'

import { ref, onMounted} from 'vue'
import { useRouter } from 'vue-router'
import api from "../api/axios"
const router = useRouter()
const categories = ref([])
const goToCreateCategories=()=>{
    router.push('/categories/create')
}
const getCategories = async()=>{
    try{
        const response = await api.get('/categories')

        categories.value = response.data.data

    }catch(error){

        console.log(error)
    }
}
onMounted(()=>{
    getCategories ()
})
</script>


<template>

  <main class="categories-page">

    <div class="page-header">
     <div class="header-text">
      <h1>Categories</h1>
      <p>Organize your tasks with categories.</p>
</div>
      <BaseButton @click="goToCreateCategories">
        + New Category
      </BaseButton>
    </div>


<div class="categories-grid">

    <CategoryCard
        v-for="category in categories"
        :key="category.id"
        :category="category"
        @category-deleted="getCategories"
    />

</div>
   
  </main>

</template>

<style scoped>
.categories-page{
  max-width:1200px;
  margin:0 auto;
  padding:50px 30px;
  min-height:calc(100vh - 200px);
}
.page-header{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:40px;
}
.page-header h1{
  font-size:42px;
  font-weight:800;
  color:#064e3b;
  margin-bottom:8px;
  letter-spacing:-1px;
}
.page-header p{
  color:#64748b;
  font-size:16px;

}
.categories-grid{
    display:grid;
    grid-template-columns:
    repeat(auto-fill,minmax(280px,1fr));
    gap:25px;
}
.categories-grid:empty::after{
    content:"No categories found. Create your first category.";
    display:block;
    text-align:center;
    color:#64748b;
    padding:50px;
    background:white;
    border-radius:20px;
}


@media(max-width:768px){

.categories-page{

    padding:30px 15px;

}


.page-header{

    flex-direction:column;

    align-items:flex-start;

    gap:20px;

}


.page-header h1{

    font-size:32px;

}


.categories-grid{

    grid-template-columns:1fr;
}
}
</style>