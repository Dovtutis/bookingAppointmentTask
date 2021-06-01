<main>
    <div id="main-container">   
        <div id="registration-container">
            <h2 class="title-text">Book an appointment for Dr. John Doktor</h2>
            <form action="POST" autocomplete="off" id="appointment-form">
                <div id="form-container">
                    <div id="name-lastname-container">
                        <div class="form-group">
                            <label for="name">Your Name:<sup>*</sup></label>
                            <input type="text" class="form-control form-control-lg"
                                name="name" id="name" value="">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Your Lastname:<sup>*</sup></label>
                            <input type="text" class="form-control form-control-lg"
                                name="lastname" id="lastname" value="">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div id="date-container">
                        <div class="form-group">
                            <label for="day">Select available day:</label>
                            <input type="date" id="day" name="day"> 
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group" id="hour-selector">
                            <label for="time">Select available time:</label>
                            <select name="time" id="time">
                                <option value="8">08:00</option>
                                <option value="9">09:00</option>
                                <option value="10">10:00</option>
                                <option value="11">12:00</option>
                                <option value="11">13:00</option>
                                <option value="11">14:00</option>
                                <option value="11">15:00</option>
                                <option value="11">16:00</option>
                                <option value="11">17:00</option>
                                <option value="11">18:00</option>
                            </select> 
                            <span class="invalid-feedback"></span>
                        </div>
                        <button type="submit" class="submit-button">
                            Book an appointment
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div id="calendar-container">
            <div id="calendar">
                <div class="month">
                    <i class="fas fa-angle-left prev"></i>
                    <div class="date">
                        <h1></h1>
                        <p></p>
                    </div>
                    <i class="fas fa-angle-right next"></i>
                </div>
                <div class="weekdays">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wen</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                <div class="days">

                </div>
            </div>
        </div>
    </div>
</main>
<footer>
    <div id="index-footer-container">
        © 2021. Dovydas Tutinas, all rights reserved.
    </div>
</footer>


<script>
    const appointmentFormEl = document.getElementById('appointment-form');
    const nameInputEl = document.getElementById('name');
    const lastnameInputEl = document.getElementById('lastname');
    const dayInputEl = document.getElementById('day');
    const timeInputEl = document.getElementById('time');
    const date = new Date();

    const renderCalendar = () => {
        date.setDate(1);
        const firstDayIndex = date.getDay();
        const months = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ];
        const monthDays = document.querySelector('.days');
        const lastDay = new Date(date.getFullYear(), date.getMonth() +1, 0).getDate();
        const prevLastDay = new Date(date.getFullYear(), date.getMonth(), 0).getDate();
        const lastDayIndex = new Date(date.getFullYear(), date.getMonth() +1, 0).getDay();
        const nextDays = 7 -lastDayIndex - 1;

        document.querySelector('.date h1').innerHTML = months[date.getMonth()];
        document.querySelector('.date p').innerHTML = new Date().toDateString();

        let days = "";

        for (let x = firstDayIndex; x > 0; x--) {
            days += `<div class="prev-date">${prevLastDay - x + 1}</div>`   
        }

        for (let i = 1; i <= lastDay; i++) {
            if (i === new Date().getDate() && date.getMonth() === new Date().getMonth()) {
                days += `<div class="today">${i}</div>`;
            }else {
                days += `<div>${i}</div>`;
            }
        }

        for (let j = 1; j <= nextDays; j++) {
            days += `<div class="next-date">${j}</div>`
        }

        monthDays.innerHTML = days;
    }

    document.querySelector('.prev').addEventListener('click', () => {
        date.setMonth(date.getMonth() - 1);
        renderCalendar();
    });

    document.querySelector('.next').addEventListener('click', () => {
        date.setMonth(date.getMonth() + 1);
        renderCalendar();
    });

    renderCalendar();

    appointmentFormEl.addEventListener('submit', addAnAppointment);

    function addAnAppointment(event) {
        event.preventDefault();
        resetErrors();

        const formData = new FormData(appointmentFormEl);

        fetch('/', {
            method: 'post',
            body: formData
        }).then(resp => resp.json())
            .then(data => {
                console.log(data)
                if (data.errors){
                    handleErrors(data.errors);
                }
            }).catch(error => console.error())
    }

    function handleErrors(errors) {

        if (errors['nameError'] !== "") {
            nameInputEl.classList.add('is-invalid');
            nameInputEl.nextElementSibling.innerHTML = errors['nameError'];
        }

        if (errors['lastnameError'] !== "") {
            lastnameInputEl.classList.add('is-invalid');
            lastnameInputEl.nextElementSibling.innerHTML = errors['lastnameError'];
        }

        if (errors['dayError'] !== "") {
            dayInputEl.classList.add('is-invalid');
            dayInputEl.nextElementSibling.innerHTML = errors['dayError'];
        }

        if (errors['timeError'] !== "") {
            timeInputEl.classList.add('is-invalid');
            timeInputEl.nextElementSibling.innerHTML = errors['timeError'];
        }
    }

    function resetErrors(){
        const errorEl = appointmentFormEl.querySelectorAll('.is-invalid');
        errorEl.forEach((element) => {
            element.classList.remove('is-invalid');
        });
    }
</script>