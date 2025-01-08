import styles from './Welcome.module.scss';
import { Link } from 'react-router-dom';

const Welcome = () => {
    return (
        <section>
            <img className={styles.frame} src="/images/frame.png" alt="" />
            <Link to={'/countries'} className={`button-bordered-white ${styles.link}`}>
                <img src="/images/ico-countries.svg" alt="" />
                Countries
            </Link>
            <Link to={'/disciplines'} className={`button-bordered-white ${styles.link}`}>
                <img src="/images/ico-countries.svg" alt="" />
                Disciplines
            </Link>
        </section>
    )
}

export default Welcome