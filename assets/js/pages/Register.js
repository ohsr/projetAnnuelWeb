import React,{useState} from "react";
import { toast } from 'react-toastify';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import {faCheck} from '@fortawesome/free-solid-svg-icons';
import Field from "./../componants/Field"
import SecurityService from "../services/SecurityService";
import { NavLink } from "react-router-dom";

const Register = ({history}) =>{

    toast.configure();
    const [user, setUser]= useState({
        firstName: "",
        lastName: "",
        email: "",
        password: "",
        roles: ["ROLE_USER"],
        passwordConfirm: ""
    });
    const [errors,setErrors] = useState({});
    const handleSubmit = async (event) =>{
        event.preventDefault();
        const apiErrors = {};
        if(user.password !== user.passwordConfirm){
            apiErrors.passwordConfirm = "Votre confirmation de mot de passe n'est pas conforme avec le mot de passe original"
            setErrors(apiErrors)
            console.log("Invalide")
            return;
        }
        console.log(user)
        try{
            await SecurityService.register(user);
            history.push("/login");
            toast.success("Votre compte a bien été crée, vous pouvez maintenant vous connecter ");
        }catch(error){
            const {violations} = error.response.data;
            if(violations){
                violations.map(violation =>{
                    apiErrors[violation.propertyPath] = violation.message
                })
                setErrors(apiErrors);
            }
        }
    }

    const handleChange = (event) =>{
        const value = event.currentTarget.value;
        const name = event.currentTarget.name;

        if(name == "roles"){

            if(value =="school"){
                value = ["ROLE_SCHOOL"]
            }else{
                value = ["ROLE_USER"]
            }
        }

        setUser({...user, [name]: value });

    }

    return(
        <div className="container mt-5 text-center">
                <h1 className="text-center bg-primary p-2 text-light">Inscrivez-vous</h1>
                <form onSubmit={handleSubmit}>
                    <div className="row">
                        <div className="col">
                            <Field label="Nom" name="lastName"
                                value={user.lastName} onChange={handleChange}
                                placeholder="Votre nom"
                                type="text"
                                error={errors.lastName}
                                requiredVal={true}
                            />
                        </div>
                        <div className="col">
                            <Field label="Prénom" name="firstName"
                                value={user.firstName} onChange={handleChange}
                                placeholder="Votre prénom"
                                type="text"
                                error={errors.firstName}
                                requiredVal={true}
                            />
                        </div>
                    </div>
                    <Field label="Adresse Email" name="email"
                        value={user.email} onChange={handleChange}
                        placeholder="Votre adresse email"
                        type="email"
                        error={errors.email}
                        requiredVal={true}
                    />
                    
                    <Field label="Mot de passe" name="password"
                        value={user.password} onChange={handleChange}
                        placeholder="Votre mot de passe"
                        type="password"
                        error={errors.password}
                        requiredVal={true}
                    />
                    <Field label="Confirmation Mot de passe" name="passwordConfirm"
                        value={user.passwordConfirm} onChange={handleChange}
                        placeholder="Confirmer votre mot de passe"
                        type="password"
                        error={errors.passwordConfirm}
                        requiredVal={true}
                    />
                    
                    <select name="roles"  className="form-control" onChange={handleChange}>
                        <option >{user.roles == ["USER_SCHOOL"] && "École" || "Étudiant"}</option>
                        <option value="student">Étudiant</option>
                        <option value="school">École</option>
                    </select>

                    <div className="form-group mt-2">
                        <button type="submit" className="btn btn-success">Créer mon compte <FontAwesomeIcon icon={faCheck} /></button>
                        <NavLink to="/login" className="btn btn-link">Déja un compte ?</NavLink>
                    </div>
                </form>
            </div>
    )
}

export default Register;
