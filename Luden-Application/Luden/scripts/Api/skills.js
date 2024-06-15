const baseUrl = 'http://127.0.0.1:8000/api/v1/';

export function getSkills() {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'skills', {
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

export function getSkillById(id) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'skills/' + id, {
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

export function createSkill(skill) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'skills', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        },
        body: JSON.stringify(skill)
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

export function updateSkill(skill, id) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'skills/' + id, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        },
        body: JSON.stringify(skill)
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

export function deleteSkill(id) {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = 'login.html';
        return;
    }

    return fetch(baseUrl + 'skills/' + id, {
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
