import React,{useState,useEffect} from 'react';
import axios from "axios";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faIdCard, faSchool,faTag,faRoad,faDivide,faComment,faCog, faTruckLoading } from '@fortawesome/free-solid-svg-icons';
import ClipLoader from 'react-spinners/ClipLoader';
import Pagination from "../../componants/Pagination";

const IndexCategory = () =>{

    const [categorys,setCategorys] = useState([]);
    const [loading,setLoading ] = useState(true);
    const [totalItems, setTotalItems] = useState(0);
    const [currentPage, setCurrentPage] = useState(1);
    const itemsPerPage = 9;
    useEffect(() =>{
        console.log(process.env.REACT_APP_API);
        axios.get(`http://192.168.22.10/api/categories?page=${currentPage}`)
            .then(response => {
                setCategorys(response.data['hydra:member']);
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
            <h1 className="bg-primary p-2 text-center text-light">Liste des Categories</h1>
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
                    <th><FontAwesomeIcon icon={ faTag} /><br/> Nom</th>

                    <th colSpan={2}><FontAwesomeIcon icon={ faCog} /><br/> Actions</th>
                    </thead>
                    <tbody>
                    {categorys.map(category =>(
                    <tr key={category.id}>
                        <td>{category.id}</td>
                        <td>{category.name}</td>
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

export default IndexCategory;