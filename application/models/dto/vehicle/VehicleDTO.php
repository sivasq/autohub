<?php
/**
 * Created by PhpStorm.
 * User: EbinC
 * Date: 1/20/2019
 * Time: 12:19 AM
 */

class VehicleDTO
{
    public $carYear; //String
    public $carMake; //String
    public $carModel; //String
    public $carVIN;
    public $carTrim; //String
    public $carMileage; //String
    public $carImage; //String
    public $carMileageRange;
    public $carActualMileage;
    public $carBusinessType;
    public $carType;

    /**
     * @var CommercialDataDTO
     */
    public $commercialData;

    /**
     * @return mixed
     */
    public function getCarYear()
    {
        return $this->carYear;
    }

    /**
     * @param mixed $carYear
     */
    public function setCarYear($carYear)
    {
        $this->carYear = $carYear;
    }

    /**
     * @return mixed
     */
    public function getCarMake()
    {
        return $this->carMake;
    }

    /**
     * @param mixed $carMake
     */
    public function setCarMake($carMake)
    {
        $this->carMake = $carMake;
    }

    /**
     * @return mixed
     */
    public function getCarModel()
    {
        return $this->carModel;
    }

    /**
     * @param mixed $carModel
     */
    public function setCarModel($carModel)
    {
        $this->carModel = $carModel;
    }

    /**
     * @return mixed
     */
    public function getCarVIN()
    {
        return $this->carVIN;
    }

    /**
     * @param mixed $carVIN
     */
    public function setCarVIN($carVIN)
    {
        $this->carVIN = $carVIN;
    }

    /**
     * @return mixed
     */
    public function getCarTrim()
    {
        return $this->carTrim;
    }

    /**
     * @param mixed $carTrim
     */
    public function setCarTrim($carTrim)
    {
        $this->carTrim = $carTrim;
    }

    /**
     * @return mixed
     */
    public function getCarMileage()
    {
        return $this->carMileage;
    }

    /**
     * @param mixed $carMileage
     */
    public function setCarMileage($carMileage)
    {
        $this->carMileage = $carMileage;
    }

    /**
     * @return mixed
     */
    public function getCarImage()
    {
        return $this->carImage;
    }

    /**
     * @param mixed $carImage
     */
    public function setCarImage($carImage)
    {
        $this->carImage = $carImage;
    }

    /**
     * @return mixed
     */
    public function getCarMileageRange()
    {
        return $this->carMileageRange;
    }

    /**
     * @param mixed $carMileageRange
     */
    public function setCarMileageRange($carMileageRange)
    {
        $this->carMileageRange = $carMileageRange;
    }

    /**
     * @return mixed
     */
    public function getCarActualMileage()
    {
        return $this->carActualMileage;
    }

    /**
     * @param mixed $carActualMileage
     */
    public function setCarActualMileage($carActualMileage)
    {
        $this->carActualMileage = $carActualMileage;
    }

    /**
     * @return mixed
     */
    public function getCarBusinessType()
    {
        return $this->carBusinessType;
    }

    /**
     * @param mixed $carBusinessType
     */
    public function setCarBusinessType($carBusinessType)
    {
        $this->carBusinessType = $carBusinessType;
    }

    /**
     * @return mixed
     */
    public function getCarType()
    {
        return $this->carType;
    }

    /**
     * @param mixed $carType
     */
    public function setCarType($carType)
    {
        $this->carType = $carType;
    }

    /**
     * @return CommercialDataDTO
     */
    public function getCommercialData()
    {
        return $this->commercialData;
    }

    /**
     * @param CommercialDataDTO $commercialData
     */
    public function setCommercialData(CommercialDataDTO $commercialData)
    {
        $this->commercialData = $commercialData;
    }


}