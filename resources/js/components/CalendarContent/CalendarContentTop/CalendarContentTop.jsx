import React from "react";

function CalendarContentTop({calendarSubcategories}) {
    return (
        <div className="border-bottom border-top col-12">
            <div className="col-3 border-right px-2 py-3">
                <h5 className="text-danger text-uppercase font-weight-bold mb-0">{calendarSubcategories.name}</h5>
            </div>
            <div className="col-9">

            </div>
        </div>
    );
}

export default CalendarContentTop;