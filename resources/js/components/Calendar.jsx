import axios from "axios";
import {useEffect, useState} from "react";
import usePageLoader from "../hooks/usePageLoader";
import CalendarHeader from "./CalendarHeader/calendarHeader";
import CalendarContent from "./CalendarContent/CalendarContent";

export default function Calendar() {
    const [loading, showLoader, hideLoader] = usePageLoader();
    const [calendarCategories, setCalendatCategories] = useState([]);
    const [calendarSubcategories, setCalendatSubcategories] = useState([]);
    const [calendarRooms, setCalendarRooms] = useState([]);
    const [calendarBookings, setCalendarBookings] = useState([]);

    useEffect(() => {
        showLoader();

        axios.get('/api/booking/calendar')
            .then(response => {
                if(response.status === 200) {
                    setCalendatCategories(response.data.categories);
                    setCalendatSubcategories(response.data.subcategories);
                    setCalendarRooms(response.data.rooms);
                    setCalendarBookings(response.data.bookings);
                    console.log(response.data);
                    setTimeout(() => {
                        hideLoader();
                    }, 1000);
                }
            }
        ).catch(error => {
            console.log(error);
        }
        )
    }, []);

    // get actual date
    const today = new Date();
    const dd = String(today.getDate()).padStart(2, '0');
    const mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    const yyyy = today.getFullYear();

    return (
        <div>
            {loading ? loading : (
                <div>
                    <ul>
                        {calendarCategories.map(category => (
                            <div key={category.id} className="card my-4">
                            <CalendarHeader category={category} date={today}/>
                            <CalendarContent category={category} calendarSubcategories={calendarSubcategories} calendarRooms={calendarRooms} calendarBookings={calendarBookings}/>
                            </div>
                        ))}
                    </ul>
                </div>
            )}
        </div>
    );
}