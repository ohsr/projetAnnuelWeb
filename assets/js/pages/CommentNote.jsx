import React, {useEffect, useState} from 'react';
import ClipLoader from 'react-spinners/ClipLoader';
import SchoolService from "../services/SchoolService";
import CategoryService from "../services/CategoryService";
import CommentService from "../services/CommentService";
import StarRatings from 'react-star-ratings';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faInfoCircle } from '@fortawesome/free-solid-svg-icons';

const CommentNote = ({match}) =>{
    const [school,setSchool] = useState([]);
    const [loading,setLoading ] = useState(true);

    const [categorys,setCategorys] = useState([]);
    const [categoryChoosen,setCategoryChoosen] = useState([]);
    const [firstClick,setFirstClick] = useState(false);

    const[comments,setComments] = useState([]);
    const [loadingComments,setLoadingComments ] = useState(true);
    useEffect(() => {
            SchoolService.findOneById(match.params.id)
                .then(response =>{
                    setSchool(response.data);
                })
                .then(()=>{
                    CategoryService.findAll()
                        .then(response =>{
                            setCategorys(response.data["hydra:member"]);
                            setLoading(false);
                        })
                })
                .catch(err => {
                    setLoading(false)
                    console.log("Erreur lors de la sélection")
                })
        },[]
    );

    const handleCommentsAndNotes = (school,categoryVal) =>{
        setLoadingComments(true);
        if(!firstClick)setFirstClick(true);

        setCategoryChoosen(categoryVal);
        CommentService.findBySchoolAndCategory(school,categoryVal.id)
            .then(response =>{
                setComments(response.data["hydra:member"]);
                setLoadingComments(false);
            })
            .catch(err => {
                console.log(err.response)
            })
    }
    return(
        <>
            <h2 className="text-center bg-primary p-2 text-light">Noter et Commenter</h2>
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
                <div className="card pmd-card" >
                    <div className="pmd-card-media">
                        <img src="http://propeller.in/assets/images/profile-pic.png" width="400" height="200"
                             className="img-fluid"/>
                    </div>
                    <div className="card-body">
                        <h2 className="card-title">{school.name}</h2>
                        <p className="card-subtitle mb-3">{school.adress}</p>
                        <p className="card-text">Cards provide context and an entry point to more robust information
                            and views. Don't overload cards with extraneous information or actions.</p>
                    </div>
                    <div className="card-footer">
                            <div className="row">
                                {categorys.map(category =>(
                                    <div className="col" key={category.id}>
                                        <button onClick={ () => handleCommentsAndNotes(school.id,category)} className="btn btn-outline-primary  border border-primary btn-block btn-sm" data-toggle="collapse"  role="button"
                                                aria-expanded="false" aria-controls={category.id}>
                                            {category.name}
                                        </button>
                                    </div>

                                ))}
                            </div>
                        {
                            firstClick
                            &&
                                <div className="card card-body mt-5">
                                    <h4 className="text-center bg-primary p-2 text-light">{categoryChoosen.name}</h4>
                                    <small className="form-text text-muted lead"> <FontAwesomeIcon icon={faInfoCircle}/> {categoryChoosen.info}</small>
                                    <hr/>
                                    {
                                        loadingComments
                                        &&
                                        <div className='sweet-loading text-center'>
                                            <ClipLoader
                                                sizeUnit={"px"}
                                                size={100}
                                                color={'#ff1744'}
                                            />
                                        </div>
                                        ||
                                        comments.length
                                        &&
                                        comments.map(comment => (
                                            <div key={comment.id} className="mb-2">
                                                {
                                                    comment.categorys.id === categoryChoosen.id
                                                    &&
                                                    <div className="media">
                                                        <img src="http://placehold.it/64x64" className="mr-3 mt-4 rounded rounded-circle" alt="..." />
                                                        <div className="media-body">
                                                            <h5 className="">
                                                                {comment.users.firstName} {comment.users.lastName}
                                                            </h5>
                                                            <StarRatings
                                                                rating={comment.note}
                                                                starDimension="20px"
                                                                starSpacing="10px"
                                                                starRatedColor="#ff1744"
                                                            />
                                                            <br/>
                                                            {comment.comment}
                                                        </div>
                                                    </div>
                                                }
                                            </div>
                                        ))
                                        ||
                                        <p> Aucun Commentaire pour cette section </p>
                                    }
                                </div>
                        }

                    </div>
                </div>
            }

        </>
    )
};

export default CommentNote;