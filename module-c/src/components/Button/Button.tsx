import { Link } from 'react-router-dom'
import styles from './Button.module.scss'
import { UniqButton } from '../../types/country'



const Button = ({flag, name, onClick, link}: UniqButton) => {
  return (
    <>
      <Link to={`/${link}/${name}`} className={`button-bordered-white ${styles.link}`} onClick={() => onClick(name)}>
          <img src={flag} alt="" />
          {name}
      </Link>
    </>
  )
}

export default Button