<script>
import BaseButton from '../ui/BaseButton.vue'
</script>

<template>
<nav class="navbar">
  <div class="navibar">
    <h1>TODO</h1>
  </div>
  <div>
 
    <router-link to="/login" class="nav-link"> <BaseButton>Login </BaseButton></router-link>
   <router-link to="/Register" class="nav-link"> <BaseButton>Register </BaseButton></router-link>
  </div>
  </nav>
</template>
<style scoped>
.navbar{
    border-radius:5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f0f0f0;
    padding: 20px 50px;
    background-color: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  }
  .nav-link {
  margin-left: 20px;
  text-decoration: none;
  color: white;
  background-color:darkgreen;
  padding:8px 15px;
  border-radius:5px;
}
.nav-butt-link {
  margin-left: 20px;
  text-decoration: none;
  color: green;
  font-weight: 600;
}
.nav-link:hover{
      color: #007bff; 
      text-decoration: underline;
      
}
h1{
color:darkgreen;
font-weight:bold;
font-style:sans-serif;
font-size:20px;
}
</style>