const baseUrl = 'http://127.0.0.1:8000/api/v1/';

export function getSessions() {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'sessions', {
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

export function getSessionsById(id) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'sessions/' + id, {
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

export function createSession(session) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'sessions', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        },
        body: JSON.stringify(session)
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

export function updateSession(session, id) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'sessions/' + id, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        },
        body: JSON.stringify(session)
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

export function deleteSession(id) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'sessions/' + id, {
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
