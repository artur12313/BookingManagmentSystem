import axios from "axios";
import { useEffect, useState } from "react";
import usePageLoader from "../hooks/usePageLoader";
import CalendarHeader from "./CalendarHeader/calendarHeader";
import CalendarContent from "./CalendarContent/CalendarContent";

export default function Calendar() {
    const [loading, showLoader, hideLoader] = usePageLoader();
    const [calendarCategories, setCalendatCategories] = useState([]);
    const [calendarSubcategories, setCalendatSubcategories] = useState([]);
    const [calendarRooms, setCalendarRooms] = useState([]);
    const [calendarBookings, setCalendarBookings] = useState([]);
    const [monthToAdd, setMonthToAdd] = useState(1);
    const [yearToAdd, setYearToAdd] = useState(0);

    useEffect(() => {
        showLoader();

        axios.get('/api/booking/calendar')
            .then(response => {
                if (response.status === 200) {
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

    const today = new Date();
    // var dd = String(today.getDate()).padStart(2, '0');
    var actualMonth = today.getMonth() + monthToAdd;
    var actualYear = today.getFullYear() + yearToAdd;
    var daysToDisplay = [];
    var daysToCompare = [];
    

    const nextMonth = () => {
        if (actualMonth === 12) {
            setMonthToAdd(-9);
            setYearToAdd(yearToAdd + 1);
        } else {
            setMonthToAdd(monthToAdd + 1);
        }

    }

    const prevMonth = () => {
        if (actualMonth === 1) {
            setMonthToAdd(2);
            setYearToAdd(yearToAdd - 1);
        } else {
            setMonthToAdd(monthToAdd - 1);
        }
    }

    const daysInMonth = (month, year) => new Date(year, month, 0).getDate();
    const days = daysInMonth(actualMonth, actualYear);
    for (let i = 1; i <= days; i++) {
        daysToCompare.push(actualYear + '-' + actualMonth + '-' + i);
        daysToDisplay.push(i);
    }

    return (
        <>
            {loading ? loading : (
                    calendarCategories.map(category => (
                        <div key={category.id} className="card my-4 mx-3">
                            <CalendarHeader
                                category={category}
                                prevMonth={prevMonth}
                                nextMonth={nextMonth}
                                actualMonth={actualMonth}
                                actualYear={actualYear}
                            />
                            <CalendarContent
                                category={category}
                                calendarSubcategories={calendarSubcategories}
                                calendarRooms={calendarRooms}
                                calendarBookings={calendarBookings}
                                daysToDisplay={daysToDisplay}
                                actualMonth={actualMonth}
                                actualYear={actualYear}
                                daysToCompare={daysToCompare}
                            />
                        </div>
                    ))
            )}
        </>
    );
}