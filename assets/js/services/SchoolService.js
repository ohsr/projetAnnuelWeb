import axios from 'axios';

const api = `${process.env.REACT_APP_API}/schools`;

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
    findAll : findAll,
    findOneById: findOneById,
    insertOne: insertOne
}