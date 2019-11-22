import React from 'react';

const Pagination = ({currentPage, itemsPerPage, length, OnPageChanged}) =>{
    const pagesCount = Math.ceil(length / itemsPerPage);
    const pages = [];
    for(let i=1; i<= pagesCount;i++){
        pages.push(i);
    }
    return(
        <>
            <div className="d-flex mt-2">
                <ul className="pagination mx-auto">
                    <li className={"page-item "+ (currentPage === 1 && "disabled")}>
                        <button  className="page-link" onClick={()=>OnPageChanged(currentPage-1)}>&laquo; Précédent</button >
                    </li>
                    {pages.map(page =>(
                        <li key={page} className={"page-item " + ( currentPage === page && "active") }>
                            <button className="page-link" onClick={()=>OnPageChanged(page)}>{page}</button>
                        </li>
                    ))}
                    <li className={"page-item "+ (currentPage === pagesCount && "disabled")}>
                        <button className="page-link" onClick={()=>OnPageChanged(currentPage+1)}>Suivant &raquo;</button >
                    </li>
                </ul>
            </div>
        </>
    );
}



export default Pagination;