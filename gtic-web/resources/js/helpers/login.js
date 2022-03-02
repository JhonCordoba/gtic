import axios from "axios";

export async function isAuthenticated() {
    let response;
    try {
        response = await axios({
            method: "POST",
            url: `${Window.API_URL}/auth/me`,
            headers: {
                Authorization: `Bearer ${localStorage.getItem(
                    "token_auth_api"
                )}`
            },
            data: {}
        });
    } catch (error) {
        console.log(error);
    }

    return !_.isEmpty(response.data);
}
