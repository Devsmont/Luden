function logout() {
    fetch('http://127.0.0.1:8000/api/v1/logout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text) });
        }
        window.location.href = 'login.html';
    })
    .catch(error => {
        console.error('Error:', error);
    });
}