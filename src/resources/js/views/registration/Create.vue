<template>
    <Modal class="modal-xl" targetModal="student-registration-modal" modaltitle="Registration" :backdrop="true" :escKey="false">
        Student Registration
        <template #body>
            <form-wizard finishButtonText="Register" ref="formWizard" subtitle="Student Registration" :validateOnBack="true" color="rgb(94, 141, 204)">
                <tab-content title="Student Information" icon="fa-solid fa-user" :beforeChange="validateStudentDetails">
                <!-- <div class="d-flex align-items-center mb-3">
                    <div class="col-10">
                        <div class="d-flex flex-column align-items-center text-end">
                            <label for="formFile" class="form-label">Student Image</label>
                            <img :src="defaultProfileImage" class="img-fluid mb-4" style="height:250px; width:300px;" alt="Default Profile Image">
                            <input class="form-control" type="file" id="formFile" style="width:250px;">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="d-flex flex-column align-items-end mb-4">
                            <div class="col-12  mb-3">
                                <label>Gender <span class="text-danger">*</span></label>
                                <VueMultiselect v-model="selectedGender" track-by="label" label="label" placeholder="Select Gender" :allow-empty="false" :options="options"></VueMultiselect>
                            </div>
                            <div class="col-12  mb-3">
                                <label>Date of Birth <span class="text-danger">*</span></label>
                                <VueDatePicker v-model="student.date_of_birth" :class="{ 'is-invalid': v$.student.date_of_birth.$dirty && (v$.student.date_of_birth.required.$invalid) }" placeholder="Select Birth Date" format="MM-dd-yyyy" required></VueDatePicker>
                                <div  v-if="v$.student.date_of_birth.$dirty" :class="{ 'invalid-feedback':(v$.student.date_of_birth.required.$invalid )}">
                                    <p v-if="v$.student.date_of_birth.required.$invalid">
                                        Date of Birth is required.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row mb-3">
                        <div class="d-flex flex-column align-items-center text-end">
                            <label for="formFile" class="form-label">Student Image</label>
                            <img :src="defaultProfileImage" class="img-fluid mb-4" style="height:250px; width:300px;" alt="Default Profile Image">
                            <input class="form-control" type="file" id="formFile" style="width:250px;">
                        </div>
                </div>
              
                <div class="row mb-3">
                    <div class="col-4">
                        <label>First Name <span class="text-danger">*</span></label>
                        <Input type="text" v-model="student.first_name" required :class="{ 'is-invalid': v$.student.first_name.$dirty && (v$.student.first_name.required.$invalid) }" autocomplete="name" />
                        <div  v-if="v$.student.first_name.$dirty" :class="{ 'invalid-feedback':(v$.student.first_name.required.$invalid )}">
                            <p v-if="v$.student.first_name.required.$invalid">
                                First Name is required.
                            </p>
                        </div>
                    </div>

                    <div class="col-4">
                        <label>Middle Name</label>
                        <Input type="text" v-model="student.middle_name"/>
                    </div>

                    <div class="col-4">
                        <label>Last Name <span class="text-danger">*</span></label>
                        <Input type="text" v-model="student.last_name" :class="{ 'is-invalid': v$.student.last_name.$dirty && (v$.student.last_name.required.$invalid) }" autocomplete="last_name" required/>
                        <div  v-if="v$.student.last_name.$dirty" :class="{ 'invalid-feedback':(v$.student.last_name.required.$invalid )}">
                            <p v-if="v$.student.last_name.required.$invalid">
                                Last Name is required.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4">
                        <label>Email Address <span class="text-danger">*</span></label>
                        <Input type="email" v-model="student.email"  :class="{ 'is-invalid':v$.student.email.$dirty && (v$.student.email.required.$invalid || v$.student.email.email.$invalid)}" required/>
                        <div v-if="v$.student.email.$dirty" :class="{ 'invalid-feedback':v$.student.email.$dirty && (v$.student.email.required.$invalid || v$.student.email.email.$invalid)}">
                            <p v-if="v$.student.email.required.$invalid">
                                Email Address is required.
                            </p>
                            <p v-if="v$.student.email.email.$invalid">
                                Email Address is invalid.
                            </p>
                        </div>
                    </div>

                    <div class="col-4">
                        <label>Phone #1 <span class="text-danger">*</span></label>
                        <Input type="text" v-model="student.phone_number_1" required :class="{ 'is-invalid': v$.student.phone_number_1.$dirty && (v$.student.phone_number_1.required.$invalid || v$.student.phone_number_1.minLength.$invalid || v$.student.phone_number_1.maxLength.$invalid) }" autocomplete="name" />
                        <div  v-if="v$.student.phone_number_1.$dirty" :class="{ 'invalid-feedback':(v$.student.phone_number_1.required.$invalid || v$.student.phone_number_1.minLength.$invalid || v$.student.phone_number_1.maxLength.$invalid)}">
                            <p v-if="v$.student.phone_number_1.required.$invalid">
                                Phone number is required.
                            </p>
                            <p v-if="v$.student.phone_number_1.minLength.$invalid">
                                Phone number must be at least 11 characters.
                            </p>
                            <p v-if="v$.student.phone_number_1.maxLength.$invalid">
                                Phone number must be no more than 13 characters.
                            </p>
                        </div>
                    </div>

                    <div class="col-4">
                        <label for="student_last_name" >Phone #2</label>
                        <Input type="text" v-model="student.phone_number_2" />
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-4 mb-3">
                        <label>Gender <span class="text-danger">*</span></label>
                        <VueMultiselect v-model="student.gender" :class="{ 'is-invalid': v$.student.gender.$dirty && (v$.student.gender.required.$invalid) }" track-by="label" label="label" placeholder="Select Gender" :allow-empty="false" :options="options"></VueMultiselect>
                        <div  v-if="v$.student.gender.$dirty" :class="{ 'invalid-feedback':(v$.student.gender.required.$invalid )}">
                            <p v-if="v$.student.gender.required.$invalid">
                                Gender is required.
                            </p>
                        </div>
                    </div>
                    <div class="col-4  mb-3">
                        <label>Date of Birth <span class="text-danger">*</span></label>
                        <VueDatePicker v-model="student.date_of_birth" :class="{ 'is-invalid': v$.student.date_of_birth.$dirty && (v$.student.date_of_birth.required.$invalid) }" placeholder="Select Date of Birth" format="MM-dd-yyyy" required></VueDatePicker>
                        <div  v-if="v$.student.date_of_birth.$dirty" :class="{ 'invalid-feedback':(v$.student.date_of_birth.required.$invalid )}">
                            <p v-if="v$.student.date_of_birth.required.$invalid">
                                Date of Birth is required.
                            </p>
                        </div>
                    </div>
                </div>
                </tab-content>
                <tab-content title="Guardian Information" icon="fa-solid fa-hands-holding-child">
                    Guardian Information
                </tab-content>
                <tab-content title="Address Information" icon="fa-solid fa-location-dot">
                   Address Information
                </tab-content>
                <tab-content title="Health Information" icon="fa-solid fa-notes-medical">
                    Health Information
                </tab-content>
            </form-wizard>
        </template>
    </Modal>
