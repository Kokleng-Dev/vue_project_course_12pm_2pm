import {useToast} from 'vue-toast-notification';

  export function alerts(data){
    let { type, sms, position = 'top-right' } = data;
    const toast = useToast();
    toast.open({
        message: sms,
        type: type,
        position: position
    });
}