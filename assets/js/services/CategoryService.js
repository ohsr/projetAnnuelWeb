import axios from 'axios';

const api = `${process.env.REACT_APP_API}/categories`;

function findAll(currentPage){
    return axios.get(api)
}

export default {
    findAll : findAll
}