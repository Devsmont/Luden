import { getRpgSystems } from './Api/rpg-system.js';
import { createRpg, getRpgById, updateRpg } from './Api/rpgs.js';


let url = window.location.href;

// Parseia a URL para obter os parâmetros
let urlParams = new URLSearchParams(url.split('?')[1]);

// Obtém o valor do parâmetro 'id'
let id = urlParams.get('id');

document.addEventListener('DOMContentLoaded', loadRpgSystem);
document.getElementById('rpg-form').addEventListener('submit', 
    (e) => {
        e.preventDefault()
        if(id){
            updateData(id);
        }else{
            submitData();
        }
    }
);

if (id) {
    document.getElementById('titulo-rpg').innerText = 'EDITANDO RPG'
    try {
        const rpg = await getRpgById(id);
        document.getElementById('rpg-image').value = rpg.image_url
        document.getElementById('rpg-description').value = rpg.description
        document.getElementById('rpg-rpg-system').value = rpg.rpg_system_id
        document.getElementById('rpg-name').value = rpg.name;

    } catch (error) {
        console.log(error);
    }
}

async function loadRpgSystem() {
    try {
        const rpgSystems = await getRpgSystems();
        const select = document.getElementById('rpg-rpg-system');

        rpgSystems.map(rpgSystem => {
            const option = document.createElement('option');
            option.value = rpgSystem.id;
            option.innerText = rpgSystem.name;

            select.appendChild(option);
        });
    } catch (error) {
        console.log(error);
    }
}

async function submitData(event) {
    const rpg = {
        rpg_system_id: document.getElementById('rpg-rpg-system').value,
        name: document.getElementById('rpg-name').value,
        description: document.getElementById('rpg-description').value,
        image_url: document.getElementById('rpg-image').value
    };

    try {
        await createRpg(rpg);
        alert('RPG criado com sucesso');
        window.location.href = 'home.html';
    } catch (error) {
        console.log(error);
    }
}

async function updateData(id){
    const rpg = {
        rpg_system_id: document.getElementById('rpg-rpg-system').value,
        name: document.getElementById('rpg-name').value,
        description: document.getElementById('rpg-description').value,
        image_url: document.getElementById('rpg-image').value
    };

    try{
        await updateRpg(id)
        alert('Rpg atualizado com sucesso');
        window.href.location = 'home.html';
    }catch(error){
        alert('Ocorreu um erro ao atualizar o rpg');
        console.log(error)
    }
}