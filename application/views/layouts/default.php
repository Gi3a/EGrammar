<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">

        <title><?php echo $title; ?></title>
        
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="/public/css/font.css">
        <link rel="stylesheet" type="text/css" href="/public/css/swal.css">
        <!-- CSS -->
		<link rel="stylesheet" type="text/css" href="/public/css/style.css">
        <link rel="stylesheet" type="text/css" href="/public/css/mid.css">
        
        <!-- JS -->
        <script src="/public/js/jquery.js"></script>
        <script src="/public/js/ajax.js"></script>
        <script src="/public/js/script.js"></script>
        <script src="/public/js/swal.js"></script>
        <script src="/public/js/font.js"></script>
    </head>
    <body>
        <main>
            <? if((isset($_SESSION['user']))): ?>
                    <?php require_once 'application/views/layouts/nav.php'; ?>
            <? endif; ?>
            <?php echo $content; ?>
        </main>
        <div class="load"></div>
    </body>
</html>
