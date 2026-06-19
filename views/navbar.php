<nav>
    <div style="color: var(--lime); font-size: 1.2rem; font-weight: bold;">CitaClean</div>
    <div>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="index.php?page=dashboard">Dashboard</a>
            <a href="index.php?page=laporan">Daftar Laporan</a>
            <a href="index.php?page=logout">Logout</a>
        <?php else: ?>
            <a href="index.php?page=home">Home</a>
            <a href="index.php?page=login">Login</a>
            <a href="index.php?page=register">Register</a>
        <?php endif; ?>
    </div>
</nav>