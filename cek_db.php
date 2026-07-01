<?php
$db = new SQLite3('D:\Project\Aplikasi-Cetaktalilanyard\database\database.sqlite');
$tables = $db->query("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name");
echo "=== ISI DATABASE SQLITE ===\n\n";
while ($row = $tables->fetchArray(SQLITE3_ASSOC)) {
    $table = $row['name'];
    $count = $db->querySingle("SELECT COUNT(*) FROM \"$table\"");
    echo "  $table : $count rows\n";
}
$db->close();
echo "\nTotal: selesai\n";
