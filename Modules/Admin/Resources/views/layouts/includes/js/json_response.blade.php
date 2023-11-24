if(result['success']){
    iziToast.success({
        title: '',
        message: result['success'],
    });
}else if(result['error']){
    iziToast.error({
        title: '',
        message: result['error'],
    });
}else if(result['warning']){
    iziToast.warning({
        title: '',
        message: result['warning'],
    });
}else if(result['info']){
    iziToast.info({
        title: '',
        message: result['info'],
    });
}else{
    iziToast.default({
        title: '',
        message: result['default'],
    });
}