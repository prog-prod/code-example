<?php

namespace App\DTO\NovaPoshta;

class NpDataCompanyCityDTO
{
    public string $description;
    public string $descriptionRu;
    public string $ref;
    public string $delivery1;
    public string $delivery2;
    public string $delivery3;
    public string $delivery4;
    public string $delivery5;
    public string $delivery6;
    public string $delivery7;
    public string $area;
    public string $settlementType;
    public string $isBranch;
    public string $preventEntryNewStreetsUser;
    public int $specialCashCheck;
    public string $areaDescription;
    public string $areaDescriptionRu;
    public string $cityID;
    public string $settlementTypeDescriptionRu;
    public string $settlementTypeDescription;

    /**
     * @param string $description
     * @param string $descriptionRu
     * @param string $ref
     * @param string $delivery1
     * @param string $delivery2
     * @param string $delivery3
     * @param string $delivery4
     * @param string $delivery5
     * @param string $delivery6
     * @param string $delivery7
     * @param string $area
     * @param string $settlementType
     * @param string $isBranch
     * @param string $preventEntryNewStreetsUser
     * @param string $cityID
     * @param string $settlementTypeDescriptionRu
     * @param string $settlementTypeDescription
     * @param string $areaDescription
     * @param string $areaDescriptionRu
     * @param string $specialCashCheck
     */
    public function __construct(
        string $description,
        string $descriptionRu,
        string $ref,
        string $delivery1,
        string $delivery2,
        string $delivery3,
        string $delivery4,
        string $delivery5,
        string $delivery6,
        string $delivery7,
        string $area,
        string $settlementType,
        string $isBranch,
        string $preventEntryNewStreetsUser,
        string $cityID,
        string $settlementTypeDescriptionRu,
        string $settlementTypeDescription,
        string $areaDescription,
        string $areaDescriptionRu,
        string $specialCashCheck,
    ) {
        $this->description = $description;
        $this->descriptionRu = $descriptionRu;
        $this->ref = $ref;
        $this->delivery1 = $delivery1;
        $this->delivery2 = $delivery2;
        $this->delivery3 = $delivery3;
        $this->delivery4 = $delivery4;
        $this->delivery5 = $delivery5;
        $this->delivery6 = $delivery6;
        $this->delivery7 = $delivery7;
        $this->area = $area;
        $this->settlementType = $settlementType;
        $this->isBranch = $isBranch;
        $this->preventEntryNewStreetsUser = $preventEntryNewStreetsUser;
        $this->cityID = $cityID;
        $this->settlementTypeDescriptionRu = $settlementTypeDescriptionRu;
        $this->settlementTypeDescription = $settlementTypeDescription;
        $this->areaDescription = $areaDescription;
        $this->areaDescriptionRu = $areaDescriptionRu;
        $this->specialCashCheck = $specialCashCheck;
    }

}
