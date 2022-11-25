import React from "react";
import CalendarContentTop from "./CalendarContentTop/CalendarContentTop";
import BookedDays from "./BookedDays";

function CalendarContent({ calendarSubcategories, calendarRooms, category, calendarBookings, daysToDisplay, actualMonth, actualYear, daysToCompare, today, calendarClients }) {
    return (
        <div className="card-body p-0">
            <div className="col-12 px-0">

                {calendarSubcategories.filter(sub => sub.parent_id === category.id).lenght !== 0 ? (
                    calendarSubcategories.filter(sub => sub.parent_id === category.id).map(sub => (
                        <div key={sub.id}>
                            <CalendarContentTop calendarSubcategories={sub} daysToDisplay={daysToDisplay} actualMonth={actualMonth} today={today} actualYear={actualYear}/>
                                {calendarRooms.filter(item => item.category_id === sub.id).map(item => (
                                    <div key={item.id} className="col-12 px-0 border-bottom d-flex">
                                        <div className="col-3 border-right py-1 d-flex align-items-center justify-content-center">
                                            <h6 className="text-uppercase font-weight-bold mb-0 text-center">pokój: {item.name}</h6>
                                        </div>
                                        <BookedDays calendarBookings={calendarBookings} room={item} daysToDisplay={daysToDisplay} actualMonth={actualMonth} actualYear={actualYear} daysToCompare={daysToCompare} calendarClients={calendarClients}/>
                                    </div>
                                ))}
                        </div>
                    ))
                ) : (
                    <>
                        <BookedDays calendarBookings={calendarBookings} room={room} daysToDisplay={daysToDisplay} actualMonth={actualMonth} actualYear={actualYear} daysToCompare={daysToCompare} calendarClients={calendarClients}/>
                    </>
                )}
                    <>
                        <CalendarContentTop daysToDisplay={daysToDisplay} actualMonth={actualMonth} today={today} actualYear={actualYear}/>
                        {calendarRooms.filter(room => room.category_id === category.id).map(room => (
                            <div key={room.id} className="col-12 px-0 border-bottom d-flex">
                                <div className="col-3 border-right py-1 d-flex align-items-center justify-content-center">
                                    <h6 className="text-uppercase font-weight-bold mb-0 text-center">pokój: {room.name}</h6>
                                </div>
                                <BookedDays calendarBookings={calendarBookings} room={room} daysToDisplay={daysToDisplay} actualMonth={actualMonth} actualYear={actualYear} daysToCompare={daysToCompare} calendarClients={calendarClients}/>
                            </div>
                        ))}
                    </>
            </div>
        </div>
    );
}

export default CalendarContent;