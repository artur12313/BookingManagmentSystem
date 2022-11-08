import React from "react";
import Client from "./Steps/Client";
import Room from "./Steps/Room";
import Price from "./Steps/Price";
import Summary from "./Steps/Summary";
import axios from "axios";

export default class Booking extends React.Component {

    state = {
        step: 1,
        email: '',
        phone: '',
        name: '',
        lastName: '',
        city: '',
        postalCode: '',
        room: '',
        category: '',
        subcategory: '',
        dateFrom: '',
        dateTo: '',
        categoriesWithRooms: window.categoriesWithRooms,
        adultsList: [{adults: "" }],
        childrenList: [{children: "" }],
        freeList: [{free: "" }],
        respMsg: '',
        isDisabled: true,
      }
        

      prevStep = () => {
        const { step } = this.state;
        this.setState({ step: step - 1 });
      }
    
      nextStep = () => {
        const { step } = this.state;
        this.setState({ step: step + 1 });
      }
    
      handleChange = input => e => {
        this.setState({ [input]: e.target.value });
      }

      handleDisable = (value) => {
        this.setState({ isDisabled: value });
      }
    
      setAdults = (value) => {
        this.setState({ adultsList: value });
      }

      setChildren = (value) => {
        this.setState({ childrenList: value });
      }

      setFree = (value) => {
        this.setState({ freeList: value });
      }

    render() {
        const { step } = this.state;
        const { categoriesWithRooms } = this.state;
        const { email, name, lastName, phone, city, postalCode, room, category, subcategory, dateFrom, dateTo, adultsList, childrenList, freeList, isDisabled } = this.state;
        const values = { email, name, lastName, phone, city, postalCode, room, category, subcategory, dateFrom, dateTo, adultsList, childrenList, freeList, isDisabled };
        
        switch(step) {
          case 1: 
            return (
              <Client
                step={step}
                nextStep={ this.nextStep }
                handleChange={ this.handleChange }
                values={ values }
              />
            )
          case 2: 
            return (
              <Room
                step={step}
                prevStep={ this.prevStep }
                nextStep={ this.nextStep }
                handleChange={ this.handleChange }
                values={ values }
                categoriesWithRooms={ categoriesWithRooms }
                handleDisable={ this.handleDisable }
              />
            )
          case 3: 
              return (
                <Price 
                  step={step}
                  prevStep={ this.prevStep }
                  nextStep={ this.nextStep }
                  values={ values }
                  setAdults={ this.setAdults }
                  setChildren={ this.setChildren }
                  setFree={ this.setFree }
                />
              )
            case 4: 
              return (
                <Summary
                  step={step}
                  prevStep={ this.prevStep }
                  nextStep={ this.nextStep }
                  values={ values }
                />
              )
          default: 
              // do nothing
        }
    }
}