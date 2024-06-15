import { createRpgSystem } from './Api/rpg-system.js'

document.getElementById('rpg-system-form').addEventListener('submit', (e) => {
    e.preventDefault();
    submitData();
});

async function submitData() {
    const rpgSystem = {
        name: document.getElementById('rpg-system-name').value,
        skill_dice: document.getElementById('rpg-system-dice').value,
        description: document.getElementById('rpg-system-description').value,
        image_url: document.getElementById('rpg-system-image').value
    }

    try {
        console.log(rpgSystem)
        await createRpgSystem(rpgSystem);
        //trocar por modal
        alert('criado com sucesso');
    } catch (error) {
        console.log(error)
        alert('ocorreu um erro ao cadastrar um usuario');
    }
}