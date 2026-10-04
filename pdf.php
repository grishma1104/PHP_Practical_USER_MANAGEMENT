<?php
include "db.php";
require "vendor/autoload.php";
session_start();
$uid=$_SESSION["uid"];
$sql=$conn->prepare("select * from products where uid=?");
$sql->bind_param("i",$uid);
$sql->execute();
$result=$sql->get_result();
$pdf=new TCPDF();
$pdf->AddPage();;
$pdf->setFont("times","B",18);
$pdf->Ln(6);
$pdf->Cell(0,10,"My Products",0,1,"C");
$pdf->setFont("times","I",16);
$html='<table>
<tr>
<td> Id </td>
<td> Name</td>
<td> Category </td>
<td> Price </td>
<td> Quantity </td>
<td> Supplier Name </td>
</tr>
';
while($row=$result->fetch_assoc()){
    $html.='<tr>
    <td>'. $row["pid"].'</td>
    <td>'. $row["pname"].'</td>
    <td>'. $row["category"].'</td>
    <td>'. $row["price"].'</td>
    <td>'. $row["quantity"].'</td>
    <td>'. $row["sname"].'</td>
    </tr>';
}
$html.='</table>';
$pdf->writeHtml($html, true, false, true, false, "");
$pdf->Output("product.pdf","D");
?>