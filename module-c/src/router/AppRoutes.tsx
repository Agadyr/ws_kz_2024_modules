import { Routes, Route } from 'react-router-dom';
import Welcome from '../pages/Welcome/Welcome';
import Countries from '../pages/Countries/Countries';
import Country from '../pages/Country/Country';
import Medal from '../pages/Medal/Medal';
import Disciplines from '../pages/Disciplines/Disciplines';
import Discipline from '../pages/Discipline/Discipline';

const AppRoutes = () => {
  return (
    <Routes>
      <Route path="/welcome" element={<Welcome />} />
      <Route path="/countries" element={<Countries />} />
      <Route path="/country/:countryName" element={<Country />} />
      <Route path="/country/:countryName/:medal" element={<Medal />} />
      <Route path="/disciplines" element={<Disciplines />} />
      <Route path="/discipline/:disciplineName" element={<Discipline />} />
      <Route path="/discipline/:disciplineName:countryName" element={<Discipline />} />
    </Routes>
  );
};

export default AppRoutes;
