<?php
include('koneksi.php');
if(isset($_POST["Export_Rsvp"])){
    header('Content-Type: text/csv; charset=utf-8');  
    header('Content-Disposition: attachment; filename=data-Rsvp.csv');  
    $output = fopen("php://output", "w");  
    $query = "SELECT * from rsvp WHERE walkIn = 0 AND status != 0 ORDER BY idRsvp ASC";  
    $result = mysqli_query($conn, $query);  
    while($row = mysqli_fetch_assoc($result)){  
        fputcsv($output, $row);  
    }  
    fclose($output); 
}
elseif(isset($_POST["Export_WalkIn"])){
    header('Content-Type: text/csv; charset=utf-8');  
    header('Content-Disposition: attachment; filename=data-Rsvp-By-WalkIn.csv');  
    $output = fopen("php://output", "w");  
    $query = "SELECT * from rsvp WHERE walkIn = 1 AND status != 0 ORDER BY idRsvp ASC";  
    $result = mysqli_query($conn, $query);  
    while($row = mysqli_fetch_assoc($result)){  
        fputcsv($output, $row);  
    }  
    fclose($output); 
}
?>