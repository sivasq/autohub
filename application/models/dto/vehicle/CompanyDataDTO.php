<?php

class CompanyDataDTO
{
    public $companyName;
    public $companyEmail;
    public $companyPhone;
    public $companyAddress1;
    public $companyAddress2;
    public $companyCity;
    public $companyContactName;
    public $companyContactPhone;

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param mixed $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * @return mixed
     */
    public function getCompanyEmail()
    {
        return $this->companyEmail;
    }

    /**
     * @param mixed $companyEmail
     */
    public function setCompanyEmail($companyEmail)
    {
        $this->companyEmail = $companyEmail;
    }

    /**
     * @return mixed
     */
    public function getCompanyPhone()
    {
        return $this->companyPhone;
    }

    /**
     * @param mixed $companyPhone
     */
    public function setCompanyPhone($companyPhone)
    {
        $this->companyPhone = $companyPhone;
    }

    /**
     * @return mixed
     */
    public function getCompanyAddress1()
    {
        return $this->companyAddress1;
    }

    /**
     * @param mixed $companyAddress1
     */
    public function setCompanyAddress1($companyAddress1)
    {
        $this->companyAddress1 = $companyAddress1;
    }

    /**
     * @return mixed
     */
    public function getCompanyAddress2()
    {
        return $this->companyAddress2;
    }

    /**
     * @param mixed $companyAddress2
     */
    public function setCompanyAddress2($companyAddress2)
    {
        $this->companyAddress2 = $companyAddress2;
    }

    /**
     * @return mixed
     */
    public function getCompanyCity()
    {
        return $this->companyCity;
    }

    /**
     * @param mixed $companyCity
     */
    public function setCompanyCity($companyCity)
    {
        $this->companyCity = $companyCity;
    }

    /**
     * @return mixed
     */
    public function getCompanyContactName()
    {
        return $this->companyContactName;
    }

    /**
     * @param mixed $companyContactName
     */
    public function setCompanyContactName($companyContactName)
    {
        $this->companyContactName = $companyContactName;
    }

    /**
     * @return mixed
     */
    public function getCompanyContactPhone()
    {
        return $this->companyContactPhone;
    }

    /**
     * @param mixed $companyContactPhone
     */
    public function setCompanyContactPhone($companyContactPhone)
    {
        $this->companyContactPhone = $companyContactPhone;
    }


}