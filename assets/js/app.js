import React,{useState,useEffect} from 'react';
import ReactDOM from "react-dom";
import {HashRouter,Route,Switch} from "react-router-dom";
import SecurityService from "./services/SecurityService";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faCross} from '@fortawesome/free-solid-svg-icons';
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
import 'react-toastify/dist/ReactToastify.css';
import $ from 'jquery';
import Popper from 'popper.js';
import 'bootstrap/dist/js/bootstrap.bundle.min'

function App(){
    const [isAuthenticated,setIsAuthenticated] =useState(false);

    useEffect(() => {
        if(localStorage.getItem("isAuthenticated")){
            setIsAuthenticated(true);
        }
    },[]);

    const handleLogout = () =>{
        SecurityService.logout()
            .then(response =>{
                deleteFrontAuth()
                window.location.reload();
            })
            .catch(err =>{
                console.log("Erreur lors de la déconnexion")
            })
    }

    const deleteFrontAuth = () =>{
        if(localStorage.getItem("isAuthenticated") || localStorage.getItem("userData") ){
            localStorage.removeItem("isAuthenticated");
            localStorage.removeItem("userData");
        }
        if(isAuthenticated){
            setIsAuthenticated(false);
        }
    }

    const handleAuthenticated = (userData = null)=>{
        setIsAuthenticated(!isAuthenticated);
        console.log(userData)
        if(isAuthenticated || userData){
            console.log("JE PASSE")
            localStorage.setItem("isAuthenticated",!isAuthenticated);
            localStorage.setItem("userData",JSON.stringify(userData));
        }else{
            console.log("JE PASSE PAS")
            localStorage.removeItem("isAuthenticated");
            localStorage.removeItem("userData");
        }
    }


    const handleReject = (error) =>{
        let errorResponse = "";
        switch (error) {
            case("JWT Token not found"):
                errorResponse = "Vous devez être connecté pour accèder à cette ressource !";
                deleteFrontAuth();
                break;
            case("Invalid credentials."):
                errorResponse = `Adresse email ou mot de passe incorrect 🚫`;
                break;
            default:
                errorResponse = "Une erreur est survenue";
                break;
        }
        return errorResponse;
    }
    return(
            <HashRouter>
                <Navbar isAuthenticated={isAuthenticated} handleLogout={handleLogout}/>
                <div className="container mt-5 text-center">
                    <Switch>
                        <Route path="/comment_note/:id" render = {props => <CommentNote {...props} isAuthenticated={isAuthenticated} handleReject={handleReject}/>} />
                        <Route path="/schools/new" component={() => <NewSchool/>} />
                        <Route path="/schools/:id" render = {props => <UpdateSchool {...props}/>} />
                        <Route path="/schools" component={() => <IndexSchool/>} />
                        <Route path="/users" component={() => <IndexUser/>} />
                        <Route path="/categorys" component={() => <IndexCategory/>} />
                        <Route path="/login" render={props => <Login {...props} isAuthenticated={isAuthenticated} handleAuthenticated={handleAuthenticated} handleReject={handleReject} deleteFrontAuth={deleteFrontAuth}/>} />
                        <Route path="/" component={() => <Home handleReject={handleReject}/>} />
                    </Switch>
                </div>
            </HashRouter>
    )
}

const rootElement = document.querySelector("#app");
ReactDOM.render(<App />, rootElement);