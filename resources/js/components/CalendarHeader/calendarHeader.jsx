import React from "react";

function CalendarHeader({category, date}) {

    const dd = String(date.getDate()).padStart(2, '0');
    const mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
    const yyyy = date.getFullYear();

    return (
            <div className="card-header border-bottom-0">
                <div className="d-flex justify-content-around col-12">
                    <div className="col-2">
                        <h3>{mm} {yyyy}</h3>
                    </div>
                    <div className="col-8 d-flex justify-content-center align-items-center">
                    <h3 className="text-success text-uppercase mb-0">{category.name}</h3>
                    </div>
                    <div className="col-2">
                        <h3 className="text-danger">{dd}</h3>
                    </div>
                </div>
            </div>
    );
}

export default CalendarHeader;