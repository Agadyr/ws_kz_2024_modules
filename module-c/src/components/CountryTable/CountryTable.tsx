import styles from "./CountryTable.module.scss";
import { CountryType } from "../../types/country";

interface CountryTableProps {
  country: CountryType;
}

const CountryTable = ({ country }: CountryTableProps) => {
  const { medals } = country;
  const total = medals.gold + medals.silver + medals.bronze;

  return (
    <div className={styles.tableContainer}>
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
            <td>{medals.gold}</td>
            <td>{medals.silver}</td>
            <td>{medals.bronze}</td>
            <td>{total}</td>
          </tr>
        </tbody>
      </table>
    </div>
  );
};

export default CountryTable;
