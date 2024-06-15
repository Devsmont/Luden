function validateToken(){
    const token = localStorage.getItem('token');
    if(!token){
        window.location.href = 'login.html';
        return;
    }

    fetch('http://127.0.0.1:8000/api/v1/validate-token', {
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token 
        }
    })
    .then(response => {
        if (!response.ok) {
            window.location.href = 'login.html';
        }
    }).catch((error) => {
        console.error('Network or server error:', error);
        window.location.href = 'login.html';
    })
}

document.addEventListener('DOMContentLoaded', () => {
    validateToken();
});
