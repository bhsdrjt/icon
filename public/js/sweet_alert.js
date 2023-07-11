
function infosweet(text){
    swal(text, {
        buttons: false,
        timer:2000,
     });
}
function infoSweetConfirm(text){
    swal(text, {
        timer:9000,
     });
}
function sweetSucces(title,text) {
    swal({
        title: title,
        text: text,
        icon: "success",
        button: "OK",
      });
}
function sweetError(title,text) {
    swal({
        title: title,
        text: text,
        icon: "error",
        button: "Kembali",
      });
}
function sweetInfossu(message,list) {
    swal(message)
    .then((value) => {
        swal({
            text: list
        });
    });
    
}
function sweetWarning(title,text){
swal({
    title: title,
    text: text,
    icon: "warning",
    button: "OK",
});
}