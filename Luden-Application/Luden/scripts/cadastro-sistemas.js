import { createRpgSystem, getRpgSystemById, updateRpgSystem } from './Api/rpg-system.js'
import { createSkill } from './Api/skills.js';

// Obtém a URL atual
let url = window.location.href;

// Parseia a URL para obter os parâmetros
let urlParams = new URLSearchParams(url.split('?')[1]);

// Obtém o valor do parâmetro 'id'
let id = urlParams.get('id');

// Exibe o valor do parâmetro 'id' no console
if (id) {
    document.getElementById('titulo-sistema').innerText = 'EDITANDO SISTEMA'
    try {
        const rpgSystem = await getRpgSystemById(id);
        console.log(rpgSystem);
        document.getElementById('rpg-system-name').value = rpgSystem.name
        document.getElementById('rpg-system-dice').value = rpgSystem.skill_dice
        document.getElementById('rpg-system-description').value = rpgSystem.description
        document.getElementById('rpg-system-image').value = rpgSystem.image_url

    } catch (error) {
        console.log(error);
    }
}


document.getElementById('rpg-system-form').addEventListener('submit', (e) => {
    e.preventDefault();
    if (id) {
        updateData(id);
    } else {
        submitData()
    }
});

const skillList = []
function addSkill() {
    const skill = document.getElementById('rpg-system-skill')
    if (skill.value == '') {
        alert('preencha a skill')
    }
    else {
        skillList.push(skill.value);
        console.log(skill.value);
        alert('skill adicionada');
        skill.value = '';
        skill.focus();
    }
}

document.getElementById('btn-add-skill-system').addEventListener('click', addSkill)

async function submitData() {
    const rpgSystem = {
        name: document.getElementById('rpg-system-name').value,
        skill_dice: document.getElementById('rpg-system-dice').value,
        description: document.getElementById('rpg-system-description').value,
        image_url: document.getElementById('rpg-system-image').value
    }

    try {
        const rpgSystemRes = await createRpgSystem(rpgSystem);
        for (const skill of skillList) {
            await createSkill({
                rpg_system_id: rpgSystemRes.id,
                name: skill
            });
        }
        alert('Sistema criado com sucesso');
        window.location.href = 'home.html';
    } catch (error) {
        console.log(error)
        alert('ocorreu um erro ao cadastrar um usuario');
    }
}

async function updateData(id) {
    const rpgSystem = {
        name: document.getElementById('rpg-system-name').value,
        skill_dice: document.getElementById('rpg-system-dice').value,
        description: document.getElementById('rpg-system-description').value,
        image_url: document.getElementById('rpg-system-image').value
    }

    try {
        await updateRpgSystem(rpgSystem, id);
        alert('Sistema atualizado com sucesso');
        window.location.href = 'home.html';
    } catch (error) {
        alert('ocorreu um erro ao cadastrar um usuario');
    }
}