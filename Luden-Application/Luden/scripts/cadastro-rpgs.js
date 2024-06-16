import { getRpgSystems } from './Api/rpg-system.js';
import { createRpg } from './Api/rpgs.js';

document.addEventListener('DOMContentLoaded', loadRpgSystem);
document.getElementById('rpg-form').addEventListener('submit', submitData);

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
    event.preventDefault(); // Prevent the form from submitting the traditional way

    const rpg = {
        rpg_system_id: document.getElementById('rpg-rpg-system').value,
        name: document.getElementById('rpg-name').value,
        description: document.getElementById('rpg-description').value,
        image_url: document.getElementById('rpg-image').value
    };

    try {
        console.log(rpg);
        await createRpg(rpg);
        alert('RPG criado com sucesso');
    } catch (error) {
        console.log(error);
    }
}
