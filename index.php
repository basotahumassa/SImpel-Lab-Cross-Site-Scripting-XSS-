<?php
$conn = new mysqli("localhost", "root", "", "xss_lab");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $comment = $_POST["comment"];

    // xss 
    $sql = "INSERT INTO comments (username, comment) VALUES ('$username', '$comment')";
    $conn->query($sql);
}

$result = $conn->query("SELECT * FROM comments");
?>

<!DOCTYPE html>
<html>
<head>
    <title>XSS Lab</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        .comment {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }
        .comment b {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Comments</h1>
        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="comment">Comment:</label>
            <textarea id="comment" name="comment" rows="4" required></textarea><br>
            <input type="submit" value="Submit">
        </form>
        <h2>All Comments</h2>
        <?php
        while($row = $result->fetch_assoc()) {
            echo "<div class='comment'><b>" . $row["username"] . ":</b> " . $row["comment"] . "</div>";
        }
        ?>
    </div>
</body>
</html>
