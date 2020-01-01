import axios from "axios";

function login(credentials){
    return axios.post(`${process.env.REACT_APP_API}/login_check`,credentials);
}
function logout(){
    return axios.get(`${process.env.REACT_APP_API}/logout`);
}
export default {
    login: login,
    logout: logout
}