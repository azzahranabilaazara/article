<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "blog_db";

$conn = mysqli_connect($host, $user, $pass, $db);

// Fungsi untuk menjalankan query dan mengembalikan data
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Fungsi untuk mengambil semua artikel lengkap dengan penulis dan kategori
function getAllArticles() {
    return query("
        SELECT 
            a.id,
            a.title,
            a.date,
            a.content,
            a.picture,
            au.nickname AS author,
            c.name AS category,
            c.description AS category_description
        FROM article a
        LEFT JOIN article_author aa ON a.id = aa.article_id
        LEFT JOIN author au ON aa.author_id = au.id
        LEFT JOIN article_category ac ON a.id = ac.article_id
        LEFT JOIN category c ON ac.category_id = c.id
        ORDER BY a.date DESC
    ");
}

// Fungsi untuk mengambil semua kategori unik
function getAllCategories() {
    global $conn;
    $result = mysqli_query($conn, "SELECT DISTINCT name FROM category ORDER BY name ASC");
    $categories = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
    return $categories;
}
?>