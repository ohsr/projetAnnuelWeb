import axios from "axios";

function login(credentials){
    return axios.post(`${process.env.REACT_APP_API}/login_check`,credentials);
}
function userInfo(){
    console.log("Je passe")
    return axios.get(`${process.env.REACT_APP_API}/profile`);
}
function logout(){
    return axios.get(`${process.env.REACT_APP_API}/logout`);
}
export default {
    login: login,
    userInfo: userInfo,
    logout: logout
}