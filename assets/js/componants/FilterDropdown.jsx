import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faFilter, faStar,faStarHalf,faMapMarker,faSearch} from '@fortawesome/free-solid-svg-icons';

const FilterDropdown = ({handleOrder}) =>{

    return(
        <div className="btn-group text-right">
            <button type="button" className="btn btn-light dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <FontAwesomeIcon icon={faFilter} /> Trier par
            </button>
            <div className="dropdown-menu">
                <a className="dropdown-item" onClick={()=> handleOrder("globalNote","DESC")}><FontAwesomeIcon icon={faStar} /> les mieux notées</a>
                <a className="dropdown-item" onClick={()=> handleOrder("globalNote","ASC")}><FontAwesomeIcon icon={faStarHalf} /> les moins bien notées</a>
                <a className="dropdown-item" href="#"><FontAwesomeIcon icon={faMapMarker} /> les plus proches de vous</a>
                <a className="dropdown-item" href="#"><FontAwesomeIcon icon={faSearch} /> les plus recherchées</a>
            </div>
        </div>
    )
}
export default FilterDropdown;