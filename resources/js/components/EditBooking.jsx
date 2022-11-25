import React from "react";
import Client from "./Steps/Client";
import Room from "./Steps/Room";
import Price from "./Steps/Price";
import Summary from "./Steps/Summary";
import axios from "axios";

export default class EditBooking extends React.Component {

    state = {
        step: 1,
        allSteps: 3,
        email: window.client.email,
        phone: window.client.phone,
        name: window.client.name,
        lastName: window.client.lastName,
        city: window.client.city,
        postalCode: window.client.postalCode,
        room: window.booking.room_id,
        category: window.room.category_id,
        subcategory: window.room.category_id,
        dateFrom: window.booking.start_date,
        dateTo: window.booking.end_date,
        categoriesWithRooms: window.categoriesWithRooms,
        adultsList: [{adults: "" }],
        childrenList: [{children: "" }],
        freeList: [{free: "" }],
        respMsg: '',
        comments: window.booking.comments,
        status: window.booking.status,
        price: window.booking.price,
        typeOfClient: window.client.typeOfClient,
        numberOfPeople: window.booking.numberOfPeople,
        isDisabled: false,
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

      submit = () => {
        var url = '/api/booking/update' + window.booking.id;
        axios.put(url, {
            email: this.state.email,
            phone: this.state.phone,
            name: this.state.name,
            lastName: this.state.lastName,
            city: this.state.city,
            postalCode: this.state.postalCode,
            room: this.state.room,
            category: this.state.category,
            subcategory: this.state.subcategory,
            dateFrom: this.state.dateFrom,
            dateTo: this.state.dateTo,
            comments: this.state.comments,
            status: this.state.status,
            price: this.state.price,
            typeOfClient: this.state.typeOfClient,
            numberOfPeople: this.state.numberOfPeople,
            user_id: this.state.user_id,
        })
        .then(response => {
            if (response.status === 200) {
                this.setState({ respMsg: response.data.message });
                window.location.href = '/';
            }
        })
        .catch(error => {
            console.log(error);
        });
      }

    render() {
        const { step } = this.state;
        const { allSteps } = this.state;
        const { categoriesWithRooms } = this.state;
        const { email, name, lastName, phone, city, postalCode, room, category,
          subcategory, dateFrom, dateTo, adultsList, childrenList, freeList,
          isDisabled, comments, typeOfClient, price, status, numberOfPeople } = this.state;
        const values = { email, name, lastName, phone, city, postalCode, room,
          category, subcategory, dateFrom, dateTo, adultsList, childrenList,
          freeList, isDisabled, comments, typeOfClient, price, status, numberOfPeople };
        switch(step) {
          case 1: 
            return (
              <Client
                step={step}
                allSteps={allSteps}
                nextStep={ this.nextStep }
                handleChange={ this.handleChange }
                values={ values }
              />
            )
          case 2: 
            return (
              <Room
                step={step}
                allSteps={allSteps}
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
                <Summary
                  step={step}
                  allSteps={allSteps}
                  prevStep={ this.prevStep }
                  nextStep={ this.nextStep }
                  values={ values }
                  handleChange={ this.handleChange }
                  submit={ this.submit }
                />
              )
          default: 
              // do nothing
        }
    }
}