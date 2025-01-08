import styles from "./DisciplineTable.module.scss";
import { CountryDiscipline } from "../../types/country";

interface DisciplineTableProps {
  disciplines: CountryDiscipline[];
}

const DisciplineTable = ({ disciplines }: DisciplineTableProps) => {
  return (
    <div className={styles.tableContainer}>
      <table className={styles.medalsTable}>
        <thead>
          <tr>
            <th>COUNTRY</th>
            <th>MEDALS</th>
          </tr>
        </thead>
        <tbody>
          {disciplines.map((d: CountryDiscipline, index: number) => (
            <tr key={index}>
              <td className={styles.country}>{d.name}</td>
              <td>{d.discipline.gold + d.discipline.silver + d.discipline.bronze}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default DisciplineTable;
