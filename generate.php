<?php 
  //decode the id 
  $id = base64_decode($_GET['exv']);
  //get the selected car by the id
  $stmt = $conn->prepare("SELECT * FROM cars WHERE id =? LIMIT 1");
  //execute the query
  $stmt->execute(array($id));
  //fetch the car record
  $row = $stmt->fetch();
  //extract the record/result
  extract($row,EXTR_PREFIX_ALL, "view");
?>

<?
    require_once ('./assets/vendor/fpdf.php');
    $connection = mysqli_connect('localhost', 'root', '', 'car_project_db');
    if (!$connection){
        die("Database Connection Failed" . mysqli_connect_error());
    }
    else{
        echo "Database Connected";
    }

    class PDF extends FPDF
    {
        function Header()
        {
            // Select Arial bold 15
            $this->SetFont('Arial','B',15);
            // Move to the right
            $this->Cell(80);
            // Framed title
            $this->Cell(30,10,'Title',1,0,'C');
            // Line break
            $this->Ln(20);
        }
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Select Arial italic 8
            $this->SetFont('Arial','I',8);
            // Print current and total page numbers
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
    }

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arail','',12);

    $query = "SELECT * FROM cars WHERE id = ? LIMIT 1";
    $result = mysqli_query($connection, $query);
    

    while ($row = mysqli_fetch_assoc($result)){
        $pdf->Cell(40,10,$row['car_name'],1,0);
        $pdf->Cell(40,10,$row['car_model'],1,0);
        $pdf->Cell(40,10,$row['car_manufacturer'],1,0);
        $pdf->Ln();
    }

    mysqli_close($connection);

    $pdf->Output();
?>
