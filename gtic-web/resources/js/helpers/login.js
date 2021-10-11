import axios from 'axios';

export async function isAuthenticated() {

    let response = await axios({
        method: "POST",
        url: `${Window.API_URL}/auth/me`,
        headers: {
            Authorization: `Bearer ${localStorage.getItem("token_auth_api")}`
        },
        data: {}
    });
    return !_.isEmpty(response.data);
}
