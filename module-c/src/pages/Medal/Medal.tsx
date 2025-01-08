import { useParams } from "react-router-dom"
import { useEffect, useState } from "react";
import { useGetCountriesQuery } from "../../services/api";
import { CountryType } from "../../types/country";
import styles from './Medal.module.scss'
import { Link } from "react-router-dom";
import MedalTable from "../../components/MedalTable/MedalTable";

const Medal = () => {
  const [item, setItem] = useState<CountryType | undefined>(undefined);
  const { countryName, medal } = useParams();
  const { data, error, isLoading } = useGetCountriesQuery({});

  useEffect(() => {
    if (data && countryName) {
        const foundItem = data.find((item: CountryType) => item.name === countryName);
        setItem(foundItem);
      }
    }, [data, countryName]);

    if (isLoading) return <div>Loading...</div>;
    if (error) console.error(error)
    console.log(data);
    return (
        <section>
        <Link to={`/country/${countryName}`} className={styles.prev}>
            <img src="/images/ico-prev.svg" alt="prev page" />
        </Link>

      {(item && medal) ? (
        <>
          <h1 className={styles.h1}>{item.name}</h1>
          <img src={`/${item.flag}`} alt={`${item.name} flag`} className={styles.flag} />
          <h3 className={styles.medal}>{medal?.toUpperCase()} MEDALS</h3>
          <h4 className={styles.count}>{item.medals[medal as keyof typeof item.medals]}</h4>
          <MedalTable disciplines={item.disciplines} medal={medal}/>
        </>
      ) : (
        <div>Country not found</div>
      )}
        </section>
    )
}

export default Medal