export default class AuthService{
    async login(data){
        // let data = JSON.stringify({
        //     "username": data.username,
        //     "password": data.password
        // })

        // let data = JSON.stringify({
        //     "username": "user_josh",
        //     "password": "test123"
        // });
        let config = {
            method: 'post',
            maxBodyLength: Infinity,
            url: '/fuldev/users/api_login',
            headers: { 
                'Content-Type': 'application/json',
            },
            data : data
        };

        let response = await axios.request(config)

        return response
    }

    async register(data){
        let config = {
            method: 'post',
            maxBodyLength: Infinity,
            url: '/fuldev/users/api_create',
            headers: { 
                'Content-Type': 'application/json',
            },
            data : data
        };

        let response = await axios.request(config)

        return response
    }
}

const authService = new AuthService();
export { authService }