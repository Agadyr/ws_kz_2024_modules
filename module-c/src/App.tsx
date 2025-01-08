import { BrowserRouter as Router } from 'react-router-dom';
import './App.css'
import AppRoutes from './router/AppRoutes'
import Header from './components/Header';

function App() {
  return (
    <>
      <Router>
        <Header/>
        <AppRoutes/>
      </Router>
    </>
  )
}

export default App
