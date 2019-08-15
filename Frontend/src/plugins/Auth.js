import axios from 'axios';

export default function (Vue) {
  Vue.auth = {
    /**
     * Login user
     *
     * @param {string} email
     * @param {string} password
     */
    login(email, password) {
      let vm = this;

      let params = { email, password };

      let promise = new Promise((resolve, reject) => {
        axios.post('https://api.fun-gifs.ru/api/login', params)
          .then(response => {
            console.log(response.data);
            if (response.data.access_token !== undefined) {
              vm.setToken(
                response.data.access_token,
              );
            }
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });

      return promise;
    },

    /**
     * Logout user by destroying token
     */
    logout() {
      this.destroy();
    },

    /**
     * Check if user is authenticated
     */
    async check() {

      let access_token = await this.getToken();

      if (access_token) {
        axios.defaults.baseURL = "https://api.fun-gifs.ru/api/checkaccesstoken";
        return true;
      } else {
        return false;
      }
    },

    /**
     * Set new access and refresh token
     *
     * @param {string} access_token
     */
    setToken(access_token) {
      localStorage.setItem('access_token', access_token);
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + access_token;
      axios.defaults.baseURL = 'https://api.fun-gifs.ru/api/';

    },

    /**
     * Get access token or if it has expired
     * get a new one using refresh token
     */
    async getToken() {
      let access_token = localStorage.getItem('access_token');

      if (!access_token) {
        return null;
      }
      return access_token;
    },

    /**
     * Clear tokens from local storage
     */
    destroy() {
      localStorage.removeItem('access_token');
    },
  }

  Object.defineProperties(Vue.prototype, {
    $auth: {
      get() {
        return Vue.auth;
      }
    }
  });
}
