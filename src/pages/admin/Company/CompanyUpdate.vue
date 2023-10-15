<template>
    <form @submit.prevent="submit()">
        <div>
            <label>Name</label>
            <input type="text" v-model="employee.Name" />
            <div>{{ errorMessage.nameMessage }}</div>
        </div>
        <div>
            <label>Email</label>
            <input type="email" v-model="employee.Email" />
            <div>{{ errorMessage.emailMessage }}</div>
        </div>
        <div>
            <label>Logo</label>
            <input type="text" v-model="employee.Logo" />
            <div>{{ errorMessage.logoMessage }}</div>
        </div>
        <div>
            <label>Website</label>
            <input type="url" v-model="employee.Website" />
            <div>{{ errorMessage.websiteMessage }}</div>
        </div>
        <div>
            <input type="submit" value="Update" />
        </div>
    </form>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { CustomResponseType } from '../../../model/customResponseType';
import { instance } from '../../../services/axiosInstance';
import { onBeforeMount } from 'vue';
import { Company } from '../../../model/company';
import { useRoute } from 'vue-router';
import { watchEffect } from 'vue';


const route = useRoute();

const employee = ref<Company>({
    Id: -1,
    Name: "",
    Email: "",
    Logo: "",
    Website: "",
    createdAt: "",
    updatedAt: ""
});

const errorMessage = ref({
    nameMessage: "",
    emailMessage: "",
    logoMessage: "",
    websiteMessage: ""
})

const submit = async () => {
    clearMessage();
    if (!Validation()) {
        let request = {
            name: employee.value.Name,
            email: employee.value.Email,
            logo: employee.value.Logo,
            website: employee.value.Website
        };
        let message: CustomResponseType<string> = (await instance.put('employee/' + route.params.id, request)).data;
        if (message.status == 200) {
            console.log(message.data);
        }
    }
}

const Validation = () => {
    let errorState = false;
    if (employee.value.Name == "") {
        errorMessage.value.nameMessage = "Please fill Employee Full Name";
        errorState = true;
    }
    if (employee.value.Email == "") {
        errorMessage.value.emailMessage = "Please fill Employee Email";
        errorState = true;
    }
    if (employee.value.Logo == "") {
        errorMessage.value.logoMessage = "Please fill Employee Phone";
        errorState = true;
    }
    if (employee.value.Website == "") {
        errorMessage.value.websiteMessage = "Please fill Employee company id";
        errorState = true;
    }
    return errorState;
}

const clearMessage =  () => {
    errorMessage.value = {
        nameMessage: "",
        emailMessage: "",
        logoMessage: "",
        websiteMessage: "",
    }
}
const fnGetData=async ()=>{
    const employeeU: CustomResponseType<any> = (await instance.get("company/" + route.params.id)).data;
    if (employeeU.status == 200) {
        employee.value =  {
                Id:employeeU.data.id,
                Name:employeeU.data.Name,
                Logo:employeeU.data.logo,
                Email:employeeU.data.email,
                Website:employeeU.data.website,
                createdAt:employeeU.data.created_at,
                updatedAt:employeeU.data.updated_at
            };
    }
}

onBeforeMount(async () => {
    await fnGetData();
})

watchEffect(async ()=>{
    await fnGetData();
})
</script>