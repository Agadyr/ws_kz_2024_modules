import { Routes, Route } from 'react-router-dom';
import Welcome from '../pages/Welcome/Welcome';
import Countries from '../pages/Countries/Countries';
import Country from '../pages/Country/Country';

const AppRoutes = () => {
  return (
    <Routes>
      <Route path="/welcome" element={<Welcome />} />
      <Route path="/countries" element={<Countries />} />
      <Route path="/country/:countryName" element={<Country />} />
    </Routes>
  );
};

export default AppRoutes;
