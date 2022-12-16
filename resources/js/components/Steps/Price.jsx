import React from "react";
import { useState, useEffect } from "react";

const Price = ({ prevStep, nextStep, handleChange, values, step, setChildren, setFree, allSteps }) => {

    const [inputList, setInputList] = useState(values.freeList);
    const [childrenList, setChildrenList] = useState(values.childrenList);



    const Continue = e => {

        var childrenToAdd = [];
        childrenList.map((item) => {
            childrenToAdd.push(item);
        });
        setChildren(childrenToAdd);

        var freeToAdd = [];
        inputList.map((item) => {
            freeToAdd.push(item);
        });
        setFree(freeToAdd);

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

    const handleInputChange = (e, index) => {
        const { name, value } = e.target;
        const list = [...inputList];
        list[index][name] = value;
        setInputList(list);
    };

    const handleChildrenChange = (e, index) => {
        const { name, value } = e.target;
        const list = [...childrenList];
        list[index][name] = value;
        setChildrenList(list);
    };


    const handleRemoveClick = index => {
        const list = [...inputList];
        list.splice(index, 1);
        setInputList(list);
    };

    const handleRemoveChildrenClick = index => {
        const list = [...childrenList];
        list.splice(index, 1);
        setChildrenList(list);
    };

    const handleAddClick = () => {
        setInputList([...inputList, { free: "" }]);
    };
    
    const handleAddChildrenClick = () => {
        setChildrenList([...childrenList, { children: "" }]);
    };

    useEffect(() => {
        setInputList(values.freeList);
        setChildrenList(values.childrenList);
    }, []);
    var counter = 1;
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-12">
                    <div className="card">
                        <div className="card-header d-flex justify-content-between">
                            <h5>Podaj ilość osób oraz ich wiek</h5>
                            <h5>Krok {step} z {allSteps}</h5>
                        </div>
                        <div className="card-body">
                            <form>
                                <h5>"Pełnopłatne" osoby</h5>
                                <div className="form-group row">
                                    <label htmlFor="adults" className="col-md-4 col-form-label text-md-right">Ilość osób dorosłych:</label>
                                    <div className="col-md-5">
                                        <input id="adults" type="number" className="form-control" name="adults" value={values.adults} onChange={handleChange('adults')}/>
                                    </div>
                                </div>
                                <hr />
                                <h5>Dzieci</h5>
                                {childrenList.map((x, i) => {
                                    var counter = i + 1;
                                    return (
                                        <div key={"children[" + i + "]"}>
                                            <div className="form-group row">
                                                <label htmlFor="children" className="col-md-4 col-form-label text-md-right">Data urodzenia {counter} dziecka:</label>
                                                <div className="col-md-5 d-flex">
                                                    <input id={"children[" + [i] + "]"} type="date" className="form-control" name="children" value={x.children}
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
                                    return (
                                        <div key={"free[" + i + "]"}>
                                            <div className="form-group row">
                                                <label htmlFor="free" className="col-md-4 col-form-label text-md-right">Data urodzenia {counter} osoby:</label>
                                                <div className="col-md-5 d-flex">
                                                    <input id={"free[" + [i] + "]"} type="date" className="form-control" name="free" value={x.free} 
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