<?php

class CommercialDataDTO
{
    /**
     * @var DriverDTO[]
     */
    public $carDriverData;
    /**
     * @var CompanyDataDTO
     */
    public $companyData;

    /**
     * @return mixed
     */
    public function getCarDriverData()
    {
        return $this->carDriverData;
    }

    /**
     * @param mixed $carDriverData
     */
    public function setCarDriverData($carDriverData)
    {
        $this->carDriverData = $carDriverData;
    }

    /**
     * @return CompanyDataDTO
     */
    public function getCompanyData()
    {
        return $this->companyData;
    }

    /**
     * @param CompanyDataDTO $companyData
     */
    public function setCompanyData($companyData)
    {
        $this->companyData = $companyData;
    }


}