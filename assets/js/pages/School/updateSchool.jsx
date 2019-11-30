import React,{useState,useEffect} from 'react';
import PostSchool from './forms/postSchool';
import SchoolService from '../../services/SchoolService';
import ClipLoader from 'react-spinners/ClipLoader';

const UpdateSchool = ({match}) =>{
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
    const handleSubmit = (event) =>{
        event.preventDefault();
        console.log("Submitting Update");
        console.log(school);
    };
    const handleChange = (event) =>{
        const value = event.currentTarget.value;
        const name = event.currentTarget.name;
        setSchool({...school, [name]: value });
    };

    return(
        <>
            <PostSchool
                descrPage="Modifier une Ecole"
                school={school}
                setSchool={setSchool}
                submit={handleSubmit}
                change={handleChange}
            />
        </>
    )
}

export default UpdateSchool;