<template>
    <div class="d-flex justify-content-between mt-2">
        <div>
            <router-link class="ms-5" :to="{ name:'registration-index'}" >Registration</router-link>
            <router-link class="ms-5" :to="{ name:'dashboard'}" >Dashboard</router-link>
        </div>
        <button class="btn btn-secondary me-5" @click="logout" >Logout</button>
    </div>
    <router-view></router-view>
</template>

<script>
import axios from 'axios';
    export default {
        name:'App',
        data(){
            return{
                token: localStorage.getItem('auth-token')
            }
        },
        methods:{
           logout(){
            axios.post('/api/logout',null,{
                headers:{
                    Authorization: `Bearer ${this.token}`
                }
            }).then((response) =>{
                localStorage.removeItem('auth-token');
                this.$router.push({ name: 'login' });
            }).catch((error) =>{
                console.log(error);
            })
           }
        }
    }
</script>

<style lang="scss">
@import '@/../css/app.css';
@import '@/../scss/app.scss';
</style>