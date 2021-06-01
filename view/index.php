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