<template>
    <form @submit.prevent="">
        <div>
            <label for="email">Email</label>
            <input type="text" v-model="user.email" id="email"/>
        </div>
        <div>
            <label for="email">Password</label>
            <input type="text" v-model="user.password" id="password"/>
        </div>
        <div>
            <input type="submit" value="submit" />
        </div>
    </form>
</template>

<script setup lang="ts">
    import {loginViewModel} from "../../model/user";
    import {ref} from "vue";
    
    const user=ref<loginViewModel>({
        email:"",
        password:""
    });


</script>