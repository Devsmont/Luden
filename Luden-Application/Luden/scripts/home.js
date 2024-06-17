import { getCharacters } from "./Api/characters.js";
import { getRpgSystems } from "./Api/rpg-system.js";
import { getRpgs } from "./Api/rpgs.js";
import iniciaCarousel  from "./carousel-owl/setup.js";

document.addEventListener('DOMContentLoaded', loadCarouselData);

async function loadCarouselData() {
    try {
        const [rpgs, rpgSystems, characters] = await Promise.all([
            getRpgs(),
            getRpgSystems(),
            getCharacters()
        ]);

        loadCarouselRpgData(rpgs);
        loadCarouselRpgSystemData(rpgSystems);
        loadCarouselCharacterData(characters);

        iniciaCarousel();
    } catch (error) {
        console.error('Erro ao carregar os dados do carrossel:', error);
    }
}

function loadCarouselRpgData(rpgs) {
    const carouselRpgs = document.getElementById('carousel-rpgs');
    rpgs.forEach(rpg => {
        const card = document.createElement('div');
        card.innerHTML = ` <div class="card">
                                <img src="${rpg.image_url}" class="card-image-top carrosel">
                                <div class="card-body">
                                <h5 class="card-title">${rpg.name}</h5>
                                <button class="btn-card" style="width: 100%;">Editar</button>
                                <button class="btn-card" style="width: 100%;">Deletar</button>
                                </div>
                            </div>`
        carouselRpgs.appendChild(card);
    });
}

function loadCarouselRpgSystemData(rpgSystems) {
    const carouselRpgSystems = document.getElementById('carousel-rpg-system');
    rpgSystems.forEach(rpgSystem => {
        const card = document.createElement('div');
        card.innerHTML = ` <div class="card">
                               <img src="${rpgSystem.image_url}" class="card-image-top carrosel">
                                <div class="card-body">
                                <h5 class="card-title">${rpgSystem.name}</h5>
                                <button class="btn-card" style="width: 100%;">Editar</button>
                                <button class="btn-card" style="width: 100%;">Deletar</button>
                                </div>
                            </div>`
        carouselRpgSystems.appendChild(card);
    });
}

function loadCarouselCharacterData(characters) {
    const carouselCharacters = document.getElementById('carousel-characters');
    characters.forEach(character => {
        const card = document.createElement('div');
        card.innerHTML = ` <div class="card">
                                <img src="${character.image_url}" class="card-image-top carrosel">
                                <div class="card-body">
                                <h5 class="card-title">${character.name}</h5>
                                <button class="btn-card" style="width: 100%;">Editar</button>
                                <button class="btn-card" style="width: 100%;">Deletar</button>
                                </div>
                            </div>`
        carouselCharacters.appendChild(card);
    });
}

