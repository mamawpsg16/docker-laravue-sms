<template>
    <Create/>
    <Show :student_details="student_details"/>
    <loading v-model:active="isLoading" :is-full-page="fullPage" color="#3176FF" :height="150" :weight="150" :opacity="0.4" loader="dots"/>
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
                        <td>{{ data.name }}</td>
                        <td>{{ data.date_of_birth }}</td>
                        <td>{{ data.gender }}</td>
                        <td>{{ data.school_year }}</td>
                        <td>{{ data.enrollment_status }}</td>
                        <td class="text-center"><button class="btn btn-sm btn-primary" @click="viewStudentDetails(data.id)"><i class="fa-solid fa-eye"></i></button></td>
                    </tr>
                </template>
            </Dataset>
        </div>
    </div>
</template>

<script>
import Create from './Create.vue';
import Show from './Show.vue';
import Modal from '@/components/Modal/modal.vue';
import { formatDate, titleCase } from '@/helpers/Formatter/index.js';
import {SwalDefault } from '@/helpers/Notification/sweetAlert.js';
import axios from 'axios';
import Dataset from '@/components/Dataset/Index.vue';
import Loading from 'vue-loading-overlay';

    export default {
        name:'Registration Index',
        data(){
            return{
                isExportAll:false,
                data:[],
                columns:[
                    {
                        name:'Name',
                        field:'name',
                        sort:''
                    },
                    {
                        name:'Birth Date',
                        field:'date_of_birth',
                        sort:''
                    },
                    {
                        name:'Gender',
                        field:'gender',
                        sort:''
                    },
                    {
                        name:'School Year',
                        field:'school_year',
                        sort:''
                    },
                    {
                        name:'Enrollment Status',
                        field:'enrollment_status',
                        sort:''
                    },
                    {
                        name:'Action',
                        field:'',
                        sort:''
                    }
                ],
                student_details:null,
                auth_token: `Bearer ${localStorage.getItem('auth-token')}`,
                isLoading: false,
                fullPage: false
            }
        },
        components: {
            Dataset,
            Modal,
            Create,
            Show,
            Loading
        },
        async created(){
            await this.students();
        },
        methods:{
            async students(){
                await axios.get('/api/student', { 
                    headers: {
                        Authorization: this.auth_token
                    }
                })
                .then((response) => {
                    const { students } = response.data;
                    const data = students?.map(student=>{
                        const middle_name = student.middle_name ? `${ titleCase(student.middle_name)}.` : '';
                        return {
                            ...student,
                            name: `${ titleCase(student.first_name)} ${middle_name} ${ titleCase(student.last_name) }`,
                            date_of_birth: formatDate(undefined, student.date_of_birth, 'date'),
                            gender: student.gender.name,
                            school_year: student.enrollments[0].school_year.name,
                            enrollment_status: student.enrollments[0].status
                        }
                    });

                    this.data = data;
                }).catch((error) =>{
                    console.log(error,'ERROR');
                });
            },

            async viewStudentDetails(student_id){
                const id = document.getElementById('student-details-modal');
                const modal = bootstrap.Modal.getOrCreateInstance(id);
                this.isLoading = true;
                await axios.get(`/api/student/${student_id}`, {
                    headers:{
                        Authorization: this.auth_token
                    }
                }).then((response) => {
                    const { student } = response.data;
                    console.log(student,'student');
                    
                    const middle_name = student.middle_name ? `${ titleCase(student.middle_name)}.` : '';
                    const birth_date = formatDate(undefined, student.date_of_birth, 'date');
                    
                    this.student_details = {
                            ...student,
                            name: `${ titleCase(student.first_name)} ${middle_name} ${ titleCase(student.last_name) }`,
                            health_information:{
                                ...student.health_information,
                                last_health_checkup: formatDate(undefined, student.health_information.last_health_checkup, 'date'),
                            },
                            basic_information:{
                                first_name:  student.first_name,
                                middle_name: student.middle_name,
                                last_name: student.last_name,
                                email: student.email,
                                phone_number_1:student.phone_number_1,
                                phone_number_2:student.phone_number_2,
                                date_of_birth:student.date_of_birth,
                                date_of_birth_name: birth_date,
                                gender_name: student.gender.name,
                                school_year_name: student.enrollments[0].school_year.name,
                                school_year: {
                                    label:student.enrollments[0].school_year.name,
                                    value:student.enrollments[0].school_year.id
                                },
                                gender: {
                                    label:student.gender.name,
                                    value:student.gender.id,
                                },
                            }
                    }; 

                }).catch((error) => {
                    console.log(error)
                });
                this.isLoading = false;
                modal.show();
               
            }
        },
    }
</script>

<style scoped>
</style>