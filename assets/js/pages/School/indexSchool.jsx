import React,{useState,useEffect} from 'react';
import axios from "axios";

const IndexSchool = () =>{
    const [schools,setSchools] = useState([]);

    useEffect(() =>{
        axios.get("http://192.168.22.10/api/schools")
            .then(response => {
                setSchools(response.data['hydra:member']);
            })
            .catch(error => console.log(error.response));
    },[schools]);

    return(
        <>
            <h1 className="bg-primary p-2 text-center text-light">Liste des Ecoles</h1>
            <table className="table table-hover table-striped">
                <thead className="bg-primary text-center text-light">
                    <th>Id</th>
                    <th>Type</th>
                    <th>Nom</th>
                    <th>Sigle</th>
                    <th>Status</th>
                    <th>Adresse</th>
                    <th>Notes</th>
                    <th>Commentaires</th>
                    <th colSpan={2}>Actions</th>
                </thead>
                <tbody>
                {schools.map(school =>(
                    <tr key={school.id}>
                        <td>{school.id}</td>
                        <td>{school.type}</td>
                        <td>{school.name}</td>
                        <td>{school.sigle}</td>
                        <td>{school.status}</td>
                        <td>{school.adress}</td>
                        <td>{school.notesUser.length}</td>
                        <td>{school.commentsUser.length}</td>
                        <td>
                            <button className="btn btn-warning btn-sm">Modifier</button>
                        </td>
                        <td>
                            <button className="btn btn-danger btn-sm">Supprimer</button>
                        </td>
                    </tr>
                ))}
                </tbody>
            </table>
        </>
    )
};

export default IndexSchool;