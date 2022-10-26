import React from 'react';
import ReactDOM from 'react-dom';
import Booking from './Booking';

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
