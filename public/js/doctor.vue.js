/**
 * Created by PhpStorm.
 * Date: 03.12.2018
 * Time: 0:05
 *
 * @author dev@dermanov.ru
 */

function DoctorApp (doctor) {
    let doctorApp = new Vue({
        el: '#doctor_app',
        data: {
            doctor : doctor,
            selected_slot : {},
        },
        computed: {
            selected_datetime(){
                return this.selected_slot.id ? this.selected_slot.date + ' ' + this.selected_slot.time : "";
            }
        },
        methods: {
            order(){
                if (!this.selected_slot.id) {
                    alert("Выберите дату и время в таблице!");
                    return false;
                }

                let formData = new FormData( document.getElementById("order_form") );
                let ctx = this;

                axios({
                    method: 'post',
                    url: '/order',
                    data: formData,
                })
                    .then(function (response) {
                        //handle success
                        console.log(response);

                        alert(response.data.msg);

                        ctx.selected_slot.is_free = false;
                        ctx.selected_slot.time = " - ";
                        ctx.selected_slot = {};
                    })
                    .catch(function (response) {
                        //handle error
                        console.log(response);

                        alert("Что-то пошло не так :( Попробуйте повторить свой запрос позже.");
                    });
            },
            select_slot(slot){
                if (!slot.is_free)
                    return;

                this.selected_slot = slot;
            }
        },
    });

    return doctorApp;
}
