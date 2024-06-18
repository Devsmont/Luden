import { getCharacters, deleteCharacter } from "./Api/characters.js";
import { deleteRpgSystem, getRpgSystems } from "./Api/rpg-system.js";
import { getRpgs, deleteRpg } from "./Api/rpgs.js";
import iniciaCarousel from "./carousel-owl/setup.js";

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
        card.id = 'rpg-card-' + rpg.id;
        card.classList.add('card');
        card.innerHTML = `
                <img src="${rpg.image_url}" class="card-image-top carrosel">
                <div class="card-body">
                    <h5 class="card-title">${rpg.name}</h5>
                    <button class="btn-card" style="width: 100%;" onclick="editRpg(${rpg.id})">Editar</button>
                    <button class="btn-card" style="width: 100%;" onclick="deleteRpg(${rpg.id})">Deletar</button>
                </div>
            `;
        carouselRpgs.appendChild(card);
    });
}

function loadCarouselRpgSystemData(rpgSystems) {
    const carouselRpgSystems = document.getElementById('carousel-rpg-system');
    rpgSystems.forEach(rpgSystem => {
        const card = document.createElement('div');
        card.id = 'rpg-system-card-' + rpgSystem.id;
        card.classList.add('card');
        card.innerHTML = `
                <img src="${rpgSystem.image_url}" class="card-image-top carrosel">
                <div class="card-body">
                    <h5 class="card-title">${rpgSystem.name}</h5>
                    <button class="btn-card" style="width: 100%;" onclick="editRpgSystem(${rpgSystem.id})">Editar</button>
                    <button class="btn-card" style="width: 100%;" onclick="deleteRpgSystem(${rpgSystem.id})">Deletar</button>
                </div>
            `;
        carouselRpgSystems.appendChild(card);
    });
}

function loadCarouselCharacterData(characters) {
    const carouselCharacters = document.getElementById('carousel-characters');
    characters.forEach(character => {
        const card = document.createElement('div');
        card.id = 'character-card-' + character.id;
        card.classList.add('card');
        card.innerHTML = `
                <img src="${character.image_url}" class="card-image-top carrosel">
                <div class="card-body">
                    <h5 class="card-title">${character.name}</h5>
                    <button class="btn-card" style="width: 100%;" onclick="editCharacter(${character.id})">Editar</button>
                    <button class="btn-card" style="width: 100%;" onclick="deleteCharacter(${character.id})">Deletar</button>
                </div>
            `;
        carouselCharacters.appendChild(card);
    });
}

window.editRpg = function (id) {
    console.log('Edit RPG:', id);
    window.location.href = `cadastroRPG.html?id=${id}`;
}

window.editRpgSystem = function (id) {
    console.log('Edit RPG System:', id);
    window.location.href = `CadastroSistemas.html?id=${id}`;
}

window.editCharacter = function (id) {
    console.log('Edit Character:', id);
    window.location.href = `CadastroPersonagens.html?id=${id}`;
}

window.deleteRpg = async function (id) {
    try {
        console.log('Delete RPG:', id);
        await deleteRpg(id);
        document.getElementById('rpg-card-' + id).remove();
    } catch (error) {
        console.error('Erro ao deletar RPG:', error);
        // Tratamento de erro, se necessário
    }
}

window.deleteRpgSystem = async function (id) {
    try {
        console.log('Delete RPG System:', id);
        await deleteRpgSystem(id);
        alert('Sistema de RPG deletado');
        document.getElementById('rpg-system-card-' + id).remove();
    } catch (error) {
        alert('Erro ao deletar o sistema de RPG');
        console.error('Erro ao deletar sistema de RPG:', error);
        // Tratamento de erro, se necessário
    }
}

window.deleteCharacter = async function (id) {
    try {
        console.log('Delete Character:', id);
        await deleteCharacter(id);
        document.getElementById('character-card-' + id).remove();
    } catch (error) {
        console.error('Erro ao deletar personagem:', error);
        // Tratamento de erro, se necessário
    }
}




