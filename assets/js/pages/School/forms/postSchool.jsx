import React,{useState} from 'react';
import Field from "../../../componants/Field";
import {NavLink} from "react-router-dom";

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faSave,faBackward } from '@fortawesome/free-solid-svg-icons';

const PostSchool = ({descrPage,school,setSchoo,submit,change}) =>{
    return(
        <>
            <div className="row">
                <div className="col-2">
                    <NavLink className="btn btn-link btn-block border border-primary" to="/schools">
                        <FontAwesomeIcon icon={faBackward}/> Retour
                    </NavLink>
                </div>
                <div className="col-10">
                    <h2 className="text-center bg-primary p-2 text-light">{descrPage}</h2>

                </div>
            </div>
            <form onSubmit={submit} method="post" className="mt-2">
                <div className="row">
                    <div className="col-md-6">
                        <Field label="Nom de l'école" name="name"
                               value={school.name} onChange={change}
                               placeholder="Ex: Ecole Polytechnique"
                        />
                    </div>
                    <div className="col-md-6">
                        <Field label="Type d'école" name="type"
                               value={school.type} onChange={change}
                               placeholder="Ex: Université"
                        />
                    </div>
                    <div className="col-md-6">
                        <div className="form-group">
                            <label htmlFor="status">Status de l'Ecole</label>
                            <select name="status" id="status" className="custom-select" onChange={change}>
                                <option value={school.status}>{school.status}</option>
                                <option value="Ecole publique">Ecole publique</option>
                                <option value="Ecole privé">Ecole privé</option>
                            </select>
                        </div>
                    </div>


                    <div className="col-md-6">
                        <Field label="Département" name="department"
                               value={school.department} onChange={change}
                               placeholder="Ex: Ile de France"
                        />
                    </div>
                    <div className="col-md-6">
                        <Field label="Ville" name="city"
                               value={school.city} onChange={change}
                               placeholder="Ex: Paris"
                        />
                    </div>
                    <div className="col-md-6">
                        <Field label="Rue" name="adress"
                               value={school.adress} onChange={change}
                               placeholder="Ex: 1 Avenue des Champs-Elysées"
                        />
                    </div>
                    <div className="col-md-6">
                        <Field label="Code Postal" name="postalCode"
                               value={school.postalCode} onChange={change}
                               placeholder="Ex: 75000"
                        />
                    </div>
                </div>

                <div className="form-group">
                    <button type="submit" className="btn btn-success btn-block">
                        Enregistrer <FontAwesomeIcon icon={faSave}/>
                    </button>
                </div>
            </form>

        </>
    );
};
export default PostSchool;