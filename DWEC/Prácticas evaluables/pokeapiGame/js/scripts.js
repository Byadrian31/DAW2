const app = Vue.createApp({
    data() {
        return {
            pokemons: [], // Lista de Pokémon obtenidos de la API
            selectedPokemonsPlayer: [], // Equipo del jugador
            selectedPokemonsMachine: [], // Equipo de la máquina
            isLoading: true, // Estado de carga
            searchQuery: '', // Texto de búsqueda
            selectedType: '' // Tipo seleccionado
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
                
                // Obtener detalles de cada Pokémon
                const pokemonDetails = await Promise.all(
                    data.results.map(async (pokemon) => {
                        let detailsResponse = await fetch(pokemon.url);
                        let details = await detailsResponse.json();
                        return {
                            id: details.id,
                            name: details.name,
                            sprite: details.sprites.front_default,
                            types: details.types.map(t => t.type.name) // Obtener tipos del Pokémon
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
        }
    },
    mounted() {
        this.fetchPokemons(); // Llamar a la función al montar la aplicación
    }
}).mount('#app');
