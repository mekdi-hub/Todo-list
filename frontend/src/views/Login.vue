<script setup>
import Navbar from '../components/layout/Navbar.vue'
import Basebutton from '../components/ui/Basebutton.vue'
import BaseInput from '../components/ui/BaseInput.vue'
import Footer from '../components/layout/Footer.vue'
import BaseCard from '../components/ui/BaseCard.vue'
import { ref }from 'vue'
import { useRouter } from 'vue-router'
import api from '../api/axios'
const email=ref('')
const password=ref('')
const message= ref('')
const router = useRouter()
const login = async() => {
if (email.value === '' || password.value === '') {
 message.value = 'Please fill in all fields'
  return 
}
try {

const response = await api.post('/login',{
    email: email.value,
    password: password.value
})

localStorage.setItem(
  'token',
  response.data.token
)

localStorage.setItem(
  'user',
  JSON.stringify(response.data.user)
)

message.value = "Login successful 👏👏"
router.push('/dashboard')
}
catch(error){
console.log(error.response.data)
 router.push('/dashboard')
 message.value = 'Login failed'
}

  
}
</script>

<template>

<Navbar />

<div >
<div class="card">
<h1>Welcome Back</h1>
<BaseInput placeholder="email" v-model="email" type="email" />
<BaseInput placeholder="Password" v-model="password" type="password" />
<Basebutton @click="login">Login</BaseButton>
<p>{{ message }}</p>
</div>
</div>
<Footer/>

</template>

<style scoped>
 .card{
  background-color:white;
  display:flex;
  flex-direction:column;
  margin:100px;
  align-items:center;
box-shadow: 0 2px 10px rgba(0,0,0,0.1);
border-radius:10px;
padding :20px;
  }
@media (max-width: 768px) {
  .hero-section {
    padding: 1rem 1.5rem 1.5rem;
  }
  
  .hero-image img {
    max-width: 16rem;
  }
  
  .hero-title {
    font-size: 1.875rem;
    margin-bottom: 0.75rem;
  }
  
  .hero-description {
    font-size: 0.9375rem;
    margin-bottom: 1.25rem;
  }
  
  .button-group {
    margin-bottom: 1.5rem;
  }
 
}
</style>