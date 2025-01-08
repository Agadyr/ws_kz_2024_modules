import { useEffect, useState } from "react";
import { useGetCountriesQuery } from "../../services/api";
import styles from "./Discipline.module.scss";
import { Link, useParams } from "react-router-dom";
import { CountryType } from "../../types/country";
import DisciplineTable from "../../components/DisciplineTable/DisciplineTable";

const Discipline = () => {
  const { disciplineName } = useParams();
  const { data, error, isLoading } = useGetCountriesQuery({});

  const [disciplines, setDisciplines] = useState();

  useEffect(() => {
    if (data) {
      const allCountries = data.flatMap((country: CountryType) =>
        country.disciplines
          .filter(discipline => discipline.name === disciplineName)
          .map(discipline => ({
            name: country.name,
            discipline: discipline,
          }))
      );
      setDisciplines(allCountries);
    }
  }, [data, disciplineName]);

  if (isLoading) return <div>Loading...</div>;
  if (error) console.error(error)
  console.log(disciplines);
  return (
    <section className={styles.countrySection}>
      <Link to="/disciplines" className={styles.prev}>
        <img src="/images/ico-prev.svg" alt="prev page" />
      </Link>

      {disciplines ? (
        <>
          <h1 className={styles.h1}>{disciplineName}</h1>
          <img src={`/images/${disciplineName}.svg`} alt={`flag`} className={styles.flag} />
          <DisciplineTable disciplines={disciplines}/>
        </>
      ) : (
        <div>Country not found</div>
      )}
    </section>
  );
};

export default Discipline;
