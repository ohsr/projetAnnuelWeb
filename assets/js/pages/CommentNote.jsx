import React, {useEffect, useState} from 'react';
import ClipLoader from 'react-spinners/ClipLoader';
import SchoolService from "../services/SchoolService";
import CategoryService from "../services/CategoryService";


const CommentNote = ({match}) =>{
    const [school,setSchool] = useState([]);
    const [loading,setLoading ] = useState(true);
    const [categorys,setCategorys] = useState([]);
    useEffect(() => {
            SchoolService.findOneById(match.params.id)
                .then(response =>{
                    console.log(response.data)
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
        },[match.params.id]
    );
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
                                        <button className="btn btn-outline-primary  border border-primary btn-block btn-sm" data-toggle="collapse" href={"#collapse"+category.id} role="button"
                                                aria-expanded="false" aria-controls={category.id}>
                                            {category.name}
                                        </button>
                                    </div>

                                ))}
                                {categorys.map(category =>(
                                    <div className="collapse" id={"collapse"+category.id} key={"collapse"+category.id}>
                                        <div className="card card-body">
                                            {
                                                Object.values(school.commentsUser[0].categorys).indexOf(category.name) > -1
                                                &&
                                                    <p>Il y a un commentaire pour cette catégorie pour cette école</p>
                                                ||
                                                    <p>Pas de commentaires dans cette catégorie pour cette école</p>
                                            }
                                        </div>
                                    </div>
                                ))}
                            </div>


                    </div>
                </div>
            }

        </>
    )
};

export default CommentNote;