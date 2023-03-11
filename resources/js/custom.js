axios.defaults.baseURL = 'http://admin-v2.test/api/';

$('#changeLang').click(function(){
    if($(this).prop('checked'))
    {
        axios.get('/change_lang/tr').then(function (response) {
            window.location.reload();
          })
          .catch(function (error) {
            console.log(error);
          })
    }
    else
    {
        axios.get('/change_lang/en').then(function (response) {
            window.location.reload();
          })
          .catch(function (error) {
            console.log(error);
          })
    }

})




$('#selectRole').change(function(){
    $('.permCheck').attr('checked', false);
    if(this.value)
    {

        axios.get('/role_permissions/' + this.value).then(function (response) {
            response.data.data.forEach(function (item) {
                $('#perm_'+item.id).attr('checked', true);
            });
         })
         .catch(function (error) {
           console.log(error.data);
         })
    }

})

$('#selectAll').click(function(){

    this.checked ? $('.permCheck').attr('checked', true) :  $('.permCheck').attr('checked', false);

})
