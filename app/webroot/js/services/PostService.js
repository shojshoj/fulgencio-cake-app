export default class Postservice {
    async getAllPosts(){
        let config = {
            method: 'get',
            maxBodyLength: Infinity,
            url: '/fuldev/posts/api_get_all'
        };
        let response = await axios.request(config)
        return response
    }

    async getUserPosts(){
        let config = {
            method: 'get',
            maxBodyLength: Infinity,
            url: '/fuldev/user/posts/api_get_all'
        };
        let response = await axios.request(config)
        return response
    }
}

const postService = new Postservice()
export { postService }