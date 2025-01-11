<?php
require_once __DIR__ . '/config/connection.php';

// Menjalankan query
$activities = $con->query("SELECT a.title, 
       b.type, 
       SUM(b.weight) AS total_weight
FROM activities a
JOIN activitiy_details b ON a.id = b.activity_id
GROUP BY a.id, a.title, b.type
ORDER BY a.id ASC");

$activities_01 = $con->query("SELECT a.title, 
       COUNT(b.type) AS total_detail_activity, 
       SUM(b.weight) AS total_weight
FROM activities a
JOIN activitiy_details b ON a.id = b.activity_id
GROUP BY a.id, a.title
ORDER BY a.id ASC");

$activities_02 = $con->query("SELECT a.title, 
       COUNT(DISTINCT b.type) AS total_type_activity, 
       SUM(b.weight) AS total_weight 
FROM activities a 
JOIN activitiy_details b ON a.id = b.activity_id 
GROUP BY a.id 
ORDER BY a.id ASC");

$activities_03 = $con->query("SELECT a.title, 
       b.type, 
       b.weight, 
       b.activity_id
FROM activities a
JOIN activitiy_details b ON a.id = b.activity_id
WHERE b.id IN (
    SELECT MAX(id) 
    FROM activitiy_details 
    WHERE activity_id = a.id
)
ORDER BY a.id ASC;");

// Mengambil hasil query sebagai array asosiatif

$activitiesData = $activities->fetch_all(MYSQLI_ASSOC);
$activitiesData01 = $activities_01->fetch_all(MYSQLI_ASSOC);
$activitiesData02 = $activities_02->fetch_all(MYSQLI_ASSOC);
$activitiesData03 = $activities_03->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query Test</title>
</head>

<body>
    A. Tampilkan Title, Type, dan Jumlah Weight <br>
    <table border="3">
        <tr>
            <th>Title</th>
            <th>Type</th>
            <th>Total Weight</th>
        </tr>
        <?php foreach ($activitiesData as $key) { ?>
            <tr>
                <td><?= $key['title'] ?></td>
                <td><?= $key['type'] ?></td>
                <td><?= $key['total_weight'] ?></td>
            </tr>
        <?php } ?>
    </table><br>
    B. Tampilkan Title, Total activity detail, dan Jumlah Weight <br>
    <table border="3">
        <tr>
            <th>Title</th>
            <th>Type</th>
            <th>Total Weight</th>
        </tr>
        <?php foreach ($activitiesData01 as $key01) { ?>
            <tr>
                <td><?= $key01['title'] ?></td>
                <td><?= $key01['total_detail_activity'] ?></td>
                <td><?= $key01['total_weight'] ?></td>
            </tr>
        <?php } ?>
    </table><br>

    C. Tampilkan Title, Total Jenis Type detail, dan Jumlah Weight <br>
    <table border="3">
        <tr>
            <th>Title</th>
            <th>Type</th>
            <th>Total Weight</th>
        </tr>
        <?php foreach ($activitiesData02 as $key02) { ?>
            <tr>
                <td><?= $key02['title'] ?></td>
                <td><?= $key02['total_type_activity'] ?></td>
                <td><?= $key02['total_weight'] ?></td>
            </tr>
        <?php } ?>
    </table><br>

    D. Tampilkan data detail terakhir dari masing-masing activity <br>
    <table border="3">
        <tr>
            <th>Title</th>
            <th>Type</th>
            <th>Total Weight</th>
        </tr>
        <?php foreach ($activitiesData03 as $key03) { ?>
            <tr>
                <td><?= $key03['title'] ?></td>
                <td><?= $key03['type'] ?></td>
                <td><?= $key03['weight'] ?></td>
            </tr>
        <?php } ?>
    </table><br>
</body>

</html>