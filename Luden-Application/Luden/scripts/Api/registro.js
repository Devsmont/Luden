document.querySelector('#registroForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission
    register()
});

function register(){
    const name = document.getElementById('name').value;
    const email = document.getElementById('r-email').value;
    const password = document.getElementById('r-password').value;
    const confirm_password = document.getElementById('confirm-password').value;
    
    fetch('http://127.0.0.1:8000/api/v1/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            name: name,
            email: email,
            password: password,
            confirm_password: confirm_password
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
        alert('Registration successful!');
        window.location.href = 'login.html';
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Registration failed');
    });
}
