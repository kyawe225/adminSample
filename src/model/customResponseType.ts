interface SuccessType<T>{
    status:200,
    data:T
}

interface ErrorType{
    status:string,
    error:string
}

export type CustomResponseType<T> = SuccessType<T> | ErrorType