<template>
    <Modal class="modal-xl" targetModal="student-details-modal" modaltitle="Student Details" :backdrop="true" :escKey="false">
        <template #body>
            <form-wizard  finishButtonText="Update" ref="formWizard" subtitle="Student Details" :validateOnBack="true" color="#3176FF">
                <tab-content title="Student Information" icon="fa-solid fa-user">
                    <div class="row mb-3">
                        <div class="d-flex flex-column align-items-center text-end">
                            <img :src="image" class="img-fluid mb-4 rounded-circle" style="height: 250px; width: 250px; border: 2px solid #ccc;" alt="Default Profile Image">
                            <div v-if="edit" class="d-flex justify-content-center align-items-center">
                                <input class="form-control object-fit-cover " type="file" id="formFile" style="width: 250px;" @change="uploadImage" accept="image/*">
                                <button v-if="image" type="button" class="ms-2 btn btn-sm btn-danger" @click="removeImage"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end mb-3">
                        <div class="col-3">
                            <label>School Year <span class="text-danger" v-if="edit">*</span></label>
                            <VueMultiselect v-if="edit" :loading="loadingSchoolYears" :disabled="loadingSchoolYears" :class="{ inputInvalidClass : checkInputValidity('student','school_year',['required']) }" v-model="student.school_year" track-by="label" label="label" placeholder="Select S.Y" :options="school_years"></VueMultiselect>
                            <Input v-else type="text" v-model="student.school_year_name" :disabled="!edit"/>
                            <div  v-if="v$.student.school_year.$dirty" :class="{ 'text-danger': checkInputValidity('student','school_year',['required']) && edit }">
                                <p v-if="v$.student.school_year.required.$invalid">
                                    School Year is required.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label>First Name <span class="text-danger" v-if="edit">*</span></label>
                            <Input type="text" v-model="student.first_name" :disabled="!edit" :class="{ inputInvalidClass : checkInputValidity('student','first_name',['required']) && edit }" required   autocomplete="name" />
                            <div  v-if="v$.student.first_name.$dirty" :class="{ 'text-danger': checkInputValidity('student','first_name',['required']) && edit }">
                                <p v-if="v$.student.first_name.required.$invalid">
                                    First Name is required.
                                </p>
                            </div>
                        </div>

                        <div class="col-4">
                            <label>Middle Name</label>
                            <Input type="text" v-model="student.middle_name" :disabled="!edit"/>
                        </div>

                        <div class="col-4">
                            <label>Last Name <span class="text-danger" v-if="edit">*</span></label>
                            <Input type="text" v-model="student.last_name" :disabled="!edit" :class="{ inputInvalidClass : checkInputValidity('student','last_name',['required']) && edit }" autocomplete="last_name" required/>
                            <div  v-if="v$.student.last_name.$dirty" :class="{ 'text-danger': checkInputValidity('student','last_name',['required']) && edit }">
                                <p v-if="v$.student.last_name.required.$invalid">
                                    Last Name is required.
                                </p>
                            </div>
                           
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4">
                            <label>Email Address <span class="text-danger" v-if="edit">*</span></label>
                            <Input type="email" v-model="student.email" :disabled="!edit" :class="{ inputInvalidClass : checkInputValidity('student','email',['required','email']) && edit }"  required/>
                            <div v-if="v$.student.email.$dirty" :class="{ 'text-danger': checkInputValidity('student','email',['required','email']) && edit }">
                                <p v-if="v$.student.email.required.$invalid">
                                    Email Address is required.
                                </p>
                                <p v-if="v$.student.email.email.$invalid">
                                    Email Address is invalid.
                                </p>
                            </div>
                        </div>

                        <div class="col-4">
                            <label>Phone #1 <span class="text-danger" v-if="edit">*</span></label>
                            <Input type="number" step="0.01" :disabled="!edit"  v-model="student.phone_number_1" :class="{ inputInvalidClass : checkInputValidity('student','phone_number_1',['required', 'minLength', 'maxLength']) && edit }"  required autocomplete="name" />
                            <div  v-if="v$.student.phone_number_1.$dirty" :class="{ 'text-danger':  checkInputValidity('student','phone_number_1',['required', 'minLength', 'maxLength']) && edit }">
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
                            <Input type="number" v-model="student.phone_number_2" step="0.01" :disabled="!edit"/>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4">
                            <label>Gender <span class="text-danger" v-if="edit">*</span></label>
                            <VueMultiselect  v-if="edit" :loading="loadingGenders" :disabled="loadingGenders" :class="{ inputInvalidClass : checkInputValidity('student','gender',['required']) && edit }" v-model="student.gender" track-by="label" label="label" placeholder="Select Gender" :allow-empty="false" :options="genders"></VueMultiselect>
                            <Input v-else type="text" v-model="student.gender_name" :disabled="!edit"/>
                            <div  v-if="v$.student.gender.$dirty" :class="{ 'text-danger': checkInputValidity('student','gender',['required']) && edit }">
                                <p v-if="v$.student.gender.required.$invalid">
                                    Gender is required.
                                </p>
                            </div>
                        </div>
                        <div class="col-4">
                            <label>Date of Birth <span class="text-danger" v-if="edit">*</span></label>
                            <VueDatePicker v-if="edit" :class="{ inputInvalidClass : checkInputValidity('student','date_of_birth',['required']) && edit }"  v-model="student.date_of_birth" placeholder="Select Date of Birth" format="MM-dd-yyyy" required></VueDatePicker>
                            <Input v-else type="text" v-model="student.date_of_birth_name" :disabled="!edit"/>
                            <div  v-if="v$.student.date_of_birth.$dirty" :class="{ 'text-danger':  checkInputValidity('student','date_of_birth',['required'])  && edit }">
                                <p v-if="v$.student.date_of_birth.required.$invalid">
                                    Date of Birth is required.
                                </p>
                            </div>
                        </div>
                    </div>

                </tab-content>
                <tab-content title="Guardian Information" icon="fa-solid fa-hands-holding-child">
                    <div v-for="(guardian, index) in guardians" :key="index" class="row align-items-center"> 
                        <h2 class="mb-3">{{ guardian.guardian_type.name }}</h2> 
                        <template v-for="(property, key) in guardian" :key="key">
                            <div v-if="guardians_label_options[key]" class="col-4 mb-3">
                                <label>{{ guardians_label_options[key]?.label }}  <span class="text-danger" v-if="guardians_label_options[key].required && edit">*</span></label> 
                                <Input v-if="key != 'guardian_type'" text="text" v-model="guardians[index][key]" :disabled="!edit"/> 
                                <Input v-else text="text" v-model="guardian.guardian_type.name" :disabled="!edit"/> 
                            </div>
                        </template>
                    </div>
                </tab-content>
                <tab-content title="Address Information" icon="fa-solid fa-location-dot">
                   <div class="row mb-3">
                        <div class="col-12">
                            <label>Address <span class="text-danger" v-if="edit">*</span></label>
                            <textarea class="form-control" v-model="address.address" :disabled="!edit"></textarea>
                        </div>
                    </div>
                   <div class="row mb-3">
                        <div class="col-4">
                            <label>Landmark <span class="text-danger" v-if="edit">*</span></label>
                            <Input type="text" v-model="address.land_mark" :disabled="!edit"/>
                        </div>
                        <div class="col-4">
                            <label>Contact Person <span class="text-danger" v-if="edit">*</span></label>
                            <Input type="text" v-model="address.contact_person" :disabled="!edit"/>
                        </div>
                        <div class="col-4">
                            <label>Phone # <span class="text-danger" v-if="edit">*</span></label>
                            <Input type="text" v-model="address.phone_number" :disabled="!edit"/>
                        </div>
                    </div>
                </tab-content>
                <tab-content title="Health Information" icon="fa-solid fa-notes-medical">
                    <div class="row mb-3">
                        <div class="col-4">
                            <label>Height <code>(cm)</code></label>
                            <Input type="text" v-model="health_information.height"  :disabled="!edit"/>
                        </div>
                        <div class="col-4">
                            <label>Weight <code>(cm)</code></label>
                            <Input type="text" v-model="health_information.weight" :disabled="!edit"/>
                        </div>
                        <div class="col-4">
                            <label>Blood Type</label>
                            <Input type="text" v-model="health_information.blood_type" :disabled="!edit"/>
                        </div>
                        
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label>Allergies</label>
                            <Input type="text" v-model="health_information.allergies" :disabled="!edit"/>
                        </div>
                        <div class="col-4">
                            <label>Medications</label>
                            <Input type="text" v-model="health_information.medications" :disabled="!edit"/>
                        </div>
                        <div class="col-4">
                            <label>Emergency Contact Person</label>
                            <Input type="text" v-model="health_information.emergency_contact_name" :disabled="!edit"/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label>Emergency Contact #</label>
                            <Input type="text" v-model="health_information.emergency_contact_phone" :disabled="!edit"/>
                        </div>
                        <div class="col-4">
                            <label>Last checkup</label>
                            <Input type="text" v-model="health_information.last_health_checkup" :disabled="!edit"/>
                        </div>
                    </div>
                </tab-content>
                <template v-slot:custom-buttons-right="props">
                    <button type="button"  v-if="!edit" class="btn btn-md btn-primary me-1 px-3" @click="editDetails"><i class="fa-solid fa-pencil"></i></button>
                    <button type="button"  v-else class="btn btn-md btn-danger me-1 px-3" @click="cancelEdit">Cancel</button>
                    <span v-if="props.isLastStep"></span>
                </template>
                <template v-slot:finish="props">
                    <span v-if="props.isLastStep && !edit"></span>
                </template>
            </form-wizard>
        </template>
    </Modal>
