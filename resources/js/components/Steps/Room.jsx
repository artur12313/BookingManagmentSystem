import React from "react";

const Room = ({ nextStep, prevStep, handleChange, values }) => {

    const Continue = e => {
        e.preventDefault();
        nextStep();
      }
    
      const Previous = e => {
        e.preventDefault();
        prevStep();
      }

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-12">
                    <div className="card">
                        <div className="card-header d-flex justify-content-between">
                            <h5>Wybierz pokój oraz czas pobytu</h5>
                            <h5>Krok 2 z 4</h5>
                        </div>
                        <div className="card-body">
                            <form>
                                <div className="form-group row">
                                    <label htmlFor="room" className="col-md-4 col-form-label text-md-right">Pokój</label>
                                    <div className="col-md-6">
                                        <select id="room" className="form-control" name="room" required>
                                            <option value="1">Pokój 1</option>
                                            <option value="2">Pokój 2</option>
                                            <option value="3">Pokój 3</option>
                                            <option value="4">Pokój 4</option>
                                        </select>
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <label htmlFor="dateFrom" className="col-md-4 col-form-label text-md-right">Data przyjazdu</label>
                                    <div className="col-md-6">
                                        <input id="dateFrom" type="date" className="form-control" name="dateFrom" required />
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <label htmlFor="dateTo" className="col-md-4 col-form-label text-md-right">Data wyjazdu</label>
                                    <div className="col-md-6">
                                        <input id="dateTo" type="date" className="form-control" name="dateTo" required />
                                    </div>
                                </div>
                            </form>
                        <div className="card-footer d-flex justify-content-between">
                            <button type="button" className="btn btn-primary" onClick={ Previous }>Poprzedni</button>
                            <button type="button" className="btn btn-primary" onClick={ Continue }>Następny</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Room;