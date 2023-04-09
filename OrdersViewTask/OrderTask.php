<?php
$xml = simplexml_load_file('data.xml');


echo "<h2>Order Info<h2>";
echo "Purchase Order Number: ".$xml['PurchaseOrderNumber']."<br>";
echo "Order Date: ".$xml['OrderDate']."<br>";

echo "<h2>Shipping Address</h2>";
echo "Name: ".$xml->Address[0]->Name."<br>";
echo "Street: ".$xml->Address[0]->Street."<br>";
echo "City: ".$xml->Address[0]->City."<br>";
echo "State: ".$xml->Address[0]->State."<br>";
echo "Zip: ".$xml->Address[0]->Zip."<br>";
echo "Country: ".$xml->Address[0]->Country."<br>";

echo "<h2>Billing Address</h2>";
echo "Name: ".$xml->Address[1]->Name."<br>";
echo "Street: ".$xml->Address[1]->Street."<br>";
echo "City: ".$xml->Address[1]->City."<br>";
echo "State: ".$xml->Address[1]->State."<br>";
echo "Zip: ".$xml->Address[1]->Zip."<br>";
echo "Country: ".$xml->Address[1]->Country."<br>";

echo "<h2>Delivery Notes</h2>";
echo $xml->DeliveryNotes."<br>";

echo "<h2>Items</h2>";
foreach ($xml->Items->Item as $item) {
  echo "Part Number: ".$item['PartNumber']."<br>";
  echo "Product Name: ".$item->ProductName."<br>";
  echo "Quantity: ".$item->Quantity."<br>";
  echo "US Price: ".$item->USPrice."<br>";
  if (isset($item->Comment)) {
    echo "Comment: ".$item->Comment."<br>";
  }
  if (isset($item->ShipDate)) {
    echo "Ship Date: ".$item->ShipDate."<br>";
  }
  echo "<br>";
}
?>
