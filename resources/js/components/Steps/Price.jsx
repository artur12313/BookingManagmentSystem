import React from "react";
import { useState } from "react";

const Price = ({ prevStep, nextStep, handleChange, values, step }) => {

    const [inputList, setInputList] = useState([{ free: "" }]);
    const [adultsList, setAdultsList] = useState([{ adults: "" }]);
    const [childrenList, setChildrenList] = useState([{ childrenAge: "" }]);

    console.log(inputList);
    console.log(adultsList);
    console.log(childrenList);
    const Continue = e => {
        e.preventDefault();
        nextStep();
    }

    const Previous = e => {
        e.preventDefault();
        prevStep();
    }

    const appendInput = () => {
        var newInput = `input-${this.state.inputs.length}`;
        this.setState(prevState => ({ inputs: prevState.inputs.concat([newInput]) }));
    }

    // handle input change
    const handleInputChange = (e, index) => {
        const { name, value } = e.target;
        const list = [...inputList];
        list[index][name] = value;
        setInputList(list);
    };

    const handleAdultsChange = (e, index) => {
        const { name, value } = e.target;
        const list = [...adultsList];
        list[index][name] = value;
        setAdultsList(list);
    };

    const handleChildrenChange = (e, index) => {
        const { name, value } = e.target;
        const list = [...childrenList];
        list[index][name] = value;
        setChildrenList(list);
    };


    // handle click event of the Remove button
    const handleRemoveClick = index => {
        const list = [...inputList];
        list.splice(index, 1);
        setInputList(list);
    };

    const handleRemoveAdultsClick = index => {
        const list = [...adultsList];
        list.splice(index, 1);
        setAdultsList(list);
    };

    const handleRemoveChildrenClick = index => {
        const list = [...childrenList];
        list.splice(index, 1);
        setChildrenList(list);
    };

    // handle click event of the Add button
    const handleAddClick = () => {
        setInputList([...inputList, { free: "" }]);
    };

    const handleAddAdultsClick = () => {
        setAdultsList([...adultsList, { adults: "" }]);
    };
    
    const handleAddChildrenClick = () => {
        setChildrenList([...childrenList, { childrenAge: "" }]);
    };
    var counter = 1;
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-12">
                    <div className="card">
                        <div className="card-header d-flex justify-content-between">
                            <h5>Podaj ilość osób oraz ich wiek</h5>
                            <h5>Krok {step} z 4</h5>
                        </div>
                        <div className="card-body">
                            <form>
                                <h5>"Pełnopłatne" osoby</h5>
                                {adultsList.map((x, i) => {
                                    var counter = i + 1;
                                    return (
                                        <div>
                                            <div className="form-group row">
                                                <label htmlFor="adults" className="col-md-4 col-form-label text-md-right">Data urodzenia {counter} osoby:</label>
                                                <div className="col-md-5 d-flex">
                                                    <input id={"adults[" + [i] + "]"} type="date" className="form-control" name="adults" value={x.adults} key={"adults[" + i + "]"}
                                                        onChange={e => handleAdultsChange(e, i)} />
                                                    <div className="d-flex gap-2">
                                                        {adultsList.length !== 1 && <button type="button"
                                                            className="btn btn-danger bt-sm mx-2"
                                                            onClick={() => handleRemoveAdultsClick(i)}>Usuń</button>}
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="col-md-9 d-flex justify-content-end pr-1">
                                                {adultsList.length - 1 === i && <button
                                                    type="button"
                                                    className="btn btn-primary bt-sm"
                                                    onClick={handleAddAdultsClick}
                                                >
                                                    Dodaj</button>}
                                            </div>
                                        </div>
                                    );
                                })}
                                <hr />
                                <h5>Dzieci</h5>
                                {childrenList.map((x, i) => {
                                    var counter = i + 1;
                                    return (
                                        <div>
                                            <div className="form-group row">
                                                <label htmlFor="childrenAge" className="col-md-4 col-form-label text-md-right">Data urodzenia {counter} dziecka:</label>
                                                <div className="col-md-5 d-flex">
                                                    <input id={"childrenAge[" + [i] + "]"} type="date" className="form-control" name="childrenAge" value={x.childrenAge} key={"children[" + i + "]"}
                                                        onChange={e => handleChildrenChange(e, i)} />
                                                    <div className="d-flex gap-2">
                                                        {childrenList.length !== 1 && <button type="button"
                                                            className="btn btn-danger bt-sm mx-2"
                                                            onClick={() => handleRemoveChildrenClick(i)}>Usuń</button>}
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="col-md-9 d-flex justify-content-end pr-1">
                                                {childrenList.length - 1 === i && <button
                                                    type="button"
                                                    className="btn btn-primary bt-sm"
                                                    onClick={handleAddChildrenClick}
                                                >
                                                    Dodaj</button>}
                                            </div>
                                        </div>
                                    );
                                })}
                                <hr />
                                <h5>"Bezpłatne" osoby</h5>
                                {inputList.map((x, i) => {
                                    var counter = i + 1;
                                    console.log(x);
                                    return (
                                        <div>
                                            <div className="form-group row">
                                                <label htmlFor="free" className="col-md-4 col-form-label text-md-right">Data urodzenia {counter} osoby:</label>
                                                <div className="col-md-5 d-flex">
                                                    <input id={"free[" + [i] + "]"} type="date" className="form-control" name="free" value={x.free} key={"free[" + i + "]"}
                                                        onChange={e => handleInputChange(e, i)} />
                                                    <div className="d-flex gap-2">
                                                        {inputList.length !== 1 && <button type="button"
                                                            className="btn btn-danger bt-sm mx-2"
                                                            onClick={() => handleRemoveClick(i)}>Usuń</button>}
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="col-md-9 d-flex justify-content-end pr-1">
                                                {inputList.length - 1 === i && <button
                                                    type="button"
                                                    className="btn btn-primary bt-sm"
                                                    onClick={handleAddClick}
                                                >
                                                    Dodaj</button>}
                                            </div>
                                        </div>
                                    );
                                })}
                            </form>
                        </div>
                        <div className="card-footer d-flex justify-content-between">
                            <button type="button" className="btn btn-primary" onClick={Previous}>Poprzedni</button>
                            <button type="button" className="btn btn-primary" onClick={Continue}>Następny</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Price;