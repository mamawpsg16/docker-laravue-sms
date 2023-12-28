<template>
    <Create/>
    <div class="row">
        <div class="col-10 mx-auto my-2">
            <div class="d-flex justify-content-between mb-2">
                <div id="export">
                     <!-- <div class="d-flex justify-content-center align-items-center">
                        <select class="form-select" v-model="selectedExportOption" @change="handleExport">
                            <option  value="" disabled selected>Export Options</option>
                            <option  v-for="(option,index) in exportOptions" :value="index" :key="index">{{ option.name }}</option>
                        </select>
                    </div> -->
                </div>
                <div id="import">
                    <button type="button" class="btn btn-secondary text-end me-2">
                        <i class="fa-solid fa-file-import"></i>
                    </button>
                    <button type="button" class="btn btn-secondary text-end me-2">
                        <i class="fa-solid fa-file-export"></i>
                    </button>
                    <button type="button" class="btn btn-primary text-end me-2" data-bs-toggle="modal" data-bs-target="#student-registration-modal">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
           </div>
            <Dataset :data="data" :columns="columns">
                <template #body="{ data, index }">
                    <tr>
                        <td>{{ data.first_name }}</td>
                        <td>{{ data.birth_date }}</td>
                    </tr>
                </template>
            </Dataset>
        </div>
    </div>
</template>

<script>
import Create from './Create.vue';
// import Show from './Show.vue';
// import image1 from '../../../assets/images/1.png'
import Modal from '@/components/Modal/modal.vue';
import { formatDate, formatCurrency } from '@/helpers/Formatter/index.js';
// import { swalSuccess, swalError, Swal } from '@/composables/sweetAlert.js';
import axios from 'axios';
import Dataset from '@/components/Dataset/Index.vue';
// const auth_token = `Bearer ${localStorage.getItem('auth-token')}`;
    export default {
        name:'Registration Index',
        data(){
            return{
                isExportAll:false,
                data:[
                  
                ],
                columns:[
                    {
                        name:'Name',
                        field:'first_name',
                        sort:''
                    },
                    {
                        name:'Class',
                        field:'first_name',
                        sort:''
                    },
                    {
                        name:'Section',
                        field:'first_name',
                        sort:''
                    },
                    {
                        name:'Birth Date',
                        field:'birth_date',
                        sort:''
                    }
                ],
                auth_token: `Bearer ${localStorage.getItem('auth-token')}`
            }
        },
        components: {
            Dataset,
            Modal,
            Create
        },
        async created(){
            this.students();
        },
        methods:{
            async students(){
                await axios.get('/api/registrations', { 
                    headers: {
                        Authorization: this.auth_token
                    }
                })
                .then((response) => {
                    const { students } = response.data;
                    console.log(students, response);

                })
                .catch((error) =>{
                    console.log(error,'ERROR');
                });
            },
        },
    }
</script>

<style scoped>
</style>