</template>

<script>
import Modal from '@/components/Modal/modal.vue';
// import FloatingInput from '@/components/Form/FloatingInput.vue'
import Input from '@/components/Form/Input.vue'
import {FormWizard, TabContent} from 'vue3-form-wizard'
import VueDatePicker from '@vuepic/vue-datepicker';
import { useVuelidate } from '@vuelidate/core'
import { required, email, maxLength, minLength } from '@vuelidate/validators';
import defaultProfile from '../../../../public/storage/default_images/profile.png';
import VueMultiselect from 'vue-multiselect'
    export default {
        name:'Registration Create',
        setup () {
            return { v$: useVuelidate({ $autoDirty: true }) }
        },
        data(){
            return{
                defaultProfileImage: defaultProfile,
                student:{
                    first_name:null,
                    middle_name:null,
                    last_name:null,
                    email:null,
                    phone_number_1:null,
                    phone_number_2:null,
                    date_of_birth:null,
                    gender:null
                },
                options: [
                    { label: 'Male', value: 1 },
                    { label: 'Female', value: 2 },
                    { label: 'Others', value: 3 },
                ],
                
            }
        },
        validations () {
            return {
                student: {
                    first_name: { required },
                    last_name: { required },
                    email: { required, email },
                    phone_number_1: { required, maxLength: maxLength(13), minLength: minLength(11) },
                    date_of_birth: { required },
                    gender: { required },
                }
            }
        },
        components:{
            Modal,
            FormWizard,
            TabContent,
            Input,
            VueDatePicker,
            VueMultiselect
        },
        methods:{
            validateStudentDetails(){
                this.v$.student.$touch()
                const isValid =  this.v$.student.$errors.length ? false : true ;
                return isValid;
            }
        },

        mounted(){
            console.log(this.$refs.formWizard,'form wizard');
        }
    }
</script>

<style lang="scss" scoped>

</style>