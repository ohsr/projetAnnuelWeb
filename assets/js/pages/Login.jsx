import React,{useState,useEffect} from 'react';
import Pagination from '../componants/Pagination';
import SecurityService from '../services/SecurityService';
import {NavLink} from "react-router-dom";
import Field from "../componants/Field";

const Login = ({handleAuthenticated}) =>{
    const [credentials, setCredentials]= useState({
        username: "",
        password: ""
    });
    const [error,setError] = useState("");

    const handleSubmit =  event =>{
        event.preventDefault();
        SecurityService.login(credentials).then((response)=> {
            setError("");
            handleAuthenticated()
            history.replace("/");
        })
        .catch((err)=>{
            setError(err.response.data);
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
                    {
                        error
                        &&
                        <div className="alert alert-danger" role="alert">
                            {error}
                        </div>
                    }
                    <Field label="Adresse Email" name="username"
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