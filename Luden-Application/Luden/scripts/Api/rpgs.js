function getRpgs(){
    const token = localStorage.getItem('token');
    if(!token){
        window.location.href = 'login.html';
        return;
    }

    fetch('http://127.0.0.1:8000/api/v1/rpgs', {
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
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Login failed: ' + error.message);
    });
}

document.addEventListener('DOMContentLoaded', getRpgs());