@plantilla('dashboard')

@bloque('titulo')
Módulo Cobranza
@fin

@bloque('cabeza')
<link rel="stylesheet" href="cupones.css?<?php echo uniqid()?>" type="text/css" media="all">
<script src="cupones.js?<?php echo uniqid()?>" defer async></script>
@fin

@bloque('cuerpo')
<div id="cupones"></div>
@fin
