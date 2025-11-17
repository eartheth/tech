<?php
// --------------------
// Database Connection
// --------------------
$host = "localhost";
$user = "root";
$pass = "";
$db   = "mydb";  // change to your DB name

$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --------------------
// Validate & Fetch Post
// --------------------
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid post ID.");
}

$post_id = intval($_GET['id']);

$sql = "SELECT * FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Post not found.");
}

$post = $result->fetch_assoc();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title><?php echo htmlspecialchars($post['title']); ?> — Tech Info</title>
  <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>

<nav class="nav" aria-label="Primary">
  <div class="nav-inner">
    <a class="logo" href="index.html">
      <img src="assets/img/logo.svg" alt="" height="32"/>
    </a>
    <div class="menu">
      <a href="index.html">Homepage</a>
      <a href="post.php">All Posts</a>
      <a href="credits.html">Credits</a>
    </div>
  </div>
</nav>

<header class="hero">
  <div class="container">
    <h1 style="margin:0;font-size:48px">
      <?php echo htmlspecialchars($post['title']); ?>
    </h1>
    <p style="max-width:720px;color:#cbd5e1">
      Published on <?php echo date("F j, Y", strtotime($post['created_at'])); ?>
    </p>
    <div class="cta">
      <a class="btn btn-outline" href="post.php">← Back to All Posts</a>
    </div>
  </div>
</header>

<main class="container" style="margin-top:24px">

  <div class="card" style="padding:24px">
    <p style="white-space:pre-wrap;line-height:1.7;font-size:18px;">
      <?php echo nl2br(htmlspecialchars($post['content'])); ?>
    </p>
  </div>

</main>

<footer class="footer">
  <div class="container">
    <div class="grid grid-3">
      <div>
        <h3 style="margin-top:0">Tech Info</h3>
        <p>For educational use ONLY</p>
      </div>
      <div>
        <h4>Quick Links</h4>
        <ul>
          <li><a href="index.html">Homepage</a></li>
          <li><a href="credits.html">Credits</a></li>
        </ul>
      </div>
      <div>
        <img src="assets/img/sponser.png" class="sponser-img" alt="sponsors" height="50">
      </div>
    </div>
    <p style="margin-top:16px;font-size:12px;color:#cbd5e1">© 2025 Learn4Plus — School Project</p>
  </div>
</footer>

<script src="assets/js/app.js"></script>
</body>
</html>
