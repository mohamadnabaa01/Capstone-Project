
function OpenGift() {
    const gift_div = document.getElementById("id01");
    const gift = document.querySelector(".present");
    gift_div.style.display = "block";
    gift.style.display = "none";
}

function CloseGift() {
    const gift_div = document.getElementById("id01");
    const gift = document.querySelector(".present");
    gift_div.style.display = "none";
    gift.style.display = "block";
}

function OpenAppointmentBooking(button) {
    const appointment_book_div = document.getElementById("appointment-schedule");
    const book_button = button;
    appointment_book_div.style.display = "block";
}

function CloseAppointmentBooking() {
    const appointment_book_div = document.getElementById("appointment-schedule");
    appointment_book_div.style.display = "none";
}




// trying calendar here
const date = new Date();
var newDate = new Date();
var currentDate;
var Month;
var Day;

const renderCalender = () => {
    date.setDate(1);
    const monthDays = document.querySelector('.days');
    const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
    const prevLastDay = new Date(date.getFullYear(), date.getMonth(), 0).getDate();
    const firstDayIndex = date.getDay();
    const lastDayIndex = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDay();
    const nextDays = 7 - lastDayIndex - 1;
    const month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    document.querySelector('.date h1').innerHTML = month[date.getMonth()];


    document.querySelector('.date p').innerHTML = new Date().toDateString();


    let days = "";

    for (let x = firstDayIndex; x > 0; x--) {
        days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
    }
    for (let i = 1; i <= lastDay; i++) {
        if (i == new Date().getDate() && date.getMonth() == new Date().getMonth()) {
            days += `<div class="today" onclick="SetToCurrentDay(this)"> ${i} </div>`;
            newDate.setMonth(new Date().getMonth());
            newDate.setDate(new Date().getDate());

            if (newDate.getMonth() < 10) {
                Month = "0" + newDate.getMonth();
            }
            else {
                Month = newDate.getMonth();
            }
            if (newDate.getDate() < 10) {
                Day = "0" + newDate.getDate();
            }
            else {
                Day = newDate.getDate();
            }
            currentDate = newDate.getFullYear() + "-" + Month + "-" + Day;
        }
        if ((i < new Date().getDate() && date.getMonth() == new Date().getMonth()) || date.getMonth() < new Date().getMonth()) {
            days += `<div class="prev-date">${i}</div>`;
        }
        if (i > new Date().getDate() && date.getMonth() == new Date().getMonth() || date.getMonth() > new Date().getMonth()) {
            days += `<div class="otherdays" onclick="SetToCurrentDay(this)"> ${i} </div>`;
        }

    }
    for (let j = 1; j <= nextDays; j++) {
        days += `<div class="next-date">${j}</div>`;
        monthDays.innerHTML = days;
    }
}
function SetToCurrentDay(element) {
    const currentDay = document.querySelector('.today');
    const thisDay = element;
    if (currentDay != null) {
        currentDay.classList.remove('today');
        currentDay.classList.add('otherdays');
    }
    thisDay.classList.remove('otherdays');
    thisDay.classList.add('today');
    newDate.setMonth(date.getMonth());
    newDate.setDate(thisDay.innerHTML);
    // const array = newDate.toDateString().split(" ");
    // const day = array[2];
    // const month = array[1];
    // const year = array[3];
    if (newDate.getMonth() < 10) {
        Month = "0" + newDate.getMonth();
    }
    else {
        Month = newDate.getMonth();
    }
    if (newDate.getDate() < 10) {
        Day = "0" + newDate.getDate();
    }
    else {
        Day = newDate.getDate();
    }
    currentDate = newDate.getFullYear() + "-" + Month + "-" + Day;
    // console.log(day);
    // console.log(month);
    // console.log(year);
    // window.location="../calendar/calendar.php?getday=day&getmonth=month&getyear=year";
    document.querySelector('.date p').innerHTML = newDate.toDateString();
}

function SubmitAppointment() {
    var hours = document.getElementsByName('appointments_time');
    for (let hour of hours) {
        if (hour.checked) {
            window.location = window.location.href + "&appointments_time=" + hour.value + "&date=" + currentDate;
        }
    }
}

document.querySelector('.prev').addEventListener('click', () => {
    date.setMonth(date.getMonth() - 1);
    renderCalender();
})

document.querySelector('.next').addEventListener('click', () => {
    date.setMonth(date.getMonth() + 1);
    renderCalender();
})
renderCalender();
