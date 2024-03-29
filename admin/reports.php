<?php
include 'connection.php';
$name = $_SESSION['adm_fname']. " ". $_SESSION['adm_lname'];
$officer_id = $_SESSION['officerId'];

if (isset($_POST['printReportBtn'])) {
    
    $farmerID = $_POST['farmer_Id'];
    $requestID = $_POST['request_Id'];
    
    // Set the content type as a downloadable PDF file
    header('Content-Type: application/pdf');
    // Set the file name
    header('Content-Disposition: attachment; filename="officer_report_details.pdf"');

    // Include the necessary files for creating a PDF
    require('fpdf/fpdf.php');

    // Create a new PDF document
    $pdf = new FPDF();
    $pdf->AddPage();

    // Set the font and font size for the document
    $pdf->SetFont('Arial', 'B', 14);

    // Add the logo to the document
    $pdf->Image('images/logo.png', $pdf->GetPageWidth()/2 - 25, 10, 50, 0, 'PNG');

    // Write the title of the document
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 50, '', 0, 1, 'C');
    $pdf->Cell(0, 10, 'National Agricultural Advisory Services', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Extension Officer Report Details', 0, 1, 'C');

    // Set the font and font size for the table headers
    $pdf->SetFont('Arial', 'B', 12);

    // Write the headers of the table
    $pdf->Cell(30, 10, 'Request ID', 1);
    $pdf->Cell(40, 10, "Farmer's Name", 1);
    $pdf->Cell(40, 10, 'Farm Name', 1);
    $pdf->Cell(40, 10, 'Farm Soil Type', 1);
    $pdf->Cell(40, 10, 'Farm Location', 1);

    $pdf->Ln();

    // Query to get the school details
    $sql = "SELECT * FROM farmer_request_advice_details 
    INNER JOIN request_response_details ON farmer_request_advice_details.request_id = request_response_details.request_id
    INNER JOIN farm_details ON farm_details.farm_id = farmer_request_advice_details.farm_id
    INNER JOIN farmer_details ON farmer_details.farmer_id = farmer_request_advice_details.farmer_id
    INNER JOIN county_details ON county_details.county_id = farm_details.farm_location
    INNER JOIN extension_officer ON extension_officer.officer_id = request_response_details.officer_id
    INNER JOIN soil_details ON soil_details.soil_id = farm_details.soil_id
    WHERE request_response_details.request_id = '$requestID' AND request_response_details.officer_id ='$officer_id'";
    $result = mysqli_query($db, $sql);

    // Set the font and font size for the table rows
    $pdf->SetFont('Arial', '', 10);

  // Loop through the results and write them to the table
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Write the data to the table
        $pdf->Cell(30, 10, $row['request_id'], 1);
        $pdf->Cell(40, 10, $row['farmer_fname'] ." ".$row['farmer_lname'], 1);
        $pdf->Cell(40, 10, $row['farm_name'], 1);
        $pdf->Cell(40, 10, $row['soil_name'], 1);
        $pdf->Cell(40, 10, $row['county_name']." "."County", 1);

        //2 new lines
        $pdf->Ln();
        $pdf->Ln();
        // Write the request description to the text area
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Request Description:', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(0, 10, $row['short_description'], 1);

        //new line
        $pdf->Ln();

        // Write the response
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Advice:', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(0, 10, $row['response'], 1);
        
        //new line
        $pdf->Ln();
        $pdf->Cell(0, 10, 'Regards:', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, $row['first_name']." ".$row['last_name']." on ".$row['date_added'], 0, 1);
    }
}

  // Close the database connection and output the PDF
  mysqli_close($db);
  $pdf->Output('D', 'officer_report_details.pdf');
}


?>
<!DOCTYPE html>
<html>

<head>

    <title>Reports | Admin</title>
    <?php
include './components/header.php';
?>

</head>

<body>
    <?php
include './components/navbar.php';
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">List of Responses</h5>
                        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>Request ID</th>
                                    <th>Farmer Name</th>
                                    <th>Farmer Email</th>
                                    <th>Farmer Phone</th>
                                    <th>Farm Name</th>
                                    <th>Farm Location</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
  if($officer_id){
      $data_fetch_query = "SELECT * FROM `farmer_request_advice_details`
      INNER JOIN request_response_details ON request_response_details.request_id = farmer_request_advice_details.request_id
      INNER JOIN farm_details ON farm_details.farm_id = farmer_request_advice_details.farm_id
      INNER JOIN farmer_details ON  farmer_details.farmer_id = farmer_request_advice_details.farmer_id
      INNER JOIN county_details ON county_details.county_id = farm_details.farm_location
      INNER JOIN soil_details ON soil_details.soil_id = farm_details.soil_id
      WHERE request_response_details.officer_id = '$officer_id'";
      $data_result = mysqli_query($db, $data_fetch_query);
      if ($data_result->num_rows > 0){
          while($row = $data_result->fetch_assoc()) {
              $request_id = $row['request_id'];
              $farmer_id = $row['farmer_id'];
              $farmer_fname = $row['farmer_fname'];
              $farmer_lname = $row['farmer_lname'];
              $farmer_email = $row['farmer_email'];
              $farmer_tel = $row['farmer_phone'];
              $farm_id = $row['farm_id'];
              $farm_name = $row['farm_name'];
              $crop_id = $row['crop_id'];
              $activity_id = $row['activity_id'];
              $county_name = $row['county_name'];
              $description = $row['short_description'];
              $status= $row['request_status'];
              $soil_name= $row['soil_name'];


      echo "<tr> <td>" .$request_id.  "</td>";
      echo "<td>" . $farmer_fname." ".$farmer_lname."</td>";
      echo "<td>" .$farmer_email."</td>";
      echo "<td>" .$farmer_tel."</td>";
      echo "<td>" .$farm_name."</td>";
      echo "<td>" . $county_name."</td>";
      echo "<td>
        
      <form method ='POST' action=''>
      <input  type='text' hidden readonly name='farmer_Id' value='$farmer_id'>
      <input  type='text' hidden readonly name='request_Id' value='$request_id'>
      <input type='submit' name='printReportBtn' value='Print Report'  class='btn btn-info printReportBtn'>
      </form>
      </td> </tr>";
      }
      
      }else{
      echo "<td>"."No Data Found"."</td>";
      }
      
      } else{
          echo "<td>"."No farms available"."</td>";
      }

?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Request ID</th>
                                    <th>Farmer Name</th>
                                    <th>Farmer Email</th>
                                    <th>Farmer Phone</th>
                                    <th>Farm Name</th>
                                    <th>Farm Location</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>


        </div>
        <?php
include './components/footer.php';
            ?>
    </div>
    <script>
    </script>
    <?php
include './components/scripts.php';
?>
</body>

</html>