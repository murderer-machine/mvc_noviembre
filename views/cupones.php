@plantilla('dashboard')

@bloque('titulo')
Módulo Cobranza
@fin

@bloque('cabeza')
<link rel="stylesheet" href="assets/cupones.css?<?php echo uniqid()?>" type="text/css" media="all">
<script src="assets/cupones.js?<?php echo uniqid()?>" defer async></script>
@fin

@bloque('cuerpo')
<div id="cupones"></div>
@fin
