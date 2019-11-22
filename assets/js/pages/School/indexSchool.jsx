import React,{useState,useEffect} from 'react';
import axios from "axios";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faIdCard, faSchool,faTag,faRoad,faDivide,faComment,faCog, faTruckLoading } from '@fortawesome/free-solid-svg-icons';
import ClipLoader from 'react-spinners/ClipLoader';

import Pagination from "../../componants/Pagination";

const IndexSchool = () =>{

    const [schools,setSchools] = useState([]);
    const [loading,setLoading ] = useState(true);
    const [totalItems, setTotalItems] = useState(0);
    const [currentPage, setCurrentPage] = useState(1);
    const itemsPerPage = 9;
    useEffect(() =>{
        axios.get(`http://192.168.22.10/api/schools?page=${currentPage}`)
            .then(response => {
                setSchools(response.data['hydra:member']);
                setTotalItems(response.data['hydra:totalItems']);
            }).then(()=>{
            setLoading(false);
        })
            .catch(error => console.log(error.response));
    },[currentPage]);

    const handlePageChange = (page) =>{
        setCurrentPage(page);
        setLoading(true);
    };
    return(
        <>
            <h1 className="bg-primary p-2 text-center text-light">Liste des Ecoles</h1>
            {
                loading
                &&
                    <div className='sweet-loading text-center'>
                        <ClipLoader
                            sizeUnit={"px"}
                            size={100}
                            color={'#ff1744'}
                        />
                    </div>
                ||
                    <table className="table table-hover table-striped">
                    <thead className="bg-primary text-center text-light">
                    <th><FontAwesomeIcon icon={ faIdCard} /><br/> Id</th>
                    <th><FontAwesomeIcon icon={ faSchool} /><br/> Type</th>
                    <th><FontAwesomeIcon icon={ faTag} /><br/> Nom</th>
                    <th><FontAwesomeIcon icon={ faTag} /><br/> Sigle</th>
                    <th><FontAwesomeIcon icon={ faSchool} /><br/> Status</th>
                    <th><FontAwesomeIcon icon={ faRoad} /><br/> Adresse</th>
                    <th><FontAwesomeIcon icon={ faDivide} /><br/> Notes</th>
                    <th><FontAwesomeIcon icon={ faComment} /><br/> Commentaires</th>
                    <th colSpan={2}><FontAwesomeIcon icon={ faCog} /><br/> Actions</th>
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
            }
            <Pagination
                currentPage={currentPage}
                itemsPerPage={itemsPerPage}
                length={totalItems}
                OnPageChanged={handlePageChange}
            />
        </>
    )
};

export default IndexSchool;