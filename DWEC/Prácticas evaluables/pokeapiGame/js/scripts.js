const app = Vue.createApp({
    data() {
        return {
            characters: ["ash.png", "blue.png", "red.png" , "leaf.png", "brock.png", "misty.png", "may.png", "serena.png", "adaman.png", "cynthia.png", "n.png", "dawn.png"],
            playerCharacter: 0,
            rivalCharacter: 1,
            charactersSelected: false,
            showPokemonModal: false,
            pokemons: [],
            selectedPokemonsPlayer: [],
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
            try {
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
                            types: details.types.map(t => t.type.name)
                        };
                    })
                );

                this.pokemons = pokemonDetails;
                this.isLoading = false;
            } catch (error) {
                console.error('Error obteniendo los Pokémon:', error);
            }
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
        }
    },
    mounted() {
        this.fetchPokemons();
    }
}).mount('#app');
