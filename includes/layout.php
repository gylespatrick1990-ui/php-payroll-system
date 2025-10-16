<?php
// Usage in pages:
// $title = 'Page Title';
// ob_start();
//   ... page HTML ...
// $content = ob_get_clean();
// include __DIR__ . '/layout.php';

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/auth.php';

if (!isset($title)) { $title = APP_NAME; }
if (!isset($content)) { $content = ''; }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= h($title) ?> - <?= h(APP_NAME) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/layout.css" />
  <?php if (isset($extra_css) && is_array($extra_css)): foreach ($extra_css as $href): ?>
    <link rel="stylesheet" href="<?= h($href) ?>" />
  <?php endforeach; endif; ?>
</head>
<body>
  <div class="app-frame">
    <?php include __DIR__ . '/header.php'; ?>
    <?php include __DIR__ . '/sidebar.php'; ?>
    <main class="content">
      <?= $content ?>
    </main>
  </div>
  <script src="<?= BASE_URL ?>assets/js/main.js"></script>
  <?php if (isset($extra_js) && is_array($extra_js)): foreach ($extra_js as $src): ?>
    <script src="<?= h($src) ?>"></script>
  <?php endforeach; endif; ?>
</body>
</html>
