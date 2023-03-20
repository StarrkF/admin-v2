export default function useApi() {
    const getData = async (endpoint) => {
        let response = await axios.get(endpoint)
        return response.data
    }

    const showData = async (endpoint,parameter) => {
        let response = await axios.get(endpoint+'/'+parameter)
        return response.data
    }


    const deleteData = async (endpoint,parameter) => {
        let response = await axios.delete(endpoint+'/'+parameter)
        return response.data
    }


    return {
        getData,
        showData,
        deleteData,
    }
}
