import React from "react";

function BookedDays({ calendarBookings, room, daysToDisplay, actualMonth, actualYear, daysToCompare }) {

    let date = new Date();

    let output = [];

    daysToCompare.filter(day => {
        calendarBookings.filter(booking => {
            if (booking.room_id === room.id) {
                if (booking.start_date === day) {
                    console.log('booked days: ', day);
                    output.push(<div className="bg-danger px-2 py-1 border">&nbsp;</div>);
                } else {
                    console.log('not booked days: ', day);
                    output.push(<div className="bg-success px-2 py-1 border">&nbsp;</div>);
                }
            }
        })
    })

    let days = daysToCompare.map(day => (
        <div key={day} className="border-right d-flex flex-wrap text-center px-2 py-1">
            <div className="d-flex flex-wrap justify-content-center">
                <div>{day}</div>
                {BookedDays}
            </div>
        </div>
    ))



    return (
        <div className="col-9 monthDays d-flex flex-wrap justify-content-center" id="days">
            {/* {daysToCompare.map(day => (
                <div key={day} className="border-right d-flex flex-wrap text-center px-2 py-1">
                    <div className="d-flex flex-wrap justify-content-center">
                        <div>{day}</div>
                        {calendarBookings.filter(booking => booking.room_id === room.id).map(booking => (
                            <div key={booking.id}>
                                <li>{booking.start_date}</li>
                                <li>{booking.end_date}</li>
                            </div>
                        ))}
                    </div>
                </div>
            ))} */}

            {output.map(day => day)}
        </div>
    );
}

export default BookedDays;