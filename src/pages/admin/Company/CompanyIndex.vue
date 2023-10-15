<template>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Website</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="i in companies" @click="employeeClick(i.Id)">
                <td>{{ i.Id }}</td>
                <td>{{ i.Name }}</td>
                <td>{{ i.Email }}</td>
                <td>{{ i.Logo }}</td>
                <td>{{ i.Website }}</td>
            </tr>
        </tbody>
    </table>

</template>

<script setup lang="ts">
import { ref } from "vue";
import { Company } from "../../../model/company";
import { CustomResponseType } from "../../../model/customResponseType";
import { onBeforeMount } from "vue";
import { instance } from "./../../../services/axiosInstance";
import { useRouter } from "vue-router";

const companies = ref<Company[]>([]);
const message = ref<string>("");

const router=useRouter();

onBeforeMount(async () => {
    const temp:CustomResponseType<any>=(await instance.get("/company")).data ;
    if(temp.status==200){
        companies.value=temp.data.map((value:any):Company=>{
            return {
                Id:value.id,
                Name:value.Name,
                Logo:value.logo,
                Email:value.email,
                Website:value.website,
                createdAt:value.created_at,
                updatedAt:value.updated_at
            }
        });
        message.value="";
    }else{
        companies.value=[];
        message.value=temp.error;
    }
})

const employeeClick=(id:number)=>{
    router.push({name:"companyUpdate",params:{
        id:id
    }});
}

</script>