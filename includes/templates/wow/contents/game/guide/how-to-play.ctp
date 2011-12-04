<link rel="stylesheet" href="<?php echo CLIENT_FILES_PATH; ?>/wow/static/css/game/game-guide-how-to-play.css" type="text/css" />

		<div class="guide-top-nav">
				<a href="./" class="btn-what-is-wow">
					<span>
						<em class="chapter-mark">
							Qué es
						</em>
						World of Warcraft
					</span>
				</a>
				<a href="getting-started" class="btn-getting-started">
					<span>
						<em class="chapter-mark">
							Capítulo I
						</em>
						Cómo comenzar
					</span>
				</a>
				<a class="btn-how-to-play selected">
					<span>
						<em class="chapter-mark">
							Capítulo II
						</em>
						Cómo jugar
					</span>
				</a>
				<a href="playing-together" class="btn-playing-together">
					<span>
						<em class="chapter-mark">
							Capítulo III
						</em>
						Jugar en comunidad
					</span>
				</a>
				<a href="late-game" class="btn-late-game">
					<span>
						<em class="chapter-mark">
							Capítulo IV
						</em>
						El juego avanzado
					</span>
				</a>
	<span class="clear"><!-- --></span>
		</div>

		<div class="guide-intro-part">
			<div class="guide-section-title">
				<a href="/wow/">World of Warcraft</a><em>Guía para principiantes</em>
				<h4>Capítulo II <br/>Cómo jugar</h4>
			</div>
			<div class="guide-intro-text"><p>World of Warcraft sigue uno de los mantras principales de diseño de Blizzard Entertainment: fácil de aprender, difícil de dominar. Los conceptos centrales del juego son intuitivos y de diseño simple, así que una vez que hayas aprendido lo básico, no tardarás en matar monstruos y rescatar princesas. Para ayudarte a empezar, aquí tienes un manual de juego de World of Warcraft.</p></div>
		</div>


		<span class="guide-content-title">Descripción de la Interfaz</span>
		<div class="guide-sub-desc">
			<p>Interfaz principal del usuario que verás mientras juegas a World of Warcraft.</p>
		</div>

		
		<div class="interface">
			<span class="guide-content-subtitle">Interfaz de Usuario</span>
			<div id="interface-viewer">
						<div class="div01 hidden"></div>
						<div class="div02 hidden"></div>
						<div class="div03 hidden"></div>
						<div class="div04 hidden"></div>
						<div class="div05 hidden"></div>
						<div class="div06 hidden"></div>
						<div class="div07 hidden"></div>
						<div class="div08 hidden"></div>
						<div class="div09 hidden"></div>
						<div class="div10 hidden"></div>
						<div class="div11 hidden"></div>
						<div class="div12 hidden"></div>
			</div>
			<ul id="interface-list">
					<li><a href="javascript:;" class="l-01">Retrato de tu personaje</a></li>
					<li><a href="javascript:;" class="l-02">Salud de tu personaje</a></li>
					<li><a href="javascript:;" class="l-03">Recurso <span>(maná, energía, etc)</span></a></li>
					<li><a href="javascript:;" class="l-04">Salud de tu objetivo</a></li>
					<li><a href="javascript:;" class="l-05">Recurso de tu objetivo</a></li>
					<li><a href="javascript:;" class="l-06">Retrato de tu objetivo</a></li>
					<li><a href="javascript:;" class="l-07">Mini-mapa</a></li>
					<li><a href="javascript:;" class="l-08">Acciones especiales</a></li>
					<li><a href="javascript:;" class="l-09">Barra de acción</a></li>
					<li><a href="javascript:;" class="l-10">Menú</a></li>
					<li><a href="javascript:;" class="l-11">Teclas rápidas de Inventario</a></li>
					<li><a href="javascript:;" class="l-12">Descripción emergente</a></li>
			</ul>
        <script type="text/javascript">
        //<![CDATA[
				$(function(){
					function toggleVis(which){
						
						var source = which.currentTarget;
						if(!$(source).attr('class')) { return } 
						
						var	target = $(source).attr('class').replace('l-','div');
						$("."+target).toggleClass('hidden');
					}
					$('#interface-list a').mouseover(toggleVis).mouseout(toggleVis);
					
					function listHover(which){
						
						var source = which.currentTarget,
							target = $(source).attr('class').split(' ')[0].replace('div','l-');	
						
						$(source).toggleClass('hidden')
						$("."+target).toggleClass(target+'-hover');
					}
					
					$('#interface-viewer > div').mouseover(listHover).mouseout(listHover);
				});
        //]]>
        </script>
		</div>
		
		<div class="htp-2">
		
			
			
			<div class="left-col">
				<span class="guide-content-title">Las habilidades de tu personaje</span>
				<div class="guide-sub-desc">
					<p>En World of Warcraft puedes convertirte en un poderoso paladín, golpeando al mal con honrada furia; un ladino pícaro, aproximándose a un enemigo desprevenido daga en mano y preparado para atacar desde las sombras; un brillante mago, desatando torrentes de destructiva energía arcana para acabar con montones de monstruos; o incluso un maléfico caballero de la Muerte, bien versado las artes de la esgrima y la nigromancia. Elijas la clase que elijas, esa clase estará definida por sus facultades.</p><p>Tu nuevo personaje comienza con unas cuantas facultades de clase y puedes aprender muchas más en el transcurso de tu carrera. Cada clase tiene acceso a facultades únicas que ayudan a definir su papel en el juego y a dar forma a tu experiencia.</p>
				</div>
				
				<div class="character-image">
				</div>
			
			</div>
			
			<div class="right-col">
				<div class="parchment parchment-tall"><div class="parchment-interior">
					<span class="guide-content-subtitle">
						Usar las habilidades
					</span>
					<p>Para poder jugar bien tu personaje, tendrás que saber cuándo usar tus habilidades de clase. Dos factores determinan cuándo puedes usar una habilidad: el coste y el tiempo de reutilización.</p><p>Cada clase tiene un recurso diferente que gastar para pagar el coste de las habilidades.. Por ejemplo, los guerreros alimentan sus habilidades con ira, que se acumula a medida que infligen y reciben daño. Por otro lado, los pícaros son luchadores acróbatas y por tanto no usan ira, en cambio, gastan energía que se regenera constantemente pero limita la velocidad a la que pueden encadenar movimientos de combate. Los sacerdotes usan maná para lanzar sus hechizos. El maná se regenera despacio en combate, así que lo sacerdotes necesitan prestar atención a la velocidad a la que gastan sus reservas.</p><p>Si una habilidad tiene tiempo de reutilización, significa que tiene que pasar una determinada cantidad de tiempo antes de que el personaje esté preparado para volver a usar esa habilidad. Los tiempos de reutilización pueden ir desde unos cuantos segundos hasta media hora. Las habilidades con tiempos de reutilización largos a menudo son muy poderosas, Usadas en el momento adecuado, estas habilidades pueden ser increíblemente efectivas.</p>
				</div></div>
			</div>
			
			
	<span class="clear"><!-- --></span>
			
			
			<div class="section2">
				
				<div class="left-col">
					<span class="guide-content-title">
						Talentos y Glifos
					</span>
					<div class="guide-sub-desc">
						<p>La clase de tu personaje determina qué habilidades puede usar tu personaje, pero World of Warcraft te proporciona dos formas de personalizar tus habilidades para crear un personaje con puntos fuertes únicos.</p><p>A medida que los personajes se vuelven más fuertes obtienen puntos de talento. Estos puntos pueden gastarse en talentos que permiten a tu personaje especializarse en un subconjunto específico de sus habilidades; por ejemplo, los magos tienen acceso a ramas de talentos que mejoran sus hechizos de Escarcha, Fuego o Arcanos.</p><p>Los glifos proporcionan otra forma de mejorar tus habilidades. Los personajes aprenden a usar glifos (creados por los jugadores con la profesión inscripción) para hacer que sus habilidades sean más poderosas e incluso añadirles nuevos efectos. Un personaje solo puede equipar un número limitado de glifos a la vez, así que elige con cuidado.</p>
					</div>
				</div>
				<div class="right-col">
	<table class="media-frame clickable">
		<tr>
			<td class="tl"></td>
			<td class="tm"></td>
			<td class="tr"></td>
		</tr>
		<tr>
			<td class="ml"></td>
			<td class="mm">
		<div class="magnifying-wrapper" onclick="Lightbox.loadImage([{ path: '', src:'/wow/static/images/game/guide/how-to-play/talent-screenshot-large.jpg'}])">
						<img src="/wow/static/images/game/guide/how-to-play/talent-screenshot.jpg" alt="" />
            <span class="magnifying-glass"></span> 
		</div>
			</td>
			<td class="mr"></td>
		</tr>
		<tr>
			<td class="bl"></td>
			<td class="bm"></td>
			<td class="br"></td>
		</tr>
	</table>
				</div>
			</div>
	<span class="clear"><!-- --></span>
			
			<div class="section3">
				
				<div class="section3-image">
				</div>
				
				<div class="left-col">
					<span class="guide-content-title">Misiones</span>
					<div class="guide-sub-desc">
						<p>Ser un héroe significa realizar hazañas heroicas y en Azeroth hay montones de oportunidades de ello. Deidades enajenadas, dragones alborotados, malhechores demoníacos de más allá de las estrellas… El mundo está bajo una amenaza constante y os corresponde a ti y a tus amigos defender a vuestra gente contra estas oscuras fuerzas destructivas. Durante tu vida como héroe te embarcarás en una serie de misiones para arreglar lo que va mal, para defender a los débiles y castigar a los malvados, y para hacer que el mundo sea un lugar mejor y más seguro.</p><p>Hay varias formas diferentes de descubrir misiones en World of Warcraft:</p>
					</div>
				</div>
	<span class="clear"><!-- --></span>
				
				
				<div class="left-col">
					<div class="section-list">
						<div class="column-break">
							<div class="left-col">
								<div class="guide-content-subtitle">
					<table><tr>
					<td class="bullet-img"><div class="icon-bullet bullet1"></div></td>
					<td>Asignadores de misiones</td>
					</tr></table>
								</div>
								<div class="bullet-desc">
									Algunos personajes no jugadores (PNJ) tienen misiones para ti. Los asignadores de misiones siempre tienen una enorme “!” sobre su cabeza, así que son fáciles de ver. 
								</div>
							</div>
							<div class="right-col">
								<div class="section-list-image img1"></div>
							</div>
						</div>
						<div class="column-break">
							<div class="left-col">
								<div class="section-list-image img2"></div>
							</div>
							<div class="right-col">
								<div class="guide-content-subtitle">
					<table><tr>
					<td class="bullet-img"><div class="icon-bullet bullet2"></div></td>
					<td>Objetos de misión</td>
					</tr></table>
								</div>
								<div class="bullet-desc">
									Algunas veces te encontrarás objetos que comienzan una misión, como una nota escrita a toda prisa encontrada entre las pertenencias de un bandolero o un antiguo amuleto recuperado entre los restos de un moquillo tóxico. Estos objetos a menudo tienen una historia que supone el principio de una interesante misión.
								</div>
							</div>
						</div>
						<div class="column-break">
							<div class="left-col">
								<div class="guide-content-subtitle">
					<table><tr>
					<td class="bullet-img"><div class="icon-bullet bullet3"></div></td>
					<td>Objetos de misión</td>
					</tr></table>
								</div>
								<div class="bullet-desc">
									Puede que también encuentres algunos objetos determinados en el mundo que inician una misión. Vigila los terrenos poco comunes, los carteles de “se busca” u otros monumentos que destaquen; puede que las aventuras te esperen a la vuelta de la esquina.
								</div>
							</div>
							<div class="right-col">
								<div class="section-list-image img3"></div>
							</div>
						</div>
						<div class="column-break">
							<div class="left-col">
								<div class="section-list-image img4"></div>
							</div>
							<div class="right-col">
								<div class="guide-content-subtitle">
					<table><tr>
					<td class="bullet-img"><div class="icon-bullet bullet4"></div></td>
					<td>Completar misiones</td>
					</tr></table>
								</div>
								<div class="bullet-desc">
									Tienes que completar metas específicas para completar misiones. Estos objetivos pueden ser tan simples como hablar con un personaje concreto o tan complejas como atravesar la muralla de una fortaleza, tomar el patio, bajar la puerta principal, encender la señal de fuego y, finalmente, arrinconar al señor de la fortaleza.
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="right-col">
					<div class="section3-parchment">
						<div class="parchment parchment-short"><div class="parchment-interior">
							<span class="guide-content-subtitle">
								Tipos de misiones
							</span>
							<p>
								World of Warcraft ofrece un vasto potencial de aventura, incluido el acceso a cientos de misiones diferentes. Cada misión es única, pero hay unas amplias categorías en las que las puedes dividir.
							</p>
							<div class="quest-type">
							
										<div class="quest-type-title img1">
											Misiones normales
										</div>
										<div class="quest-type-desc">
											Las misiones normales son las más comunes. Si tu personaje tiene suficiente experiencia, podrás completar estas misiones tú solo, sin ayuda de otros jugadores. 
										</div>
										<div class="quest-type-title img2">
											Misiones de grupo
										</div>
										<div class="quest-type-desc">
											Las misiones de grupo suponen un reto mayor que las misiones normales y, a menudo, requieren que un grupo de héroes se junte, pero también ofrecen mejores recompensas. Reúne a tus amigos y prepárate para la batalla antes de intentar una de estas misiones.
										</div>
										<div class="quest-type-title img3">
											Misiones de mazmorra
										</div>
										<div class="quest-type-desc">
											Las misiones de mazmorra requieren que te adentres en las mazmorras de World of Warcraft donde habitan monstruos más peligrosos y temibles. Necesitarás un grupo para completar estas misiones.
										</div>
										<div class="quest-type-title img4">
											Misiones heroicas
										</div>
										<div class="quest-type-desc">
											Las misiones heroicas son parecidas a las misiones de mazmorra, pero tendrás que derrotar a monstruos que son aún más fuertes y mortíferos que los de las mazmorras normales. ¡Prepárate para una pelea difícil!
										</div>
										<div class="quest-type-title img5">
											Misiones de banda
										</div>
										<div class="quest-type-desc">
											Las misiones de banda son parecidas a las misiones de mazmorra, pero tendrás que enfrentarte a los retos que te esperan en los lugares más peligrosos del mundo. Estas misiones requieren un grupo grande de jugadores para completarlas (10 o 25 jugadores).
										</div>
										<div class="quest-type-title img6">
											Misiones jugador contra jugador
										</div>
										<div class="quest-type-desc">
											Las misiones jugador contra jugador te enfrentarán a otros jugadores en el campo de batalla. ¿Obtendrás la gloria, el honor y la fama o caerás ante los incesantes ataques de tus enemigos? Solo hay una forma de averiguarlo….
										</div>
										<div class="quest-type-title img7">
											Misiones diarias
										</div>
										<div class="quest-type-desc">
											Las misiones diarias son misiones repetibles que puedes completar una vez al día y normalmente sirven para llenar tus bolsillos con dinero bastante necesitado y otros recursos.
										</div>
								
							</div>
						</div></div>
					</div>
				</div>
	<span class="clear"><!-- --></span>
				<div class="section4">
				
					<div class="left-col">
						<span class="guide-content-title">Inventario</span>
						<div class="guide-sub-desc">
							<p>
							Al igual que rey Arturo blandía Excalibur, Roland a Durandal y Aquiles vestía su armadura forjada por los dioses, tú también encontrarás armas mágicas, armaduras y otros artefactos de gran poder. De hecho, encontrarás miles de ellos; los monstruos de Azeroth tienen una sorprendente tendencia a llevar abalorios potencialmente mágicos encima, listos para ser saqueados de sus rígidos cadáveres por los aspirantes a aventureros. Pero incluso si el kobold que acabas de enviar a la gran oscuridad del más allá no tiene armas ni armadura, seguro que lleva otros objetos que puedes vender para obtener beneficios. Esta colección de objetos que llevas contigo en cualquier momento es tu inventario.
							</p>
						</div>
					</div>
					
					<div class="right-col">
						<div class="section-list">
							<div class="column-break">
								<div class="guide-content-subtitle">
					<table><tr>
					<td class="bullet-img"><div class="icon-bullet bullet5"></div></td>
					<td>Tu mochila y bolsas</td>
					</tr></table>
								</div>							
								<div class="left-col">
									<div class="bullet-desc">
										Tu personaje comienza el juego con una simple mochila. Puede almacenar un número limitado de cosas, pero puedes aumentar de forma significativa la cantidad de objetos que puedes recoger con bolsas adicionales. 
									</div>
								</div>
								<div class="right-col">
									<div class="section-list-image img5"></div>
								</div>
							</div>
							<div class="column-break">
								<div class="left-col">
									<div class="section-list-image img6"></div>
								</div>
								<div class="right-col">
									<div class="guide-content-subtitle">
					<table><tr>
					<td class="bullet-img"><div class="icon-bullet bullet6"></div></td>
					<td>El banco</td>
					</tr></table>
									</div>
									<div class="bullet-desc">
										Cada ciudad principal de World of Warcraft también tiene un banco donde puedes almacenar tus objetos. Si te quedas sin espacio en la mochilas y las bolsas, puedes visitar un banco y dejar los objetos que no necesites en ese momento. Mejor aún, todos los bancos están conectados por arte de magia, así que puedes almacenar objetos en un banco y recogerlos en otro.
									</div>
								</div>
							</div>
							<div class="column-break">
								<div class="guide-content-subtitle">
					<table><tr>
					<td class="bullet-img"><div class="icon-bullet bullet7"></div></td>
					<td>La casa de subastas</td>
					</tr></table>
								</div>
								<div class="left-col">								
									<div class="bullet-desc">
										Justo enfrente de la mayoría de los bancos puedes encontrar una casa de subastas. Los jugadores pueden comprar y vender objetos en esas casas de subastas y algunos jugadores encuentran formas de convertir la casa de subastas en una fuente de ingresos fiable. ¿Quién dice que el negocio de los héroes no es beneficioso? Puedes subastar tus propios objetos y puedes buscar otras subastas en curso. Si buscas un objeto específico o si tienes un objeto valioso que no necesitas, la casa de subastas debería ser tu primera parada.
									</div>
								</div>
								<div class="right-col">
									<div class="section-list-image img7"></div>
								</div>
							</div>
						</div>
					</div>
					
	<span class="clear"><!-- --></span>
				</div>

			</div>
			
	<span class="clear"><!-- --></span>
			<div class="section5">
				<span class="guide-content-title">
					Cómo hacer amigos e influenciar a la gente 
					<span class="guide-content-subtitle aside">
						(con nuestras más sinceras disculpas a Dale Carnegie)
					</span>
				</span>
				
				<div class="left-col">
					
					<div class="guide-sub-desc">
						<p>
						En su núcleo, lo que hace de World of Warcraft un juego tan divertido es que compartes este mundo con miles de jugadores al mismo tiempo. Puedes experimentar la mayoría del contenido del juego tú solo si así lo deseas, pero chatear con otros jugadores, formar grupos, unirte a hermandades y, lo más importante, hacer amigos es esencial si quieres sacarle todo el partido a World of Warcraft.
						</p>
					</div>
					<div class="guide-sub-desc image-buffer">
						<p>
							Los apartados aquí mencionados solo muestran una pequeña parte del inmenso entorno social que ofrece World of Warcraft. Échale un vistazo al siguiente capítulo para aprender más sobre el chat, los amigos de ID Real, grupos, hermandades y más.
						</p>
					</div>
					
				</div>

				<div class="right-col">
					<div class="section3-parchment">
						<div class="parchment parchment-short"><div class="parchment-interior">
							
							<div class="">
								<span class="guide-content-subtitle">
					<table><tr>
					<td class="bullet-img"><div class="icon-bullet bullet11"></div></td>
					<td>Chat</td>
					</tr></table>
								</span>
								<div class="bullet-desc">
									World of Warcraft incluye un sofisticado sistema de chat que te permite hablar con otros jugadores escribiendo o, si estás en un grupo con otros jugadores, a través del chat de voz. Puedes gestionar todos tu canales de chat a través de la completa interfaz de chat. Puedes crear canales privados si quieres hablar solo con tus amigos, o puedes chatear en los canales de chat globales/locales si quieres llegar a una audiencia mayor y si estás en una hermandad, tendrás acceso al canal de tu hermandad. La única limitación de World of Warcraft es el chat entre facciones: no puedes comunicarte con jugadores de la facción contraria.
								</div>
							</div>
							
							<div class="">
								<span class="guide-content-subtitle">
					<table><tr>
					<td class="bullet-img"><div class="icon-bullet bullet8"></div></td>
					<td>Grupos</td>
					</tr></table>
								</span>
								<div class="bullet-desc">
									En ocasiones querrás formar grupos con otros jugadores para abordar una misión difícil o aventurarte en una de las muchas mazmorras del mundo. Puedes formar tu propio grupo invitando a otros jugadores, pedir unirte al grupo de otra persona o usar la herramienta Buscador de mazmorras para unirte automáticamente a un grupo para una mazmorra específica gracias al servicio de emparejamiento del juego. Los grupos están limitados a cinco jugadores, pero también puedes formar una banda que puede incluir hasta 40 personas.
								</div>
							</div>
							
							<div class="">
								<span class="guide-content-subtitle">
					<table><tr>
					<td class="bullet-img"><div class="icon-bullet bullet9"></div></td>
					<td>Hermandades</td>
					</tr></table>
								</span>
								<div class="bullet-desc">
									Los grupos y las bandas siempre son temporales y dejan de existir en cuando todos los miembros los abandonan o se desconectan. Las hermandades, por el contrario, son grupos permanentes y mucho más grandes de jugadores unidos bajo un estandarte para ayudarse entre ellos y jugar juntos. Formar parte de una hermandad tiene algunas ventajas: tienen su propio canal de chat, puedes usar un banco de hermandad compartido y las hermandades pueden obtener una serie de logros guays de hermandad y bonificaciones al superar ciertos retos. Puedes pedir unirte a una hermandad o puedes formar una propia con tus amigos. 
								</div>
							</div>
							
							<div class="">
								<span class="guide-content-subtitle">
					<table><tr>
					<td class="bullet-img"><div class="icon-bullet bullet10"></div></td>
					<td>Amigos</td>
					</tr></table>
								</span>
								<div class="bullet-desc">
									Mientras chateas, formas grupos  y bandas, te unes a hermandades y juegas con los demás, conocerás a otros jugadores que resultarán una compañía agradable de verdad y con los que te gustaría jugar más a menudo. Deberías añadir a esos jugadores a tu lista de amigos, lo que te permite seguir la pista a tus jugadores favoritos, ver cuándo están conectados y dónde están en World of Warcraft cuando están conectados. 
								</div>
							</div>
							
						</div></div>
					</div>
				</div>
				
	<span class="clear"><!-- --></span>
			</div>
			
		</div>
		
		

		<div class="guide-page-nav">
			<span class="current-guide-title">Capítulo II: Cómo jugar</span>
			<div class="nav-buttons">
				<a href="getting-started" class="prev">
					<span>
						<span style="background-image:url('/wow/static/images/game/guide/getting-started-prev.gif');">Capítulo I: Cómo comenzar</span>
					</span>
				</a>
				<a href="playing-together" class="next">
					<span>
						<span style="background-image:url('/wow/static/images/game/guide/playing-together-next.gif');">Capítulo III: Jugar en comunidad</span>
					</span>
				</a>
			</div>
		</div>