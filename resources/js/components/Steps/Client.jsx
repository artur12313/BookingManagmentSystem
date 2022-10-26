import React from 'react';

const Client = ({nextStep, handleChange, values}) => {

    const Continue = e => {
        e.preventDefault();
        nextStep();
      }

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-12">
                    <div className="card">
                        <div className="card-header d-flex justify-content-between">
                            <h5>Dodawanie danych klienta</h5>
                            <h5>Krok 1 z 4</h5>
                        </div>
                        <div className="card-body">
                            <form>
                                <div className="form-group row">
                                    <label htmlFor="name" className="col-md-4 col-form-label text-md-right">Imię</label>
                                    <div className="col-md-6">
                                        <input id="name" type="text" className="form-control" name="name" required />
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <label htmlFor="surname" className="col-md-4 col-form-label text-md-right">Nazwisko</label>
                                    <div className="col-md-6">
                                        <input id="surname" type="text" className="form-control" name="surname" required />
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <label htmlFor="email" className="col-md-4 col-form-label text-md-right">E-mail</label>
                                    <div className="col-md-6">
                                        <input id="email" type="email" className="form-control" name="email" required />
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <label htmlFor="phone" className="col-md-4 col-form-label text-md-right">Telefon</label>
                                    <div className="col-md-6">
                                        <input id="phone" type="text" className="form-control" name="phone" required />
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <label htmlFor="city" className="col-md-4 col-form-label text-md-right">Miasto</label>
                                    <div className="col-md-6">
                                        <input id="city" type="text" className="form-control" name="city" required />
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <label htmlFor="postalCode" className="col-md-4 col-form-label text-md-right">Kod pocztowy</label>
                                    <div className="col-md-6">
                                        <input id="postalCode" type="text" className="form-control" name="postalCode" required />
                                    </div>
                                </div>
                            </form>
                        <div className="card-footer d-flex justify-content-end">
                            <button type="submit" className="btn btn-primary" onClick={ Continue }>Następny</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Client;
