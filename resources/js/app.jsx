import React from 'react';
import ReactDOM from 'react-dom/client';
import './bootstrap';
import '../css/app.css';
import LoginForm from './components/LoginForm';


const loginDiv = document.getElementById('login-root');
if (loginDiv) {
  ReactDOM.createRoot(loginDiv).render(<LoginForm />);
}
