import { useState } from "react";
import { formatDistance, subDays } from 'date-fns';
import DayNames from "../../Tools/DayNames";
import formatDate from 'date-fns/format';
import startOfWeek from "date-fns/startOfWeek";
import addDays from "date-fns/addDays";

function CalendarContentTop({calendarSubcategories, daysToDisplay, actualMonth}) {

    const dateFormat = "EE";
    const days = [];

    let startDate = startOfWeek(actualMonth);

    // for (let i = 0; i < 7; i++) {
    //   days.push(formatDate(addDays(startDate, i), dateFormat));
    // }

    return (
        <div className="border-bottom border-top col-12 d-flex px-0">
            <div className="col-3 border-right px-2 py-3">
                <h5 className="text-danger text-uppercase font-weight-bold mb-0 text-center">{calendarSubcategories ? calendarSubcategories.name : ' '}</h5>
            </div>
            <div className="col-9 p-0">
                <div className="d-flex justify-content-around monthDays">
                    {daysToDisplay.map(day => (
                        <div key={day} className="border-right">
                            <div className="d-flex flex-column justify-content-center text-center px-2 py-1">
                                <div>{day}</div>
                                <div><DayNames dayName={formatDate(addDays(startDate, day), dateFormat)} /></div>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
}

export default CalendarContentTop;