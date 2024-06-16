import { createRpgSystem } from './Api/rpg-system.js'
import { createSkill } from './Api/skills.js';

document.getElementById('rpg-system-form').addEventListener('submit', (e) => {
    e.preventDefault();
    submitData();
});

const skillList = []
function addSkill(){
    const skill = document.getElementById('rpg-system-skill')
    if(skill.value == ''){
        alert('preencha a skill')
    }
    else{
        skillList.push(skill.value);
        console.log(skill.value);
        alert('skill adicionada');
        skill.value = '';
        skill.focus();
    }
}

document.getElementById('btn-add-skill-system').addEventListener('click',addSkill)

async function submitData() {
    const rpgSystem = {
        name: document.getElementById('rpg-system-name').value,
        skill_dice: document.getElementById('rpg-system-dice').value,
        description: document.getElementById('rpg-system-description').value,
        image_url: document.getElementById('rpg-system-image').value
    }

    try {
        console.log(rpgSystem)
        const rpgSystemRes = await createRpgSystem(rpgSystem);
        console.log(rpgSystemRes);
        for (const skill of skillList) {
            await createSkill({
                rpg_system_id:rpgSystemRes.id,
                name: skill
            });
        }
        alert('criado com sucesso');
    } catch (error) {
        console.log(error)
        alert('ocorreu um erro ao cadastrar um usuario');
    }
}