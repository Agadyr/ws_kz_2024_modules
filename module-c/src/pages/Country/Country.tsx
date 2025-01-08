import { useEffect, useState } from "react";
import { useGetCountriesQuery } from "../../services/api";
import styles from "./Country.module.scss";
import { Link, useParams } from "react-router-dom";
import { CountryType } from "../../types/country";
import CountryTable from "../../components/CountryTable/CountryTable";

const Country = () => {
  const [item, setItem] = useState<CountryType | undefined>(undefined);
  const { countryName } = useParams();
  const { data, error, isLoading } = useGetCountriesQuery({});

  useEffect(() => {
    if (data && countryName) {
      const foundItem = data.find((item: CountryType) => item.name === countryName);
      setItem(foundItem);
    }
  }, [data, countryName]);

  if (isLoading) return <div>Loading...</div>;
  if (error) console.error(error)
  
  return (
    <section className={styles.countrySection}>
      <Link to="/countries" className={styles.prev}>
        <img src="/images/ico-prev.svg" alt="prev page" />
      </Link>

      {item ? (
        <>
          <h1 className={styles.h1}>{item.name}</h1>
          <img src={`/${item.flag}`} alt={`${item.name} flag`} className={styles.flag} />
          <CountryTable country={item} />
          <Link to={`${countryName}/gold/medals`} className={`button-bordered-white ${styles.link}`}>
                <img  width={40} src="/images/medals/gold.png" alt="" />
                Medals
          </Link>
          <Link to={`${countryName}/silver/medals`} className={`button-bordered-white ${styles.link}`}>
                <img  width={40} src="/images/medals/silver.png" alt="" />
                Medals
          </Link>
          <Link to={`${countryName}/gold/bronze`} className={`button-bordered-white ${styles.link}`}>
                <img  width={40} src="/images/medals/bronze.png" alt="" />
                Medals
          </Link>
        </>
      ) : (
        <div>Country not found</div>
      )}
    </section>
  );
};

export default Country;
