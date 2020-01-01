import React from 'react';
import ReactDOM from "react-dom";
import {HashRouter,Route,Switch} from "react-router-dom";
import Navbar from "./componants/Navbar";
import Home from "./pages/Home";
import IndexSchool from "./pages/School/indexSchool";
import IndexUser from "./pages/User/indexUser";
import IndexCategory from "./pages/Category/indexCategory";
import NewSchool from "./pages/School/newSchool";
import UpdateSchool from "./pages/School/updateSchool";
import CommentNote from "./pages/CommentNote";
import Login from "./pages/Login";

require('../css/app.css');
import $ from 'jquery';
import Popper from 'popper.js';
import 'bootstrap/dist/js/bootstrap.bundle.min'

function App(){
    return(
            <HashRouter>
                <Navbar/>
                <div className="container mt-5 text-center">
                    <Switch>
                        <Route path="/comment_note/:id" render = {props => <CommentNote {...props}/>} />
                        <Route path="/schools/new" component={() => <NewSchool/>} />
                        <Route path="/schools/:id" render = {props => <UpdateSchool {...props}/>} />
                        <Route path="/schools" component={() => <IndexSchool/>} />
                        <Route path="/users" component={() => <IndexUser/>} />
                        <Route path="/categorys" component={() => <IndexCategory/>} />
                        <Route path="/login" component={() => <Login/>} />
                        <Route path="/" component={() => <Home/>} />
                    </Switch>
                </div>
            </HashRouter>
    )
}

const rootElement = document.querySelector("#app");
ReactDOM.render(<App />, rootElement);