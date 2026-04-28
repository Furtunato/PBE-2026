<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Pokédex Game Boy - Coleção com Evolução por Captura</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=VT323&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            user-select: none;
        }
        body {
            background: linear-gradient(145deg, #0f380f 0%, #306230 100%);
            font-family: 'Press Start 2P', 'VT323', monospace;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .gameboy-container {
            width: 800px;
            max-width: 100%;
            position: relative;
        }
        .gameboy-shell {
            background: #8b9a6e;
            border-radius: 35px 35px 45px 45px;
            box-shadow: 0 18px 0 -5px #4a5c3a, 0 22px 15px -5px rgba(0,0,0,0.5), inset 0 1px 4px rgba(255,255,200,0.4);
            padding: 20px 18px 25px 18px;
            border: 2px solid #5d7148;
        }
        .screen-frame {
            background: #221c12;
            border-radius: 18px;
            padding: 10px;
            border: 3px solid #3b2e22;
            box-shadow: inset 0 0 0 2px #5c4b32, 0 5px 0 #2b2218;
        }
        .screen-glass {
            background: #8bac6e;
            border-radius: 12px;
            padding: 14px;
            position: relative;
            height: 650px;
            overflow-y: auto;
            box-shadow: inset 0 0 15px rgba(0,0,0,0.3), 0 0 0 2px #c4e6a1;
        }
        .screen-glass::-webkit-scrollbar {
            width: 6px;
        }
        .screen-glass::-webkit-scrollbar-track { background: #4d613c; border-radius: 10px; }
        .screen-glass::-webkit-scrollbar-thumb { background: #221c12; border-radius: 10px; }
        .tab-button {
            font-family: 'Press Start 2P', monospace;
            font-size: 0.5rem;
            transition: all 0.1s;
            letter-spacing: 1px;
            padding: 8px 8px;
        }
        .tab-button.active {
            background: #d4c9a6;
            color: #1f2c0a;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.2), 0 1px 0 #fff5cf;
        }
        .type-badge {
            font-family: 'Press Start 2P', monospace;
            font-size: 0.55rem;
            padding: 0.35rem 0.8rem;
            border-radius: 40px;
        }
        .gb-btn {
            font-family: 'Press Start 2P', monospace;
            font-size: 0.5rem;
            transition: all 0.07s linear;
            box-shadow: 0 4px 0 #3a2a1f;
        }
        .gb-btn:active {
            transform: translateY(3px);
            box-shadow: 0 1px 0 #3a2a1f;
        }
        .stat-bar-bg { background-color: #2b3420; border-radius: 20px; height: 8px; overflow: hidden; }
        .stat-fill { height: 100%; background: #5fba6a; border-radius: 20px; transition: width 0.3s; }
        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-8px) rotate(-10deg); }
            75% { transform: translateX(8px) rotate(10deg); }
            100% { transform: translateX(0); }
        }
        .pokeball-shake { animation: shake 0.3s ease-in-out 3; }
        .pokemon-captured { animation: captureGlow 0.6s ease; }
        @keyframes captureGlow {
            0% { filter: brightness(1); }
            50% { filter: brightness(1.3) drop-shadow(0 0 10px gold); transform: scale(1.05); }
            100% { filter: brightness(1); }
        }
        .coin-earn { animation: coinPop 0.4s ease-out; }
        @keyframes coinPop {
            0% { transform: scale(1); }
            50% { transform: scale(1.3); color: #ffd700; text-shadow: 0 0 5px gold; }
            100% { transform: scale(1); }
        }
        .shop-item, .pokemon-card-item {
            transition: all 0.1s;
            cursor: pointer;
        }
        .shop-item:hover, .pokemon-card-item:hover {
            transform: scale(1.02);
            background: #4a6e3a !important;
        }
        .fruit-active { border: 2px solid #ffd966; background: #3e5a2a !important; }
        .evolution-bar { background: #3a2c1f; border-radius: 10px; height: 8px; overflow: hidden; }
        .evolution-fill { background: #fbbf24; height: 100%; transition: width 0.3s; }
    </style>
</head>
<body>

<div class="gameboy-container">
    <div class="gameboy-shell">
        <div class="flex justify-between items-center mb-2 px-1">
            <div class="flex gap-2">
                <div class="w-3 h-3 rounded-full bg-red-600 shadow-md animate-pulse"></div>
                <div class="w-3 h-3 rounded-full bg-green-800 shadow-inner"></div>
            </div>
            <div class="w-16 h-2 bg-[#3a2c1a] rounded-full"></div>
            <div class="text-xs text-[#2c3820] opacity-60">PKDX</div>
        </div>

        <div class="screen-frame">
            <div class="screen-glass">
                <div class="flex gap-1 mb-3 border-b-2 border-[#4f6a3a] pb-2 flex-wrap">
                    <button id="tab-pokedex-btn" class="tab-button active bg-[#b8c49a] rounded-t-lg">📖 POKÉDEX</button>
                    <button id="tab-collection-btn" class="tab-button bg-[#5a6e48] rounded-t-lg">🏆 MEUS POKÉMONS</button>
                    <button id="tab-capture-btn" class="tab-button bg-[#5a6e48] rounded-t-lg">🎯 CAPTURAR</button>
                    <button id="tab-shop-btn" class="tab-button bg-[#5a6e48] rounded-t-lg">🏪 LOJA</button>
                    <button id="tab-search-btn" class="tab-button bg-[#5a6e48] rounded-t-lg">🔍 BUSCAR</button>
                </div>

                <!-- ABA POKÉDEX -->
                <div id="pokedex-tab" class="tab-content">
                    <div id="pokemon-card-container">
                        <div class="bg-[#1f2c12] rounded-lg py-2 px-2 mb-3 text-center">
                            <h1 id="pokemon-name" class="text-white text-xs" style="font-family: 'Press Start 2P';">CARREGANDO...</h1>
                        </div>
                        <div class="bg-[#4a6136] p-2 rounded-xl flex justify-center mb-3">
                            <div class="bg-[#d4eab0] rounded-xl p-2"><img id="pokemon-img" src="" class="w-24 h-auto mx-auto"></div>
                        </div>
                        <div id="types-container" class="flex justify-center gap-2 mb-3 flex-wrap"></div>
                        <div class="bg-[#2a3820] rounded-md px-3 py-2 mb-3 text-white text-xs">⚖️ PESO: <span id="pokemon-weight">--</span> kg | 📏 ALTURA: <span id="pokemon-height">--</span> m</div>
                        <div class="bg-[#1f2a14] rounded-lg p-2 mb-3"><div class="text-[#ffdfa5] text-[0.4rem] text-center">✦ STATUS ✦</div><div id="stats-list" class="space-y-1"></div></div>
                    </div>
                </div>

                <!-- ABA MINHA COLEÇÃO -->
                <div id="collection-tab" class="tab-content hidden">
                    <div class="bg-[#2a3820] rounded-xl p-3">
                        <p class="text-[#ffdfa5] text-[0.5rem] text-center mb-2">⭐ SEUS POKÉMONS CAPTURADOS ⭐</p>
                        <div id="collection-list" class="space-y-2 max-h-[480px] overflow-y-auto pr-1">
                            <!-- Lista de Pokémon capturados -->
                        </div>
                        <div id="collection-empty" class="text-center text-[#a5c882] text-xs py-4">Nenhum Pokémon capturado ainda! Vá na aba CAPTURAR!</div>
                    </div>
                </div>

                <!-- ABA CAPTURA -->
                <div id="capture-tab" class="tab-content hidden">
                    <div class="bg-[#2a3820] rounded-xl p-3">
                        <div class="flex justify-between items-center mb-3 bg-[#1f2c12] rounded-lg px-3 py-2">
                            <div class="flex gap-3"><span>💰 <span id="money-amount">500</span></span><span>🎯 <span id="pokeball-count">5</span></span></div>
                            <div class="text-xs"><span>🍎 FRUTA:</span> <span id="active-fruit-name" class="text-[#ffd966]">NENHUMA</span></div>
                        </div>
                        <div id="fruit-bonus-display" class="bg-[#1a2410] rounded-lg px-2 py-1 mb-2 text-center text-xs text-[#a5c882] hidden">✨ BÔNUS: +<span id="fruit-bonus-value">0</span>% ✨</div>
                        
                        <div class="bg-[#1f2a14] rounded-xl p-3 mb-3 text-center">
                            <img id="wild-pokemon-img" src="" class="w-24 h-auto mx-auto mb-1">
                            <h2 id="wild-pokemon-name" class="text-white text-xs font-bold mb-2">---</h2>
                            <div class="bg-[#0f1a08] rounded-lg p-2">
                                <div class="flex justify-between text-xs mb-1"><span>🏆 RARIDADE:</span><span id="rarity-text" class="text-[#ffd966]">COMUM</span></div>
                                <div class="flex justify-between text-xs"><span>🎲 CHANCE:</span><span id="capture-chance" class="text-[#5fba6a]">0%</span></div>
                                <div class="mt-1"><div class="stat-bar-bg"><div id="chance-bar" class="stat-fill" style="width:0%"></div></div></div>
                            </div>
                        </div>
                        
                        <div class="flex gap-2 mb-2">
                            <button id="throw-pokeball-btn" class="flex-1 gb-btn bg-red-600 text-white py-2 rounded-lg">🎯 LANÇAR</button>
                            <button id="new-encounter-btn" class="flex-1 gb-btn bg-[#7a5a3a] text-white py-2 rounded-lg">🌿 NOVO</button>
                        </div>
                        <div id="capture-message" class="text-center text-[#ffd966] text-xs py-1 hidden bg-[#1a2410] rounded-lg"></div>
                    </div>
                </div>

                <!-- ABA LOJA -->
                <div id="shop-tab" class="tab-content hidden">
                    <div class="bg-[#2a3820] rounded-xl p-3">
                        <div class="flex justify-between mb-3 bg-[#1f2c12] rounded-lg px-3 py-2">
                            <span>💰 MOEDAS: <span id="shop-money">500</span></span>
                            <span>🎯 POKÉBOLAS: <span id="shop-pokeballs">5</span></span>
                        </div>
                        <p class="text-[#ffdfa5] text-[0.45rem] mb-2 text-center">🍎 FRUTAS (BÔNUS DE CAPTURA)</p>
                        <div id="fruits-shop" class="grid grid-cols-3 gap-1 mb-3"></div>
                        <p class="text-[#ffdfa5] text-[0.45rem] mb-2 text-center">🎯 POKÉBOLAS</p>
                        <div id="pokeballs-shop" class="grid grid-cols-2 gap-2 mb-3"></div>
                        <div id="shop-message" class="text-center text-[#ffc285] text-xs py-1 hidden bg-[#1a2410] rounded-lg"></div>
                    </div>
                </div>

                <!-- ABA BUSCAR -->
                <div id="search-tab" class="tab-content hidden">
                    <div class="bg-[#2a3820] rounded-xl p-4">
                        <p class="text-[#f5e2a4] text-[0.5rem] mb-3 text-center">DIGITE NOME OU NÚMERO</p>
                        <input type="text" id="search-input" placeholder="EX: CHARMANDER / 25" class="w-full bg-[#2f3a22] border-2 border-[#4e6640] text-white px-3 py-2 rounded-lg text-center uppercase text-sm">
                        <div class="flex gap-2 justify-center mt-3"><button id="search-btn" class="gb-btn bg-[#2d732d] text-white px-4 py-1 rounded-full">🔍 BUSCAR</button><button id="clear-search-btn" class="gb-btn bg-[#7a5a3a] text-white px-4 py-1 rounded-full">✖️ LIMPAR</button></div>
                        <div id="search-message" class="text-center mt-3 text-[#ffc285] text-xs hidden"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center mt-5 px-2">
            <div class="relative w-16 h-16"><div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-[#1f1a12] rounded-md shadow-inner"></div>
                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-4 h-5 bg-[#30281c] rounded-sm"></div>
                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-4 h-5 bg-[#30281c] rounded-sm"></div>
                <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-5 h-4 bg-[#30281c] rounded-sm"></div>
                <div class="absolute right-0 top-1/2 transform -translate-y-1/2 w-5 h-4 bg-[#30281c] rounded-sm"></div>
            </div>
            <div class="flex gap-4"><button id="prev-btn" class="gb-btn bg-[#982828] text-white px-4 py-2 rounded-full text-xs">◀ ANTERIOR</button><button id="next-btn" class="gb-btn bg-[#2d732d] text-white px-5 py-2 rounded-full text-xs">PRÓXIMO ▶</button></div>
            <div class="flex gap-1"><div class="w-5 h-5 rounded-full bg-[#ad2a2a]"></div><div class="w-5 h-5 rounded-full bg-[#c9a03d]"></div></div>
        </div>
    </div>
</div>

<script>
    // ===================== SISTEMA DE COLEÇÃO E EVOLUÇÃO =====================
    const API_URL = "https://pokeapi.co/api/v2/pokemon/";
    let currentId = 1;
    const MAX_ID = 898;
    
    // Coleção do jogador: { pokemonId, name, sprite, count, level, evolutionStage, nextEvolutionId, evolutionRequirement }
    let playerCollection = [];
    
    // Recursos
    let money = 500;
    let pokeballs = 5;
    let currentWildPokemon = null;
    let activeFruit = null;
    let currentPokeballType = { id: "normal", nome: "POKÉBOLA", bonus: 0, preco: 100 };
    
    // Cache de evoluções (simplificado - para demonstração, alguns Pokémon evoluem por nível)
    // Mapeamento de evolução baseado no ID (alguns exemplos)
    const evolutionMap = {
        1: { next: 2, name: "IVYSAUR", requirement: 2 },   // Bulbasaur -> Ivysaur (2 capturas)
        2: { next: 3, name: "VENUSAUR", requirement: 3 },  // Ivysaur -> Venusaur (3 capturas)
        4: { next: 5, name: "CHARMELEON", requirement: 2 }, // Charmander
        5: { next: 6, name: "CHARIZARD", requirement: 3 },
        7: { next: 8, name: "WARTORTLE", requirement: 2 },
        8: { next: 9, name: "BLASTOISE", requirement: 3 },
        25: { next: 26, name: "RAICHU", requirement: 2 },  // Pikachu
        133: { next: 134, name: "VAPOREON", requirement: 3 }, // Eevee -> Vaporeon (requer 3)
        137: { next: 233, name: "PORYGON2", requirement: 2 },
        233: { next: 474, name: "PORYGON-Z", requirement: 3 }
    };
    
    // Carregar coleção do localStorage
    function loadCollection() {
        const saved = localStorage.getItem('pokemonCollection');
        if (saved) {
            playerCollection = JSON.parse(saved);
        } else {
            playerCollection = [];
        }
        renderCollection();
    }
    
    function saveCollection() {
        localStorage.setItem('pokemonCollection', JSON.stringify(playerCollection));
    }
    
    // Adicionar ou incrementar captura
    async function addPokemonToCollection(pokemon) {
        const existing = playerCollection.find(p => p.pokemonId === pokemon.id);
        
        if (existing) {
            existing.count++;
            // Verificar evolução
            const evolution = evolutionMap[existing.pokemonId];
            if (evolution && existing.count >= evolution.requirement) {
                // Evoluir!
                const evolvedPokemon = await fetchPokemonData(evolution.next);
                if (evolvedPokemon) {
                    existing.pokemonId = evolvedPokemon.id;
                    existing.name = evolvedPokemon.name;
                    existing.sprite = evolvedPokemon.sprites?.other?.["official-artwork"]?.front_default || evolvedPokemon.sprites?.front_default;
                    existing.count = existing.count - evolution.requirement; // mantém sobras
                    existing.level++;
                    existing.evolutionStage = (existing.evolutionStage || 0) + 1;
                    
                    // Mostrar mensagem de evolução
                    const msgDiv = document.getElementById('capture-message');
                    msgDiv.innerHTML = `✨ EVOLUÇÃO! ${pokemon.name.toUpperCase()} evoluiu para ${evolvedPokemon.name.toUpperCase()}! ✨`;
                    msgDiv.classList.remove('hidden');
                    msgDiv.style.color = "#ffd966";
                    setTimeout(() => msgDiv.classList.add('hidden'), 3000);
                }
            }
        } else {
            // Novo Pokémon
            playerCollection.push({
                pokemonId: pokemon.id,
                name: pokemon.name,
                sprite: pokemon.sprites?.other?.["official-artwork"]?.front_default || pokemon.sprites?.front_default,
                count: 1,
                level: 1,
                evolutionStage: 0
            });
        }
        saveCollection();
        renderCollection();
    }
    
    function renderCollection() {
        const container = document.getElementById('collection-list');
        const emptyMsg = document.getElementById('collection-empty');
        
        if (!playerCollection.length) {
            if (emptyMsg) emptyMsg.classList.remove('hidden');
            if (container) container.innerHTML = '';
            return;
        }
        
        if (emptyMsg) emptyMsg.classList.add('hidden');
        container.innerHTML = '';
        
        playerCollection.forEach(pokemon => {
            const evolution = evolutionMap[pokemon.pokemonId];
            const nextEvoName = evolution ? evolution.name : "MÁXIMO";
            const required = evolution ? evolution.requirement : 0;
            const progress = pokemon.count;
            const progressPercent = required ? Math.min(100, (progress / required) * 100) : 100;
            
            const card = document.createElement('div');
            card.className = 'pokemon-card-item bg-[#3e5630] rounded-lg p-2 flex items-center gap-3';
            card.innerHTML = `
                <img src="${pokemon.sprite}" class="w-12 h-12 object-contain">
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <span class="text-white text-xs font-bold uppercase">${pokemon.name}</span>
                        <span class="text-[#ffd966] text-[0.5rem]">NÍVEL ${pokemon.level}</span>
                    </div>
                    <div class="text-[#a5c882] text-[0.4rem]">⭐ CAPTURAS: ${pokemon.count}</div>
                    <div class="mt-1">
                        <div class="flex justify-between text-[0.35rem] text-[#e6dbb5]"><span>🔮 EVOLUIR: ${nextEvoName}</span><span>${progress}/${required}</span></div>
                        <div class="evolution-bar"><div class="evolution-fill" style="width: ${progressPercent}%"></div></div>
                    </div>
                </div>
            `;
            container.appendChild(card);
        });
    }
    
    // ===================== SISTEMA DE CAPTURA =====================
    const fruits = [
        { id: "berry", nome: "🍓 FRAMBA", bonus: 10, preco: 50 },
        { id: "oran", nome: "🍊 ORAN", bonus: 20, preco: 100 },
        { id: "sitrus", nome: "🍋 SITRUS", bonus: 35, preco: 200 },
        { id: "rare", nome: "🍎 RARA", bonus: 50, preco: 350 }
    ];
    
    const pokeballsTypes = [
        { id: "normal", nome: "🎯 POKÉBOLA", bonus: 0, preco: 100 },
        { id: "great", nome: "🔵 GREAT BALL", bonus: 20, preco: 300 },
        { id: "ultra", nome: "🟡 ULTRA BALL", bonus: 40, preco: 600 }
    ];
    
    function calcularRaridade(totalStats) {
        if (totalStats >= 600) return { nome: "⚜️ LENDÁRIO", recompensa: 500, dificuldade: 85 };
        if (totalStats >= 500) return { nome: "💎 ÉPICO", recompensa: 300, dificuldade: 70 };
        if (totalStats >= 400) return { nome: "✨ RARO", recompensa: 150, dificuldade: 55 };
        if (totalStats >= 300) return { nome: "🟢 INCOMUM", recompensa: 80, dificuldade: 40 };
        return { nome: "🟤 COMUM", recompensa: 50, dificuldade: 25 };
    }
    
    function calcularChanceCaptura(totalStats, hpStat) {
        let baseChance = 85;
        if (totalStats >= 600) baseChance = 20;
        else if (totalStats >= 500) baseChance = 35;
        else if (totalStats >= 400) baseChance = 55;
        else if (totalStats >= 300) baseChance = 70;
        else baseChance = 85;
        
        let hpFactor = Math.max(0.6, 1 - (hpStat / 300));
        let finalChance = Math.floor(baseChance * hpFactor);
        if (activeFruit) finalChance += activeFruit.bonus;
        if (currentPokeballType) finalChance += currentPokeballType.bonus;
        return Math.min(95, Math.max(5, finalChance));
    }
    
    async function fetchPokemonData(id) {
        try {
            const res = await fetch(`${API_URL}${id}`);
            if (!res.ok) return null;
            return await res.json();
        } catch { return null; }
    }
    
    async function buscarPokemonAleatorio() {
        const randomId = Math.floor(Math.random() * (MAX_ID - 1)) + 1;
        const pokemon = await fetchPokemonData(randomId);
        return pokemon || await buscarPokemonAleatorio();
    }
    
    async function novoEncontro() {
        const pokemon = await buscarPokemonAleatorio();
        currentWildPokemon = pokemon;
        let totalStats = 0, hpStat = 0;
        pokemon.stats.forEach(s => { totalStats += s.base_stat; if(s.stat.name === 'hp') hpStat = s.base_stat; });
        const rarity = calcularRaridade(totalStats);
        
        document.getElementById('wild-pokemon-img').src = pokemon.sprites?.other?.["official-artwork"]?.front_default || pokemon.sprites?.front_default;
        document.getElementById('wild-pokemon-name').innerHTML = pokemon.name.charAt(0).toUpperCase() + pokemon.name.slice(1);
        document.getElementById('rarity-text').innerHTML = rarity.nome;
        
        const chance = calcularChanceCaptura(totalStats, hpStat);
        document.getElementById('capture-chance').innerHTML = `${chance}%`;
        document.getElementById('chance-bar').style.width = `${chance}%`;
        document.getElementById('chance-bar').style.background = chance > 60 ? '#5fba6a' : (chance > 30 ? '#fbbf24' : '#ef4444');
        document.getElementById('capture-message').classList.add('hidden');
    }
    
    async function lancarPokebola() {
        if (pokeballs <= 0) {
            showMsg("❌ SEM POKÉBOLAS! Compre na loja!", "#ffae70");
            return;
        }
        if (!currentWildPokemon) await novoEncontro();
        
        const btn = document.getElementById('throw-pokeball-btn');
        btn.classList.add('pokeball-shake');
        setTimeout(() => btn.classList.remove('pokeball-shake'), 400);
        
        let totalStats = 0, hpStat = 0;
        currentWildPokemon.stats.forEach(s => { totalStats += s.base_stat; if(s.stat.name === 'hp') hpStat = s.base_stat; });
        const chance = calcularChanceCaptura(totalStats, hpStat);
        const capturado = Math.random() * 100 <= chance;
        
        pokeballs--;
        atualizarUI();
        
        if (capturado) {
            const recompensa = calcularRaridade(totalStats).recompensa;
            money += recompensa;
            await addPokemonToCollection(currentWildPokemon);
            atualizarUI();
            showMsg(`✅ CAPTURADO! +${recompensa} moedas! ${currentWildPokemon.name.toUpperCase()} foi para sua coleção!`, "#a5d6a5");
            document.getElementById('wild-pokemon-img').classList.add('pokemon-captured');
            setTimeout(() => document.getElementById('wild-pokemon-img').classList.remove('pokemon-captured'), 600);
            document.getElementById('throw-pokeball-btn').disabled = true;
            setTimeout(async () => { await novoEncontro(); document.getElementById('throw-pokeball-btn').disabled = false; }, 1500);
        } else {
            showMsg(`❌ FUGIU! ${currentWildPokemon.name.toUpperCase()} escapou! Chance: ${chance}%`, "#ffae70");
            document.getElementById('throw-pokeball-btn').disabled = true;
            setTimeout(async () => { await novoEncontro(); document.getElementById('throw-pokeball-btn').disabled = false; }, 1500);
        }
    }
    
    function usarFruta(fruit) {
        if (money >= fruit.preco) {
            money -= fruit.preco;
            activeFruit = fruit;
            atualizarUI();
            document.getElementById('active-fruit-name').innerHTML = fruit.nome;
            document.getElementById('fruit-bonus-display').classList.remove('hidden');
            document.getElementById('fruit-bonus-value').innerHTML = fruit.bonus;
            showMsg(`🍎 USOU ${fruit.nome}! +${fruit.bonus}% de chance!`, "#a5d6a5");
            if (currentWildPokemon) atualizarChanceAtual();
        } else showMsg(`💰 MOEDAS INSUFICIENTES para ${fruit.nome}!`, "#ffae70");
    }
    
    function comprarPokebola(tipo) {
        if (money >= tipo.preco) {
            money -= tipo.preco;
            pokeballs++;
            currentPokeballType = tipo;
            atualizarUI();
            showMsg(`🟢 COMPROU ${tipo.nome}! +${tipo.bonus}% de chance!`, "#a5d6a5");
            if (currentWildPokemon) atualizarChanceAtual();
        } else showMsg(`💰 MOEDAS INSUFICIENTES para ${tipo.nome}!`, "#ffae70");
    }
    
    async function atualizarChanceAtual() {
        if (!currentWildPokemon) return;
        let totalStats = 0, hpStat = 0;
        currentWildPokemon.stats.forEach(s => { totalStats += s.base_stat; if(s.stat.name === 'hp') hpStat = s.base_stat; });
        const chance = calcularChanceCaptura(totalStats, hpStat);
        document.getElementById('capture-chance').innerHTML = `${chance}%`;
        document.getElementById('chance-bar').style.width = `${chance}%`;
        document.getElementById('chance-bar').style.background = chance > 60 ? '#5fba6a' : (chance > 30 ? '#fbbf24' : '#ef4444');
    }
    
    function showMsg(msg, color) {
        const msgDiv = document.getElementById('capture-message');
        msgDiv.innerHTML = msg;
        msgDiv.style.color = color;
        msgDiv.classList.remove('hidden');
        setTimeout(() => msgDiv.classList.add('hidden'), 2000);
    }
    
    function atualizarUI() {
        document.getElementById('money-amount').innerText = money;
        document.getElementById('pokeball-count').innerText = pokeballs;
        if (document.getElementById('shop-money')) document.getElementById('shop-money').innerText = money;
        if (document.getElementById('shop-pokeballs')) document.getElementById('shop-pokeballs').innerText = pokeballs;
    }
    
    function carregarLoja() {
        const fruitsDiv = document.getElementById('fruits-shop');
        fruitsDiv.innerHTML = "";
        fruits.forEach(fruit => {
            const div = document.createElement('div');
            div.className = `shop-item bg-[#3e5630] rounded-lg p-2 text-center text-xs ${activeFruit?.id === fruit.id ? 'fruit-active' : ''}`;
            div.innerHTML = `<div>${fruit.nome}</div><div class="text-[#ffd966]">+${fruit.bonus}%</div><div>💰 ${fruit.preco}</div>`;
            div.onclick = () => usarFruta(fruit);
            fruitsDiv.appendChild(div);
        });
        const pokeballsDiv = document.getElementById('pokeballs-shop');
        pokeballsDiv.innerHTML = "";
        pokeballsTypes.forEach(ball => {
            const div = document.createElement('div');
            div.className = `shop-item bg-[#3e5630] rounded-lg p-2 text-center text-xs ${currentPokeballType?.id === ball.id ? 'fruit-active' : ''}`;
            div.innerHTML = `<div>${ball.nome}</div><div class="text-[#ffd966]">+${ball.bonus}%</div><div>💰 ${ball.preco}</div>`;
            div.onclick = () => comprarPokebola(ball);
            pokeballsDiv.appendChild(div);
        });
    }
    
    // ===================== POKÉDEX =====================
    const tipoEmPortugues = { fire: "Fogo", water: "Água", grass: "Planta", electric: "Elétrico", psychic: "Psíquico", ice: "Gelo", fighting: "Lutador", poison: "Venenoso", ground: "Terra", flying: "Voador", bug: "Inseto", rock: "Pedra", ghost: "Fantasma", dragon: "Dragão", dark: "Sombrio", steel: "Aço", fairy: "Fada", normal: "Normal" };
    const typeColors = { fire: "bg-orange-600", water: "bg-blue-600", grass: "bg-green-700", electric: "bg-yellow-400 text-black", psychic: "bg-pink-500", ice: "bg-cyan-400 text-black", fighting: "bg-red-800", poison: "bg-purple-700", ground: "bg-amber-700", flying: "bg-indigo-500", bug: "bg-lime-700", rock: "bg-stone-600", ghost: "bg-violet-900", dragon: "bg-indigo-900", dark: "bg-gray-800", steel: "bg-gray-500", fairy: "bg-pink-300 text-black", normal: "bg-neutral-500" };
    
    async function renderizarPokemon(pokemon) {
        if (!pokemon) return;
        document.getElementById('pokemon-name').innerText = pokemon.name.charAt(0).toUpperCase() + pokemon.name.slice(1);
        document.getElementById('pokemon-img').src = pokemon.sprites?.other?.["official-artwork"]?.front_default || pokemon.sprites?.front_default;
        document.getElementById('pokemon-height').innerText = (pokemon.height/10).toFixed(1);
        document.getElementById('pokemon-weight').innerText = (pokemon.weight/10).toFixed(1);
        const typesDiv = document.getElementById('types-container');
        typesDiv.innerHTML = "";
        pokemon.types.forEach(t => { const badge = document.createElement('span'); badge.className = `type-badge ${typeColors[t.type.name]} text-white`; badge.innerText = tipoEmPortugues[t.type.name] || t.type.name; typesDiv.appendChild(badge); });
        const statsDiv = document.getElementById('stats-list');
        statsDiv.innerHTML = "";
        pokemon.stats.forEach(stat => { const percent = Math.min(100, (stat.base_stat/200)*100); const div = document.createElement('div'); div.className = "flex items-center gap-1 text-[0.5rem]"; div.innerHTML = `<span class="text-[#e6dbb5] w-20">${stat.stat.name.toUpperCase()}</span><span class="text-white w-6">${stat.base_stat}</span><div class="stat-bar-bg flex-1"><div class="stat-fill" style="width:${percent}%"></div></div>`; statsDiv.appendChild(div); });
    }
    
    async function atualizarPokedex(id) { const p = await fetchPokemonData(id); if(p) renderizarPokemon(p); }
    
    // ===================== NAVEGAÇÃO =====================
    function ativarAba(aba) {
        document.getElementById('pokedex-tab').classList.add('hidden');
        document.getElementById('collection-tab').classList.add('hidden');
        document.getElementById('capture-tab').classList.add('hidden');
        document.getElementById('shop-tab').classList.add('hidden');
        document.getElementById('search-tab').classList.add('hidden');
        if (aba === 'pokedex') document.getElementById('pokedex-tab').classList.remove('hidden');
        else if (aba === 'collection') document.getElementById('collection-tab').classList.remove('hidden');
        else if (aba === 'capture') document.getElementById('capture-tab').classList.remove('hidden');
        else if (aba === 'shop') document.getElementById('shop-tab').classList.remove('hidden');
        else document.getElementById('search-tab').classList.remove('hidden');
        
        [tabPokedex, tabCollection, tabCapture, tabShop, tabSearch].forEach(btn => { btn.classList.remove('active', 'bg-[#b8c49a]', 'text-[#1f2c0a]'); btn.classList.add('bg-[#5a6e48]', 'text-[#efe6c9]'); });
        if (aba === 'pokedex') { tabPokedex.classList.add('active', 'bg-[#b8c49a]', 'text-[#1f2c0a]'); atualizarPokedex(currentId); }
        else if (aba === 'collection') { tabCollection.classList.add('active', 'bg-[#b8c49a]', 'text-[#1f2c0a]'); renderCollection(); }
        else if (aba === 'capture') { tabCapture.classList.add('active', 'bg-[#b8c49a]', 'text-[#1f2c0a]'); if(!currentWildPokemon) novoEncontro(); }
        else if (aba === 'shop') { tabShop.classList.add('active', 'bg-[#b8c49a]', 'text-[#1f2c0a]'); carregarLoja(); atualizarUI(); }
        else { tabSearch.classList.add('active', 'bg-[#b8c49a]', 'text-[#1f2c0a]'); }
    }
    
    const tabPokedex = document.getElementById('tab-pokedex-btn');
    const tabCollection = document.getElementById('tab-collection-btn');
    const tabCapture = document.getElementById('tab-capture-btn');
    const tabShop = document.getElementById('tab-shop-btn');
    const tabSearch = document.getElementById('tab-search-btn');
    
    tabPokedex.addEventListener('click', () => ativarAba('pokedex'));
    tabCollection.addEventListener('click', () => ativarAba('collection'));
    tabCapture.addEventListener('click', () => ativarAba('capture'));
    tabShop.addEventListener('click', () => ativarAba('shop'));
    tabSearch.addEventListener('click', () => ativarAba('search'));
    document.getElementById('prev-btn').addEventListener('click', async () => { currentId = currentId-1 < 1 ? MAX_ID : currentId-1; await atualizarPokedex(currentId); ativarAba('pokedex'); });
    document.getElementById('next-btn').addEventListener('click', async () => { currentId = currentId+1 > MAX_ID ? 1 : currentId+1; await atualizarPokedex(currentId); ativarAba('pokedex'); });
    document.getElementById('throw-pokeball-btn').addEventListener('click', lancarPokebola);
    document.getElementById('new-encounter-btn').addEventListener('click', novoEncontro);
    document.getElementById('search-btn').addEventListener('click', async () => { const query = document.getElementById('search-input').value.trim().toLowerCase(); if (!query) return; const p = await fetchPokemonData(query); if(p) { await renderizarPokemon(p); ativarAba('pokedex'); document.getElementById('search-message').classList.add('hidden'); } else { document.getElementById('search-message').innerText = `"${query}" não encontrado!`; document.getElementById('search-message').classList.remove('hidden'); } });
    document.getElementById('clear-search-btn').addEventListener('click', () => { document.getElementById('search-input').value = ""; document.getElementById('search-message').classList.add('hidden'); });
    
    loadCollection();
    atualizarPokedex(1);
    atualizarUI();
    document.getElementById('active-fruit-name').innerHTML = "NENHUMA";
</script>
</body>
</html>