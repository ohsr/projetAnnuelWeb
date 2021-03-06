import axios from 'axios';

const api = `${process.env.REACT_APP_API}/schools`;


function findMainWindow(currentPage,status,order = null, search = null){
    let request = `${api}?page=${currentPage}&status=${status}`;
    
    if(order.target){
        request = `${request}&order[${order.target}]=${order.value}`
    }
    if(search.target){
        request = `${request}&search[${search.target}]=${search.value}`
    }
    return axios.get(request);
}

function findAll(currentPage){
    return axios.get(`${api}?page=${currentPage}`)
}

function findOneById(id){
    return axios.get(`${api}/${id}`);
}

function insertOne(data){
    return axios.post(api,data);
}


export default {
    findMainWindow: findMainWindow,
    findAll : findAll,
    findOneById: findOneById,
    insertOne: insertOne
}