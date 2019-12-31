import axios from "axios";
const api = (process.env.REACT_APP_API).replace("/api","");

function login(credentials){
    return axios.post(`${api}/login`,credentials);
}
function logout(){
    return axios.get('http://projetannuel.test/logout');
}
export default {
    login: login,
    logout: logout
}