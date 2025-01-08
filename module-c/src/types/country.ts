export interface Discipline {
    name: string;
    image: string;
    gold: number;
    silver: number;
    bronze: number;
  }
  
export interface Medals {
    gold: number;
    silver: number;
    bronze: number;
}
  
export interface CountryType {
    name: string;
    flag: string;
    medals: Medals;
    disciplines: Discipline[];
    id: string;
}

export interface UniqButton {
    id?: number
    flag: string
    name: string
    onClick: (name: string) => void;
}

export type Countries = CountryType[];
  