<?php

namespace App\Enums\NovaPoshta;

enum CargoTypeEnum: string
{
    case PARCEL = "Parcel";
    case CARGO = "Cargo";
    case DOCS = "Documents";
    case TIRESWHEELS = "TiresWheels";
    case PALLET = "Pallet";

}
