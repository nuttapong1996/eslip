<?php
// ข้อมูลตัวอย่างที่ได้จากฐานข้อมูล
$data = [
    ['id' => 1, 'name' => 'John', 'email' => 'john@example.com'],
    ['id' => 2, 'name' => 'Jane', 'email' => 'jane@example.com'],
    ['id' => 3, 'name' => 'Doe', 'email' => 'doe@example.com'],
];

// เตรียมข้อมูลใหม่จากการ map ด้วย foreach
$mappedData = [];
foreach ($data as $item) {
    $mappedData[] = [
        'user_id' => $item['id'],
        'username' => $item['name'],
        'user_email' => $item['email']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Display Data as Table</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Data Table</h2>
<table>
    <thead>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>User Email</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($mappedData as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['user_id']) ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['user_email']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
