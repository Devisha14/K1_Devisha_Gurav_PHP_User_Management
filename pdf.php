<?php
include 'db.php';
require 'vendor/autoload.php';
$result=$conn->query("select *from products");
$pdf=new TCPDF();
$pdf->AddPage();
$pdf->SetFont('Times','I','12');

$html='<table>
<tr>
<td>ID</td>
<td>Name</td>
<td>Category</td>
<td>Price</td>
<td>Quantity</td>
<td>Supplier Name</td>

</tr>';
 while($row=$result->fetch_assoc()){
 $html.='<tr>
 <td>'.$row["pid"].'</td>
 <td>'.$row["pname"].'</td>
 <td>'.$row["category"].'</td>
 <td>'.$row["price"].'</td>
 <td>'.$row["quantity"].'</td>
 <td>'.$row["sname"].'</td>
 </tr>';
 }
$html.='</table>';
$pdf->writeHTML($html,true,false,true,false,'');
$pdf->Output("Product.pdf","D");
?>