import React from "react";
import CalendarContentTop from "./CalendarContentTop/CalendarContentTop";

function CalendarContent({ calendarSubcategories, calendarRooms, category, calendarBookings }) {
    return (
        <div className="card-body p-0">
            <div className="col-12 px-0">
                        {calendarSubcategories.filter(sub => sub.parent_id === category.id).map(sub => (
                            <div key={sub.id}>
                                <CalendarContentTop calendarSubcategories={sub}/>
                                    {calendarRooms.filter(item => item.category_id === sub.id).map(item => (
                                        <div key={item.id} className="col-12 border-bottom">
                                            <div className="col-3 border-right px-2 py-3">
                                                <h5 className="text-uppercase font-weight-bold mb-0">pokój: {item.name}</h5>
                                                <ul>
                                                    {calendarBookings.filter(booking => booking.room_id === item.id).map(booking => (
                                                        <div key={booking.id}>
                                                            <li>{booking.start_date}</li>
                                                            <li>{booking.end_date}</li>
                                                        </div>
                                                    ))}
                                                </ul>
                                            </div>
                                        </div>
                                    ))}
                            </div>
                        ))}
                    <ul>
                        {calendarRooms.filter(room => room.category_id === category.id).map(room => (
                            <div key={room.id}>
                                <li>pokój: {room.name}</li>
                                <ul>
                                    {calendarBookings.filter(booking => booking.room_id === room.id).map(booking => (
                                        <div key={booking.id}>
                                            <li>{booking.start_date}</li>
                                            <li>{booking.end_date}</li>
                                        </div>
                                    ))}
                                </ul>
                            </div>
                        ))}
                    </ul>
            </div>
        </div>
    );
}

export default CalendarContent;