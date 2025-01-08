import styles from "./DisciplineTable.module.scss";
import { CountryDiscipline } from "../../types/country";
import { useState } from "react";
import { Link } from "react-router-dom";

interface DisciplineTableProps {
  disciplines: CountryDiscipline[];
}

const DisciplineTable = ({ disciplines }: DisciplineTableProps) => {
  const [selectedCountry, setSelectedCountry] = useState<CountryDiscipline | undefined>(undefined);

  const totalMedals = selectedCountry
    ? selectedCountry.discipline.gold + selectedCountry.discipline.silver + selectedCountry.discipline.bronze : 0;

  const renderCountryTable = () => (
    <table className={styles.medalsTable}>
      <thead>
        <tr>
          <th>COUNTRY</th>
          <th>MEDALS</th>
        </tr>
      </thead>
      <tbody>
        {disciplines.map((d, index) => (
          <tr key={index}>
            <td onClick={() => setSelectedCountry(d)} className={styles.country}>{d.name}</td>
            <td>{d.discipline.gold + d.discipline.silver + d.discipline.bronze}</td>
          </tr>
        ))}
      </tbody>
    </table>
  );

  const renderDisciplineDetails = () => (
    <table className={styles.medalsTable}>
      <thead>
        <tr>
          <th>GOLD</th>
          <th>SILVER</th>
          <th>BRONZE</th>
          <th>TOTAL</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{selectedCountry?.discipline.gold}</td>
          <td>{selectedCountry?.discipline.silver}</td>
          <td>{selectedCountry?.discipline.bronze}</td>
          <td>{totalMedals}</td>
        </tr>
      </tbody>
    </table>
  );

  return (
    <div className={styles.tableContainer}>
      <Link
        to={!selectedCountry ? "/disciplines" : `/discipline/${selectedCountry?.discipline.name}`}
        className={styles.prev}
        onClick={() => setSelectedCountry(undefined)}
      >
        <img src="/images/ico-prev.svg" alt="prev page" />
      </Link>

      {selectedCountry ? <h3 className={styles.h3}>{selectedCountry.name}</h3> : ''}
      
      {selectedCountry ? renderDisciplineDetails() : renderCountryTable()}
    </div>
  );
};

export default DisciplineTable;
