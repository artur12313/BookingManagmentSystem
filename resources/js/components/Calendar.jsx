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
    const [calendarClients, setCalendarClients] = useState([]);
    const [justifyContent, setJustifyContent] = useState('justify-content-around');
    const [boxWidth, setBoxWidth] = useState('45px');

    useEffect(() => {
        showLoader();

        axios.get('/api/booking/calendar')
            .then(response => {
                if (response.status === 200) {
                    setCalendatCategories(response.data.categories);
                    setCalendatSubcategories(response.data.subcategories);
                    setCalendarRooms(response.data.rooms);
                    setCalendarBookings(response.data.bookings);
                    setCalendarClients(response.data.clients);

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
    var actualMonth = today.getMonth() + monthToAdd;
    var actualYear = today.getFullYear() + yearToAdd;
    var daysToDisplay = [];
    var daysToCompare = [];

    const nextMonth = () => {
        if (actualMonth === 12) {
            setMonthToAdd(-10);
            setYearToAdd(yearToAdd + 1);
        } else {
            setMonthToAdd(monthToAdd + 1);
        }

    }

    const prevMonth = () => {
        if (actualMonth === 1) {
            setMonthToAdd(1);
            setYearToAdd(yearToAdd - 1);
        } else {
            setMonthToAdd(monthToAdd - 1);
        }
    }
    const daysInMonth = (month, year) => new Date(year, month, 0).getDate();
    const days = daysInMonth(actualMonth, actualYear);
    for (let i = 1; i <= days; i++) {
        var dd = String(i).padStart(2, '0');
        if(actualMonth < 10) {
            daysToCompare.push(actualYear + '-' + String(actualMonth).padStart(2, '0') + '-' + dd);
        } else {
            daysToCompare.push(actualYear + '-' + actualMonth + '-' + dd);
        }
        daysToDisplay.push(dd);
    }

    const setWidth = (value) => {
        setBoxWidth(value);
    }

    const setJustify = (value) => {
        setJustifyContent(value);
    }

    return (
        <>
            {loading ? loading : (
                <>
                <div className="container d-flex justify-content-center gap-2">
                    <div>
                        <button className="btn btn-sm btn-primary">&nbsp;</button> - <span>Oczekiwanie na płatność</span>
                    </div>
                    <div>
                        <button className="btn btn-sm btn-danger">&nbsp;</button> - <span>Zapłacone</span>
                    </div>
                    <div>
                        <button className="btn btn-sm btn-info">&nbsp;</button> - <span>Zarezerwowane</span>
                    </div>
                    <div>
                        <button className="btn btn-sm btn-success">&nbsp;</button> - <span>Wolny termin</span>
                    </div>
                </div>


                    {calendarCategories.map(category => (
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
                                today={today}
                                calendarClients={calendarClients}
                                boxWidth={boxWidth}
                                setWidth={setWidth}
                                setJustify={setJustify}
                                justifyContent={justifyContent}
                            />
                        </div>
                    ))}
                </>
            )}
        </>
    );
}