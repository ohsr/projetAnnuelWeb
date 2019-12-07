import React, {useEffect, useState} from 'react';
import ClipLoader from 'react-spinners/ClipLoader';
import SchoolService from "../services/SchoolService";
import CategoryService from "../services/CategoryService";
import CommentService from "../services/CommentService";
import ImgRender from "../componants/ImgRender";

import CommentNotepart from "../componants/CommentNotePart";

const CommentNote = ({match}) =>{
    const [school,setSchool] = useState([]);
    const [loading,setLoading ] = useState(true);

    const [categorys,setCategorys] = useState([]);
    const [categoryChoosen,setCategoryChoosen] = useState([]);
    const [categoryMoy,setCategoryMoy] = useState(0);
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

    const calcMoy = (commentsVal) =>{
        let rating = 0;
        let count = 0;
        commentsVal.map(comment =>{
            rating += comment.note;
            count ++;
        })
        console.log(rating)
        console.log(count)
        return (rating/count).toFixed(1);
    }
    const handleCommentsAndNotes = (school,categoryVal) =>{
        setLoadingComments(true);
        if(!firstClick)setFirstClick(true);

        setCategoryChoosen(categoryVal);
        CommentService.findBySchoolAndCategory(school,categoryVal.id)
            .then(response =>{
                setComments(response.data["hydra:member"]);
                setCategoryMoy(calcMoy(response.data["hydra:member"]));
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
                        <ImgRender picture={school.picture} size={25} />
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
                                <CommentNotepart category={categoryChoosen} comments={comments} loadingComments={loadingComments} categoryMoy={categoryMoy}/>
                        }
                    </div>
                </div>
            }

        </>
    )
};

export default CommentNote;