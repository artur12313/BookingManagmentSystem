import {useState} from "react";
import axios from "axios";

const Summary = ({ prevStep, nextStep, values, step, categoriesWithRooms }) => {
    
    const [roomName, setRoomName] = useState("");
    const [categoryName, setCategoryName] = useState("");
    const [subcategoryName, setSubcategoryName] = useState("");

    const Continue = e => {
        e.preventDefault();
        nextStep();
      }
    
    const Previous = e => {
        e.preventDefault();
        prevStep();
      }
    console.log(values);

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
                console.log(response);
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
                            <div className="row">
                                <div className="col-md-6">
                                    <h5>Dane klienta</h5>
                                    <p>Imię: {values.name}</p>
                                    <p>Nazwisko: {values.lastName}</p>
                                    <p>Email: {values.email}</p>
                                    <p>Telefon: {values.phone}</p>
                                    <p>Miasto: {values.city}</p>
                                    <p>Kod pocztowy: {values.postalCode}</p>
                                </div>
                                <div className="col-md-6">
                                    <h5>Dane rezerwacji</h5>
                                    { subcategoryName !== "" ? (<p>Sekcja: {subcategoryName}</p>) : (null) }
                                    <p>Domek: {categoryName}</p>
                                    <p>Pokój: {roomName}</p>
                                    <p>Podkategoria: {values.subcategory}</p>
                                    <p>Data przyjazdu: {values.dateFrom}</p>
                                    <p>Data wyjazdu: {values.dateTo}</p>
                                </div>
                            </div>
                        </div>
                        <button className="btn btn-primary" onClick={getData}>Dane</button>
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