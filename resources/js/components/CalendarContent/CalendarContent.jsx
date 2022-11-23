import React from "react";
import CalendarContentTop from "./CalendarContentTop/CalendarContentTop";
import BookedDays from "./BookedDays";

function CalendarContent({ calendarSubcategories, calendarRooms, category, calendarBookings, daysToDisplay, actualMonth, actualYear, daysToCompare }) {
    return (
        <div className="card-body p-0">
            <div className="col-12 px-0">

                {calendarSubcategories.filter(sub => sub.parent_id === category.id) != null ? (
                    calendarSubcategories.filter(sub => sub.parent_id === category.id).map(sub => (
                        <div key={sub.id}>
                            <CalendarContentTop calendarSubcategories={sub} daysToDisplay={daysToDisplay} actualMonth={actualMonth}/>
                                {calendarRooms.filter(item => item.category_id === sub.id).map(item => (
                                    <div key={item.id} className="col-12 px-0 border-bottom d-flex overflow-scroll">
                                        <div className="col-3 border-right px-2 py-3 d-flex align-items-center justify-content-center">
                                            <h5 className="text-uppercase font-weight-bold mb-0 text-center">pokój: {item.name}</h5>
                                        </div>
                                        <BookedDays calendarBookings={calendarBookings} room={item} daysToDisplay={daysToDisplay} daysToCompare={daysToCompare}/>
                                    </div>
                                ))}
                        </div>
                    ))
                ) : (
                    <>
                        <BookedDays calendarBookings={calendarBookings} room={item} daysToDisplay={daysToDisplay} daysToCompare={daysToCompare}/>
                    </>
                )}
                    <>
                        {/* <CalendarContentTop daysToDisplay={daysToDisplay} actualMonth={actualMonth}/> */}
                        {calendarRooms.filter(room => room.category_id === category.id).map(room => (
                            <div key={room.id} className="col-12 px-0 border-bottom d-flex">
                                <div className="col-3 border-right px-2 py-3 d-flex align-items-center justify-content-center">
                                    <h5 className="text-uppercase font-weight-bold mb-0 text-center">pokój: {room.name}</h5>
                                </div>
                                <BookedDays calendarBookings={calendarBookings} room={room} daysToDisplay={daysToDisplay} actualMonth={actualMonth} actualYear={actualYear} daysToCompare={daysToCompare}/>
                            </div>
                        ))}
                    </>
            </div>
        </div>
    );
}

export default CalendarContent;