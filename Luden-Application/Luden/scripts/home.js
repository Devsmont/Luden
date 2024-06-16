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
        const div = document.createElement('div');
        const img = document.createElement('img');
        img.src = rpg.image_url;
        img.className = 'carrosel';
        div.appendChild(img);
        carouselRpgs.appendChild(div);
    });
}

function loadCarouselRpgSystemData(rpgSystems) {
    const carouselRpgSystems = document.getElementById('carousel-rpg-system');
    rpgSystems.forEach(rpgSystem => {
        const div = document.createElement('div');
        const img = document.createElement('img');
        img.src = rpgSystem.image_url;
        img.className = 'carrosel';
        div.appendChild(img);
        carouselRpgSystems.appendChild(div);
    });
}

function loadCarouselCharacterData(characters) {
    const carouselCharacters = document.getElementById('carousel-characters');
    characters.forEach(character => {
        const div = document.createElement('div');
        const img = document.createElement('img');
        img.src = character.image_url;
        img.className = 'carrosel';
        div.appendChild(img);
        carouselCharacters.appendChild(div);
    });
}
