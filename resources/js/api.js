export default function useApi() {

    const getData = async (endpoint) => {
        try {
            const response = await axios.get(endpoint);
            return response.data;
        } catch (error) {
            return error.message;
        }

    }

    const showData = async (endpoint,parameter) => {
        try {
            const response = await axios.get(endpoint + '/' + parameter)
            return response.data
        } catch (error) {
            return error.message;
        }
    }

    const storeData = async (endpoint,data) => {
        try {
            const response = await axios.post(endpoint, data)
            return response.data
        } catch (error) {
            return error.message;
        }
    }

    const updateData = async (endpoint, parameter, data) => {
        try {
            const response = await axios.put(endpoint + '/' + parameter, data)
            return response.data
        } catch (error) {
            return error.message
        }
    }


    const deleteData = async (endpoint,parameter) => {
        try {
            const response = await axios.delete(endpoint + '/' + parameter)
            return response.data
        } catch (error) {
            return error.message;
        }
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
