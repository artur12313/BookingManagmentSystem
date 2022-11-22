import React from "react";
import formatDate from 'date-fns/format';
import MonthNames from "../Tools/MonthNames";

function CalendarHeader({category, prevMonth, nextMonth, actualMonth, actualYear}) {

    return (
            <div className="card-header border-bottom-0">
                <div className="d-flex justify-content-around col-12">
                    <div className="col-4 d-flex align-items-center justify-content-center">
                            <button onClick={prevMonth} className="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="bi bi-chevron-left" viewBox="0 0 16 16">
                                    <path fillRule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                </svg>
                            </button>
                        <div className="col-5 d-flex justify-content-center">
                            <h4 className="mb-0 d-flex"><MonthNames actualMonth={actualMonth} /> {actualYear}</h4>
                        </div>
                            <button onClick={nextMonth} className="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fillRule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </button>
                    </div>
                    <div className="col-9 d-flex justify-content-center align-items-center">
                    <h3 className="text-success text-uppercase mb-0">{category.name}</h3>
                    </div>
                </div>
            </div>
    );
}

export default CalendarHeader;