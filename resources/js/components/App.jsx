import React from 'react';
import ReactDOM from 'react-dom';
import Booking from './Booking';
import EditBooking from './EditBooking';
import Calendar from './Calendar';
import '../../css/app.css';

function App() {
    return (
        <div className="bookingForm">
            <Booking />
        </div>
    );
}

export default App;

if (document.getElementById('booking')) {
    ReactDOM.render(<App />, document.getElementById('booking'));
}
else if (document.getElementById('calendar')) {
    ReactDOM.render(<Calendar />, document.getElementById('calendar'));
}
else if (document.getElementById('editBooking')) {
    ReactDOM.render(<EditBooking />, document.getElementById('editBooking'));
}