</template>

<script>
import Modal from '@/components/Modal/modal.vue';
import Input from '@/components/Form/Input.vue'
import defaultProfile from '@/../../public/storage/default_images/profile.png';
import {FormWizard, TabContent} from 'vue3-form-wizard'
import VueMultiselect from 'vue-multiselect'
import VueDatePicker from '@vuepic/vue-datepicker';
import { useVuelidate } from '@vuelidate/core'
import { required, email, maxLength, minLength } from '@vuelidate/validators';
import { deepClone } from '@/helpers/PartialHelpers/index.js';
import { checkValidity, checkLoopValidity, checkLoopErrors } from '@/helpers/Vuelidate/InputValidation.js';
    export default {
        name:'Student Details',
        props:['student_details'],
        setup () {
            return { v$: useVuelidate({ $autoDirty: true ,student: {} }) }
        },
        data(){
            return{
                guardians_label_options:{
                    first_name:{
                        label:'First Name',
                        validations:['required'],
                        required: true,
                    },
                    middle_name:{
                        label:'Middle Name',
                        required: false,
                    },
                    last_name:{
                        label:'Last Name',
                        validations:['required'],
                        required: true,
                    },
                    email:{
                        label:'Email Address',
                        validations:['required','email'],
                        required: true,
                    },
                    phone_number_1:{
                        label:'Phone #1',
                        validations:['required','maxLength','minLength'],
                        required: true,
                    },
                    phone_number_2:{
                        label:'Phone #2',
                        required: false,
                    },
                    guardian_type:{
                        label:'Relationship',
                        validations:['required'],
                        required: true,
                    }
                },
                student:{},
                address:{},
                health_information:{},
                guardians:[],
                image:null,
                file:null,
                auth_token:`Bearer ${localStorage.getItem('auth-token')}`,
                details:[],
                prevDetails:{},
                genders:[],
                relationships:[],
                school_years:[],
                loadingSchoolYears:false,
                loadingGenders:false,
                loadingRelationships:false,
                edit:false
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
                    school_year: { required },
                },
                guardians:this.guardians.map((guardian) => ({
                    first_name: { required },
                    last_name: { required },
                    email: { required, email },
                    phone_number_1: { required, maxLength: maxLength(13), minLength: minLength(11) },
                    guardian_type: { required },
                })),
                address_information: {
                    address: { required },
                    address: { required },
                    landmark: { required },
                    contact_person: { required },
                    phone_number: { required,  maxLength: maxLength(13), minLength: minLength(11) }
                },
                health_information: {
                    blood_type: { maxLength: maxLength(5)}
                },
            }
        },

        components:{
            Modal,
            FormWizard,
            TabContent,
            Input,
            VueMultiselect,
            VueDatePicker
        },

        async created(){
            await this.getSchoolYears()
            await this.getGenderOptions()
            await this.getGuardianTypes()
        },

        methods:{

            resetForm() {
                this.$refs.formWizard.reset();
                this.v$.$reset();
                this.$refs.formWizard.activateAll();
                this.image = deepClone(this.prevDetails.student_image);
                this.student = deepClone(this.prevDetails.basic_information);
                this.address = deepClone(this.prevDetails.address);
                this.guardians = deepClone(this.prevDetails.guardians);
                this.health_information = deepClone(this.prevDetails.health_information);
            },

            editDetails(){
                this.edit = true;
            },

            cancelEdit(){
                this.edit = false;
                this.resetForm();
            },

            uploadImage(e){
                e.preventDefault()
                const file = e.target.files[0];
                this.file = file;
                if (file) {
                    // Use FileReader to read the file as a data URL
                    const reader = new FileReader();
                    reader.onload = () => {
                        this.image = reader.result; // Set the imageUrl to the data URL
                    };
                    reader.readAsDataURL(file);
                }
            },

            removeImage(){
                this.file = null;
                this.image = defaultProfile;
            },

            async getGenderOptions(){
                this.loadingGenders = true;
                await axios.get('/api/genderOptions', { 
                    headers: {
                        Authorization: this.auth_token
                    }
                })
                .then((response) => {
                    const { genders } = response.data;
                    console.log(genders, response);
                    this.genders = genders;
                    this.loadingGenders = false;
                    console.log(response,'GENDERS');
                })
                .catch((error) =>{
                    console.log(error,'error');
                });
            },

            async getGuardianTypes(){
                await axios.get('/api/guardianTypeOptions', { 
                    headers: {
                        Authorization: this.auth_token
                    }
                })
                .then((response) => {
                    const { guardianTypes } = response.data;
                    console.log(guardianTypes, response);

                    this.relationships = guardianTypes;
                    console.log(response,'GUARDIANS');
                })
                .catch((error) =>{
                    console.log(error,'ERROR');
                });
            },
            
            async getSchoolYears(){
                this.loadingSchoolYears = true;

                await axios.get('/api/schoolYearOptions', { 
                    headers: {
                        Authorization: this.auth_token
                    }
                })
                .then((response) => {
                    const { schoolYears } = response.data;

                    this.school_years = schoolYears;
                    this.loadingSchoolYears = false;
                })
                .catch((error) =>{
                    console.log(error,'ERROR');
                });
            },

            checkInputValidity(parentProperty = null, dataProperty, validations = []) {
               return checkValidity(this.v$, parentProperty, dataProperty, validations);
            },
            
            checkLoopInputValidity(parentProperty = null, dataProperty, validations = [], index = null) {
               return checkLoopValidity(this.v$, parentProperty, dataProperty, validations, index);
            },

            checkLoopValidationErrors(parentProperty = null, dataProperty, validations = [], index = null){
                return checkLoopErrors(this.v$, parentProperty, dataProperty, validations, index);
            },

            validateStudentDetails(){
                this.v$.student.$touch()
                const isValid =  this.v$.student.$errors.length ? false : true ;
                return isValid;
            },

            validateGuardianDetails(){
                this.v$.guardians.$touch()
                const isValid =  this.v$.guardians.$errors.length ? false : true ;
                return isValid;
            },

            validateAddressDetails(){
                this.v$.address_information.$touch()
                const isValid =  this.v$.address_information.$errors.length ? false : true ;
                return isValid;
            },
            
        },

        mounted(){
        },

        watch:{
            student_details(){
                this.edit = false;
                this.prevDetails = deepClone(this.student_details);
                this.resetForm();
                this.details = this.student_details;
                this.address = this.student_details.address;
                this.guardians = this.student_details.guardians;
                this.image = this.student_details.student_image;
                this.health_information = this.student_details.health_information;
                this.student = this.student_details.basic_information;
                immediate:true
            }
        }
    }
</script>

<style scoped>
.inputInvalidClass {
  border: 1px solid red; /* Adjust the style as needed */
  border-radius: 5px;
}

</style>