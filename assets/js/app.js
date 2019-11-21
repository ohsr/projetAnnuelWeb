import React from 'react';
import ReactDOM from "react-dom";

import NavBar from "./componants/navbar";

require('../css/app.css');

function App(){
    return(
        <div>
            <NavBar/>
            <div className="container text-center mt-5">
                <h1>ReactJs + Webpack 🐑 </h1>
                <button className="btn btn-primary mt-1">En savoir plus</button>
            </div>
        </div>
    )
}

const rootElement = document.querySelector("#app");
ReactDOM.render(<App />, rootElement);