<html>
<head>
    <title>App Name</title>
</head>
<body>
<div id="app">
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <example></example>
    <home></home>
</div>
<script src="/js/app.js"></script>
</body>
</html>