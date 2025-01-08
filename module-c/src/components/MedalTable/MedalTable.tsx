import { Disciplines } from "../../types/country";
import styles from "./MedalTable.module.scss";

interface DisciplineTableProps {
  disciplines: Disciplines;
  medal: string
}

const MedalTable = ({ disciplines, medal }: DisciplineTableProps) => {
  console.log(disciplines);
  return (
    <div className={styles.tableContainer}>
      <table className={styles.medalsTable}>
        <thead>
          <tr>
            <th>DISCIPLINE</th>
            <th>MEDALS</th>
          </tr>
        </thead>
        <tbody>
          {disciplines.map((item, index) => (
            <tr key={index}>
              <td>{item.name}</td>
              <td>{item[medal as keyof typeof item]}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default MedalTable;
