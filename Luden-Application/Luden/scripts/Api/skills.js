function getSkills(){
    const token = localStorage.getItem('token');
    const selectSkills = document.querySelector('#select-skills')

    if(!token){
        window.location.href = 'login.html';
        return;
    }

    fetch('http://127.0.0.1:8000/api/v1/skills', {
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token 
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text) });
        }
        return response.json();
    })
    .then(data => {
        const skills = data.data

        skills.forEach(element => {
            const option = document.createElement('option');
            option.value = element.id;
            option.innerText = element.name;
            selectSkills.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Login failed: ' + error.message);
    });
}

document.addEventListener('DOMContentLoaded', getSkills());