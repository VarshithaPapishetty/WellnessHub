// app.js

import React from 'react';
import ReactDOM from 'react-dom';
import Dashboard from './dashboard'; // Your main dashboard component

ReactDOM.render(
  <React.StrictMode>
    <Dashboard />
  </React.StrictMode>,
  document.getElementById('root') // This assumes you have a <div id="root"> in your index.html
);
