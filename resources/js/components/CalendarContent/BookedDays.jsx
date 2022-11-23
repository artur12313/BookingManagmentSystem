import React from "react";

function BookedDays({ calendarBookings, room, daysToDisplay, actualMonth, actualYear, daysToCompare }) {

    let date = new Date();

    let output = [];
    let newbookingLink = '/booking'

    daysToCompare.forEach(day => {
        let bookings = calendarBookings.filter(booking => booking.room_id === room.id && day >= booking.start_date && day <= booking.end_date);
        if (bookings.length === 0) {
            output.push(
                <div key={day}>
                    <a href={newbookingLink} className="btn btn-sm btn-success rounded-0 border outline-0 p-0" style={{width: 45}}><div className="py-3">&nbsp;</div></a>
                </div>
            );
        } else {
            bookings.forEach(booking => {
                let editLink = '/booking/details/' + booking.id;
                output.push(
                    <div key={day}>
                       <a href={editLink} className="btn btn-sm btn-danger rounded-0 border outline-0 p-0" style={{width: 45}}><div className="py-3" style={{width: 45}}>&nbsp;</div></a>
                    </div>
                );
            });
        }
    });

    return (
        <div className="col-9 px-0 monthDays d-flex flex-wrap justify-content-around">
                   {output}
        </div>
    );
}

export default BookedDays;