<SCRIPT LANGUAGE="JavaScript">
function salta(Sel){
if (Sel.ad.selectedIndex != 0){
document.location=Sel.ad.options[Sel.ad.selectedIndex].value
}}
</SCRIPT>
<div class="section-title">
<span>Obtener creditos</span>
<p>Hola <?php echo $_SESSION['username']; ?>, los creditos son premios asignados por el servidor, a los buenos usuarios, obtendrás creditos cada vez que realices una donación y puedes usarlos para canjear items, nivel, oro, etc. Además también puedes conseguir creditos si votas a diario por el servidor en los rankings o reportas bugs importantes. Selecciona una de las opciones de abajo para empezar.</p>
</div>
<span class="clear"><!-- --></span>
<div class="main-services">
    <a href="?p=17" class="main-services-banner left-bnr" style="background-image:url('wow/static/images/services/thumbnails/thumb-donacion-services-5.jpg');">
        <span class="banner-title">Vía SMS y Telefono</span>
        <span class="banner-desc">Envia un Mensaje de texto desde tu celular ó llama desde tu telefono fijo para obtener un crédito.</span>
    </a>
    <a href="?p=21" class="main-services-banner right-bnr" style="background-image:url('wow/static/images/services/thumbnails/thumb-donacion-services-3.jpg');">
        <span class="banner-title">PayPal - Visa - MasterCard</span>
        <span class="banner-desc">Realizá un aporte al servidor a través de paypal, o con tus tarjetas Credito/Debito, recibirás creditos en función de la cantidad donada</span>
    </a>
    <a href="?p=19" class="main-services-banner left-bnr" style="background-image:url('wow/static/images/services/thumbnails/thumb-donacion-services-4.jpg');">
        <span class="banner-title">MoneyGram - WesternUnion</span>
        <span class="banner-desc">Realizá un aporte al servidor a través de giros por correo, recibirás creditos en función de la cantidad donada.</span>
    </a>
    <span class="clear"><!-- --></span>
</div>





