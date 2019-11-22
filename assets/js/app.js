import React from 'react';
import ReactDOM from "react-dom";
import {HashRouter,Route,Switch} from "react-router-dom";
import NavBar from "./componants/navbar";
import Home from "./pages/Home";
import IndexSchool from "./pages/School/indexSchool";

require('../css/app.css');

function App(){
    return(
            <HashRouter>
                <NavBar/>
                <div className="container mt-5 text-center">
                    <Switch>
                        <Route path="/schools" component={() => <IndexSchool/>} />
                        <Route path="/" component={() => <Home/>} />
                    </Switch>
                </div>
            </HashRouter>
    )
}

const rootElement = document.querySelector("#app");
ReactDOM.render(<App />, rootElement);