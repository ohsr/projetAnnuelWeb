import React from 'react';
import ImgFirst from "../../img/university/first.jpg";
import ImgSecond from "../../img/university/second.jpg";
import ImgThird from "../../img/university/third.jpg";
import ImgFourth from "../../img/university/fourth.jpg";



const ImgRender = ({picture,size}) =>{

    const css = `
        .card-img-top {
            width: 100%;
            height: ${size}em;
            object-fit: cover;
        }
    `;
    return(
        <>
            <style>{css}</style>
            <img src={picture  ===  "first.jpg" ? ImgFirst : picture === "second.jpg" ? ImgSecond : picture === "third.jpg" ? ImgThird : picture === "fourth.jpg" ? ImgFourth : ImgFirst}
                 className="img-fluid card-img-top"
            />
        </>
    )
}
export default ImgRender;