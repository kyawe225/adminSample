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
            <input type="text" v-model="employee.Website" />
            <div>{{ errorMessage.websiteMessage }}</div>
        </div>
        <div>
            <input type="submit" value="Save" />
        </div>
    </form>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { CustomResponseType } from '../../../model/customResponseType'
import { instance } from '../../../services/axiosInstance';
import { Company } from '../../../model/company';


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
        let message: CustomResponseType<string> = (await instance.post('company', request)).data;
        if (message.status == 200) {
            console.log(message.data);
        }
    }
}

const Validation = () => {
    let errorState = false;
    if (employee.value.Name == "") {
        errorMessage.value.nameMessage = "Please fill Company Name";
        errorState = true;
    }
    if (employee.value.Email == "") {
        errorMessage.value.emailMessage = "Please fill Company Email";
        errorState = true;
    }
    if (employee.value.Logo == "") {
        errorMessage.value.logoMessage = "Please fill CompanyLogo";
        errorState = true;
    }
    if (employee.value.Website == "") {
        errorMessage.value.websiteMessage = "Please fill Company Website";
        errorState = true;
    }
    return errorState;
}

const clearMessage = () => {
    errorMessage.value = {
        nameMessage: "",
        emailMessage: "",
        logoMessage: "",
        websiteMessage: ""
    }
}

</script>