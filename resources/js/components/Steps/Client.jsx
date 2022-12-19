import axios from 'axios';
import React, { useState } from 'react';

const Client = ({nextStep, handleChange, values, step, allSteps}) => {

    const [message, setMessage] = useState('');
    const [error, setError] = useState('');

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
                            <h5>Krok {step} z {allSteps}</h5>
                        </div>
                        <form>
                            <div className="card-body">
                                <div className="form-group row">
                                    <label htmlFor="name" className="col-md-4 col-form-label text-md-right">Imię <span className="text-danger">*</span></label>
                                    <div className="col-md-6">
                                        <input
                                            id="name"
                                            type="text"
                                            className="form-control"
                                            name="name"
                                            required
                                            onChange={handleChange('name')}
                                            defaultValue={values.name}
                                        />
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <label htmlFor="lastName" className="col-md-4 col-form-label text-md-right">Nazwisko <span className="text-danger">*</span></label>
                                    <div className="col-md-6">
                                        <input
                                            id="lastName"
                                            type="text"
                                            className="form-control"
                                            name="lastName"
                                            required
                                            onChange={handleChange('lastName')}
                                            defaultValue={values.lastName}
                                        />
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <label htmlFor="email" className="col-md-4 col-form-label text-md-right">Adres e-mail</label>
                                    <div className="col-md-6">
                                        <input
                                            id="email"
                                            type="email"
                                            className="form-control"
                                            name="email"
                                            required
                                            onChange={handleChange('email')}
                                            defaultValue={values.email}
                                        />
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <label htmlFor="phone" className="col-md-4 col-form-label text-md-right">Telefon kontaktowy</label>
                                    <div className="col-md-6">
                                        <input
                                            id="phone"
                                            type="text"
                                            className="form-control"
                                            name="phone"
                                            required
                                            onChange={handleChange('phone')}
                                            defaultValue={values.phone}
                                        />
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <label htmlFor="city" className="col-md-4 col-form-label text-md-right">Miasto</label>
                                    <div className="col-md-6">
                                        <input
                                            id="city"
                                            type="text"
                                            className="form-control"
                                            name="city"
                                            required
                                            onChange={handleChange('city')}
                                            defaultValue={values.city}
                                        />
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <label htmlFor="postalCode" className="col-md-4 col-form-label text-md-right">Kod pocztowy</label>
                                    <div className="col-md-6">
                                        <input
                                            id="postalCode"
                                            type="text"
                                            className="form-control"
                                            name="postalCode"
                                            required
                                            onChange={handleChange('postalCode')}
                                            defaultValue={values.postalCode}
                                            />
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <label htmlFor="typeOfClient" className="col-md-4 col-form-label text-md-right">Klient <span className="text-danger">*</span></label>
                                    <div className="col-md-6">
                                        <select className="form-control custom-select" id="typeOfClient" name="typeOfClient" onChange={handleChange('typeOfClient')} defaultValue={values.typeOfClient}>
                                            <option value="">Wybierz</option>
                                            <option value="1">Stały</option>
                                            <option value="2">Nowy</option>
                                            <option value="3">Powracający</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div className="card-footer d-flex justify-content-end">
                                <button type="submit" className="btn btn-primary" onClick={ Continue }>Następny</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Client;
