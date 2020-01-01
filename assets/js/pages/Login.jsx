import React,{useState,useEffect} from 'react';
import Pagination from '../componants/Pagination';
import SecurityService from '../services/SecurityService';
import {NavLink} from "react-router-dom";
import Field from "../componants/Field";
import { toast } from 'react-toastify'


const Login = ({history,isAuthenticated,handleAuthenticated,handleReject}) =>{
    toast.configure();
    const [credentials, setCredentials]= useState({
        username: "",
        password: ""
    });

    useEffect(() => {
       if(isAuthenticated){
           localStorage.removeItem("isAuthenticated");
           handleAuthenticated();
       }
    },[]);
    const handleSubmit =  event =>{
        event.preventDefault();
        SecurityService.login(credentials)
        .then((response)=> {
            handleAuthenticated()
            history.replace("/");
            toast.success("Connexion réusssie !");
        })
        .catch((err)=>{
            let error ="";
            toast.error(handleReject(err.response.data.message));
            setCredentials({
                username: credentials.username,
                password: ""
            })
        })
    };
    const handleChange = (event) =>{
        let name = event.currentTarget.name;
        let value = event.currentTarget.value;
        setCredentials({...credentials,[name]:value })
    }
    return(
        <>
            <div className="container">
                <h1 className="text-center bg-primary p-2 text-light">Connectez-vous</h1>
                <form onSubmit={handleSubmit}>

                    <Field label="Adresse Email" name="username" type="email"
                           value={credentials.username} onChange={handleChange}
                   />
                    <Field label="Mot de passe" name="password"
                           value={credentials.password} onChange={handleChange}
                           placeholder="Votre mot de passe"
                           type="password"
                    />

                    <div className="form-group">
                        <button type="submit" className="btn btn-success btn-block">Connexion</button>
                    </div>
                </form>
            </div>
        </>
    )
};

export default Login;