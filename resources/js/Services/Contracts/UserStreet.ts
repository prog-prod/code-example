import { LocationCoordinates } from "./LocationCoordinates";

export interface UserStreet {
    location: LocationCoordinates;
    present: string;
    settlementRef: string;
    settlementStreetDescription: string;
    settlementStreetDescriptionRu: string;
    settlementStreetRef: string;
    streetsType: string;
    streetsTypeDescription: string;
}
