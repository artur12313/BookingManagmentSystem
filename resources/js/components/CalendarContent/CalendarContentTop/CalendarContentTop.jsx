import DayNames from "../../Tools/DayNames";
import formatDate from 'date-fns/format';
import getDay from "date-fns/getDay";

function CalendarContentTop(
    { 
        calendarSubcategories,
        daysToDisplay,
        actualMonth,
        today,
        actualYear,
        boxWidth,
    }) {

    const dateFormat = "dd-MM-yyyy";
    const todayFormatDate = formatDate(today, dateFormat);
    const days = [];
    daysToDisplay.map(day => {
        if (formatDate(new Date(actualYear, actualMonth - 1, day), dateFormat) === todayFormatDate) {
           days.push(<div key={day} >
                <div className="d-flex flex-column text-danger justify-content-center text-sm-center py-1" style={{ width: boxWidth }}>
                    <div>{day}</div>
                    <div><DayNames dayName={getDay(new Date(actualYear, actualMonth - 1, day))}/></div>
                </div>
            </div>)
        } else {
            days.push(<div key={day} >
                <div className="d-flex flex-column justify-content-center text-sm-center py-1" style={{ width: boxWidth }}>
                    <div>{day}</div>
                    <div><DayNames dayName={getDay(new Date(actualYear, actualMonth - 1, day))}/></div>
                </div>
            </div>)
        }
    });
    return (
        <div className="border-bottom border-top col-12 d-flex px-0">
            <div className="col-2 border-right px-2 py-3">
                <h6 className="text-danger text-uppercase font-weight-bold mb-0 text-center">{calendarSubcategories ? calendarSubcategories.name : ' '}</h6>
            </div>
            <div className="col-10 p-0">
                <div className="d-flex monthDays justify-content-between">
                    {days.map(item => item)}
                </div>
            </div>
        </div>
    );
}

export default CalendarContentTop;