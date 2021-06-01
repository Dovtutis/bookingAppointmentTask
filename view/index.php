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
                        </div>
                        <div class="form-group" id="hour-selector">
                            <label for="time">Select available time:</label>
                            <select name="time" id="time">
                                <option value="8">08:00</option>
                                <option value="9">09:00</option>
                                <option value="10">10:00</option>
                                <option value="11">11:00</option>
                            </select> 
                        </div>
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

</script>