<?php
$user = current_user($pdo);
$role = $user['role'] ?? 'guest';
$script = basename($_SERVER['PHP_SELF']);
function active($scripts) {
    $current = basename($_SERVER['PHP_SELF']);
    return in_array($current, (array)$scripts, true) ? 'active' : '';
}
?>
<aside class="sidebar" id="sidebar">
  <nav>
    <a class="nav-item <?= active(['dashboard.php']) ?>" href="<?= BASE_URL ?>pages/dashboard.php">
      <span class="icon">🏠</span><span>Dashboard</span>
    </a>
    <?php if ($role === 'admin'): ?>
    <a class="nav-item <?= active(['employees.php']) ?>" href="<?= BASE_URL ?>pages/employees.php">
      <span class="icon">👥</span><span>Employees</span>
    </a>
    <a class="nav-item <?= active(['payroll.php']) ?>" href="<?= BASE_URL ?>pages/payroll.php">
      <span class="icon">💸</span><span>Payroll</span>
    </a>
    <?php else: ?>
    <a class="nav-item <?= active(['payroll.php']) ?>" href="<?= BASE_URL ?>pages/payroll.php">
      <span class="icon">💸</span><span>My Payroll</span>
    </a>
    <?php endif; ?>
    <a class="nav-item" href="<?= BASE_URL ?>pages/logout.php">
      <span class="icon">🚪</span><span>Logout</span>
    </a>
  </nav>
</aside>
