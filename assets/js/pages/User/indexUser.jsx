import React,{useState,useEffect} from 'react';
import axios from "axios";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faIdCard, faMailBulk, faUser ,faCog } from '@fortawesome/free-solid-svg-icons';
import ClipLoader from 'react-spinners/ClipLoader';
import Pagination from "../../componants/Pagination";

const IndexUser = () =>{

    const [users,setUsers] = useState([]);
    const [loading,setLoading ] = useState(true);
    const [totalItems, setTotalItems] = useState(0);
    const [currentPage, setCurrentPage] = useState(1);
    const itemsPerPage = 9;
    useEffect(() =>{
        axios.get(`http://192.168.22.10/api/users?page=${currentPage}`)
            .then(response => {
                setUsers(response.data['hydra:member']);
                setTotalItems(response.data['hydra:totalItems']);
            }).then(()=>{
            setLoading(false);
        }).catch(error => console.log(error.response));
    },[currentPage]);

    const handlePageChange = (page) =>{
        setCurrentPage(page);
        setLoading(true);
    };
    return(
        <>
            <h1 className="bg-primary p-2 text-center text-light">Liste des Utilisateurs</h1>
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
                        <th><FontAwesomeIcon icon={ faMailBulk} /><br/> Email</th>
                        <th><FontAwesomeIcon icon={ faUser} /><br/> Prénom</th>
                        <th><FontAwesomeIcon icon={ faUser} /><br/> Nom</th>
                        <th><FontAwesomeIcon icon={ faUser } /><br/> Role</th>
                        <th colSpan={2}><FontAwesomeIcon icon={ faCog} /><br/> Actions</th>
                    </thead>
                    <tbody>
                    {users.map(user =>(
                        <tr key={user.id}>
                            <td>{user.id}</td>
                            <td>{user.email}</td>
                            <td>{user.firstName}</td>
                            <td>{user.lastName}</td>
                            <td>{user.roles}</td>
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

export default IndexUser;