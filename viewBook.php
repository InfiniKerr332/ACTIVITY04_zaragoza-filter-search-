<?php
require_once "library.php";
$bookObj = new Library();

$search = "";
$genre = "";

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $search = isset($_GET["search"]) ? trim(htmlspecialchars($_GET["search"])) : "";
    $genre = isset($_GET["genre"]) ? trim(htmlspecialchars($_GET["genre"])) : "";
}

$books = $bookObj->viewBooks($search, $genre);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>
    <link rel="stylesheet" href="viewbook.css">
</head>
<body>
    <div class="container">
        <h1>Book List</h1>
        
        <form action="" method="get">
            <label for="">Search:</label>
            <input type="search" name="search" id="search" value="<?= htmlspecialchars($search) ?>">
            <select name="genre" id="genre">
                <option value="">All</option>
                <option value="Comedy" <?= ($genre == "Comedy") ? "selected" : "" ?>>Comedy</option>
                <option value="Romance" <?= ($genre == "Romance") ? "selected" : "" ?>>Romance</option>
                <option value="Fantasy" <?= ($genre == "Fantasy") ? "selected" : "" ?>>Fantasy</option>
            </select>
            <input type="submit" value="Search">
        </form>

        <?php if($books && count($books) > 0): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Genre</th>
                        <th>Year</th>
                        <th>Publisher</th>
                        <th>Copies</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $counter = 1;
                    foreach($books as $book):
                    ?>
                    <tr>
                        <td><?= $counter++ ?></td>
                        <td><?= htmlspecialchars($book["title"]) ?></td>
                        <td><?= htmlspecialchars($book["author"]) ?></td>
                        <td><?= htmlspecialchars($book["genre"]) ?></td>
                        <td><?= htmlspecialchars($book["publication_year"]) ?></td>
                        <td><?= htmlspecialchars($book["publisher"]) ?></td>
                        <td><?= htmlspecialchars($book["copies"]) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-books">
                <p>No books found. Add your first book!</p>
            </div>
        <?php endif; ?>

        <div class="nav-btn">
            <a href="addBook.php">Add Book</a>
        </div>
    </div>
</body>
</html>