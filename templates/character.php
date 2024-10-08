<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Character List</title>
</head>
<body>
<h1>Character List</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Class</th>
        <th>Level</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $character): ?>
        <tr>
            <td><?= $character->getId() ?></td>
            <td><?= $character->getName() ?></td>
            <td><?= $character->getClass() ?></td>
            <td><?= $character->getLevel() ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
