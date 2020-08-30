import React from 'react';


const Field = ({label, name, value, onChange, placeholder, type ="text", error = "",requiredVal = false}) =>{

    return(
        <>
            <div className="form-group">
                <label htmlFor={name}>{label}</label>
                <input type={type} className={"form-control " + (error && " is-invalid") } placeholder={placeholder}
                       value={value}  onChange={onChange} id={name} name={name} required={requiredVal && "required"} />
                {error &&  <p className="text-center invalid-feedback">{error}</p>}
            </div>
        </>
    )
};
export default Field;