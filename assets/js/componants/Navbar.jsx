import React from 'react';
import ReactDOM from "react-dom";
import {NavLink} from "react-router-dom";

const Navbar = () =>{
    return (
        <>
            <nav className="navbar navbar-expand-lg navbar-dark bg-primary">
                <NavLink className="navbar-brand" to="/">NoteMySchool</NavLink>
                <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
                        aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>

                <div className="collapse navbar-collapse" id="navbarColor01">
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
                </div>
            </nav>
        </>
    )
};

export default Navbar;