<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="minimum-scale=1, initial-scale=1, width=device-width"/>
        <title>@bloque('titulo')</title>
        <link rel="stylesheet" href="assets/general.css?<?php echo uniqid() ?>" type="text/css" media="all">
        <script src="assets/vendor.js?<?php echo uniqid() ?>" defer async></script>
        <script src="assets/general.js?<?php echo uniqid() ?>" defer async></script>

        <link rel="stylesheet" href="assets/menu.css?<?php echo uniqid() ?>" type="text/css" media="all">
        <script src="assets/menu.js?<?php echo uniqid() ?>" defer async></script>

        <link rel="stylesheet" href="assets/@bloque('cabeza').css?<?php echo uniqid() ?>" type="text/css" media="all">
        <script src="assets/@bloque('cabeza').js?<?php echo uniqid() ?>" defer async></script>
    </head>
    <body>
    @bloque('cuerpo')
    </body>
</html>
