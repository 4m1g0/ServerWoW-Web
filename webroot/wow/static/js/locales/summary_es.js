        //<![CDATA[
        var MsgProfile = {
            tooltip: {
                feature: {
					notYetAvailable: "Esta opción aún no está disponible."
				},
				vault: {
					character: "Sólo se puede acceder a esta sección si has iniciado sesión con este personaje.",
					guild: "Sólo se puede acceder a esta sección si has iniciado sesión con un personaje que pertenezca a esta hermandad."
				}
            }
        };
        var MsgSummary = {
            viewOptions: {
                threed: {
                    title: "3D View"
                }
            },
            inventory: {
                slots: {
					1: "Cabeza",
					2: "Cuello",
					3: "Hombros",
					4: "Camisa",
					5: "Pecho",
					6: "Cintura",
					7: "Piernas",
					8: "Pies",
					9: "Muñeca",
					10: "Manos",
					11: "Dedo",
					12: "Abalorio",
					15: "A distancia",
					16: "Espalda",
					19: "Tabardo",
					21: "Mano derecha",
					22: "Mano izquierda",
					28: "Reliquia",
					empty: "Ranura vacía."
                }
            },
            audit: {
                whatIsThis: "Esta opción hace sugerencias sobre cómo puede mejorar este personaje. La siguiente información está verificada:<br /\><br /\>- Ranuras para glifos vacías<br /\>- Puntos de talentos sin usar<br /\>- Objetos sin encantar<br /\>- Ranuras vacías<br /\>- Armadura no óptima<br /\>- Falta hebilla de cinturón<br /\>- Ventajas de profesión sin usar",
				missing: "Te falta {0}",
				enchants: {
					tooltip: "Sin encantamiento"
				},
				sockets: {
					singular: "ranura vacía",
					plural: "ranuras vacías"
				},
				armor: {
					tooltip: "Sin {0}",
					1: "Tela",
					2: "Cuero",
					3: "Malla",
					4: "Placa"
				},
				lowLevel: {
					tooltip: "Nivel bajo"
				},
				blacksmithing: {
					name: "Herrería",
					tooltip: "Ranura faltante"
				},
				enchanting: {
					name: "Encantamiento",
					tooltip: "Sin encantamiento"
				},
				engineering: {
					name: "Ingeniería",
					tooltip: "Falta mejora de manitas"
				},
				inscription: {
					name: "Inscripción",
					tooltip: "Sin encantar"
				},
				leatherworking: {
					name: "Peletería",
					tooltip: "Sin encantar"
				}
            },
            talents: {
                specTooltip: {
                    title: "Especializacion de talentos",
					primary: "Primario:",
					secondary: "Secundario:",
					active: "Activo"
                }
            },
            stats: {
                toggle: {
                    all: "Mostrar todos los atributos",
					core: "Mostrar atributos principales"
                },
                increases: {
					attackPower: "Aumenta el poder de ataque en {0}.",
					critChance: "Aumenta la posibilidad de golpe crítico en {0}%.",
					spellCritChance: "Aumenta la posibilidad de golpe crítico con hechizos en {0}%.",
					health: "Aumenta {0} puntos de salud.",
					mana: "Aumenta {0} puntos de maná.",
					manaRegen: "Aumenta la regeneración de maná en {0} cada 5 segundos, mientras no estás lanzando hechizos.",
					meleeDps: "Aumenta el daño con armas cuerpo a cuerpo en {0} de daño por segundo.",
					rangedDps: "Aumenta el daño con armas a distancia en {0} de daño por segundo.",
					petArmor: "Aumenta la armadura de tu mascota en {0}.",
					petAttackPower: "Aumenta el poder de ataque de tu mascota en {0}.",
					petSpellDamage: "Aumenta el daño por hechizos de tu mascota en {0}.",
					petAttackPowerSpellDamage: "Aumenta el poder de ataque de tu mascota en {0} y el daño por hechizos en {1}."
				},
				decreases: {
					damageTaken: "Reduce el daño físico recibido en un {0}%.",
					enemyRes: "Reduce las resistencias de tu enemigo en {0}.",
					dodgeParry: "Reduce la posibilidad de esquiven o bloqueen tus ataques en un {0}%."
				},
				noBenefits: "No beneficia a tu clase.",
				beforeReturns: "(Antes del rendimiento decreciente)",
				damage: {
					speed: "Velocidad de ataque (segundos):",
					damage: "Daño:",
					dps: "Daño por segundo:"
				},
				averageItemLevel: {
					title: "Nivel de objeto {0}",
					description: "Nivel de objeto medio de tu mejor equipamiento. Mejorar este aspecto te permitirá acceder a mazmorras más complicadas en la herramienta de Buscador de Mazmorras."
				},
				health: {
					title: "Salud {0}",
					description: "Máximo nivel de salud. Morirás si tu salud llega a cero (0)."
				},
				mana: {
					title: "{0} de maná",
					description: "Máximo nivel de maná. El maná te permite lanzar hechizos."
				},
				rage: {
					title: "{0} de ira",
					description: "Máximo nivel de ira. La ira se consume al usar habilidades y se recupera mediante el combate."
				},
				focus: {
					title: "{0} de enfoque",
					description: "Máximo nivel de enfoque. El enfoque se consume al usar habilidades y se recupera con el paso del tiempo."
				},
				energy: {
					title: "{0} de energía",
					description: "Máximo nivel de energía. La energía se consume al usar habilidades y se recupera con el tiempo."
				},
				runic: {
					title: "{0} de rúnico",
					description: "Máximo nivel de poder rúnico."
				},
				strength: {
					title: "{0} de fuerza"
				},
				agility: {
					title: "{0} de agilidad"
				},
				stamina: {
					title: "{0} de aguante"
				},
				intellect: {
					title: "{0} de intelecto"
				},
				spirit: {
					title: "{0} de espíritu"
				},
				mastery: {
					title: "{0} de maestría",
					description: "Un índice de {0} en Maestría otorga {1} de Maestría.",
					unknown: "Debes aprender Maestría de tu entrenador para que tenga efecto.",
					unspecced: "Debes escoger una especialización de talentos para poder activar la Maestría. "
				},
				meleeDps: {
					title: "Daño por segundo"
				},
				meleeAttackPower: {
					title: "Poder de ataque cuerpo a cuerpo {0}"
				},
				meleeSpeed: {
					title: "Velocidad de ataque cuerpo a cuerpo {0}"
				},
				meleeHaste: {
					title: "Celeridad de ataque cuerpo a cuerpo {0}%",
					description: "Un índice de {0} en celeridad otorga un {1}% de celeridad.",
					description2: "Aumenta la velocidad de ataque cuerpo a cuerpo."
				},
				meleeHit: {
					title: "Oportunidad de golpear cuerpo a cuerpo {0}%.",
					description: "Índice de golpe de {0} otorga {1}% de probabilidad de golpe."
				},
				meleeCrit: {
					title: "Probabilidad de golpe crítico cuerpo a cuerpo de {0}%.",
					description: "Índice de golpe crítico de {0} otorga {1}% de golpe crítico.",
					description2: "Probabilidad de que los ataques cuerpo a cuerpo inflijan daño adicional."
				},
				expertise: {
					title: "{0} de pericia.",
					description: "Índice de pericia de {0} otorga {1} de pericia."
				},
				rangedDps: {
					title: "Daño por segundo."
				},
				rangedAttackPower: {
					title: "{0} de poder de ataque a distancia."
				},
				rangedSpeed: {
					title: "{0} de velocidad de ataque a distancia."
				},
				rangedHaste: {
					title: "{0}% de celiridad a distancia.",
					description: "Índice de celeridad de {0} otorga {1}% de celeridad.",
					description2: "Aumenta la velocidad de ataque a distancia."
				},
				rangedHit: {
					title: "{0}% de probabilidad de golpe a distancia.",
					description: "Índice de golpe de {0} otorga {1}% de probabilidad de golpe."
				},
				rangedCrit: {
					title: "{0}% de probabilidad de golpes críticos a distancia.",
					description: "Índice de golpes críticos de {0} otorga {1}% de golpes críticos.",
					description2: "Probabilidad de que los ataques a distancia inflijan daño adicional."
				},
				spellPower: {
					title: "{0} de poder con hechizos",
					description: "Aumenta el daño y la sanación con hechizos."
				},
				spellHaste: {
					title: "{0}% de celeridad con hechizos",
					description: "Índice de celeridad de {0} otorga {1}% de celeridad.",
					description2: "Aumenta la velocidad de lanzamiento de hechizos."
				},
				spellHit: {
					title: "{0}% de probabilidad de golpes con hechizos",
					description: "Índice de golpe de {0} otorga {1}% de probabilidad de golpes."
				},
				spellCrit: {
					title: "{0}% de probabilidad de golpes críticos con hechizos",
					description: "Índice de golpes críticos de {0} otorga {1}% de golpes críticos.",
					description2: "Probabilidad de que los hechizos inflijan daño o sanación adicional."
				},
				spellPenetration: {
					title: "{0} de penetración de hechizos"
				},
				manaRegen: {
					title: "Regeneración de maná",
					description: "{0} de maná regenerado cada 5 segundos mientras no se está en combate."
				},
				combatRegen: {
					title: "Reg. combate",
					description: "{0} de maná regenerado cada 5 segundos mientras se está en combate."
				},
				armor: {
					title: "{0} de armadura"
				},
				dodge: {
					title: "{0}% de probabilidad de esquivar",
					description: "Índice de esquivar de {0} otorga {1}% de esquivar."
				},
				parry: {
					title: "{0}% de probabilidad de parar",
					description: "Índice de parar de {0} otorga {1}% de parar."
				},
				block: {
					title: "{0}% de probabilidad de bloqueo.",
					description: "Índice de bloqueo de {0} otorga {1}% de probabilidad de bloqueo.",
					description2: "Tu bloqueo detiene un {0}% del próximo daño."
				},
				resilience: {
					title: "{0} de resistencia.",
					description: "Otorga un {0}% de reducción de daño contra todo el daño infligido por los jugadores y por sus mascotas o esbirros."
				},
				arcaneRes: {
					title: "{0} de resistencia a lo Arcano.",
					description: "Reduce el daño Arcano recibido por una media de {0}%."
				},
				fireRes: {
					title: "{0} de resistencia al Fuego",
					description: "Reduce el daño de Fuego recibido por una media de {0}%."
				},
				frostRes: {
					title: "{0} de resistencia a la Escarcha.",
					description: "Reduce el daño de Escarcha recibido por una media de {0}%."
				},
				natureRes: {
					title: "{0} de resistencia a la Naturaleza",
					description: "Reduce el daño de la Naturaleza recibido por una media de {0}%."
				},
				shadowRes: {
					title: "{0} de resistencia a las Sombras",
					description: "Reduce el daño de las Sombras recibido por una media de {0}%."
				}
            },
            recentActivity: {
                subscribe: "Suscribirse a este informe de actividad"
            },
            raid: {
                tooltip: {
                    normal: "(Normal)",
                    heroic: "(Heroico)",
                    players: "{0} players",
                    complete: "{0}% completado ({1}/{2})",
                    optional: "(opcional)",
                    expansions: {
                            0: "Classic",
                            1: "The Burning Crusade",
                            2: "Wrath of the Lich King",
                            3: "Cataclysm"
                    }
                },
                expansions: {
                        0: "Classic",
                        1: "The Burning Crusade",
                        2: "Wrath of the Lich King",
                        3: "Cataclysm"
                }
            }
        };
	//]]>