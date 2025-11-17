<?php
// --------------------
// Database Connection
// --------------------
$host = "localhost";
$user = "dev_team";
$pass = "qENK2ZpzqlQ@n2.Y";
$db   = "learn4plus_extension";

$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset("utf8");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// --------------------
// Fetch Posts
// --------------------
$sql = "SELECT id, title, excerpt FROM posts ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>All Posts — Tech Info</title>
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
    <h1 style="margin:0;font-size:48px">All Posts</h1>
    <p style="max-width:720px">Browse all posts from the database.</p>
  </div>
</header>

<main class="container">

<section class="grid grid-3" style="margin-top:24px">

<?php
// --------------------
// Loop through posts
// --------------------
if ($result && $result->num_rows > 0):
  while ($row = $result->fetch_assoc()):
?>

  <div class="card">
    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
    <p><?php echo htmlspecialchars($row['excerpt']); ?></p>

    <a class="btn btn-primary" href="p.php?id=<?php echo $row['id']; ?>">
      Open Post
    </a>
  </div>

<?php
  endwhile;
else:
?>
  <p>No posts found.</p>
<?php endif; ?>

</section>

<section class="notice" style="margin-top:32px">
  <strong>Note:</strong> All posts below are dynamically loaded from the database.
</section>

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
