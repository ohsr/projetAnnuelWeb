import React,{useState,useEffect} from 'react';
import Pagination from '../componants/Pagination';
import SchoolService from '../services/SchoolService';
import FilterDropdown from "../componants/FilterDropdown";

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faStar,faComment} from '@fortawesome/free-solid-svg-icons';
import ClipLoader from 'react-spinners/ClipLoader';
import {NavLink} from "react-router-dom";
import ImgRender from "../componants/ImgRender";
import { toast } from 'react-toastify';

const Home = ({handleReject}) =>{
    toast.configure();
    const [schools,setSchools] = useState([]);
    const [loading,setLoading ] = useState(true);
    const [totalItems, setTotalItems] = useState(0);
    const [currentPage, setCurrentPage] = useState(1);
    const [schoolStatus, setSchoolStatus] = useState("Ecole Publique");
    const [schoolOrder, setSchoolOrder] = useState({
        target: null,
        value: null
    })
    const [schoolSearch, setSchoolSearch] = useState({
        target: null,
        value: null
    })

    const itemsPerPage = 9;

    useEffect(() => {
        SchoolService.findMainWindow(currentPage,schoolStatus,schoolOrder,schoolSearch)
            .then(response => {
                setSchools(response.data["hydra:member"]);
                setTotalItems(response.data["hydra:totalItems"]);
                setLoading(false);
            })
            .catch(err =>{
                toast.error(handleReject(err.response.data.message),{
                    position: toast.POSITION.BOTTOM_RIGHT,
                    className: 'foo-bar'
                });
                setLoading(false)
            })
    }, [currentPage,schoolStatus,schoolOrder]);

    const handlePageChange = (page) =>{
        setCurrentPage(page);
        setLoading(true);
    }
    const handleStatus = (status) =>{
        setSchoolStatus(status);
        setCurrentPage(1);
        setLoading(true);
    }
    const handleOrder = (target,value) =>{
        setSchoolOrder({target,value});
        setCurrentPage(1);
        setLoading(true);
    }
    return(
        <>

            <h1>Projet Annuel - NoteMySchool 🏫 </h1>
            <div className="container">
                <div className="row justify-content-md-center">
                    <div className="col-lg-2">
                        <button onClick={() => handleStatus("Ecole Publique")} className="btn btn-sm btn-block btn-outline-primary border border-primary">
                            Ecoles Publiques
                        </button>
                    </div>
                    <div className="col-lg-2">
                        <button onClick={() => handleStatus("Ecole Privé")} className="btn btn-sm btn-block btn-outline-primary border border-primary">
                            Ecoles Privées
                        </button>
                    </div>
                    <div className="col-lg-1">
                        <FilterDropdown handleOrder={handleOrder}/>
                    </div>
                </div>
                
            </div>
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
                <div>

                <div className="row mt-3">
                    {schools.map(school =>(

                            <div className="col-md-4 mt-2 d-flex align-items-stretch" key={school.id}>

                                <div className="card pmd-card d-block d-flex " >
                                    <div className="bg-warning text-light lead"><FontAwesomeIcon icon={faStar} /> {school.globalNote}</div>

                                    <div className="pmd-card-media">
                                        
                                        <ImgRender picture={school.picture} size={12} />
                                        
                                    </div>
                                    <div className="card-body">
                                        <h2 className="card-title">{school.name}</h2>
                                        <p className="card-subtitle mb-3">{school.adress}</p>
                                        <p className="card-text">Cards provide context and an entry point to more robust information
                                            and views. Don't overload cards with extraneous information or actions.</p>
                                    </div>
                                    <div className="card-footer">
                                        <NavLink to={"/comment_note/"+school.id} className="align-self-end m-1 btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary">
                                            <FontAwesomeIcon icon={faStar} /> Noter & Commenter <FontAwesomeIcon icon={faComment} />
                                        </NavLink>
                                    </div>
                                </div>
                            </div>
                    ))}
                </div>
                <Pagination
                    currentPage={currentPage}
                    itemsPerPage={itemsPerPage}
                    length={totalItems}
                    OnPageChanged={handlePageChange}

                />
                </div>
            }

        </>
    )
};

export default Home;