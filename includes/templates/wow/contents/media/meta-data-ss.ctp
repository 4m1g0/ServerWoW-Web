<div>
<div class="meta-data">
<dl class="meta-details">
<dt>Fecha: </dt>
<dd><?php echo date('d/m/Y', $item['post_date']); ?></dd>
</dl>
<dl class="meta-details">
<dt class="dt-downloads">Descargar:</dt>
<dd class="dd-downloads">
<a class="format" href="<?php echo $this->getCoreUrl('uploads/screenshots/' . $item['id'] . '.jpg'); ?>" onclick="window.open(this.href);return false;">Formato original</a> </dd>
</dl>
<span class="clear"><!-- --></span>
</div>
</div>