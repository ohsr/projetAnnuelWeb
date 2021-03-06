import React,{useState} from 'react';
import ClipLoader from 'react-spinners/ClipLoader';
import StarRatings from 'react-star-ratings'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faInfoCircle,faStar,faStarHalfAlt } from '@fortawesome/free-solid-svg-icons';
import CommentService from "../services/CommentService";
import { toast } from 'react-toastify';

const CommentNotePart = ({isAuthenticated,handleReject,category,comments,loadingComments,categoryMoy,school}) =>{
    toast.configure()
    const [commentNote,setCommentNote] = useState({
        note: 0,
        comment: ""
    })
    const handleSubmit = (event) =>{
        event.preventDefault();
        commentNote.note = parseInt(commentNote.note);
        commentNote["categorys"] = `/api/categories/${category.id}`;
        commentNote["schools"] = `/api/schools/${school.id}`;
        CommentService.create(commentNote).then(response=>{
                toast.success("Votre Commentaire a bien été posté");
            }
        ).catch(err =>{
            toast.error(handleReject(err.response.data.message));
            setCommentNote({
                note: 0,
                comment: ""
            })
        })
    }
    const handleChange = (event) =>{
        let name = event.currentTarget.name;
        let value = event.currentTarget.value;
        setCommentNote({...commentNote,[name]:value })
    }
    return(
        <>
            <div className="card card-body mt-5">
                <h4 className="text-center bg-primary p-2 text-light">{category.name}</h4>
                <small className="form-text text-muted lead"> <FontAwesomeIcon icon={faInfoCircle}/> {category.info}</small>
                {
                    !loadingComments
                    &&
                    <small className="form-text text-muted lead">
                        <FontAwesomeIcon icon={faStar}/>  Note Moyenne pour cette catégorie <b>{categoryMoy}/5</b>
                    </small>
                }
                <hr/>
                { isAuthenticated
                &&
                <form className="border border-primary m-5" onSubmit={handleSubmit}>
                    <h5 className="text-center bg-primary p-2 text-light">Noter & Commenter l'école pour son {category.name}</h5>
                    <div className="form-group">
                        <label htmlFor="note">Note</label>
                        <input type="number" name="note" id="note" className="form-control" onChange={handleChange}/>
                    </div>
                    <div className="form-group">
                        <label htmlFor="comment">Commentaire</label>
                        <textarea name="comment" id="comment" className="form-control" onChange={handleChange}></textarea>
                    </div>
                    <button type="submit" className="btn btn-success mb-2 ">Commenter</button>
                </form>
                }
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
                                comment.categorys.id === category.id
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
        </>
    )
}

export default CommentNotePart;