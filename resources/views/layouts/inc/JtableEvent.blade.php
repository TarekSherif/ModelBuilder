,
//Initialize validation logic when a form is created
formCreated: function (event, data) {
    //
    data.form.validationEngine('attach'+promptPosition);
  //  data.form.validationEngine();
},
//Validate form when it is being submitted
formSubmitting: function (event, data) { 
    return data.form.validationEngine('validate');
    
},
//Dispose validation logic when form is closed
formClosed: function (event, data) {
    data.form.validationEngine('hide');
    data.form.validationEngine('detach');
}
{{-- ,rowUpdated: function (event, data){
    window.location.reload();
} --}}
