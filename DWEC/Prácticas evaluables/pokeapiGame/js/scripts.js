const app = Vue.createApp({
    data() {
        return {
            characters: ["ash.png", "blue.png", "red.png", "leaf.png", "brock.png", "misty.png", "may.png", "serena.png", "adaman.png", "cynthia.png", "n.png", "dawn.png"],
            gameModeSelected: false,
            gameMode: "",
            playerCharacter: 0,
            rivalCharacter: 1,
            charactersSelected: false,
            showPokemonModal: false,
            battleStarted: false,
            battlefieldShown: false,
            pokemons: [],
            selectedPokemonsPlayer1: [],
            selectedPokemonsPlayer2: [],
            currentPokemonPlayer1: null,
            currentPokemonPlayer2: null,
            battleLog: "",
            isLoading: true,
            searchQuery: '',
            selectedType: '',
            pokemonSelectionPhase: false,
            waitingForPokemonSelection: false,
            canChangePokemon: true,
            gameOver: false,
            currentPlayer: 1,
            activePlayer: 1,
            isAI: false,
            audioEnabled: false,
            canAttack: true
        };
    },
    computed: {
        filteredPokemons() {
            return this.pokemons.filter(pokemon => {
                const matchesName = pokemon.name.toLowerCase().includes(this.searchQuery.toLowerCase());
                const matchesType = this.selectedType ? pokemon.types.includes(this.selectedType) : true;
                // Verificar si el pokemon no está en ningún equipo
                const notInTeam1 = !this.selectedPokemonsPlayer1.some(p => p.id === pokemon.id);
                const notInTeam2 = !this.selectedPokemonsPlayer2.some(p => p.id === pokemon.id);
                return matchesName && matchesType && notInTeam1 && notInTeam2;
            });
        },
        currentPlayerTeam() {
            return this.currentPlayer === 1 ? this.selectedPokemonsPlayer1 : this.selectedPokemonsPlayer2;
        },
        modalTitle() {
            if (this.gameMode === 'IA') {
                return 'Selecciona tu equipo Pokémon';
            }
            return `Selecciona el equipo del Jugador ${this.currentPlayer}`;
        },
        characterSelectionTitle() {
            if (this.gameMode === 'IA') {
                return 'Elige tu entrenador y tu rival (IA)';
            }
            return 'Elige tu entrenador y tu rival';
        },
        player2Title() {
            return this.gameMode === 'IA' ? 'IA' : 'Jugador 2';
        }
    },
    methods: {
        async fetchPokemons() {
            let response = await fetch('https://pokeapi.co/api/v2/pokemon?limit=151');
            let data = await response.json();

            const pokemonDetails = await Promise.all(
                data.results.map(async (pokemon) => {
                    let detailsResponse = await fetch(pokemon.url);
                    let details = await detailsResponse.json();

                    // Obtener hasta 2 movimientos con poder > 0
                    let moveUrls = details.moves.map(m => m.move.url).sort(() => 0.5 - Math.random());
                    let selectedMoves = [];
        
                    for (let moveUrl of moveUrls) {
                        try {
                            let moveResponse = await fetch(moveUrl);
                            let moveData = await moveResponse.json();
        
                            if (moveData.power && moveData.power > 0) {
                                selectedMoves.push({
                                    name: moveData.names.find(n => n.language.name === "es")?.name || moveData.name,
                                    power: moveData.power
                                });
        
                                if (selectedMoves.length === 2) break;
                            }
                        } catch (error) {
                            console.error("Error al obtener movimiento:", moveUrl, error);
                        }
                    }

                    // Si no se encontraron 2 movimientos con poder, rellenar con movimientos básicos
                    while (selectedMoves.length < 2) {
                        selectedMoves.push({
                            name: "Placaje",
                            power: 40
                        });
                    }

                    return {
                        id: details.id,
                        name: details.name,
                        sprite: details.sprites.front_default,
                        types: details.types.map(t => t.type.name),
                        hp: details.stats.find(stat => stat.stat.name === "hp").base_stat,
                        maxHp: details.stats.find(stat => stat.stat.name === "hp").base_stat,
                        attack: details.stats.find(stat => stat.stat.name === "attack").base_stat,
                        defense: details.stats.find(stat => stat.stat.name === "defense").base_stat,
                        speed: details.stats.find(stat => stat.stat.name === "speed").base_stat,
                        moves: selectedMoves
                    };
                })
            );

            this.pokemons = pokemonDetails;
            this.isLoading = false;
        },

        selectGameMode(mode) {
            this.gameMode = mode;
            this.gameModeSelected = true;
        },

        initializeAudio() {
            this.audioTracks = {
                inicio: document.getElementById('Inicio'),
                combate: document.getElementById('Combate'),
                victoria: document.getElementById('Victoria')
            };
        
            // Configurar volumen inicial
            Object.values(this.audioTracks).forEach(track => {
                if (track) track.volume = 0.5; // 50% del volumen
            });
        },

        enableAudio() {
            this.audioEnabled = true;
            this.playAudio('inicio');
        },

        playAudio(trackName) {
            if (this.currentTrack && this.currentTrack !== this.audioTracks[trackName]) {
                this.currentTrack.pause();
                this.currentTrack.currentTime = 0;
            }
        
            if (this.audioTracks[trackName]) {
                this.audioTracks[trackName].play()
                    .catch(error => console.log("Error reproduciendo audio:", error));
                this.currentTrack = this.audioTracks[trackName];
            }
        },

        stopAllAudio() {
            Object.values(this.audioTracks).forEach(track => {
                if (track) {
                    track.pause();
                    track.currentTime = 0;
                }
            });
            this.currentTrack = null;
        },

        selectPokemon(pokemon) {
            const currentTeam = this.currentPlayer === 1 ? this.selectedPokemonsPlayer1 : this.selectedPokemonsPlayer2;
            
            if (currentTeam.length < 6) {
                const pokemonCopy = {
                    ...pokemon,
                    hp: pokemon.maxHp,
                    hpPercentage: 100,
                    moves: [...pokemon.moves]
                };
                if (this.currentPlayer === 1) {
                    this.selectedPokemonsPlayer1.push(pokemonCopy);
                } else {
                    this.selectedPokemonsPlayer2.push(pokemonCopy);
                }
            }
        },
        removePokemon(index) {
            if (this.currentPlayer === 1) {
                this.selectedPokemonsPlayer1.splice(index, 1);
            } else {
                this.selectedPokemonsPlayer2.splice(index, 1);
            }
        },
        fillRandomTeam() {
            const currentTeam = this.currentPlayer === 1 ? 'selectedPokemonsPlayer1' : 'selectedPokemonsPlayer2';
            this[currentTeam] = [];
            let shuffled = [...this.pokemons].sort(() => 0.5 - Math.random());
            this[currentTeam] = shuffled.slice(0, 6).map(pokemon => ({
                ...pokemon,
                hp: pokemon.maxHp,
                hpPercentage: 100,
                moves: [...pokemon.moves]
            }));
        },
        confirmTeamSelection() {
            if (this.gameMode === 'IA') {
                this.isAI = true;
                this.fillRivalTeam();
                this.startBattle();
            } else if (this.currentPlayer === 1) {
                this.currentPlayer = 2;
                this.searchQuery = '';
                this.selectedType = '';
            } else {
                this.startBattle();
            }
        },
        fillRivalTeam() {
            this.selectedPokemonsPlayer2 = [];
            let shuffled = [...this.pokemons].sort(() => 0.5 - Math.random());
            this.selectedPokemonsPlayer2 = shuffled.slice(0, 6).map(pokemon => ({
                ...pokemon,
                hp: pokemon.maxHp,
                hpPercentage: 100,
                moves: [...pokemon.moves]
            }));
        },
        nextCharacter(type) {
            if (type === 'player') {
                this.playerCharacter = (this.playerCharacter + 1) % this.characters.length;
            } else {
                this.rivalCharacter = (this.rivalCharacter + 1) % this.characters.length;
            }
        },
        prevCharacter(type) {
            if (type === 'player') {
                this.playerCharacter = (this.playerCharacter - 1 + this.characters.length) % this.characters.length;
            } else {
                this.rivalCharacter = (this.rivalCharacter - 1 + this.characters.length) % this.characters.length;
            }
        },
        startBattle() {
            this.playAudio('combate');
            this.showPokemonModal = false;
            this.battleStarted = true;
            this.pokemonSelectionPhase = true;
            this.waitingForPokemonSelection = true;
            this.battleLog = "Jugador 1, selecciona tu primer Pokémon";
            this.currentPokemonPlayer1 = null;
            this.currentPokemonPlayer2 = null;
    
            setTimeout(() => {
                this.battlefieldShown = true;
            }, 4000);
        },
    
        // Método para seleccionar Pokémon inicial o cambiar durante batalla
        selectBattlePokemon(playerNumber, pokemonIndex) {
            const selectedTeam = playerNumber === 1 ? this.selectedPokemonsPlayer1 : this.selectedPokemonsPlayer2;
            const pokemon = selectedTeam[pokemonIndex];

            if (pokemon.hp <= 0) {
                this.battleLog = "No puedes seleccionar un Pokémon debilitado";
                return;
            }

            // Si estamos en fase inicial de selección
            if (this.pokemonSelectionPhase) {
                this.handleInitialSelection(playerNumber, pokemon);
                return;
            }

            // Verificar si es el mismo Pokémon
            if ((playerNumber === 1 && pokemon === this.currentPokemonPlayer1) ||
                (playerNumber === 2 && pokemon === this.currentPokemonPlayer2)) {
                this.battleLog = "Este Pokémon ya está en batalla";
                return;
            }

            // Verificar si el Pokémon actual está debilitado
            const currentPokemon = playerNumber === 1 ? this.currentPokemonPlayer1 : this.currentPokemonPlayer2;
            const isCurrentFainted = !currentPokemon || currentPokemon.hp <= 0;

            // Si no es un Pokémon debilitado, verificar el turno
            if (!isCurrentFainted && playerNumber !== this.activePlayer) {
                this.battleLog = "No puedes cambiar de Pokémon en el turno del oponente";
                return;
            }

            // Realizar el cambio
            if (playerNumber === 1) {
                this.currentPokemonPlayer1 = pokemon;
            } else {
                this.currentPokemonPlayer2 = pokemon;
            }

            this.battleLog = `${playerNumber === 1 ? 'Jugador 1' : 'Jugador 2'} cambió a ${pokemon.name}!`;

            // Solo cambiar el turno si no era un Pokémon debilitado
            if (!isCurrentFainted) {
                this.activePlayer = this.activePlayer === 1 ? 2 : 1;
            }

            // Si después del cambio es turno de la IA, programar su ataque
            if (this.gameMode === 'IA' && this.activePlayer === 2) {
                this.scheduleAIAttack();
            }
        },
    
        handleInitialSelection(playerNumber, pokemon) {
            if (pokemon.hp <= 0) {
                this.battleLog = "No puedes seleccionar un Pokémon debilitado";
                return;
            }

            if (playerNumber === 1) {
                this.currentPokemonPlayer1 = pokemon;
                
                if (this.gameMode === 'IA') {
                    // La IA simplemente selecciona el primer Pokémon vivo de su equipo
                    const firstAlivePokemon = this.selectedPokemonsPlayer2.find(p => p.hp > 0);
                    this.currentPokemonPlayer2 = firstAlivePokemon;
                    this.pokemonSelectionPhase = false;
                    this.waitingForPokemonSelection = false;
                    this.determineFirstTurn();
                } else {
                    this.battleLog = "Jugador 2, selecciona tu primer Pokémon";
                }
            } else if (this.gameMode !== 'IA') {
                this.currentPokemonPlayer2 = pokemon;
                this.pokemonSelectionPhase = false;
                this.waitingForPokemonSelection = false;
                this.determineFirstTurn();
            }
        },


    
        handleBattleSwitch(playerNumber, pokemon) {
            if (this.gameMode === 'IA' && playerNumber === 2) return; // Prevenir cambios manuales de la IA
    
            if (playerNumber === 1) {
                if (this.currentPokemonPlayer1 === pokemon) {
                    this.battleLog = "Este Pokémon ya está en batalla";
                    return;
                }
                this.currentPokemonPlayer1 = pokemon;
            } else {
                if (this.currentPokemonPlayer2 === pokemon) {
                    this.battleLog = "Este Pokémon ya está en batalla";
                    return;
                }
                this.currentPokemonPlayer2 = pokemon;
            }
    
            this.battleLog = `${playerNumber === 1 ? 'Jugador 1' : 'Jugador 2'} cambió a ${pokemon.name}!`;
            this.activePlayer = this.activePlayer === 1 ? 2 : 1;
            
            if (this.gameMode === 'IA' && this.activePlayer === 2) {
                setTimeout(this.rivalAttack, 2000);
            }
        },
    
        attack(move) {
            if (this.gameOver) return;
            if (!this.currentPokemonPlayer1 || !this.currentPokemonPlayer2) return;
            
            let attacker, defender;
            if (this.activePlayer === 1) {
                attacker = this.currentPokemonPlayer1;
                defender = this.currentPokemonPlayer2;
            } else {
                attacker = this.currentPokemonPlayer2;
                defender = this.currentPokemonPlayer1;
            }
    
            let effectiveDamage = move.power - defender.defense;
            let finalDamage = effectiveDamage <= 0 ? 10 : effectiveDamage;
            
            defender.hp = Math.max(defender.hp - finalDamage, 0);
            defender.hpPercentage = (defender.hp / defender.maxHp) * 100;
        
            this.battleLog = `${attacker.name} usó ${move.name} e hizo ${Math.floor(finalDamage)} de daño!`;
    
            if (defender.hp <= 0) {
                this.handleFaintedPokemon(defender);
                return; // Importante: salir si el Pokémon fue derrotado
            }
    
            // Cambiar el turno solo si el juego no ha terminado
            if (!this.gameOver) {
                this.activePlayer = this.activePlayer === 1 ? 2 : 1;
                
                // Si es el turno de la IA, programar su ataque
                if (this.gameMode === 'IA' && this.activePlayer === 2) {
                    this.scheduleAIAttack();
                }
            }
        },

        scheduleAIAttack() {
            // Limpiar cualquier timeout existente
            if (this.aiTimeout) {
                clearTimeout(this.aiTimeout);
            }
            
            // Programar el nuevo ataque
            this.aiTimeout = setTimeout(() => {
                if (!this.gameOver && this.activePlayer === 2) {
                    this.rivalAttack();
                }
            }, 2000);
        },

        handleFaintedPokemon(defender) {
            const defenderTeam = this.activePlayer === 1 ? this.selectedPokemonsPlayer2 : this.selectedPokemonsPlayer1;
            const hasRemainingPokemon = defenderTeam.some(pokemon => pokemon.hp > 0);

            defender.hp = 0;
            defender.hpPercentage = 0;

            if (!hasRemainingPokemon) {
                this.playAudio('victoria');
                if (this.gameMode === 'IA') {
                    this.battleLog = this.activePlayer === 1 ? '¡Has ganado!' : 'La IA ha ganado';
                } else {
                    this.battleLog = `¡El Jugador ${this.activePlayer} ha ganado la batalla!`;
                }
                this.gameOver = true;
                return;
            }

            if (this.gameMode === 'IA' && this.activePlayer === 1) {
                // La IA selecciona automáticamente el siguiente Pokémon vivo
                const nextPokemon = this.selectedPokemonsPlayer2.find(pokemon => pokemon.hp > 0);
                setTimeout(() => {
                    this.currentPokemonPlayer2 = nextPokemon;
                    this.battleLog += `\nIA envía a ${nextPokemon.name}!`;
                    // Programar el siguiente ataque de la IA después del cambio
                    if (this.activePlayer === 2) {
                        this.scheduleAIAttack();
                    }
                }, 1000);
            } else {
                this.battleLog += "\n¡Selecciona tu siguiente Pokémon!";
                if (this.activePlayer === 1) {
                    this.currentPokemonPlayer2 = null;
                } else {
                    this.currentPokemonPlayer1 = null;
                }
                // No cambiar el turno cuando un Pokémon es debilitado
            }
        },
    
        rivalAttack() {
            if (this.gameOver || this.activePlayer !== 2) return;

            // Seleccionar el movimiento más fuerte
            const bestMove = this.currentPokemonPlayer2.moves.reduce(
                (max, move) => move.power > max.power ? move : max,
                this.currentPokemonPlayer2.moves[0]
            );

            // Ejecutar el ataque
            this.attack(bestMove);
        },
    
        determineFirstTurn() {
            if (this.currentPokemonPlayer1.speed >= this.currentPokemonPlayer2.speed) {
                this.activePlayer = 1;
                this.battleLog = "¡Comienza la batalla! Jugador 1 tiene el primer turno";
            } else {
                this.activePlayer = 2;
                this.battleLog = "¡Comienza la batalla! " + (this.gameMode === 'IA' ? "La IA" : "Jugador 2") + " tiene el primer turno";
                if (this.gameMode === 'IA') {
                    setTimeout(this.rivalAttack, 2000);
                }
            }
            this.canAttack = true; // Asegurarse de que se pueden realizar ataques
        },
        getHealthClass(pokemon) {
            if (!pokemon || pokemon.hp === undefined || pokemon.maxHp === undefined) return "red";
            let percentage = (pokemon.hp / pokemon.maxHp) * 100;
            if (percentage > 60) return "green";
            if (percentage > 30) return "orange";
            return "red";
        },
        getHealthPercentage(pokemon) {
            if (!pokemon || pokemon.hp === undefined || pokemon.maxHp === undefined) return "0%";
            return ((pokemon.hp / pokemon.maxHp) * 100) + "%";
        },
        restartGame() {
            this.gameModeSelected = false;
            this.gameMode = "";
            this.charactersSelected = false;
            this.showPokemonModal = false;
            this.battleStarted = false;
            this.battlefieldShown = false;
            this.selectedPokemonsPlayer1 = [];
            this.selectedPokemonsPlayer2 = [];
            this.currentPokemonPlayer1 = null;
            this.currentPokemonPlayer2 = null;
            this.battleLog = "";
            this.gameOver = false;
            this.currentPlayer = 1;
            this.activePlayer = 1;
        }
    },
    mounted() {
        this.fetchPokemons();
        this.initializeAudio();
    }
}).mount('#app');

