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

                        let result = response.data;

                        if (result.success) {
                            ctx.order_selected_slot();
                            alert("Вы успешно записались на прием! Номер вашего визита: " + result.more.order_id);
                        } else {
                            alert(result.msg);

                            if (result.more.slot_is_not_free) {
                                ctx.order_selected_slot();
                            }
                        }
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
            },
            order_selected_slot(){
                this.selected_slot.is_free = false;
                this.selected_slot.time = " - ";
                this.selected_slot = {};
            }
        },
    });

    return doctorApp;
}
