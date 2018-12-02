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

                document.getElementById("order_form").submit();
            }
        },
    });

    return doctorApp;
}