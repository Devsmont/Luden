document.querySelector('#loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    login()
});

function login(){
    const email = document.getElementById('l-email').value;
    const password = document.getElementById('l-password').value;
    
    fetch('http://127.0.0.1:8000/api/v1/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            email: email,
            password: password,
        })
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text) });
        }
        return response.json();
    })
    .then(data => {
        console.log(data);
        localStorage.setItem('token', data.data.token);
        window.location.href = 'home.html';
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Login failed: ' + error.message);
    });
}