
function DisplayError(color, message) {

    console.log(color);
    $.notify({
        icon: color == '2' ? 'ti-check' : "ti-alert",
        message: message

    },{
        type: type[color],
        timer: 4000,
        placement: {
            from: 'top',
            align: 'right'
        }
    });

}