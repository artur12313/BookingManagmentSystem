import React from "react";

const Summary = ({ prevStep, nextStep, values, step }) => {
    
    const Continue = e => {
        e.preventDefault();
        nextStep();
      }
    
    const Previous = e => {
        e.preventDefault();
        prevStep();
      }
    console.log(values);
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-12">
                    <div className="card">
                        <div className="card-header d-flex justify-content-between">
                            <h5>Podsumowanie</h5>
                            <h5>Krok {step} z 4</h5>
                        </div>
                        <div className="card-body">
                            <form>
                                <div className="form-group row">
                                    <div className="col-md-6">
                                    <label htmlFor="name" className="col-form-label text-md-right">Imię</label>
                                        <input type="text" className="form-control" name="name" value={values.name} disabled />
                                    </div>
                                    <div className="col-md-6">
                                        <label htmlFor="lastName" className="col-form-label text-md-right">Nazwisko</label>
                                        <input type="text" className="form-control" name="lastName" value={values.lastName} disabled />
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <div className="col-md-6">
                                        <label htmlFor="email" className="col-form-label text-md-right">Adres e-mail</label>
                                        <input type="email" className="form-control" name="email" value={values.email} disabled />
                                    </div>
                                    <div className="col-md-6">
                                        <label htmlFor="phone" className="col-form-label text-md-right">Numer telefonu</label>
                                        <input type="text" className="form-control" name="phone" value={values.phone} disabled />
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <div className="col-md-6">
                                        <label htmlFor="city" className="col-form-label text-md-right">Miasto</label>
                                        <input type="text" className="form-control" name="city" value={values.city} disabled />
                                    </div>
                                    <div className="col-md-6">
                                        <label htmlFor="postalCode" className="col-form-label text-md-right">Kod pocztowy</label>
                                        <input type="text" className="form-control" name="postalCode" value={values.postalCode} disabled />
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <div className="col-md-6">
                                        <label htmlFor="room" className="col-form-label text-md-right">Pokój</label>
                                        <input type="text" className="form-control" name="room" value={values.room} disabled />
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div className="card-footer d-flex justify-content-between">
                            <button type="button" className="btn btn-primary" onClick={ Previous }>Poprzedni</button>
                            <a href="/" className="btn btn-primary">Zakończ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Summary;