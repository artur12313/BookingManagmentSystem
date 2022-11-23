import React from "react";

function BookedDays({ calendarBookings, room, daysToDisplay, actualMonth, actualYear, daysToCompare }) {

    let date = new Date();

    let output = [];
    let newbookingLink = '/booking'

    daysToCompare.forEach(day => {

        calendarBookings.forEach(booking => {
            let editLink = '/booking/details/' + booking.id;
            if (booking.room_id === room.id && day >= booking.start_date && day <= booking.end_date) {
                if (booking.start_date === day || booking.end_date === day) {
                    console.log('booked days: ', day);
                    // output.push(<a href={editLink} className="btn btn-sm btn-danger rounded-0 border outline-0 p-0" style={{width: 45}}><div className="py-1" style={{width: 45}}>&nbsp;</div></a>);
                    output.push(<a href={editLink} className="btn btn-sm btn-danger rounded-0 border outline-0 p-0" style={{width: 45}}><div className="py-1" style={{width: 45}}>&nbsp;</div></a>);
                }
            }
        })
        console.log('not booked days: ', day);
        output.push(<a href={newbookingLink} className="btn btn-sm btn-success rounded-0 border outline-0 p-0" style={{width: 45}}><div className="py-1">&nbsp;</div></a>);
    })

    // daysToCompare.filter(day => {
    //     calendarBookings.filter(booking => booking.room_id === room.id && day >= booking.start_date && day <= booking.end_date).map(booking => {
    //         output.push(<div className="bg-danger px-2 py-1 border">&nbsp;</div>);
    //     })
    // })

    let days = daysToCompare.map(day => (
        <div key={day} className="border-right d-flex flex-wrap text-center px-2 py-1">
            <div className="d-flex flex-wrap justify-content-center">
                <div>{day}</div>
                {BookedDays}
            </div>
        </div>
    ))



    return (
        <div className="col-9 px-0 monthDays d-flex flex-wrap justify-content-around" id="days">
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