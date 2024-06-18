import { createCharacter, getCharacterById, updateCharacter } from './Api/characters.js';
import { getRpgSystems } from './Api/rpg-system.js'
import { getSkills } from './Api/skills.js';

let url = window.location.href;

// Parseia a URL para obter os parâmetros
let urlParams = new URLSearchParams(url.split('?')[1]);

// Obtém o valor do parâmetro 'id'
let id = urlParams.get('id');

document.addEventListener('DOMContentLoaded', loadRpgSystem)
document.getElementById('character-rpg-system').addEventListener('change', loadSkills);
document.getElementById('character-form').addEventListener('submit', (e) =>{
    e.preventDefault()
    if(id){
        updateData(id)
    }else{
        submitData()
    }
})


// Exibe o valor do parâmetro 'id' no console
if (id) {
    document.getElementById('titulo-personagem').innerText = 'EDITANDO PERSONAGEM'
    try {
        const character = await getCharacterById(id);
        const select =  document.getElementById('character-skill');
        console.log(character);
        document.getElementById('character-name').value = character.name;
        document.getElementById('visibility').value = character.visibility;
        document.getElementById('character-description').value = character.description;
        
        // Formatar data para o formato yyyy-mm-dd
        if (character.birth_date) {
            var birthDate = new Date(character.birth_date);
            var formattedBirthDate = birthDate.toISOString().split('T')[0];
            document.getElementById('character-birth-date').value = formattedBirthDate;
        }

        document.getElementById('character-image').value = character.image_url;
        document.getElementById('character-status').value = character.status;

    } catch (error) {
        console.log(error);
    }
}

async function loadRpgSystem(){
    const select =  document.getElementById('character-rpg-system');

    try
    {
        const rpgsSystems = await getRpgSystems()

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
        alert('Personagem criado com sucesso');
        window.location.href = 'home.html';
    }catch(error){
        console.log(error);
        alert('Falha ao criar personagem');
    }
    
}

async function updateData(id) {
    const character = {
        name: document.getElementById('character-name').value,
        visibility: document.getElementById('visibility').value,
        description:document.getElementById('character-description').value,
        birth_date: document.getElementById('character-birth-date').value,
        image_url: document.getElementById('character-image').value,
        status: document.getElementById('character-status').value,
        skills: skillList 
    }

    try {
        await updateCharacter(character, id);
        alert('Personagem atualizado com sucesso');
        window.location.href = 'home.html';
    } catch (error) {
        alert('Ocorreu um erro ao Atualizar um usuario');
    }
}