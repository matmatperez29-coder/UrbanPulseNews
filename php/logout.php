<?php
require_once 'php/php/php/php//php/auth.php';

$confirmed = isset($_GET['confirmed']) && $_GET['confirmed'] === '1';

if ($confirmed) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UrbanPulse | Confirm Logout</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Source+Sans+3:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/navfooter.css">
</head>
<body style="margin:0;min-height:100vh;background:#f8f8f8;display:grid;place-items:center;">
  <script src="js/ui-interactions.js"></script>
  <script>
    window.addEventListener('load', function () {
      if (window.UrbanPulseUI && typeof window.UrbanPulseUI.openModal === 'function') {
        window.UrbanPulseUI.openModal({
          title: 'Log out of UrbanPulse?',
          text: 'You are about to sign out of your account on this device.',
          badge: 'Account',
          confirmLabel: 'Log out',
          cancelLabel: 'Go back',
          tone: 'danger',
          onConfirm: function () { window.location.replace('php/logout.php?confirmed=1'); },
          onCancel: function () {
            if (document.referrer) window.history.back();
            else window.location.replace('index.php');
          }
        });
      }
    });
  </script>
</body>
</html>
