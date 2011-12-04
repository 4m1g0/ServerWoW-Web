<link rel="stylesheet" href="<?php echo CLIENT_FILES_PATH; ?>/wow/static/css/game/game-guide-playing-together.css" type="text/css" />
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
				<a href="how-to-play" class="btn-how-to-play">
					<span>
						<em class="chapter-mark">
							Capítulo II
						</em>
						Cómo jugar
					</span>
				</a>
				<a class="btn-playing-together selected">
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
				<h4>Capítulo III <br/>Jugar en comunidad</h4>
			</div>
			<div class="guide-intro-text"><p>En World of Warcraft interactuar con otros jugadores es opcional. Puedes llegar al máximo nivel sin unir fuerzas con ningún jugador, sin tener que decir ni “hola” a nadie de tu reino. Pero yendo solo no podrás superar algunos de los retos más difíciles del juego, tardarás más en llegar al final del juego y no tendrás acceso a los tesoros mágicos más poderosos del juego. Lo más importante, los demás jugadores de tu reino se perderán el placer de conocerte. Tus caminos se cruzarán con los de miles de personas que comparten objetivos similares, intereses y gustos contigo, así que habla. En World of Warcraft es fácil hacer nuevos amigos.</p></div>
		</div>


        <script type="text/javascript">
        //<![CDATA[
		$(function() {
			$('#chat .dialog').hover(
				function() {
					$('#chat .bubble').fadeOut('fast');
					$('#chat .cb'+ $(this).data('bubble')).fadeIn('fast');
				},
				function() {
					$('#chat .bubble').fadeOut('fast');
				}
			);
		});
        //]]>
        </script>

	<div id="chat">
		<div class="guide-content-title">Chat</div>

		<div class="box box-left intro">
			Conocer a gente nueva en la vida real es bastante intimidante. ¿Cómo te presentas? ¿Cómo inicias una conversación? Por suerte, chatear en World of Warcraft es más fácil y casual que cualquier cosa que hayas hecho en el mundo real. Normalmente, el chat del juego se basa en texto. Verás las conversaciones públicas de otras personas en la ventana de chat del juego y, si te apetece, podrás entrar en ellas en cualquier momento para aportar algo a una conversación en curso o comenzar una conversación sobre otro tema.
		</div>

		<div class="box box-left chat-channel">
			<div class="guide-content-subtitle">Canales de chat:<br />Filtrar el ruido</div>

			Los canales públicos de chat estándar son General, Comercio, Defensa local, Buscar grupo y Reclutamiento. Puedes unirte y abandonar estos canales cuando quieras y todos los jugadores pueden chatear en ellos. Estos canales están para proporcionar a los jugadores lugares apropiados para temas específicos como el intercambio de objetos o el reclutamiento para hermandades.<br/><br/>

	<table class="media-frame clickable">
		<tr>
			<td class="tl"></td>
			<td class="tm"></td>
			<td class="tr"></td>
		</tr>
		<tr>
			<td class="ml"></td>
			<td class="mm">
		<div class="magnifying-wrapper" onclick="Lightbox.loadImage([{ path: '', src:'/wow/static/images/game/guide/playing-together/ss-chat-1-large.jpg'}])">
				<img src="/wow/static/images/game/guide/playing-together/ss-chat-1.jpg" alt="" />
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

		<div class="box box-right chat-voice">
			<div class="guide-content-subtitle single-line">Chat de voz</div>

			En vez de teclear las palabras para chatear con otros jugadores, también puedes usar el chat de voz incorporado en World of Warcraft para hablar. Todo lo que necesitas es un micrófono y unos altavoces. Hablar es una forma mucho más ágil de comunicarse que escribir. En el fragor de la batalla, puede que no tengas tiempo de teclear lo que quieres decir. <br /><br/>

	<table class="media-frame clickable">
		<tr>
			<td class="tl"></td>
			<td class="tm"></td>
			<td class="tr"></td>
		</tr>
		<tr>
			<td class="ml"></td>
			<td class="mm">
		<div class="magnifying-wrapper" onclick="Lightbox.loadImage([{ path: '', src:'/wow/static/images/game/guide/playing-together/ss-chat-2-large.jpg'}])">
				<img src="/wow/static/images/game/guide/playing-together/ss-chat-2.jpg" alt="" />
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

		<div class="box chat-other">
			<div class="guide-content-subtitle single-line">Otras cosas en el chat</div>

			<div class="box">Hay tres tipos de conversación principales que deberías conocer: decir, gritar y susurrar.</div>

			<div class="bubble cb1" id="bubble-1-1"></div>
			<div class="bubble cb1" id="bubble-1-2"></div>
			<div class="bubble cb2" id="bubble-2-1"></div>
			<div class="bubble cb2" id="bubble-2-2"></div>
			<div class="bubble cb3" id="bubble-3-1"></div>

			<div class="dialog d1" data-bubble="1">
				<h3>Decir</h3>
				Decir algo es la herramienta de comunicación fundamental más básica en el juego. Cuando dices algo, tu mensaje solo es visible para los personajes que se encuentran cerca de tu personaje. Las conversaciones entre extraños, el juego de rol en lugares públicos, un chiste divertido que contar junto al buzón… Este tipo de interacciones a menudo se dicen. 
			</div>

			<div class="dialog d2" data-bubble="2">
				<h3>Gritar</h3>
				Gritar es para cuando necesitas llegar a los jugadores que no se encuentran tan cerca de ti, las cosas que gritas las pueden leer los jugadores que están a cierta distancia, pero mucha gente lo considera grosero, especialmente si abusas de los gritos. Los jugadores a menudo usan gritar para avisar de cosas a otros jugadores que de otro modo no lo oirían. Decir y gritar son modos de chat de área, creados para comunicarse con jugadores cercanos. 
			</div>

			<div class="dialog d3" data-bubble="3">
				<h3>Susurrar</h3>
				Susurrar es la herramienta de comunicación en privado de World of Warcraft. Los susurros solo los puede oír el jugador específico al que se los mandas. Aún mejor, los susurros no están limitados a tu entorno, así puedes susurrarle a cualquier jugador de tu misma facción en tu reino, sin importar dónde esté. (Sí, incluso puedes susurrar a alguien que esté en otro continente. Será mejor que no le demos muchas vueltas a esto).
			</div>
		</div>
	</div>

	<div id="party">
		<div class="guide-content-title">Grupos y bandas</div>

		<div class="box box-left intro">
			Si quieres enfrentarte a los mayores retos que ofrece World of Warcraft, necesitarás aliados que luchen junto a ti contra las oleadas de oscuridad. Con los grupos y bandas puedes reunir a otros jugadores para que se unan a ti en tu misión y derrotar a cualquier mal que se interponga en vuestro camino. <br /><br/>
		</div>

		<div class="party-info">
			<div class="left">
				<div class="box party-form">
					<div class="guide-content-subtitle single-line">Formar grupos</div>
					Puedes formar tu propio grupo en cualquier momento y lugar. Solo tienes que invitar a otro jugador a unirse a tu grupo. Si acepta la invitación, estaréis en un grupo. Puedes invitar a los jugadores a través del chat, de tu lista de amigos o haciendo clic en sus personajes… Invitar a los jugadores y formar grupos es sencillo.
				</div>

				<div class="box party-rule">
					<div class="guide-content-subtitle single-line">Normas del grupo</div>
					Uno de los motivos por los que querrás formar un grupo con otros jugadores es para poder enfrentarte a monstruos más difíciles y conseguir el botín superior que protegen. Por supuesto, esto plantea la pregunta de cómo dividir el botín de forma justa entre tu grupo. Como líder de grupo, puedes elegir una de las cinco normas distintas para el botín:
				</div>
				
				<div class="party-rules">
					<ul>
						<li class="ffa">
							<div class="icon"></div>
							<h3>Libre</h3>
							<p>Cualquier miembro del grupo puede despojar los cuerpos de los monstruos asesinados por tu grupo. La distribución de los tesoros es básicamente el primero que llega, se lo lleva todo.</p>
						</li>
						<li class="robin">
							<div class="icon"></div>
							<h3>Por turnos</h3>
							<p>Todos los miembros del grupo tienen turnos para despojar.</p>
						</li>
						<li class="group">
							<div class="icon"></div>
							<h3>Botín de grupo</h3>
							<p>Parecido al modo por turnos, pero con una diferencia clave. Cuando el grupo encuentra objetos especiales o raros, todos los miembros del grupo pueden decidir tirar los dados y la tirada más alta gana el objeto. Si decides tirar los dados por un objeto, puedes tirar “necesidad” si el objeto en cuestión es adecuado para tu personaje o “codicia” si quieres el objeto por otros motivos.</p>
						</li>
						<li class="looter">
							<div class="icon"></div>
							<h3>Maestro despojador</h3>
							<p>El líder nombra a un miembro del grupo maestro despojador. El maestro despojador puede registrar a los monstruos primero y es responsable de cómo se distribuye el botín entre el grupo.</p>
						</li>
						<li class="greed">
							<div class="icon"></div>
							<h3>Necesidad antes que codicia</h3>
							<p>Este ajuste es similar al Botín de grupo, con la excepción de que los jugadores que no pueden usar el objeto pasan automáticamente.</p>
						</li>
					</ul>
				</div>
			</div>

			<div class="right">
				<div class="box party-leader">
					<div class="guide-content-subtitle single-line">Líder de grupo</div>
					Si creas un grupo, eres el líder de grupo por defecto. Como líder, puedes ajustar algunas de las normas del grupo (hablaremos de ellas después), añadir a otros jugadores al grupo y también puedes echar a los jugadores de tu grupo si se pasan de la raya. También puedes promocionar a otro jugador a líder en cualquier momento. Si el líder de un grupo se marcha, otro jugador se convierte en líder de forma automática.
				</div>
	<table class="media-frame clickable">
		<tr>
			<td class="tl"></td>
			<td class="tm"></td>
			<td class="tr"></td>
		</tr>
		<tr>
			<td class="ml"></td>
			<td class="mm">
		<div class="magnifying-wrapper" onclick="Lightbox.loadImage([{ path: '', src:'/wow/static/images/game/guide/playing-together/ss-party-1-large.jpg'}])">
					<img src="/wow/static/images/game/guide/playing-together/ss-party-1.jpg" alt="" />
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
	<span class="clear"><!-- --></span>
		</div>
	</div>


	<div id="guild">
		<div class="guide-content-title">Hermandades</div>

		<div class="box box-left intro">
			Los grupos y las bandas son alianzas temporales, pero las hermandades son grupos persistentes de personajes que juegan juntos habitualmente y que generalmente prefieren un estilo de juego parecido. Si eres miembro de una hermandad, podrás acceder de forma más sencilla a otros jugadores con los que formar grupos y bandas, pero también hay muchos otros beneficios cuando estás en una hermandad.
		</div>

		<div class="box box-left guild-tabard">
			<div class="guide-content-subtitle">Tabardo y nombre<br />de hermandad</div>

			Para mostrar tu apoyo a una hermandad puedes hacer que tu personaje lleve un tabardo con los colores y el logotipo de tu hermandad. El maestro de hermandad es el responsable de tomar estas decisiones de diseño. Tienes una amplia selección de iconos y combinaciones de colores entre los que elegir, así que deja que tu creatividad fluya y crea un diseño verdaderamente único que tus amigos lleven con orgullo. También tendrás que elegir un nombre para la hermandad cuando entregues los estatutos de la hermandad para registrarla. Este nombre se mostrará bajo el nombre de todos los miembros de la hermandad para que los demás lo vean, así que elige sabiamente.

	<table class="media-frame clickable">
		<tr>
			<td class="tl"></td>
			<td class="tm"></td>
			<td class="tr"></td>
		</tr>
		<tr>
			<td class="ml"></td>
			<td class="mm">
		<div class="magnifying-wrapper" onclick="Lightbox.loadImage([{ path: '', src:'/wow/static/images/game/guide/playing-together/ss-guild-1-large.jpg'}])">
				<img src="/wow/static/images/game/guide/playing-together/ss-guild-1.jpg" alt="" />
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

		<div class="box guild-leader">
			<div class="leader-wrapper">
				<div class="guide-content-subtitle">Liderazgo<br />de hermandad</div>

				<p class="leader-p">Al igual que los grupos y bandas, las hermandades tienes normas que sus maestros pueden ajustar y modificar para otorgar a la hermandad de estructura y propósito. Como maestro de hermandad puedes:</p>

				<div class="guild-roles">
					<ul>
						<li class="ranks">
							<div class="icon"> </div>
							<h3>Definir los rangos de la hermandad</h3>
							<p>Puedes crear rangos con distintos títulos y privilegios dentro de tu hermandad. Algunos jugadores prefieren las jerarquías estrictas, a otros les gusta un estilo más… libre de organización. La elección es tuya.</p>	<span class="clear"><!-- --></span>

						</li>
						<li class="promote">
							<div class="icon"> </div>
							<h3>Promocionar/degradar miembros</h3>
							<p>Puedes asignar los rangos que has definido anteriormente a los miembros de tu hermandad, moviendo a la gente de unos a otros dependiendo de qué tal lo estén haciendo en la hermandad.</p>	<span class="clear"><!-- --></span>

						</li>
						<li class="manage">
							<div class="icon"> </div>
							<h3>Gestionar miembros</h3>
							<p>Probablemente querrás que tu hermandad crezca y consiga nuevos miembros, pero puede que llegue un día en el que tengas que ejercer tu posición de maestro de hermandad y eliminar a los jugadores que estén causando problemas para la hermandad. Como maestro de hermandad, puedes añadir o eliminar jugadores de la hermandad en cualquier momento.</p>	<span class="clear"><!-- --></span>

						</li>
						<li class="leader">
							<div class="icon"> </div>
							<h3>Asignar un nuevo maestro de hermandad</h3>
							<p>Si crees que tu época como maestro de hermandad ha llegado a su fin, o si los miembros de tu hermandad te están pidiendo que dimitas después de ese “desafortunado incidente”, puedes pasar el testigo a un nuevo maestro de hermandad que heredará todos tus poderes y responsabilidades.</p>	<span class="clear"><!-- --></span>

						</li>
					</ul>
	<span class="clear"><!-- --></span>
				</div>
			</div>

	<table class="media-frame clickable">
		<tr>
			<td class="tl"></td>
			<td class="tm"></td>
			<td class="tr"></td>
		</tr>
		<tr>
			<td class="ml"></td>
			<td class="mm">
		<div class="magnifying-wrapper" onclick="Lightbox.loadImage([{ path: '', src:'/wow/static/images/game/guide/playing-together/ss-guild-2-large.jpg'}])">
				<img src="/wow/static/images/game/guide/playing-together/ss-guild-2.jpg" alt="" />
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

	<table class="media-frame clickable">
		<tr>
			<td class="tl"></td>
			<td class="tm"></td>
			<td class="tr"></td>
		</tr>
		<tr>
			<td class="ml"></td>
			<td class="mm">
		<div class="magnifying-wrapper" onclick="Lightbox.loadImage([{ path: '', src:'/wow/static/images/game/guide/playing-together/ss-guild-2b-large.jpg'}])">
				<img src="/wow/static/images/game/guide/playing-together/ss-guild-2b.jpg" alt="" />
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

	<span class="clear"><!-- --></span>
		</div>

		<div class="box box-left guild-bank">
			<div class="guide-content-subtitle single-line">Banco de hermandad</div>

			Una de las ventajas de estar en una hermandad es el acceso al banco de hermandad. Estos bancos funcionan de forma muy parecida al banco personal de tu personajes, salvo porque este banco lo comparten todos los miembros de la hermandad con privilegios de banco de hermandad (establecidos por el maestro de hermandad). Otra diferencia importante es que puedes depositar oro en tu banco de hermandad, de ese modo, todos los miembros de la hermandad pueden acumular sus recursos y ayudarse entre ellos con las facturas de reparación y otros gastos.

	<table class="media-frame clickable">
		<tr>
			<td class="tl"></td>
			<td class="tm"></td>
			<td class="tr"></td>
		</tr>
		<tr>
			<td class="ml"></td>
			<td class="mm">
		<div class="magnifying-wrapper" onclick="Lightbox.loadImage([{ path: '', src:'/wow/static/images/game/guide/playing-together/ss-guild-3-large.jpg'}])">
				<img src="/wow/static/images/game/guide/playing-together/ss-guild-3.jpg" alt="" />
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

		<div class="box box-right guild-chat">
			<div class="guide-content-subtitle single-line">Chat de hermandad</div>

			Cada hermandad tiene sus propios canales de chat que proporcionan a sus miembros un modo conveniente de hablar entre ellos. Los dos canales estándar de cada hermandad se llaman Chat hermandad y Chat de oficiales. El maestro de hermandad puede otorgar distintos derechos de acceso para estos chats dependiendo de tu rango en la hermandad. El Chat de hermandad se usa para la comunicación habitual en la hermandad, mientras que el Chat de oficiales habitualmente solo está disponible para los miembros veteranos de la hermandad.

	<table class="media-frame clickable">
		<tr>
			<td class="tl"></td>
			<td class="tm"></td>
			<td class="tr"></td>
		</tr>
		<tr>
			<td class="ml"></td>
			<td class="mm">
		<div class="magnifying-wrapper" onclick="Lightbox.loadImage([{ path: '', src:'/wow/static/images/game/guide/playing-together/ss-guild-4-large.jpg'}])">
				<img src="/wow/static/images/game/guide/playing-together/ss-guild-4.jpg" alt="" />
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

		<div class="box box-left guild-advance">
			<div class="guide-content-subtitle single-line">Progreso de la hermandad</div>

			A medida que los miembros de la hermandad aumentan en número y juegan juntos, tu hermandad obtiene puntos de experiencia que normalmente se traducen en ventajas y bonificaciones especiales para tu hermandad. Cuanto más juegas con otros miembros de tu hermandad, más experiencia obtienes para tu hermandad.

	<table class="media-frame clickable">
		<tr>
			<td class="tl"></td>
			<td class="tm"></td>
			<td class="tr"></td>
		</tr>
		<tr>
			<td class="ml"></td>
			<td class="mm">
		<div class="magnifying-wrapper" onclick="Lightbox.loadImage([{ path: '', src:'/wow/static/images/game/guide/playing-together/ss-guild-5-large.jpg'}])">
				<img src="/wow/static/images/game/guide/playing-together/ss-guild-5.jpg" alt="" />
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

	<div id="friends">
		<div class="guide-content-title">Amigos</div>

		<div class="box box-left intro">
			Más allá de los grupos, bandas y hermandades, te encontrarás de forma inevitable con otros jugadores que comparten algunos intereses y gustos contigo; gente con la que acabarás hablando incluso cuando no estés en una mazmorra o misión, el tipo de gente con la que el tiempo pasa volando mientras intercambiáis historias, chistes y jugáis juntos. En otras palabras: harás amigos. Hacer amigos e ir de aventura con ellos es parte de lo que hace que World of Warcraft sea tan divertido.
		</div>

		<div class="friends">
			<div class="box friends-list">
				<div class="guide-content-subtitle">Lista de amigos</div>

				Puedes seguir la pista a tus amigos del juego gracias a la interfaz Lista de amigos de World of Warcraft. Cuando has añadido a alguien a tu amigos, este pequeño y útil recuadro te permite saber cuándo están conectados y por dónde andan. Puedes hablar con tus amigos fácilmente e incluso invitarlos a tu grupo mediante la lista de amigos.
			</div>

			<div class="box friends-realid">
				<div class="guide-content-subtitle">Amigos con ID real</div>
				<img src="/wow/static/images/game/guide/playing-together/real-id.gif" alt=""  class="real-id" />
				Antes del lanzamiento de StarCraft II: Wings of Liberty, añadimos una nueva opción llamada ID real en nuestro servicio de juego online Battle.net. En resumen; la ID real te permite seguir en contacto con tus amigos aunque estén jugando a otros juegos en Battle.net. <br/><br/>
	<span class="clear"><!-- --></span>
				<br/>
				
				<div class="float-left"
				>


	<a
		class="ui-button button2-next "
			href="http://eu.battle.net/es/realid/"
		
		
		
		
		
		
		
		>
		<span>
			<span>					Más información sobre ID Real
</span>
		</span>
	</a>
			</div>
	<span class="clear"><!-- --></span>
				
		</div>
	</div>
	</div>


		<div class="guide-page-nav">
			<span class="current-guide-title">Capítulo III: Jugar en comunidad</span>
			<div class="nav-buttons">
				<a href="how-to-play" class="prev">
					<span>
						<span style="background-image:url('/wow/static/images/game/guide/how-to-play-prev.gif');">Capítulo II: Cómo jugar</span>
					</span>
				</a>
				<a href="late-game" class="next">
					<span>
						<span style="background-image:url('/wow/static/images/game/guide/late-game-next.gif');">Capítulo IV: El juego avanzado</span>
					</span>
				</a>
			</div>
		</div>