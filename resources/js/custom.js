
// new Choices('.choices');

$('.swalDelete').click(function (e) {

    e.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          this.submit();
        }
      })
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

    var className = '.' + $(this).data('class');
    this.checked ? $(className).attr('checked', true) :  $(className).attr('checked', false);

})


$('.editUser').click(function(){

    axios.get('/user/' + this.id).then(function (response) {
       let data = response.data.data;
       $('#name').val(data.name);
       $('#hidden_id').val(data.id);
       $('#email').val(data.email);
       $('#role').val(data.role_id);
    })
})
