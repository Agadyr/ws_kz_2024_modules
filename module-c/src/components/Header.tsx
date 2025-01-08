import { useLocation } from 'react-router-dom';

const Header = () => {
  const location = useLocation()
  return (
    <section className='header'>
        <img 
          src={location.pathname === '/welcome' ? '/images/logo-white.png' : '/images/logo-sm-white.png'} 
          alt="Logo white"
        />
    </section>
  )
}

export default Header