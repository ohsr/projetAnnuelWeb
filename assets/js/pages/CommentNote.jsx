import React, {useEffect, useState} from 'react';
import SchoolService from "../services/SchoolService";
import ClipLoader from 'react-spinners/ClipLoader';


const CommentNote = ({match}) =>{
    const [school,setSchool] = useState([]);
    const [loading,setLoading ] = useState(true);

    useEffect(() => {
            SchoolService.findOneById(match.params.id)
                .then(response =>{
                    setSchool(response.data);
                    setLoading(false);
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
                    <div className="card">
                        Chargé
                    </div>
            }

        </>
    )
};

export default CommentNote;