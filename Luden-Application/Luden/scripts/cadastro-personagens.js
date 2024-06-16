import { createCharacter } from './Api/characters.js';
import { getRpgSystems } from './Api/rpg-system.js'
import { getSkills } from './Api/skills.js';

document.addEventListener('DOMContentLoaded', loadRpgSystem)
document.getElementById('character-rpg-system').addEventListener('change', loadSkills);
document.getElementById('character-form').addEventListener('submit', (e) =>{
    e.preventDefault()
    submitData()
})

async function loadRpgSystem(){
    const select =  document.getElementById('character-rpg-system');

    try
    {
        const rpgsSystems = await getRpgSystems()
        console.log(rpgsSystems);

        rpgsSystems.map(rpgsSystem => {
            const option  = document.createElement('option');
            option.value = rpgsSystem.id;
            option.innerText = rpgsSystem.name;
            select.appendChild(option);
        });

    }catch(error){
        console.log(error);
    }
}

async function loadSkills(){
    const select =  document.getElementById('character-skill');
    const rpgsSystemId = document.getElementById('character-rpg-system').value

    try
    {
        const skills = await getSkills()
        let filteredSkills = skills.filter(skill => skill.rpg_system.id == rpgsSystemId)
        select.innerHTML = ''

        filteredSkills.map(skill => {
            const option  = document.createElement('option');
            option.value = skill.id;
            option.innerText = skill.name;
            select.appendChild(option);
        });

    }catch(error){
        console.log(error);
    }
}
const skillList  = []

function addSkill() {
    const skill = {
        id: document.getElementById('character-skill').value,
        value: document.getElementById('character-skill-value').value
    }


    if(skill.id == '#' || skill.value == ''){
        alert('Preencha uma skill');
    }else{
        skillList.push(skill)
        console.log(skillList)
    }
}

document.getElementById('btn-add-skill').addEventListener('click',addSkill);

async function submitData() {
    const character = {
        name: document.getElementById('character-name').value,
        visibility: document.getElementById('visibility').value,
        description:document.getElementById('character-description').value,
        birth_date: document.getElementById('character-birth-date').value,
        image_url: document.getElementById('character-image').value,
        status: document.getElementById('character-status').value,
        skills: skillList 
    }

    try{
        await createCharacter(character);
        alert('personagem criado com sucesso');
    }catch(error){
        console.log(error);
    }
    
}