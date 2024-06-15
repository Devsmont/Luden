const baseUrl = 'http://127.0.0.1:8000/api/v1/';

export function getRpgSystems() {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'rpgSystems', {
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

export function getRpgSystemById(id) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'rpgSystems/' + id, {
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

export function createRpgSystem(rpgSystem) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'rpgSystems', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        },
        body: JSON.stringify(rpgSystem)
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

export function updateRpgSystem(rpgSystem, id) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'rpgSystems/' + id, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        },
        body: JSON.stringify(rpgSystem)
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

export function deleteRpgSystem(id) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'rpgSystems/' + id, {
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
