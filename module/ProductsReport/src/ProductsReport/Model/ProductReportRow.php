<?php
namespace ProductsReport\Model;

class ProductReportRow
{
    public $productName;
    public $jan;
    public $feb;
    public $mar;

    public $apr;
    public $may;
    public $jun;
    public $jul;

    public $aug;
    public $sep;
    public $oct;
    public $nov;
    public $decem;

    public function exchangeArray($data)
    {
        $this->productName = (!empty($data['productName'])) ? $data['productName'] : null;
        $this->jan = (!empty($data['jan'])) ? $data['jan'] : null;
        $this->feb = (!empty($data['feb'])) ? $data['feb'] : null;
        $this->mar = (!empty($data['mar'])) ? $data['mar'] : null;
        $this->apr = (!empty($data['apr'])) ? $data['apr'] : null;
        $this->may = (!empty($data['may'])) ? $data['may'] : null;
        $this->jun = (!empty($data['jun'])) ? $data['jun'] : null;
        $this->jul = (!empty($data['jul'])) ? $data['jul'] : null;
        $this->aug = (!empty($data['aug'])) ? $data['aug'] : null;
        $this->sep = (!empty($data['sep'])) ? $data['sep'] : null;
        $this->oct = (!empty($data['oct'])) ? $data['oct'] : null;
        $this->nov = (!empty($data['nov'])) ? $data['nov'] : null;
        $this->decem = (!empty($data['decem'])) ? $data['decem'] : null;

    }

    public function getRowTotal(){

        return $this->jan + $this->feb + $this->mar +$this->apr +$this->may +$this->jun +$this->jul +$this->aug
        +$this->sep + $this->oct + $this->nov +$this->decem;
    }
}