<template>
  <button class="btn">
    <slot></slot>
  </button>
</template>
<style scoped>
.btn{
background-color:#064e3b;
color:white;
border:none;
padding:10px 20px;
border-radius:5px;
cursor:pointer;
font-size: 16px;
font-weight: 600;
transition: 0.3s;
margin :10px;
}
.btn:hover{
background-color:#065f46
}

</style>