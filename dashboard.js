// Dashboard.js

import React from 'react';
import DashboardHeader from './DashboardHeader';
import Navigation from './Navigation';
import BookAppointment from './BookAppointment';
import DoctorChatbot from './DoctorChatbot';
import FitnessTracker from './FitnessTracker';
import EShopping from './EShopping';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';

function Dashboard() {
  return (
    <Router>
      <div className="App">
        <DashboardHeader />
        <Navigation />
        <Switch>
          <Route path="/book-appointment" component={BookAppointment} />
          <Route path="/doctor-chatbot" component={DoctorChatbot} />
          <Route path="/fitness-tracker" component={FitnessTracker} />
          <Route path="/e-shopping" component={EShopping} />
        </Switch>
      </div>
    </Router>
  );
}

export default Dashboard;
