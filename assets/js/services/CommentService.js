    import axios from 'axios';

const api = `${process.env.REACT_APP_API}/user_comment_schools`;

function findAll(currentPage){
    return axios.get(`${api}?page=${currentPage}`)
}

function findBySchoolAndCategory(school,category){
    return axios.get(`${api}?schools=${school}&categorys=${category}`);
}

export default {
    findAll : findAll,
    findBySchoolAndCategory: findBySchoolAndCategory,
}