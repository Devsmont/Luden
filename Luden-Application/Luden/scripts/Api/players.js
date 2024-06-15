const baseUrl = 'http://127.0.0.1:8000/api/v1/';

export function getPlayers() {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'players', {
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

export function getPlayersById(id) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'players/' + id, {
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

export function createPlayer(player) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'players', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        },
        body: JSON.stringify(player)
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

export function updatePlayer(player, id) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'players/' + id, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        },
        body: JSON.stringify(player)
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

export function deletePlayer(id) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'players/' + id, {
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
