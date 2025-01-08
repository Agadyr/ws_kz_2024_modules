import { createApi, fetchBaseQuery } from '@reduxjs/toolkit/query/react';

export const api = createApi({
  reducerPath: 'api',
  baseQuery: fetchBaseQuery({ baseUrl: 'http://localhost:3000' }),
  endpoints: (builder) => ({
    getCountries: builder.query({
      query: () => 'countries',
      keepUnusedDataFor: 60,
    }),
  }),
});

export const { useGetCountriesQuery } = api;
