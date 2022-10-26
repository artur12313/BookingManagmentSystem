import React from 'react';
import ReactDOM from 'react-dom';

function Booking() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-12">
                    <div className="card">
                        <div className="card-header">Dodawanie nowej rezerwacji</div>

                        <div className="card-body">Card body</div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Booking;

if (document.getElementById('booking')) {
    ReactDOM.render(<Booking />, document.getElementById('booking'));
}
