<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 2/1/2018
 * Time: 8:06 PM
 */

require_once("Classes/PHPExcel.php");
require_once("utils.php");

$data = json_decode($_POST["json"], true);

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Mr.Koo")
                            ->setLastModifiedBy("Mr.Koo")
                            ->setTitle("Result of search through Google Map")
                            ->setSubject("Search Result")
                            ->setDescription("")
                            ->setKeywords("tempKeyword")
                            ->setCategory("Document");

try {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue("A1", "Name")
        ->setCellValue("B1", "Country")
        ->setCellValue("C1", "City")
        ->setCellValue("D1", "Phone Number")
        ->setCellValue("E1", "Website addaddress")
        ->setCellValue("F1", "Rating")
        ->setCellValue("G1", "Type")
        ->setCellValue("H1", "Vicinity")
        ->setCellValue("I1", "GoogleURL");

    $row_index = 2;
    foreach($data as $row) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("A{$row_index}", getMember($row, "name"))
            ->setCellValue("B{$row_index}", getMember($row, "country"))
            ->setCellValue("C{$row_index}", getMember($row, "city"))
            ->setCellValue("D{$row_index}", getMember($row, "phone"))
            ->setCellValue("E{$row_index}", getMember($row, "website"))
            ->setCellValue("F{$row_index}", getMember($row, "rating"))
            ->setCellValue("G{$row_index}", getMember($row, "type"))
            ->setCellValue("H{$row_index}", getMember($row, "vicinity"))
            ->setCellValue("I{$row_index}", getMember($row, "url"));
        $row_index++;
    }

    $objPHPExcel->getActiveSheet()->setTitle("First sheet");

    $filename = generateRandomString();

//    header('Content-Type: application/vnd.ms-excel');
//    header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
//    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('output/' . $filename . '.xls');
    $url = isset($_SERVER['HTTPS']) ? "https" : "http" . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url = substr($url, 0, strrpos($url, '/'));
    $url .= "/output/" . $filename . '.xls';
    echo(json_encode(["url" => $url]));
} catch (Exception $e) {
    die("there isn't any sheet in this document, even if you cannot believe!");
}

