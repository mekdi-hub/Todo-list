<script setup>
import Navbar from '../components/layout/Navbar.vue'
import BaseButton from '../components/ui/BaseButton.vue'
import BaseInput from '../components/ui/BaseInput.vue'
import BaseCard from '../components/ui/BaseCard.vue'
import { ref } from 'vue'
import api from '../api/axios'
const email=ref('')
const password=ref('')
const name=ref('')
const confirmPassword=ref('')
const message=ref('')
const register = async()=>{

    if(email.value === '' || password.value === ''|| name.value === '' || confirmPassword.value === '')
    {
        message.value = ' This fields cannot be empty '
        return
    }
    if ( password.value !== confirmPassword.value)
     {
        message.value='Passwords do not match'
        return
      } 
      try {
   
    const response = await api.post('/register', {
      name: name.value,
      email: email.value,
       password: password.value,
       password_confirmation: confirmPassword.value
    })
    
      message.value= ' Registered successfully 👏'
    }
    catch (error) {
    console.log(error.response.data)
    message.value = 'Registratin faild'

   }
}
</script>

<template>
<Navbar/>
<div class="card">

<h1>Create Account</h1>
<BaseInput v-model="name" type="text" placeholder="Name"/>
<BaseInput v-model="email" type="email" placeholder="Email"/>
<BaseInput v-model="password" type="password" placeholder="Password"/>
<BaseInput v-model="confirmPassword" type="password" placeholder="Confirm Password"/>
<BaseButton @click='register'>Register</BaseButton>
<p>{{message}}</p>

</div>
</template>

<style scoped>

</style>