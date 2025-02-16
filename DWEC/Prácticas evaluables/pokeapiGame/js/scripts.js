const app = Vue.createApp({
    data() {
        return {
            characters: ["ash.png", "blue.png", "red.png", "leaf.png", "brock.png", "misty.png", "may.png", "serena.png", "adaman.png", "cynthia.png", "n.png", "dawn.png"],
            gameModeSelected: false, // Para mostrar el menú previo
            gameMode: "", // Guarda el modo (IA o J2)
            isPlayerTurn: true, // Control de turnos en J2
            playerCharacter: 0,
            rivalCharacter: 1,
            charactersSelected: false,
            showPokemonModal: false,
            battleStarted: false,
            battlefieldShown: false,
            pokemons: [],
            selectedPokemonsPlayer: [],
            selectedPokemonsRival: [],
            currentPokemonPlayer: null,
            currentPokemonRival: null,
            selectedMoves: [],
            battleLog: "",
            isLoading: true,
            searchQuery: '',
            selectedType: '',
            gameOver: false

        };
    },
    computed: {
        filteredPokemons() {
            return this.pokemons.filter(pokemon => {
                const matchesName = pokemon.name.toLowerCase().includes(this.searchQuery.toLowerCase());
                const matchesType = this.selectedType ? pokemon.types.includes(this.selectedType) : true;
                return matchesName && matchesType;
            });
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

                    let moveUrls = details.moves.map(m => m.move.url).sort(() => 0.5 - Math.random()).slice(0, 5);
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
        
                                if (selectedMoves.length === 2) break; // Solo necesitamos 2 movimientos
                            }
                        } catch (error) {
                            console.error("Error al obtener movimiento:", moveUrl, error);
                        }
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

            this.pokemons = pokemonDetails.filter(pokemon => pokemon.moves.length > 0);
            this.isLoading = false;
        },
        selectGameMode(mode) {
            this.gameMode = mode;
            this.gameModeSelected = true; // Oculta el menú y avanza a la selección de personajes
        },
        selectPokemon(pokemon) {
            if (this.selectedPokemonsPlayer.length < 6 && !this.selectedPokemonsPlayer.includes(pokemon)) {
                this.selectedPokemonsPlayer.push(pokemon);
            }
        },
        removePokemon(index) {
            this.selectedPokemonsPlayer.splice(index, 1);
        },
        fillRandomTeam() {
            this.selectedPokemonsPlayer = [];
            let shuffled = [...this.pokemons].sort(() => 0.5 - Math.random());
            this.selectedPokemonsPlayer = shuffled.slice(0, 6).map(pokemon => ({
                ...pokemon,
                hp: pokemon.maxHp,
                hpPercentage: 100,
                moves: [...pokemon.moves] // Crear una copia independiente de los movimientos
            }));
        },
        
        fillRivalTeam() {
            let shuffled = [...this.pokemons].sort(() => 0.5 - Math.random());
            this.selectedPokemonsRival = shuffled.slice(0, 6).map(pokemon => ({
                ...pokemon,
                hp: pokemon.maxHp,
                hpPercentage: 100,
                moves: [...pokemon.moves] // Crear una copia independiente de los movimientos
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
            if (this.gameMode === 'IA') {
                this.fillRivalTeam();
            } else {
                // En J2, los dos jugadores seleccionan su equipo
                this.selectedPokemonsRival = [...this.selectedPokemonsPlayer].sort(() => 0.5 - Math.random()).slice(0, 6);
            }
        
            this.currentPokemonPlayer = this.selectedPokemonsPlayer[0] || null;
            this.currentPokemonRival = this.selectedPokemonsRival[0] || null;
        
            this.showPokemonModal = false;
            this.battleStarted = true;
        
            // Turno basado en velocidad
            if (this.currentPokemonPlayer.speed >= this.currentPokemonRival.speed) {
                this.isPlayerTurn = true;
            } else {
                this.isPlayerTurn = false;
                if (this.gameMode === 'IA') {
                    setTimeout(this.rivalAttack, 1000);
                }
            }
        
            setTimeout(() => {
                this.battlefieldShown = true;
            }, 5000);
        },
        attack(move) {
            if (!this.isPlayerTurn || !this.currentPokemonPlayer || !this.currentPokemonRival) return;
        
            let damage = Math.max(move.power - this.currentPokemonRival.defense, 10);
            this.currentPokemonRival.hp = Math.max(this.currentPokemonRival.hp - damage, 0);
        
            this.battleLog = `${this.currentPokemonPlayer.name} usó ${move.name} e hizo ${damage} de daño!`;
        
            if (this.currentPokemonRival.hp <= 0) {
                let nextIndex = this.selectedPokemonsRival.indexOf(this.currentPokemonRival) + 1;
                if (nextIndex < this.selectedPokemonsRival.length) {
                    this.currentPokemonRival = this.selectedPokemonsRival[nextIndex];
                } else {
                    this.battleLog = "¡El equipo rival ha sido derrotado!";
                    this.gameOver = true;
                    return;
                }
            }
        
            // Cambio de turno para J2
            this.isPlayerTurn = !this.isPlayerTurn;
        
            if (!this.isPlayerTurn && this.gameMode === "IA") {
                setTimeout(this.rivalAttack, 1000);
            }
        },        

        rivalAttack() {
            if (this.gameMode === "J2") return; // No hay IA en J2
        
            let strongestMove = this.currentPokemonRival.moves.reduce((max, move) => (move.power > max.power ? move : max), { power: 0 });
        
            let damage = Math.max(strongestMove.power - this.currentPokemonPlayer.defense, 10);
            this.currentPokemonPlayer.hp = Math.max(this.currentPokemonPlayer.hp - damage, 0);
        
            this.battleLog = `${this.currentPokemonRival.name} usó ${strongestMove.name} e hizo ${damage} de daño!`;
        
            if (this.currentPokemonPlayer.hp <= 0) {
                let nextIndex = this.selectedPokemonsPlayer.indexOf(this.currentPokemonPlayer) + 1;
                if (nextIndex < this.selectedPokemonsPlayer.length) {
                    this.currentPokemonPlayer = this.selectedPokemonsPlayer[nextIndex];
                } else {
                    this.battleLog = "¡Tu equipo ha sido derrotado!";
                    this.gameOver = true;
                    return;
                }
            }
        
            this.isPlayerTurn = true;
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
            this.selectedPokemonsPlayer = [];
            this.selectedPokemonsRival = [];
            this.currentPokemonPlayer = null;
            this.currentPokemonRival = null;
            this.battleLog = "";
            this.gameOver = false;
        }        
    },
    mounted() {
        this.fetchPokemons();
    }
}).mount('#app');
