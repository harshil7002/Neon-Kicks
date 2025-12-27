<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';

// Clear all session data
if (session_status() === PHP_SESSION_NONE) {
		session_start();
}
$_SESSION = [];

// Delete session cookie
if (ini_get('session.use_cookies')) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
				$params['path'], $params['domain'], $params['secure'], $params['httponly']
		);
}

// Destroy session
session_unset();
session_destroy();

// Output JS to clear localStorage and redirect (handles browser and client-side stored user)
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Logging out...</title>
	<script>
		try { localStorage.removeItem('neonkicks-current-user'); } catch(e) {}
		try { localStorage.removeItem('neonkicks-current-admin'); } catch(e) {}
		// Also remove any UI state showing admin menu
		try { document.querySelectorAll('.user-menu, .admin-menu').forEach(el=>el.remove()); } catch(e) {}
		// fallback redirect
		window.location.replace('../login.php');
	</script>
</head>
<body>
	<p>Logging out... If you are not redirected automatically, <a href="../login.php">click here</a>.</p>
</body>
</html>
