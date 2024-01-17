<?php
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

$query = new MongoDB\Driver\Query([]);
$cursor = $manager->executeQuery('stock_database.most_active_stocks', $query);

echo <<<EOT
<script>
function sortTable(n, isNumeric) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  dir = "asc";
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      var cmpX = isNaN(parseFloat(x.innerHTML)) ? x.innerHTML.toLowerCase() : parseFloat(x.innerHTML);
      var cmpY = isNaN(parseFloat(y.innerHTML)) ? y.innerHTML.toLowerCase() : parseFloat(y.innerHTML);
      if ((dir == "asc" && cmpX > cmpY) || (dir == "desc" && cmpX < cmpY)) {
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount++;
    } else if (switchcount == 0 && dir == "asc") {
      dir = "desc";
      switching = true;
    }
  }
}
</script>
EOT;

echo '<table id="myTable" border="1">';
echo '<tr>';
echo '<th><a href="#" onclick="sortTable(0, false); return false;">Index</a></th>';
echo '<th><a href="#" onclick="sortTable(1, false); return false;">Symbol</a></th>';
echo '<th><a href="#" onclick="sortTable(2, false); return false;">Name</a></th>';
echo '<th><a href="#" onclick="sortTable(3, true); return false;">Price (Introday)</a></th>';
echo '<th><a href="#" onclick="sortTable(4, true); return false;">Change</a></th>';
echo '<th><a href="#" onclick="sortTable(5, true); return false;">Volume</a></th>';
echo '</tr>';

$index = 1;
foreach ($cursor as $document) {
    $stock = (array)$document;
    echo '<td>' . $index++ . '</td>';
    echo '<td>' . $stock['Symbol'] . '</td>';
    echo '<td>' . $stock['Name'] . '</td>';
    echo '<td>' . $stock['Price (Introday)'] . '</td>';
    echo '<td>' . $stock['Change'] . '</td>';
    echo '<td>' . $stock['Volume'] . '</td>';
    echo '</tr>';
}

echo '</table>';
?>