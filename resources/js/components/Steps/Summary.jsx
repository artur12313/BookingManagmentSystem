import {useState, useEffect} from "react";
import axios from "axios";

const Summary = ({ prevStep, values, step, handleChange, submit, allSteps, setNumberOfChildren, setNumberOfPeople }) => {
    
    const [roomName, setRoomName] = useState("");
    const [categoryName, setCategoryName] = useState("");
    const [subcategoryName, setSubcategoryName] = useState("");
    
    const Previous = e => {
        e.preventDefault();
        prevStep();
      }

    const getData = () => {
        setCategoryName(" ");
        setSubcategoryName(" ");
        setRoomName(" ");
        axios.post('/api/booking/rooms', {
                room: values.room,
                category: values.category,
                subcategory: values.subcategory,
            })
            .then(response => {
                if(response.status === 200)
                {
                    setRoomName(response.data.room.name);
                    setCategoryName(response.data.category.name);
                    if(response.data.subcategory)
                    {
                        setSubcategoryName(response.data.subcategory.name);
                    }
                }
            })
            .catch(error => {
                console.log(error);
            });
    }

    useEffect(() => {
        getData();
        getAdults();
    }, []);

    const getAdults = () => {
        var numberOfPeopleToCount = [];
        var numberOfChildrenToCount = [];

        values.childrenList.map((item) => {
            if(item.children !== "")
            {
                var date = new Date(item.children);
                var dob = new Date(date);
                var month_diff = Date.now() - dob.getTime();
                var age_dt = new Date(month_diff); 
                var year = age_dt.getUTCFullYear();
                var age = Math.abs(year - 1970);
                if(age <= 2)
                {
                    numberOfPeopleToCount.push(item.children);
                } else if( age > 2 && age <= 9)
                {
                    numberOfChildrenToCount.push(item.children);
                }
            }
        });

        values.freeList.map((item) => {
            if(item.free !== "")
            {
                var date = new Date(item.free);
                var dob = new Date(date);
                var month_diff = Date.now() - dob.getTime();
                var age_dt = new Date(month_diff); 
                var year = age_dt.getUTCFullYear();
                var age = Math.abs(year - 1970);
                if(age <= 2)
                {
                    numberOfPeopleToCount.push(item.free);
                } else if( age > 2 && age <= 9)
                {
                    numberOfChildrenToCount.push(item.children);
                }
            }
        });

        
        if( numberOfPeopleToCount.length > 0 || numberOfChildrenToCount.length > 0)
        {
            setNumberOfChildren(numberOfChildrenToCount.length);
            setNumberOfPeople(numberOfPeopleToCount.length);
        }
    }
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-12">
                    <div className="card">
                        <div className="card-header d-flex justify-content-between">
                            <h5>Podsumowanie</h5>
                            <h5>Krok {step} z {allSteps}</h5>
                        </div>
                        <div className="card-body">
                            <div className="row">
                                <div className="col-md-6">
                                    <h5 className="text-decoration-underline">Dane klienta</h5>
                                    <p>Imię: {values.name}</p>
                                    <p>Nazwisko: {values.lastName}</p>
                                    <p>Email: {values.email}</p>
                                    <p>Telefon: {values.phone}</p>
                                    <p>Miasto: {values.city}</p>
                                    <p>Kod pocztowy: {values.postalCode}</p>
                                </div>
                                <div className="col-md-6">
                                    <h5 className="text-decoration-underline">Dane rezerwacji</h5>
                                    <p>Domek: {categoryName}</p>
                                    <p>Pokój: {roomName}</p>
                                    <p>Data przyjazdu: {values.dateFrom}</p>
                                    <p>Data wyjazdu: {values.dateTo}</p>
                                    <p>Liczba osób dorosłych: {values.adults}</p>
                                    <p>Liczba dzieci bezpłatnych: {values.numberOfPeople ? values.numberOfPeople : 0}</p>
                                    <p>Liczba dzieci poniżej 9 lat objętych zniżką: {values.numberOfChildren ? values.numberOfChildren : 0}</p>
                                </div>
                            </div>
                            <hr/>
                            <div className="row">
                                <div className="col-md-6">
                                    <div className="row d-flex">
                                        <div className="col-md-6">
                                            <div className="form-group">
                                                <label htmlFor="status">Status: <span className="text-danger">*</span></label>
                                                <select name="status" className="form-control custom-select" onChange={handleChange('status')} defaultValue={values.status}>
                                                    <option value="">-Wybierz-</option>
                                                    <option value="1">Zarezerwowane</option>
                                                    <option value="2">Oczekiwanie na płatność</option>
                                                    <option value="3">Zapłacone</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div className="col-md-6">
                                            <div className="form-group">
                                                <label htmlFor="price">Cena:</label>
                                                <input name="price" type="text" className="form-control" placeholder="" onChange={handleChange('price')} defaultValue={values.price}/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-md-6">
                                    <div className="form-group">
                                        <label htmlFor="comments">Uwagi:</label>
                                        <textarea
                                            name="comments"
                                            className="form-control"
                                            rows="5"
                                            placeholder="Uwagi do rezerwacji"
                                            onChange={handleChange('comments')}
                                            defaultValue={values.comments}
                                            >
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="card-footer d-flex justify-content-between">
                            <button type="button" className="btn btn-primary" onClick={ Previous }>Poprzedni</button>
                            <button className="btn btn-primary" onClick={ submit }>Zakończ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Summary;