export interface loginInfo{
    email:string,
    token:string,
    name:string,
    dateOfBirth:string
}

export interface loginViewModel{
    email:string,
    password:string
}

export interface registerViewModel{
    email:string,
    password:string,
    name:string,
    dateOfBirth:Date
}