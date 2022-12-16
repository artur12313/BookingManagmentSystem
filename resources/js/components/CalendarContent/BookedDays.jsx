import { useEffect } from "react";

function BookedDays(
    { 
        calendarBookings,
        room,
        daysToCompare,
        calendarClients,
        boxWidth,
        setWidth,
        setJustify,
        justifyContent
    }) {


    let output = [];
    let newbookingLink = '/booking'

    useEffect(() => {
        if(daysToCompare.length == 31) {
            setJustify('justify-content-between');
            setWidth('38px');
        } else if(daysToCompare.length == 28) {
                setJustify('justify-content-between');
                setWidth('42px');
        } else {
            setJustify('justify-content-around');
            setWidth('39px');
        }
    }, [daysToCompare]);

    daysToCompare.map(day => {
        let bookings = calendarBookings.filter(booking => booking.room_id == room.id && day >= booking.start_date && day <= booking.end_date);
        if (bookings.length == 0) {
            output.push(
                <div key={day}>
                    <a href={newbookingLink} target="_blank" className="btn btn-sm btn-success rounded-0 border outline-0 p-0" data-toggle="tooltip" data-placement="bottom" title={day} style={{ minWidth: boxWidth, width: "100%", height: "100%"}}>&nbsp;</a>
                </div>
            );
        } else {
            bookings.map(booking => {
                let editLink = '/booking/details/' + booking.id;
                let title = calendarClients.filter(client => client.id == booking.client_id).map(client => {
                    if (client.id == booking.client_id) {
                        return 'Zarezerwowane przez: ' + client.name + ' ' + client.lastName + ' od ' + booking.start_date + ' do ' + booking.end_date;
                    }
                }); 
                switch (parseInt(booking.status)) {
                    case 0:
                        output.push(
                            <div key={day}>
                                <a href={editLink} target="_blank" className="btn btn-sm btn-warning rounded-0 border outline-0 p-0" data-toggle="tooltip" data-placement="bottom" title={title} style={{ minWidth: boxWidth, width: "100%", height: "100%"}}>&nbsp;</a>
                            </div>
                        );
                        break;
                    case 1:
                        output.push(
                            <div key={day}>
                                <a href={editLink} target="_blank" className="btn btn-sm btn-info rounded-0 border outline-0 p-0" data-toggle="tooltip" data-placement="bottom" title={title} style={{ minWidth: boxWidth, width: "100%", height: "100%"}}>&nbsp;</a>
                            </div>
                        );
                        break;
                    case 2:
                        output.push(
                            <div key={day}>
                                <a href={editLink} target="_blank" className="btn btn-sm btn-primary rounded-0 border outline-0 p-0" data-toggle="tooltip" data-placement="bottom" title={title} style={{ minWidth: boxWidth, width: "100%", height: "100%"}}>&nbsp;</a>
                            </div>
                        );
                        break;
                    case 3:
                        output.push(
                            <div key={day}>
                                <a href={editLink} target="_blank" className="btn btn-sm btn-danger rounded-0 border outline-0 p-0" data-toggle="tooltip" data-placement="bottom" title={title} style={{ minWidth: boxWidth, width: "100%", height: "100%"}}>&nbsp;</a>
                            </div>
                        );
                        break;
                }
            });
        }
    });

    return (
        <div className={"col-10 px-0 monthDays d-flex " + justifyContent}>
            {output}
        </div>
    );
}

export default BookedDays;