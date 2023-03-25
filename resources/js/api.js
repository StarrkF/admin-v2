export default function useApi() {

    const getData = async (endpoint, page = 1, type = null, search = null, pagination = 10, orderBy = null) => {
        return await axios.get(endpoint, { params: { type: type, search: search, page: page, pagination: pagination, orderBy: orderBy } })
            .then(function (response) {
                return response.data
            })
            .catch(function (error) {
                error.message
            });
    }

    const showData = async (endpoint, parameter) => {

        return await axios.get(endpoint + '/' + parameter)
            .then(function (response) {
                return response.data
            })
            .catch(function (error) {
                return error.message
            })

    }

    const storeData = async (endpoint, data) => {
        return await axios.post(endpoint, data)
            .then(function (response) {
                return response.data
            })
            .catch(function (error) {
                return error.message
            })
    }

    const updateData = async (endpoint, parameter, data) => {

        return await axios.put(endpoint + '/' + parameter, data)
            .then(function (response) {
                return response.data
            })
            .catch(function (error) {
                return error.message
            })
    }


    const deleteData = async (endpoint, parameter) => {
        return await axios.delete(endpoint + '/' + parameter)
            .then(function (response) {
                return response.data
            })
            .catch(function (error) {
                return error.message
            })
    }

    const swalSuccess = (message = 'Completed!') => {
        Swal.fire(
            'Good job!',
            message,
            'success'
        )
    }

    const swalError = (message = 'Did not complete!') => {
        Swal.fire({
            icon: 'error',
            title: message,
            text: 'Something went wrong!',
        })
    }

    const swalTrigger = (process, message = 'Complete!') => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let response = await process()
                response ? swalSuccess() : swalError()
            }

        })
    }

    return {
        getData,
        showData,
        deleteData,
        storeData,
        updateData,
        swalSuccess,
        swalError,
        swalTrigger
    }
}
