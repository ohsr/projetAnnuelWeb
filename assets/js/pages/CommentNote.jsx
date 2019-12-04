import React, {useEffect, useState} from 'react';
import ClipLoader from 'react-spinners/ClipLoader';
import SchoolService from "../services/SchoolService";
import CategoryService from "../services/CategoryService";
import CommentService from "../services/CommentService";

const CommentNote = ({match}) =>{
    const [school,setSchool] = useState([]);
    const [loading,setLoading ] = useState(true);
    const [categorys,setCategorys] = useState([]);
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
                .catch(err => console.log("Erreur lors de la sélection"))
        },[]
    );

    const handleCommentsAndNotes = (school,category) =>{
        setLoadingComments(true);
        CommentService.findBySchoolAndCategory(school,category)
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
                                        <button href={"#collapse"+category.id} onClick={ () => handleCommentsAndNotes(school.id,category.id)} className="btn btn-outline-primary  border border-primary btn-block btn-sm" data-toggle="collapse"  role="button"
                                                aria-expanded="false" aria-controls={category.id}>
                                            {category.name}
                                        </button>
                                    </div>

                                ))}

                            </div>
                        {categorys.map(category =>(
                            <div className="collapse" id={"collapse"+category.id} key={"collapse"+category.id}>
                                <div className="card card-body">
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
                                                    <div key={comment.id}>
                                                        {
                                                            comment.categorys.id === category.id
                                                            &&
                                                            <div className="media">
                                                                <img src="http://placehold.it/64x64" className="mr-3" alt="..." />
                                                                    <div className="media-body">
                                                                        <h5 className="mt-0">{comment.users.firstName} {comment.users.lastName}</h5>
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
                            </div>
                        ))}


                    </div>
                </div>
            }

        </>
    )
};

export default CommentNote;