<?php

namespace ProductsReport\Controller;

use ProductsReport\Model\ProductReportRow;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProductsReportController extends AbstractActionController
{
    protected $productReportRowTable;

    public function indexAction()
    {
        $queryResults = $this->getProductsReportRowTable()->findReportRows();//queryResults is a Rowset of arrays
        $reportRows = array();
        $totalJan = 0;
        $totalFeb = 0;
        $totalMar = 0;
        $totalApr = 0;
        $totalMay = 0;
        $totalJun = 0;
        $totalJul = 0;
        $totalAug = 0;
        $totalSep = 0;
        $totalOct = 0;
        $totalNov = 0;
        $totalDecem = 0;
        $total = 0;
        foreach($queryResults as $queryResult) { //queryResult is an array of data
            $row = new ProductReportRow();
            $row->exchangeArray($queryResult);//populate the attributes of the object with the data from the query result
            $reportRows[] = $row;
            $totalJan += $row->jan;
            $totalFeb += $row->feb;
            $totalMar += $row->mar;
            $totalApr += $row->apr;
            $totalMay += $row->may;
            $totalJun += $row->jun;
            $totalJul += $row->jul;
            $totalAug += $row->aug;
            $totalSep += $row->sep;
            $totalOct += $row->oct;
            $totalNov += $row->nov;
            $totalDecem += $row->decem;
            $total += $row->getRowTotal();
        }
        return new ViewModel(array(
            'rows' => $reportRows,
            'totalJan' => $totalJan,
            'totalFeb' => $totalFeb,
            'totalMar' => $totalMar,
            'totalApr' => $totalApr,
            'totalMay' => $totalMay,
            'totalJun' => $totalJun,
            'totalJul' => $totalJul,
            'totalAug' => $totalAug,
            'totalSep' => $totalSep,
            'totalOct' => $totalOct,
            'totalNov' => $totalNov,
            'totalDecem' => $totalDecem,
            'total' => $total
        ));
    }

    public function getProductsReportRowTable()
    {
        if (!$this->productReportRowTable) {
            $sm = $this->getServiceLocator();
            $this->productReportRowTable = $sm->get('ProductsReport\Model\ProductReportRowTable');
        }
        return $this->productReportRowTable;
    }
}