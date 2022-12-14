import React from "react";

const Room = ({ nextStep, prevStep, handleChange, values, step, categoriesWithRooms, handleDisable, allSteps}) => {

    const Continue = e => {
        e.preventDefault();
        nextStep();
      }
    
    const Previous = e => {
        e.preventDefault();
        prevStep();
      }

    var categories = [];
        
    categoriesWithRooms.map((item) => {
        categories.push(item.category);
    });

    var subcategoriesToShow = [];
    var roomsToShow = [];
    if (values.category) {
        categoriesWithRooms.map((item) => {
            if (item.category.id == values.category) {
                subcategoriesToShow = item.subcategories;
                roomsToShow = item.rooms;
            }
        });
        if(values.subcategory)
        {
            subcategoriesToShow.map((sub) => {
                if (sub.id == values.subcategory) {
                    roomsToShow = sub.rooms;
                }
            });
        }
    }

    const checkDate = () => {
        if (values.room){
            if(values.dateFrom === '' || values.dateTo === '')
            {
                alert('Uzupełnij daty');
                handleDisable(true);
            } else {
                if(values.dateFrom > values.dateTo)
                {
                    alert('Data przyjazdu nie może być większa niż data wyjazdu');
                    handleDisable(true);
                } else {
                    axios.post('/api/checkDate', {
                        room: values.room,
                        dateFrom: values.dateFrom,
                        dateTo: values.dateTo,
                    })
                    .then(response => {
                        if (response.status === 200) {
                        values.respMsg = response.data.message;
                            alert(values.respMsg);
                            handleDisable(response.data.booked);
                        } else {
                            alert(response.data.message);
                            handleDisable(true);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                        handleDisable(true);
                    });
                }
            }
        } else {
            alert('Wybierz pokój');
        }
    }

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-12">
                    <div className="card">
                        <div className="card-header d-flex justify-content-between">
                            <h5>Wybierz pokój oraz czas pobytu</h5>
                            <h5>Krok {step} z {allSteps}</h5>
                        </div>
                        <div className="card-body">
                            <form>
                                {categories.length > 0 ? (
                                    <div className="form-group row">
                                    <label htmlFor="categories" className="col-md-4 col-form-label text-md-right">Domek</label>
                                    <div className="col-md-6">
                                        <select className="form-control custom-select" id="categories" name="categories" onChange={handleChange('category')} defaultValue={values.category}>
                                            <option value="">-Wybierz-</option>
                                            {categories.map((category, index) => (
                                                <option key={index} value={category.id}>{category.name}</option>
                                            ))}
                                        </select>
                                    </div>
                                </div>) : <div className="row d-flex justify-content-center my-2"><div className="mx-auto col-2"><a href="/categories" className="text-center btn btn-success">Dodaj domki do bazy danych</a></div></div>}
                                {subcategoriesToShow.length > 0 ? (
                                    <div className="form-group row">
                                    <label htmlFor="subcategories" className="col-md-4 col-form-label text-md-right">Sekcja</label>
                                    <div className="col-md-6">
                                        <select id="subcategories" className="form-control custom-select" name="subcategories" onChange={handleChange('subcategory')} defaultValue={values.subcategory}>
                                            <option value="">-Wybierz-</option>
                                            {subcategoriesToShow.map((item) => {
                                                return <option key={item.id} value={item.id}>{item.name}</option>
                                            })}
                                        </select>
                                    </div>
                                </div>) : <div></div>}
                                {roomsToShow.length > 0 ? (
                                    <div className="form-group row">
                                    <label htmlFor="room" className="col-md-4 col-form-label text-md-right">Pokój</label>
                                    <div className="col-md-6">
                                        <select id="room" className="form-control custom-select" name="room" required onChange={handleChange('room')} defaultValue={values.room}>
                                            <option value="">-Wybierz-</option>
                                            {roomsToShow.map((item) => {
                                                return <option key={item.id} value={item.id}>{item.name}</option>
                                            })}
                                        </select>
                                    </div>
                                </div>) : <div></div>}
                                <div className="form-group row">
                                    <label htmlFor="dateFrom" className="col-md-4 col-form-label text-md-right">Data przyjazdu</label>
                                    <div className="col-md-6">
                                        <input id="dateFrom" type="date" className="form-control" name="dateFrom" required onChange={handleChange('dateFrom')} defaultValue={values.dateFrom}/>
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <label htmlFor="dateTo" className="col-md-4 col-form-label text-md-right">Data wyjazdu</label>
                                    <div className="col-md-6">
                                        <input id="dateTo" type="date" className="form-control" name="dateTo" required  onChange={handleChange('dateTo')} defaultValue={values.dateTo}/>
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <label htmlFor="dateAvability" className="col-md-4 col-form-label text-md-right">Sprawdź dostępność</label>
                                    <div className="col-md-6">
                                        <button type="button" className="btn btn-success" onClick={ checkDate }>Sprawdź</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div className="card-footer d-flex justify-content-between">
                            <button type="button" className="btn btn-primary" onClick={ Previous }>Poprzedni</button>
                            <button type="button" className="btn btn-primary next" onClick={ Continue } disabled={values.isDisabled}>Następny</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Room;