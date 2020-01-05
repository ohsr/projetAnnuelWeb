    import axios from 'axios';

const api = `${process.env.REACT_APP_API}/user_comment_schools`;

function findAll(currentPage){
    return axios.get(`${api}?page=${currentPage}`)
}

function create(data){
    console.log(api,data);
    return axios.post(api,data)
}

function findBySchoolAndCategory(school,category){
    return axios.get(`${api}?schools=${school}&categorys=${category}`);
}

export default {
    findAll : findAll,
    create: create,
    findBySchoolAndCategory: findBySchoolAndCategory,
}