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
        rooms: window.rooms,
      }
    
    componentDidMount() {
        console.log(this.state.rooms);
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
    

    render() {
        const { step } = this.state;
        const { rooms } = this.state;
        const { email, name, lastName, phone, city, postalCode, room } = this.state;
        const values = { email, name, lastName, phone, city, postalCode, room }
        
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
                rooms={ rooms }
              />
            )
          case 3: 
              return (
                <Price 
                  step={step}
                  prevStep={ this.prevStep }
                  nextStep={ this.nextStep }
                  values={ values }
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