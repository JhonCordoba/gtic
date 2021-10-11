import axios from 'axios';

let getTareasPendientes = () => {

    return axios.get(`${Window.API_URL}/tareas/pendientes`, {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem("token_auth_api")}`
        }
      });

}

export{
    getTareasPendientes
}