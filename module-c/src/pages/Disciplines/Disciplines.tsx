import { useGetCountriesQuery } from "../../services/api";
import styles from "./Disciplines.module.scss";
import { CountryType, Discipline } from "../../types/country";
import Button from "../../components/Button/Button";
import { Link } from "react-router-dom";
import { useEffect, useState } from "react";

const Disciplines = () => {
  const { data, error, isLoading } = useGetCountriesQuery({}) as {
    data: CountryType[];
    error: Error;
    isLoading: boolean;
  };

  const [disciplines, setDisciplines] = useState<Discipline[]>([]);

  useEffect(() => {
    if (data) {
      const allDisciplines = data.flatMap((country: CountryType) => country.disciplines);

      const uniqueDisciplines = Array.from(
        new Map(
          allDisciplines.map((discipline) => [discipline.name, discipline])
        ).values()
      );

      setDisciplines(uniqueDisciplines);
    }
  }, [data]);
  if (isLoading) return <div>Loading ...</div>;
  if (error) {
    console.error(error);
    return <div>Error loading data</div>;
  }

  const onClick = (name: string) => {
    console.log(name);
  };

  return (
    <section>
      <Link to={"/welcome"} className={styles.prev}>
        <img src="/images/ico-prev.svg" alt="prev page" />
      </Link>
      <h1 className={styles.h1}>Disciplines</h1>
      {disciplines.slice(1,9).map((item: Discipline, index: number) => (
        <Button
          key={index}
          id={index}
          flag={item.image}
          name={item.name}
          link="discipline"
          onClick={onClick}
        />
      ))}
    </section>
  );
};

export default Disciplines;
