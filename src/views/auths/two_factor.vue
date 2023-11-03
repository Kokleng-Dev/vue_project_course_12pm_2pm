<template>
  <div class="modal fade" id="twoFactor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close" @click="exit()">X</button>
      </div>
      <form action="" method="POST" @submit.prevent="handleSubmit()">
        <div class="modal-body">
            <div class="mb-3">
                <label for="otp">OTP</label>
                <input type="number" v-model="otp" class="form-control" placeholder="input your otp from sms or email">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="exit()">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
</template>

<script>
import { auth } from '../../stores/auth';
export default {
    props : ['userId'],
    data(){
        return {
            otp : ''
        }
    },
    methods : {
        exit(){
            $('#twoFactor').modal('hide');
        },
        async handleSubmit(){
            try {
                const { data } = await this.$http.post('check_otp', {
                    otp : this.otp,
                    user_id : this.userId
                })
                if(data.status == 'success'){
                    this.exit();
                    const defineAuth = auth();
                    defineAuth.login(data);
                    this.$alert({
                        type : 'success',
                        sms : data.sms
                    });
                    this.$router.push('/');
                } else {
                    this.$alert({
                        type : 'warning',
                        sms : data.sms
                    });
                }
            } catch (error) {
                console.log(error)
            }
        }
    }
}
</script>

<style>

</style>