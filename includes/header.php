<?php
$user = current_user($pdo);
?>
<div class="topbar">
  <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
    <span class="material-icon">☰</span>
  </button>
  <div class="brand"><?= h(APP_NAME) ?></div>
  <div class="topbar-right">
    <?php if ($user): ?>
      <span class="user-chip neu"><?= h($user['full_name']) ?> (<?= h($user['role']) ?>)</span>
      <a class="btn btn-ghost" href="<?= BASE_URL ?>pages/logout.php">Logout</a>
    <?php else: ?>
      <a class="btn btn-ghost" href="<?= BASE_URL ?>pages/login.php">Login</a>
    <?php endif; ?>
  </div>
</div>
