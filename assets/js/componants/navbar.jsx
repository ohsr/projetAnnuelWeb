import React from 'react';

const NavBar = () =>{
    return (
        <>
            <nav className="navbar navbar-expand-lg navbar-dark bg-primary">
                <a className="navbar-brand" href="#">NoteMySchool</a>
                <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
                        aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>

                <div className="collapse navbar-collapse" id="navbarColor01">
                    <ul className="navbar-nav mr-auto">
                        <li className="nav-item active">
                            <a className="nav-link" href="#">Accueil <span className="sr-only">(current)</span></a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" href="#">Universités</a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" href="#">Recherche</a>
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

export default NavBar;