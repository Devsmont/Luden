const baseUrl = 'http://127.0.0.1:8000/api/v1/';

export function getCharacters() {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'characters', {
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text); });
        }
        return response.json();
    })
    .then(data => {
        return data.data;
    })
    .catch(error => {
        console.error('Error:', error);
        throw error;
    });
}

export function getCharacterById(id) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'characters/' + id, {
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text); });
        }
        return response.json();
    })
    .then(data => {
        return data.data;
    })
    .catch(error => {
        console.error('Error:', error);
        throw error;
    });
}

export function createCharacter(character) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'characters', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        },
        body: JSON.stringify(character)
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text); });
        }
        return response.json();
    })
    .then(resData => {
        return resData.data;
    })
    .catch(error => {
        console.error('Error:', error);
        throw error;
    });
}

export function updateCharacter(character, id) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'characters/' + id, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        },
        body: JSON.stringify(character)
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text); });
        }
        return response.json();
    })
    .then(resData => {
        return resData.data;
    })
    .catch(error => {
        console.error('Error:', error);
        throw error;
    });
}

export function deleteCharacter(id) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'characters/' + id, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text); });
        }
        return response.json();
    })
    .then(resData => {
        return resData.data;
    })
    .catch(error => {
        console.error('Error:', error);
        throw error;
    });
}
