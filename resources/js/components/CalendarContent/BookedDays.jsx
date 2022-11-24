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
                    <a href={newbookingLink} target="_blank" className="btn btn-sm btn-success rounded-0 border outline-0 p-0" data-toggle="tooltip" data-placement="bottom" title={day} style={{ width: 45 }}>
                        <div className="py-3">&nbsp;</div>
                    </a>
                </div>
            );
        } else {
            bookings.forEach(booking => {
                let editLink = '/booking/details/' + booking.id;
                switch (booking.status) {
                    case 0:
                        output.push(
                            <div key={day}>
                                <a href={editLink} target="_blank" className="btn btn-sm btn-warning rounded-0 border outline-0 p-0" data-toggle="tooltip" data-placement="bottom" style={{ width: 45 }}>
                                    <div className="py-3" style={{ width: 45 }}>&nbsp;</div>
                                </a>
                            </div>
                        );
                        break;
                    case 1:
                        output.push(
                            <div key={day}>
                                <a href={editLink} target="_blank" className="btn btn-sm btn-info rounded-0 border outline-0 p-0" data-toggle="tooltip" data-placement="bottom" style={{ width: 45 }}>
                                    <div className="py-3" style={{ width: 45 }}>&nbsp;</div>
                                </a>
                            </div>
                        );
                        break;
                    case 2:
                        output.push(
                            <div key={day}>
                                <a href={editLink} target="_blank" className="btn btn-sm btn-primary rounded-0 border outline-0 p-0" data-toggle="tooltip" data-placement="bottom" style={{ width: 45 }}>
                                    <div className="py-3" style={{ width: 45 }}>&nbsp;</div>
                                </a>
                            </div>
                        );
                        break;
                        case 3:
                        output.push(
                            <div key={day}>
                                <a href={editLink} target="_blank" className="btn btn-sm btn-danger rounded-0 border outline-0 p-0" data-toggle="tooltip" data-placement="bottom" style={{ width: 45 }}>
                                    <div className="py-3" style={{ width: 45 }}>&nbsp;</div>
                                </a>
                            </div>
                        );
                        break;
                    default:
                        output.push(
                            <div key={day}>
                                <a href={editLink} target="_blank" className="btn btn-sm btn-danger rounded-0 border outline-0 p-0" style={{ width: 45 }}>
                                    <div className="py-3" style={{ width: 45 }}>&nbsp;</div>
                                </a>
                            </div>
                        );
                        break;
                }
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