<?php
namespace ProductsReport\Model;

use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;

class ProductReportRowTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function findReportRows(){
        $sql = new Sql($this->tableGateway->getAdapter());
        $select = $sql->select();
        $select->from(array("prod" => "products"))
            ->join(array("adv"=>"adverts"),"prod.id = adv.prod_id")
            ->join(array("issue"=>"issues"),"prod.id = issue.prod_id",array(
                "jan" =>  new Expression("sum(CASE WHEN month(issue.issue) = 1 THEN truncate(adv.adcost,2) END)"),
                "feb" =>  new Expression("sum(CASE WHEN month(issue.issue) = 2 THEN truncate(adv.adcost,2) END)"),
                "mar" =>  new Expression("sum(CASE WHEN month(issue.issue) = 3 THEN truncate(adv.adcost,2) END)"),
                "apr" =>  new Expression("sum(CASE WHEN month(issue.issue) = 4 THEN truncate(adv.adcost,2) END)"),
                "may" =>  new Expression("sum(CASE WHEN month(issue.issue) = 5 THEN truncate(adv.adcost,2) END)"),
                "jun" =>  new Expression("sum(CASE WHEN month(issue.issue) = 6 THEN truncate(adv.adcost,2) END)"),
                "jul" =>  new Expression("sum(CASE WHEN month(issue.issue) = 7 THEN truncate(adv.adcost,2) END)"),
                "aug" =>  new Expression("sum(CASE WHEN month(issue.issue) = 8 THEN truncate(adv.adcost,2) END)"),
                "sep" =>  new Expression("sum(CASE WHEN month(issue.issue) = 9 THEN truncate(adv.adcost,2) END)"),
                "oct" =>  new Expression("sum(CASE WHEN month(issue.issue) = 10 THEN truncate(adv.adcost,2) END)"),
                "nov" =>  new Expression("sum(CASE WHEN month(issue.issue) = 11 THEN truncate(adv.adcost,2) END)"),
                "decem" =>  new Expression("sum(CASE WHEN month(issue.issue) = 12 THEN truncate(adv.adcost,2) END)")
            ));

        //especificar las columnas que queremos en el resultados de las consultas.
        $select->columns(array("productName" => "name"));

        $select->group('prod.id');

        $statement = $sql->prepareStatementForSqlObject($select);
        $rowset = $statement->execute();
        return $rowset;
    }
}
?>