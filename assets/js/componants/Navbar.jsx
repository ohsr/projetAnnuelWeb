import React from 'react';
import ReactDOM from "react-dom";
import {NavLink} from "react-router-dom";

const Navbar = ({isAuthenticated,handleLogout}) =>{
    return (
        <>
            <nav className="navbar navbar-expand-lg navbar-dark bg-primary">
                <NavLink className="navbar-brand" to="/">NoteMySchool</NavLink>
                <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
                        aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>

                <div className="collapse navbar-collapse" id="navbarColor01">
                    {isAuthenticated
                    &&
                        <ul className="navbar-nav mr-auto">

                            <li className="nav-item">
                                    <NavLink className="nav-link" to="/schools">Ecoles</NavLink>
                                </li>
                                <li className="nav-item">
                                    <NavLink className="nav-link" to="/categorys">Catégories</NavLink>
                                </li>
                                <li className="nav-item">
                                    <NavLink className="nav-link" to="/users">Utilisateurs</NavLink>
                                </li>
                                <li className="nav-item">
                                    <a className="nav-link" href="#">Mon Profil</a>
                            </li>
                        </ul>

                    }
                        
                    <ul className="navbar-nav ml-auto">
                        {!isAuthenticated &&
                        <>
                            <li>
                                <NavLink to="/register" className="nav-link">Inscription</NavLink>
                            </li>
                            <li className="nav-item">
                                <NavLink to="/login" className="btn btn-success">Connexion</NavLink>
                            </li>
                        </>
                        ||
                        <li className="nav-item">
                            <button onClick={handleLogout} className="btn btn-danger">Déconnexion</button>
                        </li>
                        }
                    </ul>
                </div>
            </nav>
        </>
    )
};

export default Navbar;