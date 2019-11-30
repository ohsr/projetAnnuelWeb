import React,{useState} from 'react';

import PostSchool from './forms/postSchool';

const NewSchool = () =>{
    const [school,setSchool] = useState([]);
    const handleSubmit = (event) =>{
        event.preventDefault();
        console.log("Submitting");
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
                descrPage="Créer une Ecole"
                school={school}
                setSchool={setSchool}
                submit={handleSubmit}
                change={handleChange}
            />
        </>
    )
}

export default NewSchool;