<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Test</h2>
    <h3 style="color:<?php echo $data["color"] ?>"><?php 
    while ($row = mysqli_fetch_array($data["user"])) {
        echo $row["email"]."<br/ >";
    }
    ?></h3>
    
</body>
</html>