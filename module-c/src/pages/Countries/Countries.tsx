import { useGetCountriesQuery } from "../../services/api"
import styles from "./Countries.module.scss"
import { UniqButton } from "../../types/country"
import Button from "../../components/Button/Button"
import { Link } from "react-router-dom"

const Countries = () => {
  const {data, error, isLoading} = useGetCountriesQuery({})

  if (isLoading) return <div>Loading ...</div>
  if (error) console.log(error);

  const onClick = (name: string) => {
    console.log(name)
  }
  return (
    <section>
        <Link to={'/'} className={styles.prev}>
          <img src="/images/ico-prev.svg" alt="prev page" />
        </Link>
        <h1 className={styles.h1}>Countries</h1>
        {data.map((item: UniqButton) => (
            <Button key={item.id} id={item.id} flag={item.flag} name={item.name} onClick={onClick}/>
        ))}
    </section>
  )
}

export default Countries