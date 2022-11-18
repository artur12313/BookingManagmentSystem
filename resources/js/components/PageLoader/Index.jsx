import React from "react";

const PageLoader = (loadingMsg) => {
    return(
        <div className="d-flex justify-content-center align-items-center py-4">
            <div className="spinner-border text-dark mx-2" role="status">
            </div>
            <div>
                {/* <span className="sr-only">Pobieranie danych...</span> */}
                <span>Pobieranie danych...</span>
            </div>
        </div>
    );
};

export default PageLoader