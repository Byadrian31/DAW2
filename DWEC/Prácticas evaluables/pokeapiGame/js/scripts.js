const app = Vue.createApp({
    data() {
        return {
            characters: ["ash.png", "blue.png", "red.png", "leaf.png", "brock.png", "misty.png", "may.png", "serena.png", "adaman.png", "cynthia.png", "n.png", "dawn.png"],
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
            isLoading: true,
            searchQuery: '',
            selectedType: ''
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
                    return {
                        id: details.id,
                        name: details.name,
                        sprite: details.sprites.front_default,
                        types: details.types.map(t => t.type.name),
                        hp: details.stats.find(stat => stat.stat.name === "hp").base_stat,
                        maxHp: details.stats.find(stat => stat.stat.name === "hp").base_stat,
                        attack: details.stats.find(stat => stat.stat.name === "attack").base_stat,
                        defense: details.stats.find(stat => stat.stat.name === "defense").base_stat,
                        speed: details.stats.find(stat => stat.stat.name === "speed").base_stat
                    };
                })
            );
            this.pokemons = pokemonDetails;
            this.isLoading = false;
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
            this.selectedPokemonsPlayer = shuffled.slice(0, 6);
        },
        fillRivalTeam() {
            let shuffled = [...this.pokemons].sort(() => 0.5 - Math.random());
            this.selectedPokemonsRival = shuffled.slice(0, 6);
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
            this.fillRivalTeam();
            this.currentPokemonPlayer = this.selectedPokemonsPlayer[0] || null;
            this.currentPokemonRival = this.selectedPokemonsRival[0] || null;
            
            this.showPokemonModal = false;
            this.battleStarted = true;
            setTimeout(() => {
                document.querySelector(".player-trainer").classList.add("move-to-center");
                document.querySelector(".rival-trainer").classList.add("move-to-center");
                document.querySelector(".vs-text").classList.add("vs-show");
            }, 500);
            setTimeout(() => {
                this.battlefieldShown = true;
            }, 5000);
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
        }
    },
    mounted() {
        this.fetchPokemons();
    }
}).mount('#app');
